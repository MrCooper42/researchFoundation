<?php 

get_header(); 
$args = array('post_type' => 'cs_events', ); 
$query = new WP_Query($args);
$settings  = sh_set(sh_set(get_post_meta(get_the_ID(), 'sh_page_meta', true) , 'sh_page_options') , 0);
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$sidebar = sh_set( $settings, 'sidebar');
$layout = sh_set($settings , 'layout');
$col_class = ($sidebar && $layout != 'full') ? 'col-md-8' : 'col-md-12' ;
$inner_col = ($sidebar && $layout != 'full') ? 'col-md-6' : 'col-md-4' ; 
?>
<?php $theme_options = get_option('wp_deeds'.'_theme_options'); ?>
<?php if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>
<div class="<?php if( sh_set( $settings, 'breadcumb') == 1 ): echo 'page-top'; endif; ?> <?php echo $rem_gap; ?>">
	<?php if( sh_set( $settings, 'breadcumb') == 1 ): ?>
		<div class="parallax" style="background:url(<?php echo sh_set($settings , 'top_img');?>);"></div>	
    <?php endif; ?>
	<div class="container"> 
		<h1><?php the_title(); ?></h1>
        <span> <?php echo sh_set($settings , 'sub_title'); ?></span>
		<?php if( sh_set( $settings, 'breadcumb') == 1 ): echo sh_get_the_breadcrumb(); endif; ?>
	</div>
</div>

<section>
	<div class="block">
		<div class="container">
			<div class="row">
            	<?php if($sidebar && $layout == 'left'): ?>
                <aside class="col-md-4 sidebar column">
					<?php dynamic_sidebar($sidebar); ?>
				</aside>
                <?php endif;?>
				<div class="<?php echo $col_class; ?> column">
					<div class="remove-ext">
                    <?php if($query->have_posts()): ?>
                    <?php while($query->have_posts()): $query->the_post(); 
						$events_meta = sh_set(sh_set(get_post_meta(get_the_ID() , 'sh_event_meta' , true) , 'sh_event_options') , 0);
					?>
						<div class="event-box">
							<div class="row">
								<div class="col-md-6">
									<div class="category-img">
										<?php if(has_post_thumbnail()) the_post_thumbnail('370x248'); ?>
										<h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
									</div>
								</div>
								<div class="col-md-6">
									<div class="event-detail">
										<ul>
                                            <li><a href="<?php the_permalink();?>" title=""><i class="fa fa-calendar-o"></i> 
                                            <?php echo sh_set($events_meta , 'start_date'); ?></a></li>
                                            <li><a href="<?php the_permalink();?>" title=""><i class="fa fa-clock-o"></i>
                                            <?php echo sh_set($events_meta , 'start_time'); ?></a></li>
                                        </ul>
										<p><?php echo substr(strip_tags(get_the_content()) , 0 , 290); ?></p>
										<span><i class="fa fa-map-marker"></i> <?php echo sh_set($events_meta , 'location'); ?></span>
									</div>
								</div>
							</div>
						</div>
                    <?php endwhile ; endif; wp_reset_query(); ?>
                   </div>
				</div>
                <?php _the_pagination(); ?>
                <?php if($sidebar && $layout == 'right'): ?>
                <aside class="col-md-4 sidebar column">
					<?php dynamic_sidebar($sidebar); ?>
				</aside>
                <?php endif;?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>