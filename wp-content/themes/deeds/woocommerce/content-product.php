<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */
if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

global $product, $woocommerce_loop, $post;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( !$product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop'] ++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
$classes[] = 'col-md-4';
?>
<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>


<?php
/**
 * woocommerce_before_shop_loop_item_title hook
 *
 * @hooked woocommerce_show_product_loop_sale_flash - 10
 * @hooked woocommerce_template_loop_product_thumbnail - 10
 */
//do_action( 'woocommerce_before_shop_loop_item_title' );
?>
<div class="col-md-3">
	<div class="product">
		<?php
		if ( has_post_thumbnail() ):
			woocommerce_get_template( 'loop/sale-flash.php' );
			the_post_thumbnail( '370x230' );
		endif;
		?>
		<?php $product_meta = get_post_meta( $post->ID, 'sh_product_meta', true ); ?>
		<?php echo (sh_set( $product_meta, 'product_sub_title' )) ? '<i>' . sh_set( $product_meta, 'product_sub_title' ) . '</i>' : ''; ?>
		<h3><a href="<?php echo get_permalink(); ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
		<?php /* ?><div class="ratings clearfix">
		  <?php woocommerce_get_template( 'loop/rating.php' ); ?>
		  </div><?php */ ?>
		<div class="product-bottom">
			<?php if ( $price_html = $product->get_price_html() ) : ?>
				<?php echo $price_html; ?>
			<?php endif; ?>
			<?php woocommerce_template_loop_add_to_cart(); ?>
		</div>
	</div><!-- BOOK -->
</div>
<?php
/**
 * woocommerce_after_shop_loop_item_title hook
 *
 * @hooked woocommerce_template_loop_price - 10
 */
//do_action( 'woocommerce_after_shop_loop_item_title' );
?>

<!--</a>-->

