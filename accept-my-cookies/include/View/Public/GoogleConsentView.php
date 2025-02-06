<?php

namespace AcceptMyCookies\View\Public;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class GoogleConsentView
{
    /**
     * @var array Plugin options.
     */
    private $options;

    /**
     * Constructor.
     *
     * @param array $options Plugin options.
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * Render the Google Consent Mode script.
     */
    public function render()
    {
        // Extract relevant options
        $ga_id = $this->options['ga_id'];
        $analytics_storage = $this->options['analytics_storage'] ? 'granted' : 'denied';
        $ad_storage = $this->options['ad_storage'] ? 'granted' : 'denied';
        $ad_user_data = $this->options['ad_user_data'] ? 'granted' : 'denied';
        $ad_personalization = $this->options['ad_personalization'] ? 'granted' : 'denied';

        // Include the template
        include ACCEPT_MY_COOKIES_DIR . 'include/View/Public/templates/google-consent-script.php';
    }
}
