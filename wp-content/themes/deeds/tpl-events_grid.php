<?php 
/* Template Name: Events - Grid */
get_header(); 
global $paged;
$args = array('post_type' => 'cs_events', 'paged' => $paged ); 
//$query = new WP_Query($args);
$settings  = sh_set(sh_set(get_post_meta(get_the_ID(), 'sh_page_meta', true) , 'sh_page_options') , 0);
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$sidebar = sh_set( $settings, 'sidebar');
$layout = sh_set($settings , 'layout');
$col_class = ($sidebar && $layout != 'full') ? 'col-md-8' : 'col-md-12' ;
$inner_col = ($sidebar && $layout != 'full') ? 'col-md-6' : 'col-md-4' ; 
?>
<?php $theme_options = get_option('wp_deeds'.'_theme_options'); ?>
<?php if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>
<div class="page-top <?php echo $rem_gap; ?>">
	<div class="parallax" style="background:url(<?php echo sh_set($settings , 'top_img');?>);"></div>	
	<div class="container"> 
		<h1><?php the_title(); ?></h1>
        <span> <?php echo sh_set($settings , 'sub_title'); ?></span>
		<?php echo sh_get_the_breadcrumb(); ?>
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
					<div class="events-gridview remove-ext">  
						<div class="row">
                        <?php query_posts( $args ); 
							if( have_posts()): ?>
                        <?php while( have_posts()): the_post(); 
							  $events_meta = sh_set(sh_set(get_post_meta(get_the_ID() , 'sh_event_meta' , true) , 'sh_event_options') , 0);
						?>
							<div class="<?php echo $inner_col; ?>">
								<div class="category-box">
                                    <div class="category-block">
                                        <div class="category-img">
                                            <?php if(has_post_thumbnail()) the_post_thumbnail('370x201'); ?>
                                            <ul>
                                                <li class="date"><a href="<?php the_permalink();?>" title=""><i class="fa fa-calendar-o"></i> 
                                                <?php $originalDate = sh_set($events_meta , 'start_date'); $newDate = date('d M Y', strtotime($originalDate)); echo $newDate; ?></a></li>
                                                <li class="time"><a href="<?php the_permalink();?>" title=""><i class="fa fa-clock-o"></i>
                                                <?php
                                                	$time = strtotime( sh_set( $events_meta, 'start_time' ) ); 
													$c_t = date( 'H:i:s', $time );
												?>
                                                <?php echo $c_t; ?></a></li>
                                            </ul>
                                        </div>
                                        <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
                                        <span><i class="fa fa-map-marker"></i> <?php echo sh_set($events_meta , 'location'); ?></span>
                                    </div>						
                                </div>
							</div>	
                        <?php endwhile ; endif; ?>						
						</div>
                        <?php sh_the_pagination();?>
					</div>
				</div>
                <?php if($sidebar && $layout == 'right'): ?>
                <aside class="col-md-4 sidebar column">
					<?php dynamic_sidebar($sidebar); ?>
				</aside>
                <?php endif;?>
			</div>
		</div>
	</div>
</section>
<?php get_footer();?>