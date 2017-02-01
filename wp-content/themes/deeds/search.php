<?php get_header(); 
$theme_settings = get_option( 'wp_deeds'.'_theme_options' ); 

$title = (sh_set($theme_settings, 'search_page_title')) ? sh_set($theme_settings, 'search_page_title') : '';
$subtitle = (sh_set($theme_settings, 'search_page_subtitle')) ? sh_set($theme_settings, 'search_page_subtitle') : '';
$bg = (sh_set($theme_settings, 'search_page_bg')) ? 'style=background:url('.sh_set($theme_settings, 'search_page_bg').');' : '';
$sidebar = (sh_set( $theme_settings, 'search_page_sidebar')) ? sh_set( $theme_settings, 'search_page_sidebar') : "";
$position = (sh_set($theme_settings, 'search_page_sidebar_position') != '' && $sidebar) ? sh_set( $theme_settings, 'search_page_sidebar_position') : "";
$span = ( $sidebar && $position != "" ) ? 'col-md-8' : 'col-md-12';
?>
<?php if( sh_set( $theme_settings, 'custom_header' ) == 'header1' || sh_set( $theme_settings, 'custom_header' )== 'header3' || sh_set( $theme_settings, 'custom_header' )== 'header5' || sh_set( $theme_settings, 'custom_header' )== 'header6' || sh_set( $theme_settings, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>

<?php if(sh_set($theme_settings, 'show_search_banner')) : ?>
<div class="page-top <?php echo $rem_gap; ?>">
	<div class="parallax" <?php echo esc_attr($bg); ?>></div>	
	<div class="container"> 
		<h1><?php echo esc_html($title); ?></h1>
        <span> <?php echo esc_html($subtitle); ?></span>
        <?php echo sh_get_the_breadcrumb() ; ?>
	</div>
</div>
<?php endif; ?>

<section>
	<div class="block">
		<div class="container">
			<div class="row">
			<?php if( $sidebar && $position == 'left' ): ?>
				<aside class="col-md-4 sidebar column"><?php dynamic_sidebar( $sidebar );?></aside>
			<?php endif; ?>
            <?php if(have_posts()){ ?>
				<div class="<?php echo $span ; ?>">
					<div class="remove-ext">
						<div class="search-page">
								<h4><?php _e("Search Result Found For:" , 'wp_deeds'); ?> <span>"<?php echo get_search_query(); ?>"</span></h4>
							</div>
							 <?php if(have_posts()): while(have_posts()): the_post();?>
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
							<?php endwhile; endif ; ?>
                            <div class="widget">
								<p><?php _e("Enter your keyword to found more" , 'wp_deeds') ; ?></p>
								<form class="searchform" action="<?php echo home_url();?>" method="get">
									<input name="s" type="text" placeholder="START SEARCHING" />
									<input type="submit" value="" />
								</form>
							</div><!-- SEARCH FORM -->
				 			<?php sh_the_pagination(); ?>
                            <div class="search-result">
                                
                            </div>
							</div>
                            </div>
                            <?php if( $sidebar && sh_set( $theme_settings, 'search_page_sidebar_position' ) == 'right' ): ?>
                                <aside class="col-md-4 sidebar column"><?php dynamic_sidebar( $sidebar );?></aside>
                            <?php endif; ?>
					<?php } 
					else {?>
					<div class="<?php echo $span ; ?>">
						<div class="search-result">
							<h4><?php _e("Search Result Found For: " , 'wp_deeds'); ?> <span>"<?php echo get_search_query(); ?>"</span></h4>
						</div>
						<div class="search-result">
							<p><?php _e("No results found. Please adjust your search term and try again." , 'wp_deeds'); ?></p>
						</div>
					</div>
                    <?php if( $sidebar && $position == 'right' ): ?>
						<aside class="col-md-4 sidebar column"><?php dynamic_sidebar( $sidebar );?></aside>
					<?php endif; ?>
					<?php } ?>
					</div>
					
				</div><!-- LEFT SIDE CONTENT -->
			</div>
		</div>
	</div>
</section>  
<?php get_footer(); ?>