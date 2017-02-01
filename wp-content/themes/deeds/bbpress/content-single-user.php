<?php

/**
 * Single User Content Part
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

	<?php do_action( 'bbp_template_notices' ); ?>

	<div id="bbp-user-wrapper">
		<?php bbp_get_template_part( 'user', 'details' ); ?>

		<div id="bbp-user-body">
			<?php if ( bbp_is_favorites()                 ) bbp_get_template_part( 'user', 'favorites'       ); ?>
			<?php if ( bbp_is_subscriptions()             ) bbp_get_template_part( 'user', 'subscriptions'   ); ?>
			<?php if ( bbp_is_single_user_topics()        ) bbp_get_template_part( 'user', 'topics-created'  ); ?>
			<?php if ( bbp_is_single_user_replies()       ) bbp_get_template_part( 'user', 'replies-created' ); ?>
			<?php if ( bbp_is_single_user_edit()          ) bbp_get_template_part( 'form', 'user-edit'       ); ?>
			<?php if ( bbp_is_single_user_profile()       ) bbp_get_template_part( 'user', 'profile'         ); ?>
		</div>
	</div>
</div>


</div>
</div>
</section>