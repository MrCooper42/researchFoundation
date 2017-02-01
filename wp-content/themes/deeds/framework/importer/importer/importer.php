<?php
require CPATH . 'importer/inc/class-helpers.php';
require CPATH . 'importer/inc/class-importer.php';
require CPATH . 'importer/inc/class-logger.php';

class wp_wpstoreImporter {
    private static $instance;
    private $selected_demo, $importer, $import_files, $logger, $log_file_path, $selected_index, $selected_import_files, $microtime, $frontend_error_messages, $ajax_call_number;

    public static function getInstance() {
        if ( null === static::$instance ) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function __clone() {
        
    }

    private function __wakeup() {
        
    }

    public function __construct($demo = '') {
        $this->selected_demo = $demo;
        $this->wp_wpstore_ajax_callback();
        $this->import_demo_data_ajax_callback();
    }

    public function wp_wpstore_ajax_callback() {
        $this->import_files = array();
        // Importer options array.
        $importer_options   = array( 'fetch_attachments' => true );

        // Logger options for the logger used in the importer.
        $logger_options = array( 'logger_min_level' => 'warning', );

        // Configure logger instance and set it to the importer.
        $this->logger            = new wp_wpstore_Logger();
        $this->logger->min_level = $logger_options['logger_min_level'];

        // Create importer instance with proper parameters.
        $this->importer = new wp_wpstore_Importer( $importer_options, $this->logger );
    }

    public function import_demo_data_ajax_callback() {
         
        ini_set( 'memory_limit', apply_filters( 'wp_wpstore/import_memory_limit', '350M' ) );
        $use_existing_importer_data = $this->get_importer_data();

        if ( !$use_existing_importer_data ) {
            $this->ajax_call_number        = empty( $this->ajax_call_number ) ? 0 : $this->ajax_call_number;
            $this->frontend_error_messages = '';
            $demo_import_start_time        = date( apply_filters( 'wp_wpstore/date_format_for_file_names', 'Y-m-d__H-i-s' ) );

            $this->log_file_path  = wp_wpstore_Helpers::get_log_path( $demo_import_start_time );
            $this->selected_index = empty( $_POST['selected'] ) ? 0 : absint( $_POST['selected'] );
            
            $_FILES               = SH_ROOT . 'framework/backup/'.$this->selected_demo.'/data.xml';
            
            if ( !empty( $_FILES ) ) {
                $this->selected_import_files                                   = array( 'content' => $_FILES );
                $this->import_files[$this->selected_index]['import_file_name'] = esc_html__( 'Manually uploaded files', 'wp_deeds' );
            } elseif ( !empty( $this->import_files[$this->selected_index] ) ) {
                print_r( 'ok' );
                exit;
                $this->selected_import_files = wp_wpstore_Helpers::download_import_files(
                        $this->import_files[$this->selected_index], $demo_import_start_time
                );
                if ( is_wp_error( $this->selected_import_files ) ) {
                    wp_wpstore_Helpers::log_error_and_send_ajax_response(
                        $this->selected_import_files->get_error_message(), $this->log_file_path, esc_html__( 'Downloaded files', 'wp_deeds' )
                    );
                }
                $log_added = wp_wpstore_Helpers::append_to_file(
                        sprintf(
                            esc_html__( 'The import files for: %s were successfully downloaded!', 'wp_deeds' ), $this->import_files[$this->selected_index]['import_file_name']
                        ) . wp_wpstore_Helpers::import_file_info( $this->selected_import_files ), $this->log_file_path, esc_html__( 'Downloaded files', 'wp_deeds' )
                );
            } else {
                wp_send_json( esc_html__( 'No import files specified!', 'wp_deeds' ) );
            }
        }
        $this->frontend_error_messages .= $this->import_content( $this->selected_import_files['content'] );

        

        /**
         * 6. After import setup.
         */
        $action = 'wp_wpstore/after_import';
        if ( ( false !== has_action( $action ) ) && empty( $this->frontend_error_messages ) ) {

            // Run the after_import action to setup other settings.
            $this->do_import_action( $action, $this->import_files[$this->selected_index] );
        }

        // Display final messages (success or error messages).
        if ( empty( $this->frontend_error_messages ) ) {
            wp_wpstore_wpImporterScript($this->selected_demo);
            //(new ReduxFramework_extension_importer() )->wp_wpstore_ImportSettings();
            $response['message'] = sprintf(
                esc_html__( 'Webinane 1-Click Import System has completed its task and the Data import is complete now. You can verify it here. If you face any problem, you can contact our support desk for further help. Submit your ticket here to %1$scontact support team%2$s.', 'wp_deeds' ), '<a href="https://webinane.ticksy.com/" target="_blank">', '</a>'
            );
        } else {
            $response['message'] = $this->frontend_error_messages . '<br>';
            $response['message'] .= sprintf(
                esc_html__( '%1$sThe demo import has finished, but there were some import errors.%2$sMore details about the errors can be found in this %3$s%5$slog file%6$s%4$s%7$s', 'wp_deeds' ), '<div class="notice  notice-error"><p>', '<br>', '<strong>', '</strong>', '<a href="' . wp_wpstore_Helpers::get_log_url( $this->log_file_path ) . '" target="_blank">', '</a>', '</p></div>'
            );
        }
        wp_send_json( $response );
    }

    private function import_content( $import_file_path ) {
        $this->microtime = microtime( true );
        set_time_limit( apply_filters( 'wp_wpstore/set_time_limit_for_demo_data_import', 300 ) );
        add_filter( 'wxr_importer.pre_process.user', '__return_false' );
        add_filter( 'wxr_importer.pre_process.post', array( $this, 'new_ajax_request_maybe' ) );
        if ( !apply_filters( 'wp_wpstore/regenerate_thumbnails_in_content_import', true ) ) {
            add_filter( 'intermediate_image_sizes_advanced', function() {
                return null;
            }
            );
        }
        if ( !empty( $import_file_path ) ) {
            ob_start();
            $this->importer->import( $import_file_path );
            $message   = ob_get_clean();
            $log_added = wp_wpstore_Helpers::append_to_file(
                    $message . PHP_EOL . esc_html__( 'Max execution time after content import = ', 'wp_deeds' ) . ini_get( 'max_execution_time' ), $this->log_file_path, esc_html__( 'Importing content', 'wp_deeds' )
            );
        }

        // Delete content importer data for current import from DB.
        delete_transient( 'deeds_importer_data' );

        // Return any error messages for the front page output (errors, critical, alert and emergency level messages only).
        return $this->logger->error_output;
    }

    public function new_ajax_request_maybe( $data ) {
        $time = microtime( true ) - $this->microtime;
        if ( $time > apply_filters( 'wp_wpstore/time_for_one_ajax_call', 25 ) ) {
            $this->ajax_call_number++;
            $this->set_importer_data();

            $response = array(
                'status'  => 'newAJAX',
                'message' => 'Time for new AJAX request!: ' . $time,
            );
            $message  = ob_get_clean();

            // Add message to log file.
            $log_added = wp_wpstore_Helpers::append_to_file(
                    esc_html__( 'Completed AJAX call number: ', 'wp_deeds' ) . $this->ajax_call_number . PHP_EOL . $message, $this->log_file_path, ''
            );

            wp_send_json( $response );
        }
        $current_user_obj    = wp_get_current_user();
        $data['post_author'] = $current_user_obj->user_login;

        return $data;
    }

    private function do_import_action( $action, $selected_import ) {

        ob_start();
        do_action( $action, $selected_import );
        $message = ob_get_clean();

        // Add this message to log file.
        $log_added = wp_wpstore_Helpers::append_to_file(
                $message, $this->log_file_path, $action
        );
    }

    private function set_importer_data() {
        $data = array(
            'frontend_error_messages' => $this->frontend_error_messages,
            'ajax_call_number'        => $this->ajax_call_number,
            'log_file_path'           => $this->log_file_path,
            'selected_index'          => $this->selected_index,
            'selected_import_files'   => $this->selected_import_files,
        );

        $data = array_merge( $data, $this->importer->get_importer_data() );

        set_transient( 'deeds_importer_data', $data, 0.5 * HOUR_IN_SECONDS );
    }

    private function get_importer_data() {
        if ( $data = get_transient( 'deeds_importer_data' ) ) {
            $this->frontend_error_messages = empty( $data['frontend_error_messages'] ) ? '' : $data['frontend_error_messages'];
            $this->ajax_call_number        = empty( $data['ajax_call_number'] ) ? 1 : $data['ajax_call_number'];
            $this->log_file_path           = empty( $data['log_file_path'] ) ? '' : $data['log_file_path'];
            $this->selected_index          = empty( $data['selected_index'] ) ? 0 : $data['selected_index'];
            $this->selected_import_files   = empty( $data['selected_import_files'] ) ? array() : $data['selected_import_files'];
            $this->importer->set_importer_data( $data );

            return true;
        }
        return false;
    }
}
//new wp_wpstoreImporter();
