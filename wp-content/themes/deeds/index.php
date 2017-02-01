<?php
get_header();
global $wp_query, $post;
$theme_options = get_option('wp_deeds' . '_theme_options');
$object = get_queried_object();

if (!$object) {
    echo '<style>
		.image img{
			height: 220px;
			width: 100%;
		}
	</style>';
}

if ($object):
    $page_meta = get_post_meta($object->ID, 'sh_page_meta', true);
    if (!$page_meta):
        echo '<style>
                .image img{
                        height: 220px;
                        width: 100%;
                }
		</style>';
    endif;
    if ($page_meta) :
        foreach ($page_meta as $key => $value) {
            foreach ($value as $key => $meta) {
                $meta_opt = $meta;
            }
        }
    else:
        $meta_opt = '';
    endif;
else:
    $meta_opt = '';
endif;
$sidebar = sh_set($meta_opt, 'sidebar');

if ($sidebar == ''): $sidebar = 'default-sidebar';
endif;

$layout = (sh_set($meta_opt, 'layout')) ? sh_set($meta_opt, 'layout') : 'right';

$col_class = ( $layout == 'left' || $layout == 'right' ) ? 'col-md-8' : 'col-md-12';
if (sh_set($theme_options, 'custom_header') == 'header1' || sh_set($theme_options, 'custom_header') == 'header3' || sh_set($theme_options, 'custom_header') == 'header5' || sh_set($theme_options, 'custom_header') == 'header6' || sh_set($theme_options, 'custom_header') == 'header7'): $rem_gap = 'extra-gap';
else: $rem_gap = '';
endif;
?>
<div class="page-top <?php echo $rem_gap; ?>">
    <div class="parallax" <?php if (sh_set($meta_opt, 'top_img') != '') : ?> style="background:url(<?php echo sh_set($meta_opt, 'top_img'); ?>);" <?php endif; ?>></div>	
    <div class="container"> 
        <h1><?php echo ($object) ? $object->post_title : 'Blog'; ?></h1>
        <span><?php echo sh_set($meta_opt, 'sub_title'); ?></span>
        <?php echo sh_get_the_breadcrumb(); ?>
    </div>
</div>
<section>
    <div class="block">
        <div class="container">
            <div class="row">
                <?php if ($layout == 'left') : ?>
                    <aside class="col-md-4 sidebar column">
                        <?php dynamic_sidebar($sidebar); ?>
                    </aside>
                <?php endif; ?>
                <div class="<?php echo $col_class; ?> column">
                    <div class="remove-ext">
                        <?php sh_blog_posts(); ?>
                    </div>                    
                    <?php sh_the_pagination() ?>                    
                </div>
                <?php if ($layout == 'right') : ?>
                    <aside class="col-md-4 sidebar column">
                        <?php dynamic_sidebar($sidebar); ?>
                    </aside>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>	
<?php get_footer(); ?>