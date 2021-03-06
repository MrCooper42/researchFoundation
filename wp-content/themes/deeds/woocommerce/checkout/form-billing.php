<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.2
 */
if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
?>
<div class="billing-address checkout-block">

    <div class="checkout-block">
		<?php if ( WC()->cart->ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>


			<h5><?php _e( 'Billing &amp; Shipping', 'wp_deeds' ); ?></h5>


		<?php else : ?>


			<h5><?php _e( 'Billing Address', 'wp_deeds' ); ?></h5>


		<?php endif; ?>

		<div class="checkout-content">

			<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

			<?php foreach ( $checkout->checkout_fields['billing'] as $key => $field ) : ?>

				<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

			<?php endforeach; ?>

			<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>

		</div>
	</div>

</div>

<?php if ( !is_user_logged_in() && $checkout->enable_signup ) : ?>

	<div class="checkout-block">

		<h5><?php _e( 'CLICK HERE TO SIGN UP', 'wp_deeds' ); ?></h5>

		<div class="checkout-content">

			<?php if ( $checkout->enable_guest_checkout ) : ?>

				<p class="form-row form-row-wide create-account">
					<input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'wp_deeds' ); ?></label>
				</p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

			<?php if ( !empty( $checkout->checkout_fields['account'] ) ) : ?>

				<div class="create-account">

					<p><?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'wp_deeds' ); ?></p>

					<?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

						<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

					<?php endforeach; ?>

					<div class="clear"></div>

				</div>

			<?php endif; ?>

			<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
		</div>


	</div>

<?php endif; ?>
