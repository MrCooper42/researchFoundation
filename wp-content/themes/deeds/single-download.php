<?php get_header(); ?>

<section class="post-wrapper-top">
    <div class="container">
        <div class="post-wrapper-top-shadow">
            <span class="s1"></span>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            
			<?php echo sh_get_the_breadcrumb(); ?>
            
            <h2><?php the_title(); ?></h2>
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

<?php while( have_posts() ): the_post(); ?>

	<?php $meta = get_post_meta( get_the_id(), 'sh_download_meta', true ); // printr($meta); ?>
    <section class="item-image-wrapper">
		<div class="item_image">
			
			<?php if( $featured_image = sh_set( $meta, 'featured_image' ) ):?>
            	<img src="<?php echo $featured_image; ?>" class="img-responsive aligncenter" alt="<?php the_title_attribute(); ?>" />
            <?php else: 
				the_post_thumbnail( '919x534', array('class' => 'img-responsive aligncenter' ) );
			endif; ?>
            
		</div><!-- end item_image -->
    </section>
    
    <section class="section1">
    	<div class="container clearfix">
        	
            <div class="content col-lg-12 col-md-12 col-sm-12 clearfix">
            	
                <div class="general-title text-center">
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo sh_set( $meta, 'subtitle' ); ?></p>
                    <hr>
                </div>
                
                <div class="divider"></div>
                
                <div class="item_details">
					<div class="col-lg-3 col-md-3 col-sm-12">
                    	
                        <div class="theme_details">
                            <div class="details_section">
                                
                                <h3><?php _e('Item Details', 'wp_deeds'); ?></h3>
                                <ul>
                                    <?php if( $version = sh_set( $meta, 'version' ) ) : ?>
                                    	<li class="version"><?php _e('Current version: ', 'wp_deeds'); ?><span><?php echo $version; ?></span></li>
                                    <?php endif; ?>
                                    
                                    <?php if( $update = sh_set( $meta, 'update_date' ) ) : ?>
                                    	<li class="version"><?php _e('Last Update: ', 'wp_deeds'); ?><span><?php echo date(get_option('date_format'), strtotime($update)); ?></span></li>
                                    <?php endif; ?>
                                    
                                    <?php if( $release = sh_set( $meta, 'release_date' ) ) : ?>
                                    	<li class="version"><?php _e('Release Date: ', 'wp_deeds'); ?><span><?php echo date( get_option('date_format'), strtotime($release)); ?></span></li>
                                    <?php endif; ?>

									<?php if( $author_name = sh_set( $meta, 'author_name' ) ) : ?>
                                    	<li class="version"><?php _e('Author: ', 'wp_deeds'); ?><span><?php echo $author_name; ?></span></li>
                                    <?php endif; ?>

                                    <?php if( $required = sh_set( $meta, 'requirements' ) ) : ?>
                                    	<li class="version"><?php _e('Requirements: ', 'wp_deeds'); ?><span><?php echo $required; ?></span></li>
                                    <?php endif; ?>

                                </ul>
                                
                            </div>
                            
                           
                            
                        </div>
                        
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="theme_details">
                            <div class="item-description">
                                <?php the_content(); ?>
                            </div><!-- item-description -->
                        </div><!-- theme_details -->
                    </div>
                            
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="theme_details">
                            <div class="item_price">
                            	<h3><?php edd_price( get_the_ID() ); ?></h3>
                            </div><!-- item_price -->
                            <hr>
                            <div class="buttons">
                            
                            	<?php if( $demo_link = sh_set( $meta, 'demo_link' ) ) : ?>
                                	<a target="_blank" href="<?php echo esc_url( $demo_link ); ?>" class="button btn-block large"><?php _e('LIVE DEMO', 'wp_deeds'); ?></a>
                                <?php endif; ?>
                                
                                <?php echo edd_get_purchase_link(
									array(
										'download_id' => get_the_id(),
										'class' => 'btn-block large download_button', // add your new classes here
										'price' => 0, // turn the price off
										'text' => __('BUY NOW','wp_deeds'),
										//'direct' => true
									)
								); ?>

                            </div><!-- buttons -->
                            <hr>
                            
                            <div class="text-center">
                                <?php _sh_star_rating(); ?>
                            </div>

                            
                        </div><!-- theme_details -->
                    </div>
                </div>
                <div class="clearfix"></div>
                
                <?php if( sh_set( $meta, 'show_features' ) ): ?>
                
                    <div class="general-title text-center">
                        <h3><?php echo sh_set( $meta, 'feature_title' ); ?></h3>
                        <p><?php echo sh_set( $meta, 'feature_subtitle' ); ?></p>
                        <hr>
                    </div>
                    
                    <div class="divider"></div>
                
					<?php if( $item_features = sh_set( $meta, 'item_features' ) ): ?>
                        <div class="theme_overviews clearfix">
                            
                            <?php $items_count = count( $item_features);
							$loop = 0;
							foreach( $item_features as $index => $item_feature ): 
								$first = ( $index == 0 || ( $index % 3 ) == 0 ) ? ' first' : '';
								$last = ( ($index + 1 ) % 3 == 0 ) ? ' last' : ''; ?>
                                
                                <div class="col-lg-4 col-md-4 col-sm-12<?php echo $first.$last; ?>">
                                    <div class="services">
                                        <div class="icon-container">
                                            <i class="<?php echo sh_set( $item_feature, 'icon' ); ?>"></i>
                                        </div>
                                        <header>
                                        <h3><?php echo sh_set( $item_feature, 'feature' ); ?></h3>
                                        </header>
                                        <p><?php echo sh_set( $item_feature, 'desc' ); ?></p>
                                    </div>
                                </div>
                                
                            <?php endforeach; ?>
                        
                        </div>
                    <?php endif; ?>
                
                <?php endif; ?>
                
            </div>
        
        </div>
    </section>

<?php endwhile; ?>

<?php get_footer(); ?>