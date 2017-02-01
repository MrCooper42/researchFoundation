<?php global $wp_query;
get_header();
$queried_object = get_queried_object(); 
?>

<?php $theme_options = get_option('wp_deeds'.'_theme_options');?>
<?php if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>
<div class="page-top <?php echo $rem_gap; ?>">
	<div class="parallax" style="background:url(images/parallax1.jpg);"></div>	
	<div class="container"> 
		<h1>PRODUCTS <span>PAGE</span></h1>
		<?php echo sh_get_the_breadcrumb(); ?>
	</div>
</div>

<section>
	<div class="block">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="our-products products-page">
						<div class="row">
                        <?php while( have_posts() ): the_post(); ?>
							<div class="col-md-2">
								<div class="product">
									<?php the_post_thumbnail('146x187'); ?>
                                    <i><?php echo sh_set($download_meta , 'tag_line'); ?></i>
									<h3><a title="" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="product-bottom">
										<?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID(), 'text' => 'ADD TO CART' , 'price' => false, 'style' => 'plain' ) ); ?>
                                        <span>$ 25.16</span>
                                    </div>
								</div><!-- PRODUCT -->
							</div>
						 <?php endwhile; ?>
                         <?php _the_pagination(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<?php get_footer(); ?>