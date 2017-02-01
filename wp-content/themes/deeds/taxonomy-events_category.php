<?php get_header();  
global $wp_query, $paged;
$ob = get_queried_object();
$cat_options = sh_set(sh_set(get_option('_sh_event_category_settings'.$ob->term_id) , 'sh_category_options') , 0);

$sidebar = sh_set( $cat_options, 'category_page_sidebar' );
$position = sh_set( $cat_options, 'category_page_layout' );
$span = ( $sidebar ) ? 'col-md-8' : 'col-md-12';

if(  sh_set( $cat_options, 'category_page_header_image' ) ):
	$bg = 'style="background:url('.sh_set( $cat_options, 'category_page_header_image' ).');"';
else:
	$bg = '';
endif;


?>
<?php $theme_options = get_option('wp_deeds'.'_theme_options'); ?>
<?php if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>
<div class="page-top <?php echo $rem_gap; ?>">
	<div class="parallax" <?php echo $bg; ?>></div>
	<div class="container"> 
		<h1><?php echo ucwords($ob->name); ?></h1>
        <span> <?php _e( 'Archive', 'wp_deeds' ) ?></span>
		<?php echo sh_get_the_breadcrumb(); ?>
	</div>
</div>
<section>
	<div class="block">
		<div class="container">
			<div class="row">
            	<?php if($position == 'left') : ?>
                <aside class="col-md-4 sidebar column">
					<?php dynamic_sidebar($sidebar); ?>
				</aside>
            	<?php endif; ?>
				<div class="<?php echo $span; ?> column">
					<div class="remove-ext">
						
                       <?php while(have_posts()): the_post(); ?>						
                         <div class="blog-post">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="image">
                                        <?php the_post_thumbnail( '370x230' ); ?>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="blog-detail">
                                        <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                        <p><?php echo substr(strip_tags(get_the_content()) , 0 , 150)?></p>
                                        <span><i class="fa fa-calendar-o"></i> <?php echo get_the_date(); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
    				<?php endwhile ; ?>
                    
                    <?php sh_the_pagination();?>
						
					</div>
				</div>
                <?php if($position == 'right') : ?>
				<aside class="col-md-4 sidebar column">
					<?php dynamic_sidebar($sidebar); ?>
				</aside>
                <?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php
get_footer(); ?>