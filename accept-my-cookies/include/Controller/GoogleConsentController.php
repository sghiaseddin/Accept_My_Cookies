<?php

namespace AcceptMyCookies\Controller;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

use AcceptMyCookies\View\Public\GoogleConsentView;

class GoogleConsentController
{
    /**
     * @var object the PublicController instance.
     */
    private $publicController;

    /**
     * @var array Plugin options.
     */
    private $options;
    
    /**
     * Constructor.
     */
    public function __construct($publicController)
    {
        // Load publicController object
        $this->publicController = $publicController;

        // Load plugin options
        $this->options = $this->publicController->loadSavedOptions();

        // Register the hook to inject the Google Consent Mode script
        add_action('wp_head', array($this, 'injectGoogleConsentScript'), -10);
    }

    /**
     * Inject the Google Consent Mode script into the <head>.
     */
    public function injectGoogleConsentScript()
    {
        // Check if Google Consent Mode is enabled and GA ID is set
        if ($this->options['google_consent_mode_enabled'] && !empty($this->options['ga_id'])) {
            // Initialize the view
            $google_consent_view = new GoogleConsentView($this->publicController->filterSavedOptions());

            // Render the script
            $google_consent_view->enqueueGoogleConsentScript();
        }
    }
}
