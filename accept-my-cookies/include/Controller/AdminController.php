<?php

namespace AcceptMyCookies\Controller;

use AcceptMyCookies\Controller\SettingsHandler;
use AcceptMyCookies\Controller\InputValidator;
use AcceptMyCookies\View\Admin\AdminView;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class AdminController
{
    private $settings_handler;
    private $admin_view;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->settings_handler = new SettingsHandler();
        $this->admin_view = new AdminView();
        $this->initHooks();
    }

    /**
     * Initialize hooks.
     */
    private function initHooks()
    {
        add_action('admin_menu', array( $this, 'addSettingsPage' ));
        add_action('admin_init', array( $this, 'registerSettings' ));
        add_action('admin_enqueue_scripts', array( $this->admin_view, 'enqueueScripts' ));
        add_action('wp_ajax_accept_my_cookies_cleanup', array( $this, 'ajaxCleanup' ));
        add_action('wp_ajax_accept_my_cookies_save_settings', array( $this, 'ajaxSaveSettings' ));
    }

    /**
     * Add the settings page to the WordPress admin menu.
     */
    public function addSettingsPage()
    {
        add_options_page(
            __('Accept My Cookies Settings', 'accept-my-cookies'),
            __('Accept My Cookies', 'accept-my-cookies'),
            'manage_options',
            'accept-my-cookies',
            array( $this, 'renderSettingsPage' )
        );
    }

    /**
     * Register the settings and fields.
     */
    public function registerSettings()
    {
        $schema = include ACCEPT_MY_COOKIES_DIR . '/include/options.php';

        // Register settings for the General tab
        add_settings_section(
            'accept_my_cookies_general_section',
            __('General Settings', 'accept-my-cookies'),
            null,
            'accept-my-cookies-general'
        );

        // Register settings for the Google Property tab
        add_settings_section(
            'accept_my_cookies_google_property_section',
            __('Google Property Settings', 'accept-my-cookies'),
            null,
            'accept-my-cookies-google-property'
        );

        // Register settings for the Styling tab
        add_settings_section(
            'accept_my_cookies_styling_section',
            __('Styling Settings', 'accept-my-cookies'),
            null,
            'accept-my-cookies-styling'
        );

        // Register settings fields
        foreach ($schema as $option_name => $option) {
            register_setting(
                'accept_my_cookies_options_group',
                $option['key']
            );

            switch ($option['tab']) {
                case 'general':
                    $page = 'accept-my-cookies-general';
                    $section = 'accept_my_cookies_general_section';
                    break;
                case 'google_property':
                    $page = 'accept-my-cookies-google-property';
                    $section = 'accept_my_cookies_google_property_section';
                    break;
                case 'styling':
                    $page = 'accept-my-cookies-styling';
                    $section = 'accept_my_cookies_styling_section';
                    break;
            }

            add_settings_field(
                $option['key'],
                $option['label'],
                array( $this->admin_view, 'renderOptionField' ),
                $page,
                $section,
                array( 'option_name' => $option_name )
            );
        }
    }

    /**
     * Render the settings page.
     */
    public function renderSettingsPage()
    {
        // Include the view file
        include_once ACCEPT_MY_COOKIES_DIR . '/include/View/Admin/templates/settings-page.php';
    }

    /**
     * Handle AJAX request for cleanup before deactivation.
     */
    public function ajaxCleanup()
    {
        // Verify nonce for security
        if (! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'accept_my_cookies_cleanup_nonce')) {
            wp_send_json_error(__('Invalid nonce.', 'accept-my-cookies'));
        }

        // Perform cleanup
        $this->settings_handler->deleteAllOptions();
        wp_send_json_success(__('Cleanup completed.', 'accept-my-cookies'));
    }

    public function ajaxSaveSettings()
    {
        // Verify nonce for security
        if (! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'accept_my_cookies_save_settings_nonce')) {
            wp_send_json_error(__('Your browser session is expired. Please reload this page.', 'accept-my-cookies'));
        }

        // Validate and save the settings
        $validator = new InputValidator();

        $schema = include ACCEPT_MY_COOKIES_DIR . '/include/options.php';
        foreach ($schema as $input => $option) {
            if (isset($_POST[ $option['key'] ])) {
                $value = $validator::validate(
                    $option['validation-type'],
                    $_POST[ $option['key'] ],
                    isset($option['options']) ? array_keys($option['options']) : array()
                );
                if ($value !== false) {
                    update_option($option['key'], $value);
                } else {
                    wp_send_json_error(sprintf(__('The value for "%s" is not valid. Please review it.', 'accept-my-cookies'), $option['label']));
                }
            }
        }
        wp_send_json_success(__('All options have successfully saved.', 'accept-my-cookies'));
    }
}
