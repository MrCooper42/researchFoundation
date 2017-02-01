<?php get_header(); ?>
<?php
if (have_posts()): while (have_posts()): the_post();

        $theme_options = get_option('wp_deeds' . '_theme_options'); //printr($theme_options);

        $sermons_meta = get_post_meta(get_the_ID(), 'sh_sermon_meta', true);
        $sermons_page_options = sh_set(sh_set($sermons_meta, 'sh_sermons_page_options'), 0);

        $sermon_info = sh_set(sh_set($sermons_meta, 'sh_sermon_options'), 0);
        $sermon_pastor = sh_set(sh_set($sermons_meta, 'sh_sermon_pastor'), 0);


        if (sh_set($sermons_page_options, 'show_sermon_banner')) {
            $show_banner = sh_set($sermons_page_options, 'show_sermon_banner');
            $subtitle = sh_set($sermons_page_options, 'sub_title');
            $bg = (sh_set($sermons_page_options, 'top_img')) ? "style=background:url(" . sh_set($sermons_page_options, 'top_img') . ")" : '';
        } elseif (sh_set($theme_options, 'show_single_sermon_banner')) {
            $show_banner = sh_set($theme_options, 'show_single_sermon_banner');
            $subtitle = sh_set($theme_options, 'single_sermon_subtitle');
            $bg = (sh_set($theme_options, 'single_sermon_banner_image')) ? "style=background:url(" . sh_set($theme_options, 'single_sermon_banner_image') . ")" : '';
        } else {
            $show_banner = "";
            $subtitle = "";
            $bg = '';
        }

        if (sh_set($sermons_page_options, 'sidebar')) {
            $sidebar = sh_set($sermons_page_options, 'sidebar');
            $layout = sh_set($sermons_page_options, 'layout');
        } elseif (sh_set($theme_options, 'single_sermon_sidebar')) {
            $sidebar = sh_set($theme_options, 'single_sermon_sidebar');
            $layout = sh_set($theme_options, 'single_sermon_layout');
        } else {
            $sidebar = '';
            $layout = '';
        }

        $col_class = ($sidebar && $layout != 'full') ? 'col-md-8' : 'col-md-12';


        if (sh_set($theme_options, 'custom_header') == 'header1' || sh_set($theme_options, 'custom_header') == 'header3' || sh_set($theme_options, 'custom_header') == 'header5' || sh_set($theme_options, 'custom_header') == 'header6' || sh_set($theme_options, 'custom_header') == 'header7'): $rem_gap = 'extra-gap';
        else:
            $rem_gap = '';
        endif;
        ?>

        <?php if ($show_banner) : ?>
            <div class="page-top <?php echo $rem_gap; ?>">
                <div class="parallax" <?php echo esc_attr($bg); ?>></div>
                <div class="container">
                    <h1><?php the_title(); ?></h1>
                    <span> <?php echo esc_html($subtitle); ?></span>
                    <?php
                    if (sh_set($theme_options, 'show_single_sermon_breadcrumbs')) :
                        echo sh_get_the_breadcrumb();
                    endif;
                    ?>
                </div>
            </div>
        <?php endif; ?>

        <section>
            <div class="block">
                <div class="container">
                    <div class="row">
                        <?php if ($sidebar && $layout == 'left'): ?>
                            <aside class="col-md-4 sidebar column">
                                <?php dynamic_sidebar($sidebar); ?>
                            </aside>
                        <?php endif; ?>
                        <div class="<?php echo $col_class; ?> column">
                            <div class="single-page">
                                <?php if (has_post_thumbnail()) the_post_thumbnail('770x324'); ?>
                                <h2><?php the_title(); ?></h2>
                                <?php if (sh_set($theme_options, 'show_single_sermon_date') || sh_set($theme_options, 'show_single_sermon_author')) : ?>
                                    <div class="meta">
                                        <ul>
                                            <?php if (sh_set($theme_options, 'show_single_sermon_date')) : ?>
                                                <li><i class="fa fa-calendar-o"></i><?php echo get_the_date(); ?></li>
                                            <?php endif; ?>
                                            <?php if (sh_set($theme_options, 'show_single_sermon_author')) : ?>
                                                <?php echo (sh_set($sermon_pastor, 'pastor_name')) ? "<li><i class='fa fa-user'></i>" . sh_set($sermon_pastor, 'pastor_name') . "</li>" : ''; ?>
                                            <?php endif; ?>
                                        </ul>
                                        <?php if (sh_set($theme_options, 'show_single_sermon_author')) : ?>
                                            <img src="<?php echo sh_set($sermon_pastor, 'pastor_image'); ?>" alt="" />
                                        <?php endif; ?>
                                    </div><!-- POST META -->
                                <?php endif ?>

                                <?php if (sh_set($sermon_info, 'sermon_vid_link') != '' || sh_set($sermon_info, 'audio_upload') != '' || sh_set($sermon_info, 'download_link') || sh_set($sermon_info, 'pdf_file')): ?>
                                    <ul class="sermon-media">
                                        <?php
                                        $host = get_video_host(sh_set($sermon_info, 'sermon_vid_link'));
                                        if ($host == 'youtu'):
                                            $host = 'youtube';
                                        elseif ($host == 'fast'):
                                            $host = 'wistia';
                                        else:
                                            $host = $host;
                                        endif;
                                        ?>
                                        <?php if (sh_set($sermon_info, 'sermon_vid_link') != ''): ?>
                                            <li class="lightbox"><a href="<?php echo esc_url(sh_set($sermon_info, 'sermon_vid_link')); ?>" data-poptrox="<?php echo esc_attr($host); ?>"><i class="fa fa-film"></i></a></li>
                                          
                                        <?php endif; ?>
                                        <?php if (sh_set($sermon_info, 'audio_upload') != ''): ?>
                                            <li><a title=""><i class="audio-btn fa fa-headphones"></i>
                                                    <div class="audioplayer"><audio id="player2" src="<?php echo sh_set($sermon_info, 'audio_upload'); ?>"></audio><span class="cross">X</span></div>
                                                </a></li>

                                        <?php endif; ?>
                                        <?php if (sh_set($sermon_info, 'download_link') != ''): ?><li><a href="<?php echo sh_set($sermon_info, 'download_link'); ?>" title=""><i class="fa fa-download"></i></a></li><?php endif; ?>
                                        <?php if (sh_set($sermon_info, 'pdf_file') != ''): ?><li><a href="<?php echo sh_set($sermon_info, 'pdf_file'); ?>" title=""><i class="fa fa-book"></i></a></li><?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                            </div><!-- TEAM SINGLE -->
                            <?php the_content(); ?>
                            <?php if (sh_set($sermon_pastor, 'show_pastor')): ?>
                                <div class="pastor-info">
                                    <img src="<?php echo sh_set($sermon_pastor, 'pastor_image'); ?>" alt="" />
                                    <h4><?php echo sh_set($sermon_pastor, 'pastor_name'); ?><span><?php echo sh_set($sermon_pastor, 'pastor_desig'); ?></span></h4>
                                    <p><?php echo sh_set($sermon_pastor, 'pastor_description'); ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if (sh_set($theme_options, 'show_single_sermon_shareicon')) : ?>
                                <div class="share-this">
                                    <h5><i class="fa fa-share"></i> <?php _e("SHARE THIS SERMON", 'wp_deeds'); ?></h5>
                                    <?php sh_social_sharing(); ?>
                                </div>
                            <?php endif; ?>
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

        <?php
    endwhile;
endif;
get_footer();
?>
