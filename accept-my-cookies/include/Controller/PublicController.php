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
        $this->options = $this->load_saved_options();

        // Register frontend hooks
        $this->register_hooks();
    }

    /**
     * Load saved plugin options.
     *
     * @return array Saved plugin options.
     */
    private function load_saved_options()
    {
        $schema = include ACCEPT_MY_COOKIES_DIR . 'include/options.php';
        $saved_options = array();

        foreach ($schema as $option_name => $option_details) {
            $saved_options[$option_name] = $this->settings_handler->get_option($option_name);
        }

        return $saved_options;
    }

    /**
     * Register frontend hooks.
     */
    private function register_hooks()
    {
        // Enqueue frontend scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));

        // Render the consent banner
        add_action('wp_footer', array($this, 'render_consent_banner'));
    }

    /**
     * Enqueue frontend scripts and styles.
     */
    public function enqueue_scripts()
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
    public function render_consent_banner()
    {
        // Only render if the user hasn't already consented
        if (!$this->has_user_consented()) {
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
    private function has_user_consented()
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
}