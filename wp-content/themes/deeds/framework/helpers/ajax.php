<?php

class SH_Ajax {

	function __construct() {
		add_action( 'wp_ajax_dictate_ajax_callback', array( $this, 'ajax_handler' ) );
		add_action( 'wp_ajax_nopriv_dictate_ajax_callback', array( $this, 'ajax_handler' ) );
		require_once( ABSPATH . WPINC . '/class-phpmailer.php' );
	}

	function ajax_handler() {
		$method = sh_set( $_REQUEST, 'subaction' );

		if ( method_exists( $this, $method ) )
			$this->$method();

		exit;
	}

	function sh_contact_form_submit() {
		if ( !count( $_POST ) )
			return;
			
		_load_class( 'validation', 'helpers', true );
		$t = &$GLOBALS['_sh_base'];
		$settings = get_option( 'wp_deeds' . '_theme_options' );
		$t->validation->set_rules( 'name', '<strong>' . __( 'Name', 'wp_deeds' ) . '</strong>', 'required|min_length[4]|max_lenth[30]' );
		$t->validation->set_rules( 'email', '<strong>' . __( 'Email', 'wp_deeds' ) . '</strong>', 'required|valid_email' );
		$t->validation->set_rules( 'comments', '<strong>' . __( 'Message', 'wp_deeds' ) . '</strong>', 'required|min_length[5]' );
		
		require_once(SH_ROOT.'/framework/helpers/recaptchalib.php');
		$response = null;
		$secret = $_POST['site_key'];
		$reCaptcha = new ReCaptcha($secret);
		
		
		if ($_POST["captcha"]) {
            $response = $reCaptcha->verifyResponse(
                $_SERVER["REMOTE_ADDR"],
                $_POST["captcha"]
            );
        }
        
        

		$messages = '';

		if ( $t->validation->run() !== FALSE && empty( $t->validation->_error_array ) ) {

			$name = $t->validation->post( 'name' );
			
			$email = $t->validation->post( 'email' );
			$message = $t->validation->post( 'comments' );
			$contact_to = (sh_set($_POST, 'to_email')) ? sh_set($_POST, 'to_email') : get_option( 'admin_email' );

			$headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n";
			
			if ( $response != null && $response->success) {
			wp_mail( $contact_to, __( 'Contact Us Message', 'wp_deeds' ), $message, $headers );
			$message = sh_set( $settings, 'success_message' ) ? $settings['success_message'] : sprintf( __( 'Thank you <strong>%s</strong> for using our contact form! Your email was successfully sent and we will be in touch with you soon.', 'wp_deeds' ), $name );
			$messages = '<div class="alert alert-success">
							<p>' . __( 'SUCCESS! ', 'wp_deeds' ) . $message . '</p>
						</div>';
			}else {
			    $messages .= '<div class="alert alert-error">
							<p>'. __( 'Error! Invalid Captcha ', 'wp_deeds' ) .'</p>
						</div>';
			}
		} else {
			if ( is_array( $t->validation->_error_array ) ) {
				foreach ( $t->validation->_error_array as $msg ) {
					$messages .= '<div class="alert alert-error">
										<p>' . __( 'Error! ', 'wp_deeds' ) . $msg . '</p>
									</div>';
				}
			}
		}
		echo $messages;
		exit;
		//return $messages;
	}

	function wishlist() {
		global $current_user;
		get_currentuserinfo();

		if ( is_user_logged_in() ) {

			$meta = get_user_meta( $current_user->ID, '_os_product_wishlist', true );
			$data_id = sh_set( $_POST, 'data_id' );
			if ( $meta && is_array( $meta ) ) {
				if ( in_array( $data_id, $meta ) ) {
					exit( json_encode( array( 'code' => 'exists', 'msg' => __( 'You have already added this product to wish list', 'wp_deeds' ) ) ) );
				}
				$newmeta = array_merge( array( sh_set( $_POST, 'data_id' ) ), $meta );
				update_user_meta( $current_user->ID, '_os_product_wishlist', $newmeta );
				exit( json_encode( array( 'code' => 'success', 'msg' => __( 'Product successfully added to wishlist', 'wp_deeds' ) ) ) );
			} else {
				update_user_meta( $current_user->ID, '_os_product_wishlist', array( sh_set( $_POST, 'data_id' ) ) );
				exit( json_encode( array( 'code' => 'success', 'msg' => __( 'Product successfully added to wishlist', 'wp_deeds' ) ) ) );
			}
		} else
			exit( json_encode( array( 'code' => 'fail', 'msg' => __( 'Please login first to add the product to your wishlist', 'wp_deeds' ) ) ) );
	}

