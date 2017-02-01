<?php get_header();
$theme_settings = get_option( 'wp_deeds'.'_theme_options' );
$theme_options = get_option( 'wp_deeds'.'_theme_options' );
$sidebar = sh_set( $theme_settings, '404_page_sidebar' );
$position = sh_set( $theme_settings, '404_page_sidebar_position' );
$span = ( $sidebar ) ? 'col-md-8' : 'col-md-12';
$imp = explode(' ', sh_set( $theme_settings, '404_page_title' ), 2);
?>
<?php if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>
<div class="page-top <?php echo $rem_gap; ?>">
	<div class="parallax" <?php if( sh_set( $theme_settings, '404_page_bg' ) ): ?> style="background:url(<?php echo sh_set( $theme_settings, '404_page_bg' );?>);" <?php endif;?>></div>		
	<div class="container"> 
		<h1><?php echo sh_set( $imp, 0 )?> <span><?php echo sh_set( $imp, 1 )?></span></h1>
		<?php echo sh_get_the_breadcrumb(); ?>
	</div>
</div><!--- PAGE TOP -->

<section>
	<div class="block">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="error-page">
						<h3><?php echo sh_set( $theme_settings, '404_page_heading' )?></h3>
						<i class="fa fa-thumbs-o-down"></i>
						<p><?php echo sh_set( $theme_settings, '404_page_tag_line' )?></p>
						<div class="row">
							<div class="col-md-6">
								<h4>40<i>4</i></h4>
							</div>
							<div class="col-md-6">
								<div class="quick-help">
									<span><i class="fa fa-gift"></i></span>
									<h5>FOR QUICK <span>Help</span></h5>
									<p><?php echo sh_set( $theme_settings, '404_page_text' )?></p>
								</div>

								<div class="widget">
									<form class="searchform" action="<?php echo home_url()?>" method="get">
										<input name="s" type="text" placeholder="START SEARCHING">
										<input type="submit" value="<?php _e("Search" , 'wp_deeds');?>">
									</form>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>