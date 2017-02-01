<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $woocommerce;
?>
<?php if( WC()->cart->get_cart() ): 
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) 
		{
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			
			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) )
			{?>
                <li>
                   <?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<span class="remove"><a href="%s" title="%s"><i class="fa fa-times-circle"></i></a></span>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), '' ), $cart_item_key ); ?>     
                    <span>
						<?php
                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );    
                            if ( ! $_product->is_visible() )
                                echo $thumbnail;
                            else
                                printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
                        ?>
                    </span>
                    
                    <?php 
						if ( ! $_product->is_visible() )
							echo '<h6>'.apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ).'</h6>';
						else
							echo '<h6>'.apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key ).'</h6>';

						// Meta data
						echo WC()->cart->get_item_data( $cart_item );
					?>                            
                    <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                       <?php echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s"><i class="fa fa-cog"></i></a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key ); ?>
                </li>
				<?php
			}
		} ?>
		
		 <li>
            <h5><?php _e('Sub-Total', 'wp_deeds'); ?> : <?php
                    echo $woocommerce->cart->get_cart_total(); //apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                ?>
            </h5>
        </li>

<?php else: ?>

	<p><?php _e('The cart is empty', 'wp_deeds'); ?></p>
<?php endif;

