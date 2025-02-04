<?php
use AcceptMyCookies\Controller\SettingsHandler;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Plugin activation function.
 */
function accept_my_cookies_activate() {
    $settings_handler = new SettingsHandler();
    $settings_handler->save_default_options();
}
