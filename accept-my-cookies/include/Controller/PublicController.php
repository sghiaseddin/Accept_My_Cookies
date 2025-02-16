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
        $schema = include ACCEPTMYCOOKIES_DIR . 'include/options.php';
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

        // Enqueue inline custom styles for consent banner
        add_action('wp_enqueue_scripts', array($this, 'renderConsentBannerStyles'));

        // Render the consent banner
        add_action('wp_footer', array($this, 'renderConsentBanner'));
    }

    /**
     * Enqueue frontend scripts and styles.
     */
    public function enqueueScripts()
    {
        // Register and enqueue CSS
        wp_register_style(
            'accept-my-cookies-public',
            ACCEPTMYCOOKIES_URL . 'assets/css/public.css',
            array(),
            ACCEPTMYCOOKIES_VERSION
        );
        wp_enqueue_style('accept-my-cookies-public');

        // Enqueue JavaScript
        wp_register_script(
            'accept-my-cookies-public',
            ACCEPTMYCOOKIES_URL . 'assets/js/public.js',
            array('jquery'),
            ACCEPTMYCOOKIES_VERSION,
            true
        );
        wp_enqueue_script('accept-my-cookies-public');

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
     * Render custom inline styles for consent banner.
     */
    public function renderConsentBannerStyles()
    {
        $banner_text_size                   = $this->options['banner_text_size'];
        $banner_title_text_size             = $this->options['banner_title_text_size'];
        $banner_button_text_size            = $this->options['banner_button_text_size'];
        $banner_z_index                     = $this->options['banner_z_index'];
        $banner_color_style                 = $this->options['banner_color_style'];
        if ($banner_color_style === 'custom') {
            $banner_background_color        = $this->addOpacityToHex($this->options['banner_background_color'], $this->options['banner_background_opacity']);
            $banner_overlay_color           = $this->addOpacityToHex($this->options['banner_overlay_color'], $this->options['banner_overlay_opacity']);
            $banner_text_color              = $this->options['banner_text_color'];
            $banner_link_color              = $this->options['banner_link_color'];
            $banner_button_background_color = $this->options['banner_button_background_color'];
            $banner_button_text_color       = $this->options['banner_button_text_color'];
        }

        // genreate the custom styles and enqueue to current css handler
        $custom_styles = include ACCEPTMYCOOKIES_DIR . 'include/View/Public/templates/consent-banner-style.php';
        wp_add_inline_style('accept-my-cookies-public', esc_html(wp_strip_all_tags($custom_styles)));
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
}
