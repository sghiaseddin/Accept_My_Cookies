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
        add_action( 'wp_ajax_accept_my_cookies_cleanup', array( $this, 'ajax_cleanup' ) ); // AJAX endpoint
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

        // Register settings section
        add_settings_section(
            'accept_my_cookies_main_section',
            __( 'Sample Settings', 'accept-my-cookies' ),
            null,
            'accept-my-cookies'
        );

        // Register settings fields
        foreach ( $schema as $option_name => $option ) {
            register_setting(
                'accept_my_cookies_options_group',
                $option['key']
            );

            add_settings_field(
                $option['key'],
                $option['label'],
                array( $this, 'render_option_field' ),
                'accept-my-cookies',
                'accept_my_cookies_main_section',
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
        $value = $this->settings_handler->get_option( $option_name );
        $schema = include __DIR__ . '/../options.php';
        $key = $schema[ $option_name ]['key'];
        ?>
        <input type="text" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $value ); ?>" class="regular-text">
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

        // Localize the script with AJAX URL and nonce
        wp_localize_script(
            'accept-my-cookies-deactivate',
            'acceptMyCookies',
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
}