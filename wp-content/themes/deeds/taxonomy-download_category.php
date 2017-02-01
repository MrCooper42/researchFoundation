<?php global $wp_query;
get_header();
$queried_object = get_queried_object();
$options = $GLOBALS['_sh_base']->option();
$sidebar = sh_set( $options, 'blog_pages_sidebar');
$layout = sh_set($options, 'blog_sidebar_layout');?>

<section class="post-wrapper-top">
    <div class="container">
        <div class="post-wrapper-top-shadow">
            <span class="s1"></span>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            
			<?php echo sh_get_the_breadcrumb(); ?>
            
            <h2><?php single_term_title( __( 'Products Archives for ', 'wp_deeds' ) ); ?> </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <!-- search -->
                <div class="search-bar">
                    <?php get_search_form(); ?>
                </div>
                <!-- / end div .search-bar -->
        </div>
    </div>
</section>

<section class="section1">
    <div class="container clearfix">
        
        <?php $class = ( $layout == 'full' ) ? ' col-md-12 col-lg-12' : ' col-md-8 col-lg-8';
		$pull_content = ( $layout == 'left' ) ? ' pull-right' : '';
		if( $sidebar && $layout == 'left' ): ?>
			<div class="sidebar col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<?php dynamic_sidebar( $sidebar ); ?>
			</div>
		<?php endif; ?>
        
        <div class="content<?php echo $pull_content; ?><?php echo $class; ?> col-sm-8 col-xs-12 clearfix">
        
        
			<?php while( have_posts() ): the_post(); ?>
            
                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
					
                    <div class="he-wrap tpl6 market-item">
                    
						<?php the_post_thumbnail('800x547', array('class'=>'lazyOwl')); ?>
						<div class="he-view">
							<div class="bg a0" data-animate="fadeIn">
                                <h3 class="a1" data-animate="fadeInDown"><?php the_title(); ?></h3>
                                <a href="<?php the_permalink(); ?>" class="dmbutton a2" data-animate="bounceInLeft"><?php _e('View item', 'wp_deeds'); ?></a>
                                <span class="dmbutton btn-xs a2" data-animate="bounceInRight"><?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID(), 'text' => __('Buy now', 'wp_deeds'), 'price' => false, 'style' => 'plain' ) ); ?></span>
                                <div class="rating text-center a2" data-animate="fadeIn">
                                    <?php _sh_star_rating( true ); ?>
                                </div>
							</div><!-- he bg -->
						</div><!-- he view -->		
					
                    </div><!-- he wrap -->
				
                </div><!-- end col-6 -->
                
            <?php endwhile; ?>
			
            <div class="clearfix"></div>
			<?php _the_pagination(); ?>
            
		</div>
        
        <?php if( $sidebar && $layout == 'right' ): ?>
            <div class="sidebar col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <?php dynamic_sidebar( $sidebar ); ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>