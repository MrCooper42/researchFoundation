<?php get_header();  
$theme_options = get_option('wp_deeds'.'_theme_options');


$object = get_queried_object(); 
/*

$ = ($wp_query->is_posts_page)? sh_set($page_meta , 'sub_title'): sh_set($theme_options , 'blog_page_sub_title');
$sidebar = ($wp_query->is_posts_page)? sh_set($page_meta , 'sidebar'): sh_set($theme_options , 'blog_page_sidebar');
$page_layout = ($wp_query->is_posts_page)? sh_set($page_meta , 'page_layout'): sh_set($theme_options , 'blog_page_layout');
*/

$cat_settings = get_option('_sh_category_settings'.$object->cat_ID);
$cat_sets = sh_set( sh_set ( $cat_settings, 'sh_category_options' ), 0 );

if( sh_set( $cat_sets, 'category_page_sidebars' ) != '' && sh_set( $cat_sets, 'category_page_layout') != '' ) {
	$sidebar = sh_set( $cat_sets, 'category_page_sidebars' );
	$position = (sh_set( $cat_sets, 'category_page_layout' ))?sh_set( $cat_sets, 'category_page_layout' ): '';
	$span = ( $sidebar ) ? 'col-md-8' : 'col-md-12';
}elseif( sh_set( $theme_options , 'category_page_sidebar' ) != '' ) {
	$sidebar = (sh_set( $theme_options, 'category_page_sidebar' ))?sh_set( $theme_options, 'category_page_sidebar' ):'';
	$position = (sh_set( $theme_options, 'category_page_sidebar_position' ))?sh_set( $theme_options, 'category_page_sidebar_position' ):'';
	$span = ( $sidebar ) ? 'col-md-8' : 'col-md-12';
}else {
	$sidebar = "";
	$position = '';
	$span = 'col-md-12';
}

?>
<?php if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>

<?php 
	if (sh_set($theme_options, 'show_cat_banner')) :
	$head_img = (sh_set( $theme_options, 'category_page_bg' )) ? 'style=background:url('.sh_set( $theme_options, 'category_page_bg' ).');' : '';
 ?>
<div class="page-top <?php echo $rem_gap; ?>">
	<div class="parallax" <?php echo esc_attr($head_img); ?> ></div>	
	<div class="container"> 
		<h1><?php echo (sh_set($theme_options, 'category_page_title')) ? esc_html(sh_set($theme_options, 'category_page_title')) : "" ?></h1>
        <span> <?php echo (sh_set($theme_options, 'cat_page_subtitle')) ? esc_html(sh_set($theme_options, 'cat_page_subtitle')) : ""; ?></span>
        <?php echo sh_get_the_breadcrumb() ; ?>
	</div>
</div>
<?php endif; ?>

<section>
	<div class="block">
		<div class="container">
			<div class="row">
            	<?php if($sidebar && $position == 'left') : ?>
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
                                        <?php if(sh_set($theme_options , 'show_category_date')) : ?>
                                        <span><i class="fa fa-calendar-o"></i> <?php echo get_the_date(); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
    				<?php endwhile ; ?>
                    
                    <?php sh_the_pagination();?>
						
					</div>
				</div>
                <?php if($sidebar && $position == 'right') : ?>
				<aside class="col-md-4 sidebar column">
					<?php dynamic_sidebar($sidebar); ?>
				</aside>
                <?php endif; ?>
			</div>
		</div>
	</div>
</section>	
<?php get_footer(); ?>