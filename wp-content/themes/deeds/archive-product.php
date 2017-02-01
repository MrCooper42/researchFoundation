<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates woocommerce_shop_page_id
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); 

$Settings 		=	get_option('wp_deeds'.'_theme_options');
$sidebar 		=	sh_set( $Settings, 'shop_page_sidebar' );
$position 		= 	sh_set( $Settings, 'shop_page_sidebar_position' );
$span 			= 	( $sidebar ) ? 'col-md-9' : 'col-md-12';
$inner 			= 	( $sidebar ) ? 'col-md-4' : 'col-md-3';
?>

<?php $theme_options = get_option('wp_deeds'.'_theme_options');  ?>
<?php if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>
<div class="page-top <?php echo $rem_gap; ?>">
	<div class="parallax" style="background:url(<?php echo sh_set($theme_options , 'shop_image');?>);"></div>	
	<div class="container"> 
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h1><?php woocommerce_page_title(); ?></h1>
        	<?php endif; ?>			
		<?php echo sh_get_the_breadcrumb(); ?>
	</div>
</div>

<section class="inner-page<?php echo ( $IsLeftSidebarLayout ) ? 'switch': '';?>">

	<div class="container">
        
        <div class="row">
            <?php
                /**
                 * woocommerce_before_main_content hook
                 *
                 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                 * @hooked woocommerce_breadcrumb - 20
                 */
                do_action('woocommerce_before_main_content');
            ?>
        
                <?php do_action( 'woocommerce_archive_description' ); ?>
        
                <?php if ( have_posts() ) : ?>
        
                    <?php
                        /**
                         * woocommerce_before_shop_loop hook
                         *
                         * @hooked woocommerce_result_count - 20
                         * @hooked woocommerce_catalog_ordering - 30
                         */
                        do_action( 'woocommerce_before_shop_loop' );
                    ?>
        			<?php if( $sidebar && $position == 'left') : ?>
                        <aside class="col-md-3 sidebar column">
                            <?php dynamic_sidebar($sidebar); ?>
                        </aside>
                    <?php endif; ?>	
                    <?php //woocommerce_product_loop_start(); ?>
                    <div class="<?php echo $span; ?> column">
        			<div class="featured-products">
                    <div class="row">
                        <?php woocommerce_product_subcategories(); ?>
        
                        <?php while ( have_posts() ) : the_post(); ?>
        					<?php echo '<div class="'.$inner.'">'; ?>
                            	<?php woocommerce_get_template_part( 'content', 'product' ); ?>
        					<?php echo '</div>'; ?>
                        <?php endwhile; // end of the loop. ?>
        			</div>
                    </div>
                    </div>
                    <?php //woocommerce_product_loop_end(); ?>
					<?php if($position == 'right') : ?>
                        <aside class="col-md-3 sidebar column">
                            <?php dynamic_sidebar($sidebar); ?>
                        </aside>
                    <?php endif; ?>
                    <?php
                        /**
                         * woocommerce_after_shop_loop hook
                         *
                         * @hooked woocommerce_pagination - 10
                         */
                        do_action( 'woocommerce_after_shop_loop' );
                    ?>
        
                <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
        
                    <?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>
        
                <?php endif; ?>
        
            <?php
                /**
                 * woocommerce_after_main_content hook
                 *
                 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                 */
                //do_action('woocommerce_after_main_content');
            ?>
        </div>
    
    </div>
    
</section>

<?php get_footer('shop'); ?>