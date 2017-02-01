<?php

/**
 * Email Addresses (plain)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails/Plain
 * @version     2.2.0
 */
if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

echo "\n" . __( 'Billing address', 'wp_deeds' ) . ":\n";
echo $order->get_formatted_billing_address() . "\n\n";

if ( get_option( 'woocommerce_ship_to_billing_address_only' ) == 'no' && ( $shipping = $order->get_formatted_shipping_address() ) ) :

	echo __( 'Shipping address', 'wp_deeds' ) . ":\n";

	echo $shipping . "\n\n";

endif;
