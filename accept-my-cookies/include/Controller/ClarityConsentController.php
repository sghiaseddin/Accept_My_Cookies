<?php

namespace AcceptMyCookies\Controller;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

use AcceptMyCookies\View\Public\ClarityConsentView;

class ClarityConsentController
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

        // Register the hook to inject the Clarity Consent Mode script
        add_action('wp_head', array($this, 'injectClarityConsentScript'), -10);
    }

    /**
     * Inject the Clarity Consent Mode script into the <head>.
     */
    public function injectClarityConsentScript()
    {
        // Check if Clarity Consent Mode is enabled and GA ID is set
        if ($this->options['clarity_consent_enabled'] && !empty($this->options['cl_id'])) {
            // Initialize the view
            $clarity_consent_view = new ClarityConsentView($this->publicController->filterSavedOptions());

            // Render the script
            $clarity_consent_view->enqueueClarityConsentScript();
        }
    }
}
