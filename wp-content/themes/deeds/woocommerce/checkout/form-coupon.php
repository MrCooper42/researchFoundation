<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */
if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
?>
<?php
global $woocommerce;

if ( !WC()->cart->coupons_enabled() )
	return;

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'wp_deeds' ) );
$info_message .= ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'wp_deeds' ) . '</a>';
wc_print_notice( $info_message, 'notice' );
?>

<form class="checkout_coupon" method="post" style="display:none">

	<div class="col-md-6 co-form half-field">
        <p class="form-row form-row-first">
            <input type="text" name="coupon_code" class="input-text" placeholder="<?php _e( 'Coupon code', 'wp_deeds' ); ?>" id="coupon_code" value="" />
        </p>
	</div>
    <div class="clearfix"></div>
	<div class="col-md-6 co-form half-field">
        <p class="form-row form-row-last">
            <input type="submit" class="cart-btn pull-right" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'wp_deeds' ); ?>" />
        </p>
    </div>

	<div class="clear"></div>
</form>
</div>
