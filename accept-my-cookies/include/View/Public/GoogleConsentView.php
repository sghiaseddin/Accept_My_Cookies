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
        // Check if Google Consent Mode is enabled and GA ID is set
        if ($this->options['google_consent_mode_enabled'] && !empty($this->options['ga_id'])) {
            wp_register_script(
                'gtm-script-before', 
                ACCEPT_MY_COOKIES_URL . 'assets/js/gtm-script-before.js',
                array(),
                ACCEPT_MY_COOKIES_VERSION,
                false,
                array(
                    'strategy'  => 'async',
                    'in_footer' => false
                )
            );

            // Localize script for passing PHP variables to JavaScript
            wp_localize_script(
                'gtm-script-before',
                'acceptMyCookiesData',
                array(
                    'options' => $this->options, // Pass saved options, not the schema
                )
            );

            $ga_id = $this->options['ga_id'];
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

            wp_register_script(
                'gtm-script-after', 
                ACCEPT_MY_COOKIES_URL . 'assets/js/gtm-script-after.js',
                array(),
                ACCEPT_MY_COOKIES_VERSION,
                false,
                array(
                    'strategy'  => 'async',
                    'in_footer' => false
                )
            );

            wp_enqueue_script('gtm-script-before');
            wp_enqueue_script('gtm-script');
            wp_enqueue_script('gtm-script-after');
        }
    }
}
