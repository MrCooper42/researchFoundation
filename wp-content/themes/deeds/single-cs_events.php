<?php  get_header();  ?>
<?php 
if(have_posts()): while(have_posts()): the_post(); 
$event_meta = get_post_meta(get_the_ID() , 'sh_event_meta' , true) ;
$event_page_options = sh_set(sh_set($event_meta , 'sh_events_page_options') , 0);
$event_info = sh_set(sh_set($event_meta , 'sh_event_options') , 0);
$event_pastor = sh_set(sh_set($event_meta , 'sh_event_pastor') , 0);
$sidebar = sh_set($event_page_options , 'sidebar') ;
$layout = sh_set($event_page_options , 'layout') ;
$col_class = ($sidebar && $layout != 'full') ? 'col-md-8' : 'col-md-12' ;
?>
<?php $theme_options = get_option('wp_deeds'.'_theme_options'); ?>
<?php if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>
<div class="page-top <?php echo $rem_gap; ?>">
	<div class="parallax" style="background:url(<?php echo sh_set($event_page_options , 'top_img'); ?>);"></div>	
	<div class="container"> 
		<h1><?php the_title(); ?></h1>
        <span> <?php echo sh_set($event_meta , 'sub_title'); ?></span>
		<?php echo sh_get_the_breadcrumb(); ?>
	</div>
</div><!--- PAGE TOP -->
<section>
	<div class="block">
		<div class="container">
			<div class="row">
            	<?php if($sidebar && $layout == 'left'): ?>
                <aside class="col-md-4 sidebar column">
					<?php dynamic_sidebar($sidebar); ?>
				</aside>
                <?php endif;?>
				<div class="<?php  echo $col_class; ?> column">
					<div class="single-page">
						<?php if(has_post_thumbnail()) the_post_thumbnail('770x324'); ?>
						<h2><?php the_title(); ?></h2>
						<div class="meta">
							<ul>
								<li><i class="fa fa-reply"></i><?php _e("Posted In " , 'wp_deeds'); ?> <a href="#" title=""><?php the_category(); ?></a></li>
								<li><i class="fa fa-calendar-o"></i> <?php echo sh_set(sh_set(sh_set($event_meta, 'sh_event_options'),'0'), 'start_date'); ?></li>
								<li><i class="fa fa-user"></i> <?php echo sh_set($event_pastor , 'pastor_name'); ?></li>
							</ul>
							<img src="<?php echo sh_set($event_pastor , 'pastor_image'); ?>" alt="" />
						</div><!-- POST META -->


						<div class="event-info">
							<div class="col-md-6">
								<div class="map">
									<?php echo sh_set($event_info , 'google_map');?>	
								</div>
							</div>
							<div class="col-md-6">
								<ul>
									<li><i class="fa fa-map-marker"></i> <?php echo sh_set($event_info , 'location'); ?></li>
									<li><?php echo sh_getPostLikeLink(get_the_ID());?></li>
									<li><i class="fa fa-clock-o"></i> <?php echo sh_set($event_info , 'start_time'); ?> - <?php echo sh_set($event_info , 'end_time'); ?></li>
									<li><i class="fa fa-calendar-o"></i> <?php echo sh_set($event_info , 'start_date'); ?> - <?php echo sh_set($event_info , 'end_date'); ?></li>

								</ul>
							</div>
						</div>
					</div><!-- SERMON SINGLE -->
					
					<?php the_content();?>

					 <?php if(sh_set($event_pastor , 'show_pastor')): ?>
					<div class="pastor-info">
						<img src="<?php echo sh_set($event_pastor , 'pastor_image'); ?>" alt="" />
						<h4><?php echo sh_set($event_pastor , 'pastor_name'); ?><span>
						<?php echo sh_set($event_pastor , 'pastor_desig'); ?></span></h4>
						<p><?php echo sh_set($event_pastor , 'pastor_description'); ?></p>
					</div>
                    <?php endif; ?>

					<?php if(sh_set($event_info , 'show_social_sharing')): ?>
					<div class="share-this">
						<h5><i class="fa fa-share"></i> <?php _e("SHARE THIS EVENT" , 'wp_deeds'); ?></h5>
						<?php sh_social_sharing() ;?>				
					</div>
                    <?php endif; ?>

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

<?php 
endwhile; endif; wp_reset_query();
get_footer(); ?>