<?php 
/* Template Name: Sermons */
get_header(); 
global $paged;
$args = array('post_type' => 'cs_sermons', 'paged' => $paged ); 
//$query = new WP_Query($args);
$settings  = sh_set(sh_set(get_post_meta(get_the_ID(), 'sh_page_meta', true) , 'sh_page_options') , 0);
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$sidebar = sh_set( $settings, 'sidebar');
$layout = sh_set($settings , 'layout');
$col_class = ($sidebar && $layout != 'full') ? 'col-md-8' : 'col-md-12' ;
$inner_col = ($sidebar && $layout != 'full') ? 'col-md-6' : 'col-md-4' ; 
?>

<?php $theme_options = get_option('wp_deeds'.'_theme_options'); ?>
<?php if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif;?>
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
				<div class="<?php echo $col_class; ?>">
					<div class="latest-sermons remove-ext">
                    <?php 
						query_posts($args);
					 if(have_posts()):  while(have_posts()) : the_post(); 
					 $meta = get_post_meta( get_the_ID() , 'sh_sermon_meta' , true );
					 $sermon_info = sh_set(sh_set($meta , 'sh_sermon_options') , 0);
					 $pastor_info = sh_set(sh_set($meta , 'sh_sermon_pastor') , 0);
					 ?>
						<div class="sermon">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="image">
                                        <?php if(has_post_thumbnail()) the_post_thumbnail('270x270'); ?>
                                        <a href="<?php the_permalink(); ?>" title=""><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                	<h3><a href="<?php the_permalink()?>" title=""><?php the_title();?></a></h3>
                                    <span><i class="fa fa-calendar-o"></i> <?php echo get_the_date('F d, Y');?></span>
                                    <p><?php echo substr(strip_tags(get_the_content()) , 0 , 100); ?></p>                                    
                                </div>
                                <div class="hover-in">
                                	<ul class="sermon-media lightbox">
                                    	<?php $host = get_video_host(sh_set($sermon_info, 'sermon_vid_link'));?>
                                        <li><a href="<?php echo sh_set($sermon_info , 'sermon_vid_link'); ?>" data-poptrox="<?php echo esc_attr($host); ?>"title=""><i class="fa fa-film"></i></a></li>
                                        <li><a title=""><i class="audio-btn fa fa-headphones"></i>
                                            <div class="audioplayer"><audio id="player2" src="<?php echo sh_set($sermon_info , 'audio_upload'); ?>"></audio><span class="cross">X</span></div>
                                        </a></li>
                                        <li><a href="<?php echo sh_set($sermon_info , 'download_link'); ?>" title=""><i class="fa fa-download"></i></a></li>
                                        <li><a href="<?php echo sh_set($sermon_info , 'pdf_file'); ?>" title=""><i class="fa fa-book"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endwhile ; endif; ?>
					</div>
                    <?php sh_the_pagination();?>
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