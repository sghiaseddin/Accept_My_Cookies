<?php
use AcceptMyCookies\Controller\SettingsHandler;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Plugin activation function.
 */
function Accept_My_Cookies_Activate() {
    $settings_handler = new SettingsHandler();
    $settings_handler->saveDefaultOptions();
}
