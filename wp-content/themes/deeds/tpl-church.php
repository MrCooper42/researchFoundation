<?php 
/* Template Name: Church */
get_header(); 
global $paged;
$args = array('post_type' => 'cs_church', 'paged' => $paged ); 
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
				<div class="<?php echo $col_class; ?>">
					<div class="remove-ext">
                            	<?php 
									query_posts( $args ); if(have_posts()):  while(have_posts()): the_post(); 
									$church_meta = get_post_meta(get_the_ID() , 'sh_church_meta' , true) ;
								?>
									<div class="<?php echo $inner_col; ?>">
									<div class="story">
                                        <div class="team-img">
                                            <?php if(has_post_thumbnail()): the_post_thumbnail( '370x230' ); endif; ?>
                                            <a href="<?php the_permalink()?>" title=""><i class="fa fa-link"></i></a>
                                        </div>											
                                        <div class="story-detail">
                                            <span class="date"><i class="fa fa-calendar-o"></i> <?php echo get_the_date()?></span>
                                            <h3><a href="<?php the_permalink();?>" title=""><?php the_title();?></a></h3>
                                            <span><i class="fa fa-user"></i> <?php echo sh_set( $church_meta, 'author' );?></span>
                                        </div>
									</div>
								</div>
                                <?php endwhile ; endif; ?>
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