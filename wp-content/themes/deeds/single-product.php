<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); 
global $post_type; 
$Settings = get_post_meta(get_the_ID() , 'sh_product_meta' , true) ;
$PageSettings  = get_post_meta(get_the_ID(), '_product_settings', true);
$IsWide = ( sh_set( $Settings, 'blog_layout' ) == 'wide' ) ? TRUE: FALSE;
$IsLeftSidebarLayout = ( sh_set( $Settings, 'blog_layout' ) == 'leftsidebar' ) ? TRUE: FALSE;
?>

<?php $theme_options = get_option('wp_deeds'.'_theme_options'); ?>
<?php if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>
<div class="page-top <?php echo $rem_gap; ?>">
	<div class="parallax" style="background:url(<?php echo sh_set($Settings , 'product_top_img');?>);"></div>	
	<div class="container"> 
		<h1><?php the_title(); ?></h1>
        <span> <?php echo sh_set($Settings , 'product_sub_title'); ?></span>
		<?php echo sh_get_the_breadcrumb(); ?>
	</div>
</div>

<section>
	<div class="block">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="single-product">
                    	<div id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
        
							<?php while ( have_posts() ) : the_post(); ?>
                        
                                <?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
                        
                            <?php endwhile; // end of the loop. ?>
                            
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer('shop'); ?>