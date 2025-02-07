<?php

namespace AcceptMyCookies\Controller;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

use AcceptMyCookies\View\Public\GoogleConsentView;

class GoogleConsentController
{
    /**
     * @var array Plugin options.
     */
    private $options;

    /**
     * Constructor.
     */
    public function __construct()
    {
        // Load plugin options
        $this->options = $this->loadSavedOptions();

        // Register the hook to inject the Google Consent Mode script
        add_action('wp_head', array($this, 'injectGoogleConsentScript'), -10);
    }

    /**
     * Load saved plugin options.
     *
     * @return array Saved plugin options.
     */
    private function loadSavedOptions()
    {
        $schema = include ACCEPT_MY_COOKIES_DIR . 'include/options.php';
        $saved_options = [];

        foreach ($schema as $option_name => $option_details) {
            $saved_options[$option_name] = get_option($option_details['key'], $option_details['default']);
        }

        return $saved_options;
    }

    /**
     * Inject the Google Consent Mode script into the <head>.
     */
    public function injectGoogleConsentScript()
    {
        // Check if Google Consent Mode is enabled and GA ID is set
        if ($this->options['google_consent_mode_enabled'] && !empty($this->options['ga_id'])) {
            // Initialize the view
            $google_consent_view = new GoogleConsentView($this->options);

            // Render the script
            $google_consent_view->enqueueGoogleConsentScript();
        }
    }
}
