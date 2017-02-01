<?php

class WST_Xml_importer {

    private static $_instance = null;
    private $demo;

    public function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'WST_importer_script'));
    }

    public function wst_demo_importer($options) {
        if (file_exists(SH_ROOT . 'framework/backup/'.sh_set($options, 'demo').'/data.xml')) {
            $pt_one_click_demo_import = new wp_wpstoreImporter(sh_set($options, 'demo'));
        }
        exit;
    }

    
    public function WST_importer_script() {
        wp_enqueue_style('WST_imorter', SH_URI . 'assets/css/dropdown.css');
        $script = array(
            'dropdown' => 'assets/js/dropdown.js',
            'print_element' => 'assets/js/print_element.js',
        );
        foreach ($script as $key => $s) {
            wp_enqueue_script('WP_WPSTORE_' . $key, SH_URI . $s, array(), SH_VERSION, true);
        }
    }

    static public function get_instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

}
