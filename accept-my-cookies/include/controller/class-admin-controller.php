<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class AcceptMyCookies_Admin_Controller {

    private $settings_handler;

    /**
     * Constructor.
     */
    public function __construct() {
        $this->settings_handler = new AcceptMyCookies_Settings_Handler();
        $this->init_hooks();
    }

    /**
     * Initialize hooks.
     */
    private function init_hooks() {
        add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
        add_action( 'admin_init', array( $this, 'register_settings' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'wp_ajax_accept_my_cookies_cleanup', array( $this, 'ajax_cleanup' ) );
        add_action( 'wp_ajax_accept_my_cookies_save_settings', array( $this, 'ajax_save_settings' ) );
    }

    /**
     * Add the settings page to the WordPress admin menu.
     */
    public function add_settings_page() {
        add_options_page(
            __( 'Accept My Cookies Settings', 'accept-my-cookies' ),
            __( 'Accept My Cookies', 'accept-my-cookies' ),
            'manage_options',
            'accept-my-cookies',
            array( $this, 'render_settings_page' )
        );
    }

    /**
     * Register the settings and fields.
     */
    public function register_settings() {
        $schema = include ACCEPT_MY_COOKIES_DIR . '/include/options.php';

        // Register settings for the General tab
        add_settings_section(
            'accept_my_cookies_general_section',
            __( 'General Settings', 'accept-my-cookies' ),
            null,
            'accept-my-cookies-general'
        );

        // Register settings for the Styling tab
        add_settings_section(
            'accept_my_cookies_styling_section',
            __( 'Styling Settings', 'accept-my-cookies' ),
            null,
            'accept-my-cookies-styling'
        );

        // Register settings fields
        foreach ( $schema as $option_name => $option ) {
            register_setting(
                'accept_my_cookies_options_group',
                $option['key']
            );

            $page = $option['tab'] === 'general' ? 'accept-my-cookies-general' : 'accept-my-cookies-styling';
            $section = $option['tab'] === 'general' ? 'accept_my_cookies_general_section' : 'accept_my_cookies_styling_section';

            add_settings_field(
                $option['key'],
                $option['label'],
                array( $this, 'render_option_field' ),
                $page,
                $section,
                array( 'option_name' => $option_name )
            );
        }
    }

    /**
     * Render an option input field.
     *
     * @param array $args The field arguments.
     */
    public function render_option_field( $args ) {
        $option_name = $args['option_name'];
        $schema = include ACCEPT_MY_COOKIES_DIR . '/include/options.php';
        $option = $schema[ $option_name ];
        $value = $this->settings_handler->get_option( $option_name );
        ?>
        <input type="text" name="<?php echo esc_attr( $option['key'] ); ?>" value="<?php echo esc_attr( $value ); ?>" class="regular-text">
        <?php
    }
    
    /**
     * Render the settings page.
     */
    public function render_settings_page() {
        // Include the view file
        include_once ACCEPT_MY_COOKIES_DIR . '/include/view/settings-page.php';
    }

    /**
     * Enqueue scripts and styles for the admin area.
     */
    public function enqueue_scripts() {
        wp_enqueue_script(
            'accept-my-cookies-deactivate',
            ACCEPT_MY_COOKIES_URL . 'assets/js/deactivate.js',
            array( 'jquery' ),
            ACCEPT_MY_COOKIES_VERSION,
            true
        );

        wp_enqueue_script(
            'accept-my-cookies-save-settings',
            ACCEPT_MY_COOKIES_URL . 'assets/js/save-settings.js',
            array( 'jquery' ),
            ACCEPT_MY_COOKIES_VERSION,
            true
        );

        wp_enqueue_script(
            'accept-my-cookies-tabs',
            ACCEPT_MY_COOKIES_URL . 'assets/js/tabs.js',
            array( 'jquery' ),
            ACCEPT_MY_COOKIES_VERSION,
            true
        );    
    
        wp_enqueue_style(
            'accept-my-cookies-admin',
            ACCEPT_MY_COOKIES_URL . 'assets/css/admin.css',
            array(),
            ACCEPT_MY_COOKIES_VERSION
        );
    
        // Localize the script with AJAX URL and nonce
        wp_localize_script(
            'accept-my-cookies-save-settings',
            'acceptMyCookiesSaveSettings',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'nonce'   => wp_create_nonce( 'accept_my_cookies_save_settings_nonce' )
            )
        );
    
        // Localize the script with AJAX URL and nonce
        wp_localize_script(
            'accept-my-cookies-deactivate',
            'acceptMyCookiesCleanup',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'nonce'   => wp_create_nonce( 'accept_my_cookies_cleanup_nonce' )
            )
        );
    }

    /**
     * Handle AJAX request for cleanup before deactivation.
     */
    public function ajax_cleanup() {
        // Verify nonce for security
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'accept_my_cookies_cleanup_nonce' ) ) {
            wp_send_json_error( 'Invalid nonce.' );
        }

        // Perform cleanup
        $this->settings_handler->delete_all_options();
        wp_send_json_success( 'Cleanup completed.' );
    }

    public function ajax_save_settings() {
        // Verify nonce for security
        if ( ! isset( $_POST['_ajax_nonce'] ) || ! wp_verify_nonce( $_POST['_ajax_nonce'], 'accept_my_cookies_save_settings_nonce' ) ) {
            wp_send_json_error( 'Invalid nonce.' );
        }
    
        // Save the settings
        $schema = include ACCEPT_MY_COOKIES_DIR . '/include/options.php';
        foreach ( $schema as $option ) {
            if ( isset( $_POST[ $option['key'] ] ) ) {
                update_option( $option['key'], sanitize_text_field( $_POST[ $option['key'] ] ) );
            }
        }
    
        wp_send_json_success( 'Settings saved.' );
    }
}