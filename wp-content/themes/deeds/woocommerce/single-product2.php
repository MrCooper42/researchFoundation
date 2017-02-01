<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

global $post, $woocommerce, $product;
?>
<div itemscope itemtype="<?php //echo woocommerce_get_product_schema();     ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	do_action( 'woocommerce_before_single_product' );
	?>


	<?php
	/**
	 * woocommerce_show_product_images hook
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	//do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="tab-content" id="myTabContent">
		<?php
		$gallery = $product->get_gallery_attachment_ids();
		$attachment_count = count( $product->get_gallery_attachment_ids() );

		if ( $attachment_count > 0 ) {
			$output = '';
			$counter = 1;
			foreach ( $gallery as $key => $id ) {
				$img = wp_get_attachment_image_src( $id, 'full' );
				$output .='<div id="tab' . $counter++ . '" class="tab-pane fade ';
				if ( $counter == 2 ): $output .= 'in active';
				endif;
				$output .='">
												<img src="' . $img[0] . '" alt="" />
										  </div>';
			}
		}
		echo $output;
		?>
	</div>

	<ul class="nav nav-tabs" id="myTab">
		<?php
		if ( $attachment_count > 0 ):
			$output = '';
			$counter2 = 1;
			foreach ( $gallery as $key => $id ) {
				$img = wp_get_attachment_image_src( $id, '80x80' );
				$output .= '<li ';
				if ( $counter2 == 1 ): $output .= ' class="active"';
				endif;
				$output .= '><a data-toggle="tab" href="#tab' . $counter2++ . '"><img src="' . $img[0] . '" alt="" /></a></li>';
			}
		endif;
		echo $output;
		?>
	</ul>

	<div class="single-page">
		<h2><?php the_title(); ?></h2>
		<?php if ( $price_html = $product->get_price_html() ) : ?>
			<?php echo str_replace( array( '<del><span class="amount">', '</span></del>', '<ins><span class="amount">', '</span></ins>' ), array( '<span>', '<i>', '', '</i></span>' ), $price_html ); ?>
		<?php endif; ?>
		<div class="meta">
			<ul>
				<li><i class="fa fa-reply"></i> <?php _e( 'Posted In', 'wp_deeds' ); ?> <?php the_category( ',' ); ?></li>
				<li><i class="fa fa-calendar-o"></i> <?php echo date( get_option( 'date_format' ), strtotime( get_the_date() ) ); ?></li>
				<li><i class="fa fa-user"></i> <?php the_author(); ?></li>
			</ul>
			<?php echo get_avatar( get_the_id() ); ?>
		</div><!-- POST META -->
		<a class="add_to_wishlist" data-id="<?php echo get_the_ID(); ?>" href="javascript:void(0);" title=""><i class="fa fa-heart"></i><?php _e( 'ADD TO WISHLIST', 'wp_deeds' ); ?></a>
			<?php do_action( 'woocommerce_' . $product->product_type . '_add_to_cart' ); ?>

	</div><!-- SERMON SINGLE -->

	<p><?php the_excerpt(); ?></p>
	<?php
	/**
	 * woocommerce_after_single_product_summary hook
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>


	<?php do_action( 'woocommerce_after_single_product' ); ?>
</div>
