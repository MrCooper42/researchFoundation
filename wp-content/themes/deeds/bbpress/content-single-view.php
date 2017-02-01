<?php

/**
 * Single View Content Part
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


	<?php bbp_set_query_name( bbp_get_view_rewrite_id() ); ?>

	<?php if ( bbp_view_query() ) : ?>

		<?php bbp_get_template_part( 'pagination', 'topics'    ); ?>

		<?php bbp_get_template_part( 'loop',       'topics'    ); ?>

		<?php bbp_get_template_part( 'pagination', 'topics'    ); ?>

	<?php else : ?>

		<?php bbp_get_template_part( 'feedback',   'no-topics' ); ?>

	<?php endif; ?>

	<?php bbp_reset_query_name(); ?>

</div>

</div>
</div>
</section>