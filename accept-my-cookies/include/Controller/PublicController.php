<?php

namespace AcceptMyCookies\Controller;

use AcceptMyCookies\View\Public\ConsentBanner;
use AcceptMyCookies\Controller\SettingsHandler;

/**
 * PublicController
 *
 * Handles the frontend logic for the Accept My Cookies plugin,
 * including rendering the consent banner and managing user interactions.
 */
class PublicController
{
    /**
     * @var array Plugin options.
     */
    private $options;

    /**
     * @var SettingsHandler Handles fetching and saving plugin options.
     */
    private $settings_handler;

    /**
     * Constructor.
     *
     * Initializes the PublicController and sets up necessary hooks.
     */
    public function __construct()
    {
        // Initialize SettingsHandler
        $this->settings_handler = new SettingsHandler();

        // Load saved plugin options
        $this->options = $this->loadSavedOptions();

        // Register frontend hooks
        $this->registerHooks();
    }

    /**
     * Load saved plugin options.
     *
     * @return array Saved plugin options.
     */
    private function loadSavedOptions()
    {
        $schema = include ACCEPT_MY_COOKIES_DIR . 'include/options.php';
        $saved_options = array();

        foreach ($schema as $option_name => $option_details) {
            $saved_options[$option_name] = $this->settings_handler->getOption($option_name);
        }

        return $saved_options;
    }

    /**
     * Register frontend hooks.
     */
    private function registerHooks()
    {
        // Enqueue frontend scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));

        // Render the consent banner
        add_action('wp_footer', array($this, 'renderConsentBanner'));

        // Logging request handllers
        add_action('wp_ajax_accept_my_cookies_log_consent', array($this, 'handle_log_consent'));
        add_action('wp_ajax_nopriv_accept_my_cookies_log_consent', array($this, 'handle_log_consent'));
    }

    /**
     * Enqueue frontend scripts and styles.
     */
    public function enqueueScripts()
    {
        // Enqueue CSS
        wp_enqueue_style(
            'accept-my-cookies-public',
            ACCEPT_MY_COOKIES_URL . 'assets/css/public.css',
            array(),
            ACCEPT_MY_COOKIES_VERSION
        );

        // Enqueue JavaScript
        wp_enqueue_script(
            'accept-my-cookies-public',
            ACCEPT_MY_COOKIES_URL . 'assets/js/public.js',
            array('jquery'),
            ACCEPT_MY_COOKIES_VERSION,
            true
        );

        // Localize script for passing PHP variables to JavaScript
        wp_localize_script(
            'accept-my-cookies-public',
            'acceptMyCookiesData',
            array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('accept_my_cookies_nonce'),
                'options' => $this->options, // Pass saved options, not the schema
            )
        );
    }

    /**
     * Render the consent banner.
     */
    public function renderConsentBanner()
    {
        // Only render if the user hasn't already consented
        if (!$this->hasUserConsented()) {
            // Initialize the ConsentBanner view
            $consent_banner = new ConsentBanner($this->options);

            // Render the consent banner
            $consent_banner->render();
        }
    }

    /**
     * Check if the user has already consented.
     *
     * @return bool Whether the user has consented.
     */
    private function hasUserConsented()
    {
        // Check for consent cookie or local storage (implementation depends on storage method)
        $storage_method = $this->options['storage_method'];

        if ($storage_method === 'cookies') {
            return isset($_COOKIE['accept_my_cookies_consent']);
        } else {
            // Check local storage (handled via JavaScript)
            return false;
        }
    }

    /**
     * Handle the AJAX request to log consent.
     */
    public function handle_log_consent()
    {
        // Verify nonce for security
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'accept_my_cookies_nonce')) {
            wp_send_json_error('Invalid nonce.');
        }

        // Get the consent data
        $consent_data = array(
            'ip'         => sanitize_text_field($_SERVER['REMOTE_ADDR']),
            'user_agent' => sanitize_text_field($_SERVER['HTTP_USER_AGENT']),
            'consent'    => (bool) $_POST['consent'],
            'parameters' => $_POST['parameters'], 
        );

        // Log the consent data
        $log_handler = new LogHandler();
        $log_handler->log_consent($consent_data);

        wp_send_json_success('Consent logged.');
    }
}
