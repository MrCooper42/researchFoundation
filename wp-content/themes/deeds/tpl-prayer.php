<?php
/* Template Name: Prayer */

get_header();
global $paged;

$settings = sh_set(sh_set(get_post_meta(get_the_ID(), 'sh_page_meta', true), 'sh_page_options'), 0);
$sidebar = sh_set($settings, 'sidebar');
$layout = sh_set($settings, 'layout');
$col_class = ($sidebar && $layout != 'full') ? 'col-md-8' : 'col-md-12';
$inner_col = ($sidebar && $layout != 'full') ? 'col-md-6' : 'col-md-4';
?>


<?php
global $wpdb;

$wpdb->show_errors();
$table_name = $wpdb->prefix . "prayers";

$pagenum = isset($_GET['paged']) ? (int) $_GET['paged'] : 1;
$limit = get_option('posts_per_page'); // number of rows in page
$offset = ( $pagenum - 1 ) * $limit;

$total = $wpdb->get_var("SELECT COUNT('id') FROM " . $table_name);
$num_of_pages = ceil($total / $limit);
//printr($num_of_pages);

$select = $wpdb->get_results('select * from ' . $table_name . ' ORDER BY id ASC LIMIT ' . $limit . ' offset ' . $offset);

if (!empty($select)) {
    $wpdb->print_error();
}
?>

<?php $theme_options = get_option('wp_deeds' . '_theme_options'); ?>

<?php if (sh_set($theme_options, 'custom_header') == 'header1' || sh_set($theme_options, 'custom_header') == 'header3' || sh_set($theme_options, 'custom_header') == 'header5' || sh_set($theme_options, 'custom_header') == 'header6' || sh_set($theme_options, 'custom_header') == 'header7'): $rem_gap = 'extra-gap';
else: $rem_gap = '';
endif; ?>

<div class="<?php if (sh_set($settings, 'breadcumb') == 1): echo 'page-top';
endif; ?> <?php echo $rem_gap; ?>">

    <?php if (sh_set($settings, 'breadcumb') == 1): ?>
        <div class="parallax" style="background:url(<?php echo sh_set($settings, 'top_img'); ?>);"></div>	
    <?php endif; ?>

    <div class="container"> 
        <?php if (sh_set($settings, 'breadcumb') == 1): ?>
            <h1><?php the_title(); ?></h1>
            <span> <?php echo sh_set($settings, 'sub_title'); ?></span>
            <?php echo sh_get_the_breadcrumb(); ?>
        <?php endif; ?>
    </div>

</div>

<section>
    <div class="block">
        <div class="container">
            <div class="row">

                <?php if ($sidebar && $layout == 'left'): ?>
                    <aside class="col-md-4 sidebar column">
                        <?php dynamic_sidebar($sidebar); ?>
                    </aside>
                <?php endif; ?>

                <div class="<?php echo $col_class; ?>">
                    <div class="row">
                        <div class="remove-ext">
                            <div class="prayers-columns">
                                <?php foreach ($select as $key => $value): ?>
                                    <div class="col-md-6 column">
                                        <div class="prayer">
                                            <p><?php echo $value->message ?></p>
                                            <h4><?php echo $value->name ?></h4>
                                            <span><?php $d = strtotime($value->date);
                                    echo date('m/d/Y', $d); ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($sidebar && $layout == 'right'): ?>
                    <aside class="col-md-4 sidebar column">
                        <?php dynamic_sidebar($sidebar); ?>
                    </aside>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>