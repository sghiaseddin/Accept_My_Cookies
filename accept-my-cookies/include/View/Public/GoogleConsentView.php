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
        // add_action('wp_head', array($this, 'enqueueGoogleConsentScript'));
    }

    /**
     * Enqueue the Google Consent Mode script.
     */
    public function enqueueGoogleConsentScript()
    {
        // Extract relevant options
        $ga_id = $this->options['ga_id'];
        $ga_script = get_option('accept_my_cookies_ga_script');
        $analytics_storage = $this->options['analytics_storage'] ? 'granted' : 'denied';
        $ad_storage = $this->options['ad_storage'] ? 'granted' : 'denied';
        $ad_user_data = $this->options['ad_user_data'] ? 'granted' : 'denied';
        $ad_personalization = $this->options['ad_personalization'] ? 'granted' : 'denied';
        
        // Check if Google Consent Mode is enabled and GA ID is set
        if ($this->options['google_consent_mode_enabled'] && !empty($this->options['ga_id'])) {
            wp_register_script(
                'gtm-script',
                "https://www.googletagmanager.com/gtag/js?id={$ga_id}",
                array(),
                ACCEPT_MY_COOKIES_VERSION,
                false,
                array(
                    'strategy'  => 'async',
                    'in_footer' => false
                )
            );

            // Include the templates
            $before_script = include ACCEPT_MY_COOKIES_DIR . 'include/View/Public/templates/before-google-consent-script.php';
            $after_script = include ACCEPT_MY_COOKIES_DIR . 'include/View/Public/templates/after-google-consent-script.php';
            
            wp_add_inline_script('gtm-script', $before_script, 'before');
            wp_enqueue_script('gtm-script');
            wp_add_inline_script('gtm-script', $after_script, 'after');
        }
    }
}