	function wishlist_del() {
		global $current_user;
		get_currentuserinfo();

		if ( is_user_logged_in() ) {

			$meta = get_user_meta( $current_user->ID, '_os_product_wishlist', true );
			$data_id = sh_set( $_POST, 'data_id' );
			//echo array_search( $data_id, $meta );exit;
			if ( $meta && is_array( $meta ) ) {
				$searched = array_search( $data_id, $meta );
				if ( isset( $meta[$searched] ) ) {
					unset( $meta[$searched] );
					update_user_meta( $current_user->ID, '_os_product_wishlist', array_unique( $meta ) );
					exit( json_encode( array( 'code' => 'del', 'msg' => __( 'Product is successfully deleted from wishlist', 'wp_deeds' ) ) ) );
				} else
					exit( json_encode( array( 'code' => 'fail', 'msg' => __( 'Unable to find this product into wishlist', 'wp_deeds' ) ) ) );
			}else {
				update_user_meta( $current_user->ID, '_os_product_wishlist', array( sh_set( $_POST, 'data_id' ) ) );
				exit( json_encode( array( 'code' => 'fail', 'msg' => __( 'Unable to retrieve your wishlist', 'wp_deeds' ) ) ) );
			}
		} else
			exit( json_encode( array( 'code' => 'fail', 'msg' => __( 'Please login first to add/delete product in your wishlist', 'wp_deeds' ) ) ) );
	}

	function sh_get_paypal_button() {
		$settings = get_option( 'wp_deeds' . '_theme_options' );
		$paypal = $GLOBALS['_sh_base']->donation;
		$symbol = sh_set( $settings, 'currency_symbol', '$' );
		$sh_currency_code = sh_set( $settings, 'currency_code', 'USD' );
		$return_url = $_SERVER['HTTP_REFERER'];

		if ( isset( $_POST['period'] ) && $_POST['period'] == '1' ) {
			echo $paypal->button( array( 'currency_code' => $sh_currency_code, 'item_name' => get_bloginfo( 'name' ), 'return' => $return_url ) );
		} else {
			echo $paypal->recuring_payment( array( 'item_name' => get_bloginfo( 'name' ), 'return' => $return_url ) );
		}

		die();
	}

	function sh_confirm_order() {

		include(get_template_directory() . '/framework/modules/pp_recurring/order_confirm.php');
		die();
	}

	function sh_meet_me() {
		if ( !count( $_POST ) )
			return;
		$settings = get_option( 'wp_deeds' . '_theme_options' );
		$gender = sh_set( $_POST, 'gender' );
		$age = sh_set( $_POST, 'age' );
		$cntry = sh_set( $_POST, 'cntry' );
		$name = sh_set( $_POST, 'name' );
		$email = sh_set( $_POST, 'email' );
		$sender = sh_set( $_POST, 'sender_email' );
		$msg = sh_set( $_POST, 'msg' );
		if ( sh_set( $_POST, 'sender_email' ) ) {
			$contact_to = ( sh_set( $settings, 'contact_email' ) );
		} else {
			$contact_to = get_option( 'admin_email' );
		}

		$headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n";
		if ( wp_mail( $contact_to, __( 'Meet A Request', 'wp_deeds' ), $msg, $headers ) ) {

			$message = sh_set( $settings, 'success_message' ) ? $settings['success_message'] : sprintf( __( 'Your Request was successfully sent and we will be in touch with you soon.', 'wp_deeds' ), $name );
			echo $message;
		} else {
			echo __( 'The message was not sent!', 'wp_deeds' );
		}
	}

	function sh_prayers() {
		if ( !count( $_POST ) )
			return;
		global $wpdb;
		$wpdb->show_errors();

		$name = sh_set( $_POST, 'name' );
		$email = sh_set( $_POST, 'email' );
		$message = sh_set( $_POST, 'message' );

		$date = date( 'Y-m-d h:i:s' );
		$table_name = $wpdb->prefix . "prayers";
		if ( $wpdb->insert( $table_name, array( 'name' => $name, 'email' => $email, 'message' => $message, 'date' => $date, 'status' => 'unapprove' ) ) === false ) {
			$wpdb->print_error();
		} else {
			_e( 'Your Request was successfully sent and we will be in touch with you soon.', 'wp_deeds' );
		}
	}

	function sh_footer_contact_form() {
		if ( !count( $_POST ) )
			return;
		$settings = get_option( 'wp_deeds' . '_theme_options' );
		$name = sh_set( $_POST, 'name' );
		$email = sh_set( $_POST, 'email' );
		$msg = sh_set( $_POST, 'comments' );
		$sender = sh_set( $_POST, 'sender' );

		if ( sh_set( $_POST, 'sender' ) ) {
			$contact_to = ( sh_set( $_POST, 'sender' ) );
		} else {
			$contact_to = get_option( 'admin_email' );
		}
		$headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=" . get_bloginfo( 'charset' ) . "" . "\r\n";

		if ( wp_mail( $contact_to, __( 'Meet A Request', 'wp_deeds' ), $msg ) ) {

			$message = sh_set( $settings, 'success_message' ) ? $settings['success_message'] : sprintf( __( 'Your Request was successfully sent and we will be in touch with you soon.', 'wp_deeds' ), $name );
			echo $message;
		} else {
			echo $GLOBALS['phpmailer']->ErrorInfo;
			//echo __( 'The message was not sent!', 'wp_deeds' );
		}
	}

}
