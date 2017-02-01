<?php

/**
 * Archive Topic Content Part
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

	<?php if ( bbp_allow_search() ) : ?>

		<div class="bbp-search-form">

			<?php bbp_get_template_part( 'form', 'search' ); ?>

		</div>

	<?php endif; ?>


	<?php if ( bbp_is_topic_tag() ) bbp_topic_tag_description(); ?>

	<?php do_action( 'bbp_template_before_topics_index' ); ?>

	<?php if ( bbp_has_topics() ) : ?>

		<?php bbp_get_template_part( 'pagination', 'topics'    ); ?>

		<?php bbp_get_template_part( 'loop',       'topics'    ); ?>

		<?php bbp_get_template_part( 'pagination', 'topics'    ); ?>

	<?php else : ?>

		<?php bbp_get_template_part( 'feedback',   'no-topics' ); ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_topics_index' ); ?>

</div>

</div>
</div>
</section>
