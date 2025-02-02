<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Plugin activation function.
 */
function accept_my_cookies_activate() {
    $settings_handler = new AcceptMyCookies_Settings_Handler();
    $settings_handler->save_default_options();
}
