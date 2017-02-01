<?php

class SH_Prayers {

    function __construct() {
        add_action('admin_menu', array($this, 'sh_prayers_options'));
        add_action('admin_print_scripts', array($this, 'sh_script_prayer_style'));
    }

    function sh_prayers_options() {
        add_theme_page('Prayer', 'Prayer', 'manage_options', 'deeds_prayer', array($this, 'sh_prayer_settings'), 'dashicons-chart-area');
    }

    function sh_prayer_settings() {
        global $wpdb;

        $wpdb->show_errors();
        $table_name = $wpdb->prefix . "prayers";

        $pagenum = isset($_GET['paged']) ? (int) $_GET['paged'] : 1;
        $limit = get_option('posts_per_page'); // number of rows in page
        $offset = ( $pagenum - 1 ) * $limit;

        $total = $wpdb->get_var("SELECT COUNT('id') FROM " . $table_name);
        $num_of_pages = ceil($total / $limit);
        //printr($num_of_pages);

        $select = $wpdb->get_results('select * from ' . $table_name . ' ORDER BY id DESC LIMIT ' . $limit . ' offset ' . $offset);
        if ($select == 0) {
            
        }
        ?>
        <div class="wrap">
            <h2>Prayers</h2>
        </div>
        <?php
        $page_links = paginate_links(array(
            'base' => add_query_arg('paged', '%#%'),
            'format' => '',
            'prev_text' => __('&laquo;', 'aag'),
            'next_text' => __('&raquo;', 'aag'),
            'total' => $num_of_pages,
            'current' => $pagenum
        ));

        if ($page_links) {
            echo '<div class="tablenav"><div class="tablenav-pages" >' .
            $page_links . '</div></div>';
        }
        ?>
        <div id="ad_url" style="display:none"><?php echo admin_url(); ?></div>
        <div id="admn_url" style="display:none"><?php echo get_template_directory_uri(); ?></div>
        <div id="overlay_img"><img src="<?php echo get_template_directory_uri() ?>/images/status.gif" /></div>
        <div class="mytable">
            <div class="table-head">
                <h3 class="tbl-check"><input type="checkbox"  /></h3>
                <h3 class="tbl-title">Name</h3>
                <h3 class="tbl-author">Email</h3>
                <h3 class="tbl-cat">Message</h3>
                <h3 class="tbl-date">DATE</h3>
                <h3 class="tbl-status">Status</h3>
            </div>
            <ul id="navigate">
        <?php foreach ($select as $key => $value): ?>
                    <li>
                        <div class="tbl-check">
                            <h5><input type="checkbox" name="list[]" /></h5>
                        </div>
                        <div class="tbl-title">
                            <h5><?php echo $value->name ?></h5>
                            <ul id="mouseshower" style="display:none;">
                                <li><a data-val="<?php echo $value->id ?>" id="sh_view" href="javascript:void(0)">View</a></li>
                                <li><a data-val="<?php echo $value->id ?>" id="sh_reply" href="javascript:void(0)">Reply</a></li>
                                <li><a data-val="<?php echo $value->id ?>" id="sh_approve" href="javascript:void(0)">Approve</a></li>
                                <li><a data-val="<?php echo $value->id ?>" id="sh_delete" href="javascript:void(0)">Delete</a></li>
                            </ul>
                        </div>
                        <div class="tbl-author">
                            <span><?php echo $value->email ?></span>
                        </div>
                        <div class="tbl-cat">
                            <span><?php echo substr($value->message, 0, 80) ?></span>
                        </div>
                        <div class="tbl-date">
                            <span><?php $d = strtotime($value->date);
            echo date('m/d/Y', $d); ?></span>
                        </div>
                        <div class="tbl-status">
                            <span><?php echo ucwords($value->status) ?></span>
                        </div>
                    </li>
        <?php endforeach; ?>
            </ul>

            <div class="table-head-bottom">
                <h3 class="tbl-check"><input type="checkbox" /></h3>
                <h3 class="tbl-title">Name</h3>
                <h3 class="tbl-author">Email</h3>
                <h3 class="tbl-cat">Message</h3>
                <h3 class="tbl-date">DATE</h3>
                <h3 class="tbl-status">Status</h3>
            </div>
        </div>
        <div id="overlay" style="display:none;"></div>
        <div class="popupbox" style="display:none;" id="view_box">

        </div>
        <?php
    }

    function sh_script_prayer_style() {
        $css_dir = SH_URL . 'css/';
        $js_dir = SH_URL . 'js/';

        $script = array(
            'prayer' => 'prayer.js'
        );

        foreach ($script as $js => $file) {
            $file_url = $js_dir . $file;
            wp_register_script($js, $file_url, array(), SH_VERSION, 'true');
        }

        $page = sh_set($_GET, 'page');
        if ($page == 'deeds_prayer') {
            if (is_admin()) {
                wp_enqueue_script(array('prayer'));
            }
        }

        $style = array(
            'prayer' => 'prayer.css',
        );

        foreach ($style as $css => $file) {
            $file_url = $css_dir . $file;
            $page = sh_set($_GET, 'page');
            if ($page == 'deeds_prayer') {
                wp_enqueue_style($css, $file_url, array(), SH_VERSION, 'all');
            }
        }
    }

}
