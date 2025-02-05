<?php

namespace AcceptMyCookies\View\Public;

/**
 * ConsentBanner
 *
 * Handles the rendering of the consent banner on the frontend.
 */
class ConsentBanner {
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
     * Render the consent banner.
     */
    public function render()
    {
        $this->render_banner();
    }

    /**
     * Render the HTML for the consent banner.
     */
    private function render_banner()
    {
        // Extract options for easier access
        $consent_text                   = $this->options['consent_text'];
        $learn_more_url                 = $this->options['learn_more_url'];
        $learn_more_text                = $this->options['learn_more_text'];
        $accept_button_text             = $this->options['accept_button_text'];
        $customize_button_enabled       = $this->options['customize_button_enabled'];
        $customize_button_text          = $this->options['customize_button_text'];
        $acceptall_button_text          = $this->options['acceptall_button_text'];
        $banner_position                = $this->options['banner_position'];
        $banner_color_style             = $this->options['banner_color_style'];
        $google_consent_mode_enabled    = $this->options['google_consent_mode_enabled'];
        $analytics_storage              = $this->options['analytics_storage'];
        $ad_storage                     = $this->options['ad_storage'];
        $ad_user_data                   = $this->options['ad_user_data'];
        $ad_personalization             = $this->options['ad_personalization'];

        // Include the banner template
        include ACCEPT_MY_COOKIES_DIR . 'include/View/Public/templates/consent-banner.php';
    }
}