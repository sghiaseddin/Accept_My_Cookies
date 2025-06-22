<?php

use AcceptMyCookies\Controller\SettingsHandler;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Manually load translations during activation.
 */
function Accept_My_Cookies_Load_activation_translations($locale)
{
    $domain = 'accept-my-cookies';
    $languages_path = ACCEPT_MY_COOKIES_DIR . '/languages/';
    $mo_file = $languages_path . "$domain-$locale.mo";

    if (file_exists($mo_file)) {
        $translations = new MO();
        $translations->import_from_file($mo_file);
        return $translations->entries;
    }

    return [];
}

/**
 * Plugin activation function.
 */
function Accept_My_Cookies_Activate()
{
    global $wpdb;
    $locale = get_locale(); // Get the current language
    $translations = Accept_My_Cookies_Load_activation_translations($locale);

    $settings_handler = new SettingsHandler();
    $settings_handler->saveDefaultOptions($translations);
}
