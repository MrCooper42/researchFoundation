<?php

class SH_Donation {

	var $_settings;
	var $_paypal;
	var $_paypal_settings;

	function __construct() {
		require_once(get_template_directory() . '/framework/modules/libpaypal.php');
		$this->_settings = get_option( 'wp_deeds' . '_theme_options' );

		//Create the authentication
		$pp_type = (sh_set( $this->_settings, 'paypal_type' ) == 'sandbox') ? true : false;
		$auth = new PaypalAuthenticaton( sh_set( $this->_settings, 'paypal_username' ), sh_set( $this->_settings, 'paypal_api_username' ), sh_set( $this->_settings, 'paypal_api_password' ), sh_set( $this->_settings, 'paypal_api_signature' ), $pp_type );

		//Create the paypal object
		$this->_paypal = new Paypal( $auth );
		$this->_paypal_settings = new PaypalSettings();
		$this->_paypal_settings->allowMerchantNote = true;
		$this->_paypal_settings->logNotifications = true;

		//the base url
		$this->return_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}

	/**
	 * This method is used to return button output or echo output
	 *
	 * @param	$settings	array	array of settings.
	 * return	null
	 */
	function button( $settings = array() ) {

		$action = $this->_paypal->getButtonAction(); //get button action

		/** merge settings */
		$this->args = $settings;
		$default = array( 'currency_code' => '', 'cmd' => '_donations', 'item_name' => __( 'Donation', 'wp_deeds' ), 'label' => __( 'DONATE', 'wp_deeds' ) );
		$this->args = wp_parse_args( $this->args, $default );

		/** get donation button params */
		$products = array();
		$params = $this->_paypal->getButtonParams( $products, $this->action( 'paid' ), $this->action( 'cancel' ), $this->action( 'notify' ) ); //get params for the form

		$params['currency_code'] = sh_set( $this->args, 'currency_code' );
		$params['cmd'] = '_donations';
		$params['item_name'] = sh_set( $this->args, 'item_name' );

		/** Create donation button */
		$output = '<form action="' . $action . '" method="post">';

		foreach ( $params as $key => $value ) {
			$output .= '<input type="hidden" name="' . $key . '" value="' . $value . '"/>';
		}

		$output .='<input type="text" name="amount" id="textfield" placeholder="' . __( 'ENTER YOUR AMOUNT PLEASE', 'wp_deeds' ) . '" value="">';


		$output .= '<button type="submit" class="' . sh_set( $this->args, 'btn_class', 'donate-btn' ) . '">' . sh_set( $this->args, 'label', __( 'DONATE', 'wp_deeds' ) ) . '</button>';
		$output .= '</form>';

		if ( sh_set( $this->args, 'echo' ) )
			echo $output;
		else
			return $output;
	}

	/**
	 * This method is used to return button output or echo output
	 *
	 * @param	$settings	array	array of settings.
	 * return	null
	 */
	function recuring_payment( $settings = array() ) {
		$this->args = $settings;
		$donation_data = get_option( 'wp_deeds' . '_theme_options' );


		$currency_code = sh_set( $donation_data, 'currency_code', 'USD' );
		$currency_symbol = sh_set( $donation_data, 'currency_symbol', '$' );
		$sh_donation_collected = sh_set( $donation_data, 'donation_collected' );



		$output = '<form method="post" action="">
					<input type="hidden" value="Lifeline" name="item_name">
					<input type="hidden" value="' . $currency_code . '" name="currency_code">
					<input type="hidden" value="' . $sh_donation_collected . '" name="raised_amount">
					<input type="hidden" value="' . $currency_symbol . '" name="currency_symbol">
					<input id="billing-period" type="hidden" value="" name="billing_period">
					<input id="billing-frequency" type="hidden" value="" name="billing_frequency">
					<input type="text" placeholder="ENTER YOUR AMOUNT PLEASE" value="" id="textfield" name="amount">';
		$output .='<button class="donate-btn" type="submit" name="recurring_pp_submit">DONATE NOW</button>
				</form>';
		if ( sh_set( $this->args, 'echo' ) )
			echo $output;
		else
			return $output;
	}

	/** create button return url with action */
	function action( $action ) {
		$return = ( sh_set( $this->args, 'return' ) ) ? sh_set( $this->args, 'return' ) : $this->return_url;

		return add_query_arg( array( 'action' => $action ), $return );
	}

