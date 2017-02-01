<?php  get_header();  ?>
<?php
wp_reset_query(); 

$options = get_option('wp_deeds' . '_theme_options'); //printr($options);
if( have_posts()): while(have_posts()): the_post(); 

$post_meta = get_post_meta(get_the_ID() , 'sh_post_meta' , true) ;
$post_options = sh_set(sh_set($post_meta , 'sh_post_options') , 0);

if ( sh_set($post_options , 'sidebar') && sh_set($post_options , 'layout') != "full") {
	$sidebar = sh_set($post_options , 'sidebar');	
	$layout = sh_set($post_options , 'layout');
}elseif (sh_set($options, 'single_sidebar') && sh_set($options, 'single_layout')) {
	$sidebar = sh_set($options, 'single_sidebar');
	$layout = sh_set($options, 'single_layout');
} else {
	$sidebar = "";
	$layout = "";
}

if( sh_set($post_options, 'show_banner') ) {
	$show_banner = sh_set($post_options, 'show_banner');
	$subtitle = sh_set($post_options, 'sub_title');
	$top_img = sh_set($post_options , 'top_img');
}elseif (sh_set($options, 'show_single_banner')) {
	$subtitle = sh_set($options, 'single_subtitle');
	$top_img = sh_set($options, 'single_banner_image');
	$show_banner = sh_set($options, 'show_single_banner');
}else {
	$subtitle = '';
	$top_img = '';
	$show_banner = "";
}

$col_class = (is_active_sidebar($sidebar) && $layout != 'full') ? 'col-md-8' : 'col-md-12' ;
$format = get_post_format( get_the_ID() );
?>

<?php $theme_options = get_option('wp_deeds'.'_theme_options'); //printr($theme_options);  ?>
<?php if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>

<?php if ($show_banner) : ?>
<div class="page-top <?php echo $rem_gap; ?>">
	<div class="parallax" <?php if( $top_img ): ?> style="background:url(<?php echo $top_img ?>);" <?php endif; ?>></div>	
	<div class="container"> 
		<h1><?php the_title(); ?></h1>
        <span> <?php echo esc_html($subtitle); ?></span>
		<?php echo sh_get_the_breadcrumb(); ?>
	</div>
</div>
<?php endif; ?>
<section>
	<div class="block">
		<div class="container">
			<div class="row">
            	<?php if(is_active_sidebar($sidebar) && $layout == 'left'): ?>
                <aside class="col-md-4 sidebar column">
					<?php dynamic_sidebar($sidebar); ?>
				</aside>
                <?php endif;?>
				<div class="<?php echo $col_class; ?> column default">
					<div class="single-page">
                    	<?php 
						
							if( $format == 'video' ) {
								echo '<iframe height="480" src="'. sh_set( $post_options, 'video' ) .'" ></iframe>';
							}
							elseif( $format == 'audio' ) {
								if( sh_set( $post_options, 'audio_type' ) == 'soundcloud' ) {
									echo '<iframe width="100%" height="450" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/'.sh_set( $post_options, 'soundcloud_id' ).'&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>';
								}elseif( sh_set( $post_options, 'audio_type' ) == 'own' ){
									echo '<div class="singleaudioplayer"><audio src="'.sh_set( $post_options, 'own_audio' ).'"></audio></div>';
								}
							}
							elseif( $format == "gallery" ) {
								$post_meta = get_post_meta(get_the_ID(), 'sh_post_meta', true);
								$gal_opt = sh_set(sh_set(sh_set(sh_set(sh_set($post_meta, 'sh_post_options'), '0'), 'galleries_setting'), '0'), 'gallery_opt');
								$gallery = explode(',', $gal_opt);
								
								echo '<ul class="single-gallery-carousel">';
								foreach ($gallery as $id) { 
									$url = wp_get_attachment_image_url($id, '770x324');
									echo '<li><img src="'.$url.'" alt="" /></li>';
								}
								echo '</ul>
									  <script>
									  	jQuery(document).ready(function() {
											jQuery(".single-gallery-carousel").owlCarousel({
												  autoplay:false,
												  autoplayTimeout:3000,
												  smartSpeed:2000,
												  loop:true,
												  dots:false,
												  nav:true,
												  margin:10,
												  items:1,
												  singleItem:true,
											 });
										});
									  </script>';
								
							}
							 elseif(has_post_thumbnail()) {
								 the_post_thumbnail('770x324');
							 } 
						?>
                        
						<h2><?php the_title(); ?></h2>
                        <?php if ( sh_set($options, 'show_single_cat') || sh_set($options, 'show_single_date') || sh_set($options, 'show_single_author') ) : ?>
						<div class="meta">
							<ul>
                            	<?php if (sh_set($options, 'show_single_cat')) : ?>
								<li><i class="fa fa-reply"></i><?php _e("Posted In " , 'wp_deeds'); ?> <a href="#" title=""><?php the_category( ',' ); ?></a></li>
                                <?php endif; ?>
                                <?php if (sh_set($options, 'show_single_date')) : ?>
								<li><i class="fa fa-calendar-o"></i> <?php echo get_the_date(); ?></li>
                                <?php endif; ?>
                                <?php if (sh_set($options, 'show_single_author')) : ?>
								<li><i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a></li>
                                <?php endif; ?>
							</ul>
                            <?php if (sh_set($options, 'show_single_author')) : ?>
							<?php echo get_avatar( get_the_id() ); ?>
                            <?php endif; ?>
						</div><!-- POST META -->
                        <?php endif; ?>
					</div>
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
					 <?php if(sh_set($post_options , 'show_pastor')): ?>
					<div class="pastor-info">
						<img src="<?php echo sh_set($post_options , 'pastor_image'); ?>" alt="" />
						<h4><?php echo sh_set($post_options , 'pastor_name'); ?><span><?php echo sh_set($post_options , 'pastor_desig'); ?></span></h4>
						<p><?php echo sh_set($post_options , 'pastor_description'); ?></p>
					</div>
                    <?php endif; ?>
					
                    <?php if (sh_set($options, 'show_single_sharing')) : ?>
					<div class="share-this">
						<h5><i class="fa fa-share"></i> <?php _e("SHARE THIS" , 'wp_deeds'); ?></h5>
						<?php sh_social_sharing() ;?>				
					</div>
                    <?php endif; ?>
                    
					<?php if( has_tag() && sh_set($options, 'show_single_tags')): ?>
                    <div class="share-this tagcloud">
                        <h5><i class="fa fa-tags"></i> Tags: </h5>
                        <?php the_tags('',' ','');?>
                    </div>
					<?php endif; ?>
                    
                    
					<?php comments_template(); ?>
				</div>
				 <?php if(is_active_sidebar($sidebar) && $layout == 'right'): ?>
                    <aside class="col-md-4 sidebar column">
                        <?php dynamic_sidebar($sidebar); ?>
                    </aside>
                 <?php endif;?>
				
			</div>
		</div>
	</div>
</section>
<?php 
endwhile; endif;
get_footer(); ?>