<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

return array(
    // General Tab Options
    'banner_title'          => array(
        'key'               => 'accept_my_cookies_banner_title',
        'default'           => __('Privacy & Cookies', 'accept-my-cookies'),
        'label'             => __('Banner Title', 'accept-my-cookies'),
        'type'              => 'text',
        'tab'               => 'general',
        'validation-type'   => 'text',
    ),
    'consent_text'          => array(
        'key'               => 'accept_my_cookies_consent_text',
        'default'           => __('We use cookies to enhance your experience. By continuing to visit this site, you agree to our use of cookies.', 'accept-my-cookies'),
        'label'             => __('Consent Text', 'accept-my-cookies'),
        'type'              => 'textarea',
        'tab'               => 'general',
        'description'       => __('The text displayed in the consent banner.', 'accept-my-cookies'),
        'validation-type'   => 'text',
    ),
    'learn_more_url' => array(
        'key'     => 'accept_my_cookies_learn_more_url',
        'default' => 'https://example.com/privacy-policy',
        'label'   => __('Learn More URL', 'accept-my-cookies'),
        'type'    => 'text',
        'tab'     => 'general',
        'placeholder' => __('Enter the URL for the "Learn More" link', 'accept-my-cookies'),
        'description' => __('The URL where users can learn more about your cookie policy.', 'accept-my-cookies'),
        'validation-type'   => 'url',
        'sanitize_callback' => 'sanitize_url',
    ),
    'learn_more_text' => array(
        'key'     => 'accept_my_cookies_learn_more_text',
        'default' => __('Learn More', 'accept-my-cookies'),
        'label'   => __('Learn More Text', 'accept-my-cookies'),
        'type'    => 'text',
        'tab'     => 'general',
        'placeholder' => __('Enter the text for the "Learn More" link', 'accept-my-cookies'),
        'validation-type'   => 'text',
    ),
    'accept_button_text' => array(
        'key'     => 'accept_my_cookies_accept_button_text',
        'default' => __('Accept', 'accept-my-cookies'),
        'label'   => __('Accept Button Text', 'accept-my-cookies'),
        'type'    => 'text',
        'tab'     => 'general',
        'placeholder' => __('Enter the text for the "Accept" button', 'accept-my-cookies'),
        'validation-type'   => 'text',
    ),
    'customize_button_enabled' => array(
        'key'     => 'accept_my_cookies_customize_button_enabled',
        'default' => '0', // 1 for enabled, 0 for disabled
        'label'   => __('Enable Customize Button', 'accept-my-cookies'),
        'type'    => 'checkbox',
        'tab'     => 'general',
        'description' => __('Enable the "Customize" button to allow users to adjust their consent preferences in details. This option make sense when you enable Google Consent Mode too.', 'accept-my-cookies'),
        'validation-type'   => 'boolean',
    ),
    'customize_button_text' => array(
        'key'     => 'accept_my_cookies_customize_button_text',
        'default' => __('Customize', 'accept-my-cookies'),
        'label'   => __('Customize Button Text', 'accept-my-cookies'),
        'type'    => 'text',
        'tab'     => 'general',
        'placeholder' => __('Enter the text for the "Customize" button', 'accept-my-cookies'),
        'data-depends-on' => 'accept_my_cookies_customize_button_enabled',
        'validation-type'   => 'text',
    ),
    'acceptall_button_text' => array(
        'key'     => 'accept_my_cookies_acceptall_button_text',
        'default' => __('Accept All', 'accept-my-cookies'),
        'label'   => __('Accept All Button Text', 'accept-my-cookies'),
        'type'    => 'text',
        'tab'     => 'general',
        'placeholder' => __('Enter the text for the "Accept All" button', 'accept-my-cookies'),
        'data-depends-on' => 'accept_my_cookies_customize_button_enabled',
        'validation-type'   => 'text',
    ),
    'cookie_expiration_days' => array(
        'key'     => 'accept_my_cookies_cookie_expiration_days',
        'default' => '180', // Default to 180 days
        'label'   => __('Cookie Expiration (Days)', 'accept-my-cookies'),
        'type'    => 'number',
        'tab'     => 'general',
        'placeholder' => __('Enter the number of days for cookie expiration', 'accept-my-cookies'),
        'description' => __('The number of days before the consent cookie expires.', 'accept-my-cookies'),
        'validation-type'   => 'number',
    ),
    'storage_method' => array(
        'key'     => 'accept_my_cookies_storage_method',
        'default' => 'cookies', // Options: 'cookies' or 'local_storage'
        'label'   => __('Storage Method', 'accept-my-cookies'),
        'type'    => 'select',
        'options' => array(
            'cookies'       => __('Cookies', 'accept-my-cookies'),
            'local_storage' => __('Local Storage', 'accept-my-cookies'),
        ),
        'tab'     => 'general',
        'description' => __('Choose how consent preferences are stored; cookies or local storage. We recommend cookies, as it checked and processed during php execution. However local storage could be checked only on browser runtime using javascript.', 'accept-my-cookies'),
        'validation-type'   => 'options',
    ),
    'custom_html_head' => array(
        'key'     => 'accept_my_cookies_custom_html_head',
        'default' => '', // Default empty
        'label'   => __( 'Custom HTML (Head)', 'accept-my-cookies' ),
        'type'    => 'textarea',
        'tab'     => 'general',
        'placeholder' => __( 'Enter custom HTML to be added to the <head> section', 'accept-my-cookies' ),
        'description' => __( 'Add custom HTML code that will be injected into the <head> section of your site.', 'accept-my-cookies' ),
        'validation-type'   => 'html',
    ),

    // Google Property Tab Options
    'google_consent_mode_enabled' => array(
        'key'     => 'accept_my_cookies_google_consent_mode_enabled',
        'default' => '0', // 0 for disabled, 1 for enabled
        'label'   => __('Enable Google Consent Mode', 'accept-my-cookies'),
        'type'    => 'checkbox',
        'tab'     => 'google_property',
        'description' => __('Enable Google Consent Mode to manage user consent for Google services.', 'accept-my-cookies'),
        'validation-type'   => 'boolean',
    ),
    'ga_id' => array(
        'key'     => 'accept_my_cookies_ga_id',
        'default' => '', // Default empty
        'label'   => __('Google Property ID', 'accept-my-cookies'),
        'type'    => 'text',
        'tab'     => 'google_property',
        'placeholder' => __('Enter your Google Property ID (e.g., G-123456)', 'accept-my-cookies'),
        'data-depends-on' => 'accept_my_cookies_google_consent_mode_enabled',
        'validation-type'   => 'ga_id',
    ),
    'analytics_storage' => array(
        'key'     => 'accept_my_cookies_analytics_storage',
        'default' => '1', // 1 for enabled, 0 for disabled
        'label'   => __('Enable Analytics Storage', 'accept-my-cookies'),
        'type'    => 'checkbox',
        'tab'     => 'google_property',
        'data-depends-on' => 'accept_my_cookies_google_consent_mode_enabled',
        'validation-type'   => 'boolean',
    ),
    'ad_storage' => array(
        'key'     => 'accept_my_cookies_ad_storage',
        'default' => '1', // 1 for enabled, 0 for disabled
        'label'   => __('Enable Ad Storage', 'accept-my-cookies'),
        'type'    => 'checkbox',
        'tab'     => 'google_property',
        'data-depends-on' => 'accept_my_cookies_google_consent_mode_enabled',
        'validation-type'   => 'boolean',
    ),
    'ad_user_data' => array(
        'key'     => 'accept_my_cookies_ad_user_data',
        'default' => '1', // 1 for enabled, 0 for disabled
        'label'   => __('Enable Ad User Data', 'accept-my-cookies'),
        'type'    => 'checkbox',
        'tab'     => 'google_property',
        'data-depends-on' => 'accept_my_cookies_google_consent_mode_enabled',
        'validation-type'   => 'boolean',
    ),
    'ad_personalization' => array(
        'key'     => 'accept_my_cookies_ad_personalization',
        'default' => '1', // 1 for enabled, 0 for disabled
        'label'   => __('Enable Ad Personalization', 'accept-my-cookies'),
        'type'    => 'checkbox',
        'tab'     => 'google_property',
        'data-depends-on' => 'accept_my_cookies_google_consent_mode_enabled',
        'validation-type'   => 'boolean',
    ),

    // Clarity Property Tab Options
    'clarity_consent_enabled' => array(
        'key'     => 'accept_my_cookies_clarity_consent_enabled',
        'default' => '0', // 0 for disabled, 1 for enabled
        'label'   => __('Enable Clarity Consent', 'accept-my-cookies'),
        'type'    => 'checkbox',
        'tab'     => 'clarity_property',
        'description' => __('Enable Clarity Consent to manage user consent for Microsoft Clarity services.', 'accept-my-cookies'),
        'validation-type'   => 'boolean',
    ),
    'cl_id' => array(
        'key'     => 'accept_my_cookies_cl_id',
        'default' => '', // Default empty
        'label'   => __('Clarity Tracking ID', 'accept-my-cookies'),
        'type'    => 'text',
        'tab'     => 'clarity_property',
        'placeholder' => __('Enter your Clarity Tracking ID (e.g., ra12345678)', 'accept-my-cookies'),
        'data-depends-on' => 'accept_my_cookies_clarity_consent_enabled',
        'validation-type'   => 'cl_id',
    ),
    'clarity_tracking' => array(
        'key'     => 'accept_my_cookies_clarity_tracking',
        'default' => '1', // 1 for enabled, 0 for disabled
        'label'   => __('Enable Clarity Tracking', 'accept-my-cookies'),
        'type'    => 'checkbox',
        'tab'     => 'clarity_property',
        'data-depends-on' => 'accept_my_cookies_clarity_consent_enabled',
        'validation-type'   => 'boolean',
    ),

    // Styling Tab Options
    'banner_position' => array(
        'key'     => 'accept_my_cookies_banner_position',
        'default' => 'bottom', // Options: 'bottom', 'top', 'left', 'right', 'center'
        'label'   => __('Banner Position', 'accept-my-cookies'),
        'type'    => 'select',
        'options' => array(
            'bottom' => __('Bottom', 'accept-my-cookies'),
            'top'    => __('Top', 'accept-my-cookies'),
            'left'   => __('Left', 'accept-my-cookies'),
            'right'  => __('Right', 'accept-my-cookies'),
            'center' => __('Center', 'accept-my-cookies'),
        ),
        'tab'     => 'styling',
        'description' => __('Choose where the consent banner appears on the screen.', 'accept-my-cookies'),
        'validation-type'   => 'options',
    ),
    'banner_size' => array(
        'key'     => 'accept_my_cookies_banner_size',
        'default' => 'normal', // Options: 'tiny', 'normal', 'wide'
        'label'   => __('Banner Size', 'accept-my-cookies'),
        'type'    => 'select',
        'options' => array(
            'tiny'   => __('Tiny', 'accept-my-cookies'),
            'normal' => __('Normal', 'accept-my-cookies'),
            'wide'   => __('Wide', 'accept-my-cookies'),
        ),
        'tab'     => 'styling',
        'description' => __('Choose the size of the consent banner.', 'accept-my-cookies'),
        'validation-type'   => 'options',
    ),
    'banner_button_size' => array(
        'key'     => 'accept_my_cookies_banner_button_size',
        'default' => 'normal', // Options: 'small', 'normal', 'large'
        'label'   => __('Button Size', 'accept-my-cookies'),
        'type'    => 'select',
        'options' => array(
            'small'  => __('Small', 'accept-my-cookies'),
            'normal' => __('Normal', 'accept-my-cookies'),
            'large'  => __('Large', 'accept-my-cookies'),
        ),
        'tab'     => 'styling',
        'description' => __('Choose the size of the buttons in the consent banner.', 'accept-my-cookies'),
        'validation-type'   => 'options',
    ),
    'banner_title_text_size' => array(
        'key'     => 'accept_my_cookies_banner_title_text_size',
        'default' => '18', // Default text size in pixels
        'label'   => __('Banner Title Text Size (px)', 'accept-my-cookies'),
        'type'    => 'number',
        'tab'     => 'styling',
        'description' => __('Set the font size of the title in the consent banner.', 'accept-my-cookies'),
        'validation-type'   => 'number',
    ),
    'banner_text_size' => array(
        'key'     => 'accept_my_cookies_banner_text_size',
        'default' => '14', // Default text size in pixels
        'label'   => __('Banner Text Size (px)', 'accept-my-cookies'),
        'type'    => 'number',
        'tab'     => 'styling',
        'description' => __('Set the font size of the text in the consent banner.', 'accept-my-cookies'),
        'validation-type'   => 'number',
    ),
    'banner_button_text_size' => array(
        'key'     => 'accept_my_cookies_banner_button_text_size',
        'default' => '14', // Default button text size in pixels
        'label'   => __('Button Text Size (px)', 'accept-my-cookies'),
        'type'    => 'number',
        'tab'     => 'styling',
        'description' => __('Set the font size of the text in the consent banner buttons.', 'accept-my-cookies'),
        'validation-type'   => 'number',
    ),
    'banner_z_index' => array(
        'key'     => 'accept_my_cookies_banner_z_index',
        'default' => '9999', // Default z-index
        'label'   => __('Banner Z-Index', 'accept-my-cookies'),
        'type'    => 'number',
        'tab'     => 'styling',
        'description' => __('Set the z-index of the consent banner to control its stacking order.', 'accept-my-cookies'),
        'validation-type'   => 'number',
    ),
    'banner_delay_seconds' => array(
        'key'     => 'accept_my_cookies_banner_delay_seconds',
        'default' => '2', // Default delay in seconds
        'label'   => __('Banner Delay (Seconds)', 'accept-my-cookies'),
        'type'    => 'number',
        'tab'     => 'styling',
        'description' => __('Set the delay (in seconds) before the consent banner appears.', 'accept-my-cookies'),
        'validation-type'   => 'number',
    ),
    'banner_color_style' => array(
        'key'     => 'accept_my_cookies_banner_color_style',
        'default' => 'dark', // Options: 'dark', 'bright', 'custom'
        'label'   => __('Banner Color Style', 'accept-my-cookies'),
        'type'    => 'select',
        'options' => array(
            'dark'   => __('Dark', 'accept-my-cookies'),
            'bright' => __('Bright', 'accept-my-cookies'),
            'custom' => __('Custom', 'accept-my-cookies'),
        ),
        'tab'     => 'styling',
        'description' => __('Choose a predefined color style or customize it.', 'accept-my-cookies'),
        'validation-type'   => 'options',
    ),
    'banner_background_color' => array(
        'key'     => 'accept_my_cookies_banner_background_color',
        'default' => '#1e1e1e', // Default dark background color
        'label'   => __('Banner Background Color', 'accept-my-cookies'),
        'type'    => 'color',
        'tab'     => 'styling',
        'data-depends-on' => 'accept_my_cookies_banner_color_style',
        'data-depends-value' => 'custom',
        'validation-type'   => 'color',
    ),
    'banner_background_opacity' => array(
        'key'     => 'accept_my_cookies_banner_background_opacity',
        'default' => '0.8', // Default opacity
        'label'   => __('Banner Background Opacity', 'accept-my-cookies'),
        'type'    => 'number',
        'step'    => '0.1',
        'min'     => '0',
        'max'     => '1',
        'tab'     => 'styling',
        'data-depends-on' => 'accept_my_cookies_banner_color_style',
        'data-depends-value' => 'custom',
        'description' => __('Set the opacity of the consent banner background.', 'accept-my-cookies'),
        'validation-type'   => 'unit_interval',
    ),
    'banner_overlay_color' => array(
        'key'     => 'accept_my_cookies_banner_overlay_color',
        'default' => '#000000', // Default black overlay
        'label'   => __('Banner Overlay Color', 'accept-my-cookies'),
        'type'    => 'color',
        'tab'     => 'styling',
        'data-depends-on' => 'accept_my_cookies_banner_color_style',
        'data-depends-value' => 'custom',
        'description' => __('Set the color of the overlay behind the consent banner.', 'accept-my-cookies'),
        'validation-type'   => 'color',
    ),
    'banner_overlay_opacity' => array(
        'key'     => 'accept_my_cookies_banner_overlay_opacity',
        'default' => '0.5', // Default opacity
        'label'   => __('Banner Overlay Opacity', 'accept-my-cookies'),
        'type'    => 'number',
        'step'    => '0.1',
        'min'     => '0',
        'max'     => '1',
        'tab'     => 'styling',
        'data-depends-on' => 'accept_my_cookies_banner_color_style',
        'data-depends-value' => 'custom',
        'description' => __('Set the opacity of the overlay behind the consent banner.', 'accept-my-cookies'),
        'validation-type'   => 'unit_interval',
    ),
    'banner_text_color' => array(
        'key'     => 'accept_my_cookies_banner_text_color',
        'default' => '#ffffff', // Default white text color
        'label'   => __('Banner Text Color', 'accept-my-cookies'),
        'type'    => 'color',
        'tab'     => 'styling',
        'data-depends-on' => 'accept_my_cookies_banner_color_style',
        'data-depends-value' => 'custom',
        'validation-type'   => 'color',
    ),
    'banner_link_color' => array(
        'key'     => 'accept_my_cookies_banner_link_color',
        'default' => '#0073aa', // Default link color
        'label'   => __('Banner Link Color', 'accept-my-cookies'),
        'type'    => 'color',
        'tab'     => 'styling',
        'data-depends-on' => 'accept_my_cookies_banner_color_style',
        'data-depends-value' => 'custom',
        'description' => __('Set the color of "Learn More" link in the consent banner.', 'accept-my-cookies'),
        'validation-type'   => 'color',
    ),
    'banner_button_background_color' => array(
        'key'     => 'accept_my_cookies_banner_button_background_color',
        'default' => '#0073aa', // Default button color
        'label'   => __('Button Background Color', 'accept-my-cookies'),
        'type'    => 'color',
        'tab'     => 'styling',
        'data-depends-on' => 'accept_my_cookies_banner_color_style',
        'data-depends-value' => 'custom',
        'validation-type'   => 'color',
    ),
    'banner_button_text_color' => array(
        'key'     => 'accept_my_cookies_banner_button_text_color',
        'default' => '#ffffff', // Default button text color
        'label'   => __('Button Text Color', 'accept-my-cookies'),
        'type'    => 'color',
        'tab'     => 'styling',
        'data-depends-on' => 'accept_my_cookies_banner_color_style',
        'data-depends-value' => 'custom',
        'validation-type'   => 'color',
    ),

    // Logging Tab Options
    'logging_enabled' => array(
        'key'     => 'accept_my_cookies_logging_enabled',
        'default' => '0', // 0 for disabled, 1 for enabled
        'label'   => __( 'Enable Logging', 'accept-my-cookies' ),
        'type'    => 'checkbox',
        'tab'     => 'logging',
        'description' => __( 'Enable storing consent decisions of users in a log file (wp-contents/uploads/accept-my-cookies/consents-{year}-{month}.log).', 'accept-my-cookies' ),
        'validation-type'   => 'boolean',
    ),
);