	function single_pament_result( $responce = array() ) {

		if ( isset( $responce->ok ) ) {




			$theme_options = get_option( 'wp_deeds' . '_theme_options' );

			$target_amount = (sh_set( $theme_options, 'donation_collected' )) ? (int) str_replace( ',', '', sh_set( $theme_options, 'donation_collected' ) ) + sh_set( $responce, 'amount' ) : '';
			if ( $target_amount > 0 ) {
				$theme_options['donation_collected'] = $target_amount;
			}
			update_option( 'wp_deeds' . '_theme_options', $theme_options );
			$donation_transaction = array();
			$donation_transaction = (get_option( 'general_donation' )) ? get_option( 'general_donation' ) : array();


			array_push( $donation_transaction, array(
				'transaction_id' => $responce->transactionId,
				'transaction_type' => $responce->transactionType,
				'payment_type' => $responce->type,
				'order_time' => date( 'c', $responce->date ),
				'amount' => $responce->amount,
				'currency_code' => $responce->currency,
				'fee_amount' => $responce->fee,
				'settle_amount' => $responce->currencyCorrect,
				'payment_status' => $responce->status,
				'pending_reason' => $responce->pendingReason,
				'payer_id' => $responce->buyer->id,
				'ship_to_name' => $responce->buyer->firstName . ' ' . $responce->buyer->lastName,
				'donation_type' => 'Single',
			) );
			update_option( 'general_donation', $donation_transaction );


			$user_data_old = (get_option( 'trasaction_user_data' )) ? get_option( 'trasaction_user_data' ) : array();
			$user_data = array( $responce->buyer->id => array(
					'fistname' => $responce->buyer->firstName,
					'lastName' => $responce->buyer->lastName,
					'email' => $responce->buyer->email,
					'business' => $responce->buyer->business,
					'phone' => $responce->buyer->phone,
					'status' => $responce->buyer->status,
					'addressCountry' => $responce->buyer->addressCountry,
					'addressCountryCode' => $responce->buyer->addressCountryCode,
					'addressZip' => $responce->buyer->addressZip,
					'addressState' => $responce->buyer->addressState,
					'addressCity' => $responce->buyer->addressCity,
					'addressStreet' => $responce->buyer->addressStreet,
					'addressName' => $responce->buyer->addressName,
					'addressStatus' => $responce->buyer->addressStatus,
				)
			);
			$user_data_new = array_merge( $user_data_old, $user_data );
			update_option( 'trasaction_user_data', $user_data_new );

			return "Thank you for your payment.";
		}
	}

	/**
	 * This function is used to save transaction into database.
	 * @param	$data	array	array of data transaction response from paypal.
	 * return	null
	 */
	function result( $data = array() ) {
		global $wpdb;

		if ( !$_POST )
			return;

		$data = !( $data ) ? $this->_paypal->handleNotification() : $data;

		if ( !$data )
			return;

		$array = array( 'transID' => $data->transactionId, 'status' => $data->status, 'total' => $data->total, 'donalID' => $data->buyer->id,
			'donalName' => $data->buyer->firstName . ' ' . $data->buyer->lastName, 'donalEmail' => $data->buyer->email, 'note' => $data->products[0]->name,
			'data' => serialize( $data ), 'date' => date( 'Y-m-d H:i:s', $data->date )
		);

		if ( $transID = $wpdb->get_row( "SELECT `transID` FROM `" . $wpdb->prefix . "donation` WHERE `transID` = '" . $data->transactionId . "'" ) ) {
			_e( '<p class="errormsg donationmsg">The transaction is already in our record.</p>', 'wp_deeds' );
		} elseif ( $data->status == 'Completed' ) {
			$result = $wpdb->insert( 'fw_donation', $array );
			if ( $result )
				echo '<p class="successmsg donationmsg">' . __( 'Thank you for your donation.', 'wp_deeds' ) . '</p>';
		}
		else {
			$result = $wpdb->insert( 'fw_donation', $array );
			echo '<p class="errormsg donationmsg">' . __( 'Sorry! unfortunetly the transaction is failed.', 'wp_deeds' ) . '</p>';
		}
	}

}
