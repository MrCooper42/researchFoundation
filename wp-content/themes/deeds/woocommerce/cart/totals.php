<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

global $woocommerce;

$available_methods = $woocommerce->shipping->get_available_shipping_methods();
?>
<div class="cart-total cart-table <?php if ( $woocommerce->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<?php if ( !$woocommerce->shipping->enabled || $available_methods || !$woocommerce->customer->get_shipping_country() || !$woocommerce->customer->has_calculated_shipping() ) : ?>


		<ul>

			<li>
				<p><?php _e( 'Cart Subtotal', 'wp_deeds' ); ?></p>
				<span><?php echo str_replace( '<span class="amount">', '<span>', $woocommerce->cart->get_cart_subtotal() ); ?></span>
			</li>

			<?php if ( $woocommerce->cart->get_discounts_before_tax() ) : ?>

				<li>
					<p><?php _e( 'Cart Discount', 'wp_deeds' ); ?> <a href="<?php echo add_query_arg( 'remove_discounts', '1', $woocommerce->cart->get_cart_url() ) ?>"><?php _e( '[Remove]', 'wp_deeds' ); ?></a></p>
					<span>-<?php echo $woocommerce->cart->get_discounts_before_tax(); ?></span>
				</li>

			<?php endif; ?>

			<?php if ( $woocommerce->cart->needs_shipping() && $woocommerce->cart->show_shipping() && ( $available_methods || get_option( 'woocommerce_enable_shipping_calc' ) == 'yes' ) ) : ?>

				<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

				<li>
					<p><?php _e( 'Shipping', 'wp_deeds' ); ?></p>
					<span><?php woocommerce_get_template( 'cart/shipping-methods.php', array( 'available_methods' => $available_methods ) ); ?></span>
				</li>

				<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

			<?php endif ?>

			<?php foreach ( $woocommerce->cart->get_fees() as $fee ) : ?>

				<li> class="fee fee-<?php echo $fee->id ?>">
					<p><?php echo $fee->name ?></p>
					<span><?php
						if ( $woocommerce->cart->tax_display_cart == 'excl' )
							echo woocommerce_price( $fee->amount );
						else
							echo woocommerce_price( $fee->amount + $fee->tax );
						?></span>
				</li>

			<?php endforeach; ?>

			<?php
			// Show the tax row if showing prices exclusive of tax only
			if ( $woocommerce->cart->tax_display_cart == 'excl' ) {
				foreach ( $woocommerce->cart->get_tax_totals() as $code => $tax ) {
					echo '<li class="tax-rate tax-rate-' . $code . '">
							<p>' . $tax->label . '</p>
							<span>' . $tax->formatted_amount . '</span>
						</li>';
				}
			}
			?>

			<?php if ( $woocommerce->cart->get_discounts_after_tax() ) : ?>

				<li>
					<p><?php _e( 'Order Discount', 'wp_deeds' ); ?> <a href="<?php echo add_query_arg( 'remove_discounts', '2', $woocommerce->cart->get_cart_url() ) ?>"><?php _e( '[Remove]', 'wp_deeds' ); ?></a></p>
					<span>-<?php echo str_replace( '<span class="amount">', '<span>', $woocommerce->cart->get_discounts_after_tax() ); ?></span>
				</li>

			<?php endif; ?>

			<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

			<li>
				<p><?php _e( 'Order Total', 'wp_deeds' ); ?></p>
				<span>
					<strong><?php echo str_replace( '<span class="amount">', '<span>', $woocommerce->cart->get_total() ); ?></strong>
					<?php
					// If prices are tax inclusive, show taxes here
					if ( $woocommerce->cart->tax_display_cart == 'incl' ) {
						$tax_string_array = array();

						foreach ( $woocommerce->cart->get_tax_totals() as $code => $tax ) {
							$tax_string_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
						}

						if ( !empty( $tax_string_array ) ) {
							echo '<small class="includes_tax">' . sprintf( __( '(Includes %s)', 'wp_deeds' ), implode( ', ', $tax_string_array ) ) . '</small>';
						}
					}
					?>
				</span>
			</li>

			<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

		</ul>

		<?php if ( $woocommerce->cart->get_cart_tax() ) : ?>

			<p><small><?php
					$estimated_text = ( $woocommerce->customer->is_customer_outside_base() && !$woocommerce->customer->has_calculated_shipping() ) ? sprintf( ' ' . __( ' (taxes estimated for %s)', 'wp_deeds' ), $woocommerce->countries->estimated_for_prefix() . $woocommerce->countries->countries[$woocommerce->countries->get_base_country()] ) : '';

					printf( __( 'Note: Shipping and taxes are estimated %s and will be updated during checkout based on your billing and shipping information.', 'wp_deeds' ), $estimated_text );
					?></small></p>

		<?php endif; ?>

	<?php elseif ( $woocommerce->cart->needs_shipping() ) : ?>

		<?php if ( !$woocommerce->customer->get_shipping_state() || !$woocommerce->customer->get_shipping_postcode() ) : ?>

			<div class="woocommerce-info">

				<p><?php _e( 'No shipping methods were found; please recalculate your shipping and enter your state/county and zip/postcode to ensure there are no other available methods for your location.', 'wp_deeds' ); ?></p>

			</div>

		<?php else : ?>

			<?php
			$customer_location = $woocommerce->countries->countries[$woocommerce->customer->get_shipping_country()];

			echo apply_filters( 'woocommerce_cart_no_shipping_available_html', '<div class="woocommerce-error"><p>' .
					sprintf( __( 'Sorry, it seems that there are no available shipping methods for your location (%s).', 'wp_deeds' ) . ' ' . __( 'If you require assistance or wish to make alternate arrangements please contact us.', 'wp_deeds' ), $customer_location ) .
					'</p></div>'
			);
			?>

		<?php endif; ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
