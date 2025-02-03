<?php
/**
 * @package Accept_My_Cookies
 * @version 0.0.8
 * @tag development tabs in settings page
 */
/*
Plugin Name: Accept My Cookies
Plugin URI: http://wordpress.org/plugins/accept-my-cookies/
Description: Accept My Cookies is a lightweight and customizable WordPress plugin that helps you comply with GDPR and other privacy regulations. It displays a user-friendly consent modal, allowing visitors to accept or reject tracking cookies. The plugin supports Google Consent Mode for seamless integration with Google Analytics, Ads, and Tag Manager.
Author: Shayan Ghiaseddin
Version: 0.0.8
Author URI: https://sghiaseddin.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Define useful constants
define( 'ACCEPT_MY_COOKIES_VERSION', '0.0.8' );
define( 'ACCEPT_MY_COOKIES_DIR', plugin_dir_path( __FILE__ ) );
define( 'ACCEPT_MY_COOKIES_URL', plugin_dir_url(__FILE__) );

// Load text domain for translations
function accept_my_cookies_load_textdomain() {
    load_plugin_textdomain( 'accept-my-cookies', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'accept_my_cookies_load_textdomain' );

// Include necessary files
require_once ACCEPT_MY_COOKIES_DIR . 'include/controller/class-settings-handler.php';
require_once ACCEPT_MY_COOKIES_DIR . 'include/controller/class-admin-controller.php';
require_once ACCEPT_MY_COOKIES_DIR . 'activate.php';

register_activation_hook( __FILE__, 'accept_my_cookies_activate' );

// Initialize the plugin
function accept_my_cookies_init() {
    new AcceptMyCookies_Admin_Controller();
}
add_action( 'plugins_loaded', 'accept_my_cookies_init' );