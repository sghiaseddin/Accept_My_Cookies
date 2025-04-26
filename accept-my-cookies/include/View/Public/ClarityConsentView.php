<?php

namespace AcceptMyCookies\View\Public;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class ClarityConsentView
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
        // add_action('wp_head', array($this, 'enqueueClarityConsentScript'));
    }

    /**
     * Enqueue the Clarity Consent Mode script.
     */
    public function enqueueClarityConsentScript()
    {
        // Check if Clarity Consent Mode is enabled and GA ID is set
        if ($this->options['clarity_consent_enabled'] && !empty($this->options['cl_id'])) {
            $cl_id = $this->options['cl_id'];
            wp_register_script(
                'clarity-script',
                ACCEPT_MY_COOKIES_URL . 'assets/js/clarity-script.js',
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
                'clarity-script',
                'acceptMyCookiesData',
                array(
                    'options' => $this->options, // Pass saved options, not the schema
                )
            );

            wp_enqueue_script('clarity-script');
        }
    }
}
