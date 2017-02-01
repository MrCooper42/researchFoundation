<?php
/**
 * Single Forum Content Part
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
                <?php bbp_forum_subscription_link(); ?>
            
                <?php do_action( 'bbp_template_before_single_forum' ); ?>
            
                <?php if ( post_password_required() ) : ?>
            
                    <?php bbp_get_template_part( 'form', 'protected' ); ?>
            
                <?php else : ?>
            
                    <?php bbp_single_forum_description(); ?>
            
                    <?php if ( bbp_has_forums() ) : ?>
            
                        <?php bbp_get_template_part( 'loop', 'forums' ); ?>
            
                    <?php endif; ?>
            
                    <?php if ( !bbp_is_forum_category() && bbp_has_topics() ) : ?>
            
                        <?php bbp_get_template_part( 'pagination', 'topics'    ); ?>
            
                        <?php bbp_get_template_part( 'loop',       'topics'    ); ?>
            
                        <?php bbp_get_template_part( 'pagination', 'topics'    ); ?>
            
                        <?php bbp_get_template_part( 'form',       'topic'     ); ?>
            
                    <?php elseif ( !bbp_is_forum_category() ) : ?>
            
                        <?php bbp_get_template_part( 'feedback',   'no-topics' ); ?>
            
                        <?php bbp_get_template_part( 'form',       'topic'     ); ?>
            
                    <?php endif; ?>
            
                <?php endif; ?>
            
                <?php do_action( 'bbp_template_after_single_forum' ); ?>
            
            </div>
		</div>
	</div>
</section>