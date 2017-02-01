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
		$auth = new PaypalAuthenticaton( sh_set( $this->_settings, 'paypal_api_email' ), sh_set( $this->_settings, 'paypal_api_username' ), sh_set( $this->_settings, 'paypal_api_password' ), sh_set( $this->_settings, 'paypal_api_signature' ), $pp_type );

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
		$default = array( 'currency_code' => 'USD', 'cmd' => '_donations', 'item_name' => __( 'Donation', 'wp-deeds' ), 'label' => __( 'DONATE NOW', 'wp-deeds' ), 'amount' => 10, );
		$this->args = wp_parse_args( $this->args, $default );

		/** get donation button params */
		$products = array();
		$params = $this->_paypal->getButtonParams( $products, sh_set( $this->args, 'return' ), $this->action( 'cancel' ), $this->action( 'notify' ) ); //get params for the form

		/* unset($params['currency_code']);
		  unset($params['amount']); */
//printr($this->args);
		$params['currency_code'] = sh_set( $this->args, 'currency_code' );
		$params['cmd'] = '_donations';
		$params['charset'] = 'utf-8';
		$params['rm'] = '2';
		$params['amount'] = sh_set( $this->args, 'amount' );
		$params['item_name'] = sh_set( $this->args, 'item_name' );


//if ( is_user_logged_in() ) {
		/** Create donation button */
		$output = '<form action="' . $action . '" method="post">';
		unset( $params['undefined_quantity'] );
		unset( $params['amount'] );
		foreach ( $params as $key => $value ) {
			$output .= '<input type="hidden" name="' . $key . '" value="' . $value . '"/>';
		}
		$output .= '<input type="text" name="amount" required="required" id="textfield" value="" placeholder="' . __( 'ENTER YOUR AMOUNT PLEASE', 'wp-deeds' ) . '">';
		$output .= '<button type="submit" class="' . sh_set( $this->args, 'btn_class', 'donate-btn' ) . '">' . sh_set( $this->args, 'label', __( 'DONATE NOW', 'wp-deeds' ) ) . '</button>';
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
		$sh_donation_collected = sh_set( $donation_data, 'donation_collected' );
		$output = '';
		$output .= '<form method="post" action="">
					<input type="hidden" value="' . get_bloginfo( 'name' ) . '" name="item_name">
					<input type="hidden" value="' . sh_set( $donation_data, 'currency_code' ) . '" name="currency_code">
					<input type="hidden" value="' . $sh_donation_collected . '" name="raised_amount">
					<input id="billing-period" type="hidden" value="" name="billing_period">

<input id="billing-frequency" type="hidden" value="" name="billing_frequency">
					<input type="text" placeholder="ENTER YOUR AMOUNT PLEASE" value="" id="textfield" name="amount">';
		$output .='<button class="donate-btn" type="submit" name="recurring_pp_submit">' . __( 'DONATE NOW', 'wp-deeds' ) . '</button>
				</form>';

		if ( sh_set( $this->args, 'echo' ) )
			echo $output;
		else
			return $output;
	}

	function single_pament_result( $responce = array() ) {

		if ( isset( $responce->ok ) ) {
			$theme_options = get_option( 'wp_deeds' . '_theme_options' );

			$target_amount = (sh_set( $theme_options, 'paypal_raised' )) ? (int) str_replace( ',', '', sh_set( $theme_options, 'paypal_raised' ) ) + sh_set( $responce, 'amount' ) : '';
			if ( $target_amount > 0 ) {
				$theme_options['paypal_raised'] = $target_amount;
			}
			update_option( 'wp-deeds', $theme_options );
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
		}
		return __( "Thank you for your payment.", 'wp-deeds' );
	}

	/** create button return url with action */
	function action( $action ) {
		$return = ( sh_set( $this->args, 'return' ) ) ? sh_set( $this->args, 'return' ) : $this->return_url;
		return add_query_arg( array( 'action' => $action ), $return );
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
			_e( '<p class="errormsg donationmsg">The transaction is already in our record.</p>', 'wp-deeds' );
		} elseif ( $data->status == 'Completed' ) {
			$result = $wpdb->insert( 'fw_donation', $array );
			if ( $result )
				echo '<p class="successmsg donationmsg">' . __( 'Thank you for your donation.', 'wp-deeds' ) . '</p>';
		}
		else {
			$result = $wpdb->insert( 'fw_donation', $array );
			echo '<p class="errormsg donationmsg">' . __( 'Sorry! unfortunetly the transaction is failed.', 'wp-deeds' ) . '</p>';
		}
	}

}
