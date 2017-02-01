<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */
if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

global $woocommerce;
?>
<section>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
					<?php
					wc_print_notices();

					do_action( 'woocommerce_before_checkout_form', $checkout );

					// If checkout registration is disabled and not logged in, the user cannot checkout
					if ( !$checkout->enable_signup && !$checkout->enable_guest_checkout && !is_user_logged_in() ) {
						echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'wp_deeds' ) );
						return;
					}

					// filter hook for include new pages inside the payment method
					$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() );
					?>

                    <form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">

						<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

							<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
							<div class="checkout-block">
								<p><input class="billing-add" type="radio" value="Billing Address" name="choice2" /><label>Billing Address</label></p>
								<p><input class="shipping-add" type="radio" value="Shipping Address" name="choice2" /><label>Shipping Address</label></p>
							</div>



							<?php do_action( 'woocommerce_checkout_billing' ); ?>



							<?php do_action( 'woocommerce_checkout_shipping' ); ?>





							<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>


						<?php endif; ?>

						<?php do_action( 'woocommerce_checkout_order_review' ); ?>

                    </form>

					<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

                </div>
            </div>
        </div>
    </div>
</section>
