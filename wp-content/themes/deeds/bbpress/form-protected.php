<?php

/**
 * Password Protected
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<?php
$theme_options = get_option('wp_deeds'.'_theme_options');
if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>

<div class="page-top <?php echo $rem_gap; ?>">
<div class="parallax" style="background:url(<?php echo sh_set($theme_options , 'bbpress_image'); ?>);"></div>	
<div class="container"><?php if ( function_exists( bbp_breadcrumb() ) ): bbp_breadcrumb(); endif; ?></div></div>
<section>
	<div class="block">
		<div class="container">
        
<div id="bbpress-forums">
	<fieldset class="bbp-form" id="bbp-protected">
		<Legend><?php _e( 'Protected', 'bbpress' ); ?></legend>

		<?php echo get_the_password_form(); ?>

	</fieldset>
</div>

</div>
</div>
</section>