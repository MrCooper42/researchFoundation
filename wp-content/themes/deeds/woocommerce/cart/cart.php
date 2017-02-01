<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.8
 */
if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

do_action( 'woocommerce_before_cart' );
?>
<section>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

						<?php do_action( 'woocommerce_before_cart_table' ); ?>
                        <div class="cart-table">
                            <div class="cart-head">
                                <h2>IMAGE</h2>
                                <h2 class="long-width">PRODUCT NAME</h2>
                                <h2>PRICE</h2>
                                <h2>QUANTITY</h2>
                                <h2>TOTAL</h2>
                            </div>
                            <ul class="cart-list">

								<?php do_action( 'woocommerce_before_cart_contents' ); ?>

								<?php
								foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
									$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
									$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

									if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
										?>
										<?php /* ?><tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>"><?php */ ?>
										<li>
											<ul class="cart-product">
												<li>
													<?php
													$del = '<img class="dustbin" src="' . get_template_directory_uri() . '/images/dustbin.png" alt="" />';
													echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">' . $del . '</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'wp_deeds' ) ), $cart_item_key );
													?>
													<?php
													$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

													if ( !$_product->is_visible() )
														echo $thumbnail;
													else
														printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
													?>
												</li>
												<li class="long-width"><?php
													if ( !$_product->is_visible() )
														echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
													else
														echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );

													// Meta data
													echo WC()->cart->get_item_data( $cart_item );

													// Backorder notification
													if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
														echo '<p class="backorder_notification">' . __( 'Available on backorder', 'wp_deeds' ) . '</p>';
													?></li>
												<li><?php
													echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
													?></li>
												<li>
													<?php
													if ( $_product->is_sold_individually() ) {
														$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
													} else {
														$product_quantity = woocommerce_quantity_input( array(
															'input_name' => "cart[{$cart_item_key}][qty]",
															'input_value' => $cart_item['quantity'],
															'max_value' => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
																), $_product, false );
													}

													echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
													?>
												</li>
												<li><?php
													echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
													?></li>
											</ul>
										</li>



										<?php
									}
								}

								do_action( 'woocommerce_cart_contents' );
								?>

                                <li>

									<?php if ( WC()->cart->coupons_enabled() ) { ?>

										<input type="text" name="coupon_code" class="form-control" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'wp_deeds' ); ?>" /> <input type="submit" class="pull-left" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'wp_deeds' ); ?>" />

										<?php do_action( 'woocommerce_cart_coupon' ); ?>

									<?php } ?>

                                    <input type="submit" class="pull-right" name="update_cart" value="<?php _e( 'Update Cart', 'wp_deeds' ); ?>" /> <input type="submit" class="pull-right" name="proceed" value="<?php _e( 'Proceed to Checkout', 'wp_deeds' ); ?>" />

									<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>

									<?php wp_nonce_field( 'woocommerce-cart' ); ?>
                                </li>
                            </ul>
                        </div>
						<?php do_action( 'woocommerce_after_cart_contents' ); ?>


						<?php do_action( 'woocommerce_after_cart_table' ); ?>

                    </form>

					<?php do_action( 'woocommerce_cart_collaterals' ); ?>

					<?php woocommerce_cart_totals(); ?>

					<?php woocommerce_shipping_calculator(); ?>


					<?php do_action( 'woocommerce_after_cart' ); ?>
                </div></div></div></div></section>
