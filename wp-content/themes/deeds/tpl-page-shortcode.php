<?php
/* Template Name: Shortcode Template */
get_header(); 
$settings  = sh_set(sh_set(get_post_meta(get_the_ID(), 'sh_page_meta', true) , 'sh_page_options') , 0);

$theme_options = get_option('wp_deeds'.'_theme_options');

$sidebar = sh_set( $settings, 'sidebar' );
$position = sh_set( $settings, 'layout' );
$span = ( $sidebar ) ? 'col-md-8' : 'col-md-12';

?>
<?php if(sh_set($settings , 'home') != 1):
if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>
<?php if( !$settings ): ?>
	<div class="page-top">
    	<div class="parallax" style="background:url();"></div>
        <div class="container">
        <h1><?php the_title(); ?></h1>
        <span> <?php echo sh_set($settings , 'sub_title'); ?></span>
        <?php  echo sh_get_the_breadcrumb(); ?>
        </div>
    </div>
<?php endif; ?>
<div class="<?php if( sh_set( $settings, 'breadcumb') == 1 ): echo 'page-top'; endif; ?> <?php echo $rem_gap; ?>">
	<?php if( sh_set( $settings, 'breadcumb') == 1 ): ?>
		<div class="parallax" style="background:url(<?php echo sh_set($settings , 'top_img');?>);"></div>	
    <?php endif; ?>
	<div class="container">
    	<?php if( sh_set( $settings, 'breadcumb') == 1 ): ?>
			<h1><?php the_title(); ?><span> <?php echo sh_set($settings , 'sub_title'); ?></span></h1>
		<?php  echo sh_get_the_breadcrumb(); endif; ?>
	</div>
</div>
<?php endif; ?>

	<?php while( have_posts() ): the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>

                

<?php get_footer(); ?>