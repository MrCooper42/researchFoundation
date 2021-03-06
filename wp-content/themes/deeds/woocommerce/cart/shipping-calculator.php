<?php
/**
 * Shipping Calculator
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.8
 */
if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

global $woocommerce;

if ( get_option( 'woocommerce_enable_shipping_calc' ) === 'no' || !WC()->cart->needs_shipping() )
	return;
?>

<?php do_action( 'woocommerce_before_shipping_calculator' ); ?>
<div class="checkout-block calculate-shipping">
    <form class="shippig_calculator" action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

        <h5><?php _e( 'CALCULATE SHIPPING', 'wp_deeds' ); ?></h5>
        <div class="checkout-content">

			<ul class="cart-list">
				<li>
                    <div class="col-md-12">
                        <select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state styled" rel="calc_shipping_state">
                            <option value=""><?php _e( 'Select a country&hellip;', 'wp_deeds' ); ?></option>
							<?php
							foreach ( WC()->countries->get_shipping_countries() as $key => $value )
								echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
							?>
                        </select>
                    </div>
				</li>
                <li>
                    <div class="col-md-12">
						<?php
						$current_cc = WC()->customer->get_shipping_country();
						$current_r = WC()->customer->get_shipping_state();
						$states = WC()->countries->get_states( $current_cc );

						// Hidden Input
						if ( is_array( $states ) && empty( $states ) ) {
							?><input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e( 'State / county', 'wp_deeds' ); ?>" /><?php
							// Dropdown Input
						} elseif ( is_array( $states ) ) {
							?><span>
								<select name="calc_shipping_state" id="calc_shipping_state" class="styled" placeholder="<?php _e( 'State / county', 'wp_deeds' ); ?>">
									<option value=""><?php _e( 'Select a state&hellip;', 'wp_deeds' ); ?></option>
									<?php
									foreach ( $states as $ckey => $cvalue )
										echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . esc_html( $cvalue, 'wp_deeds' ) . '</option>';
									?>
								</select>
							</span><?php
							// Standard Input
						} else {
							?><input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php _e( 'State / county', 'wp_deeds' ); ?>" name="calc_shipping_state" id="calc_shipping_state" /><?php
						}
						?>
					</div>
				</li>
				<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', false ) ) : ?>
					<li>
						<div class="col-md-12">
							<input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php _e( 'City', 'wp_deeds' ); ?>" name="calc_shipping_city" id="calc_shipping_city" />
						</div>
					</li>
				<?php endif; ?>

				<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>
					<li>
						<div class="col-md-12">
							<input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" placeholder="<?php _e( 'Postcode / Zip', 'wp_deeds' ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
						</div>
					</li>
				<?php endif; ?>
				<li>
					<p><button type="submit" name="calc_shipping" value="1" class="butto cart-btn pull-right"><?php _e( 'Update Totals', 'wp_deeds' ); ?></button></p>
				</li>
				<?php wp_nonce_field( 'woocommerce-cart' ); ?>

			</ul>

        </div>

    </form>
</div>
<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>
