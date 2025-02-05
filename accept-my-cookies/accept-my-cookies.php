<?php
/**
 * @package Accept_My_Cookies
 * @version 0.1.0
 * @tag development: user decision on consent
 */
/*
Plugin Name: Accept My Cookies
Plugin URI: http://wordpress.org/plugins/accept-my-cookies/
Description: Accept My Cookies is a lightweight and customizable WordPress plugin that helps you comply with GDPR and other privacy regulations. It displays a user-friendly consent modal, allowing visitors to accept or reject tracking cookies. The plugin supports Google Consent Mode for seamless integration with Google Analytics, Ads, and Tag Manager.
Author: Shayan Ghiaseddin
Version: 0.1.0
Author URI: https://sghiaseddin.com/
*/
use AcceptMyCookies\Controller\AdminController;
use AcceptMyCookies\Controller\PublicController;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Define useful constants
define( 'ACCEPT_MY_COOKIES_VERSION', '0.1.0' );
define( 'ACCEPT_MY_COOKIES_DIR', plugin_dir_path( __FILE__ ) );
define( 'ACCEPT_MY_COOKIES_URL', plugin_dir_url(__FILE__) );

// Load text domain for translations
function accept_my_cookies_load_textdomain() {
    load_plugin_textdomain( 'accept-my-cookies', false, ACCEPT_MY_COOKIES_DIR . 'languages/' );
}
add_action( 'init', 'accept_my_cookies_load_textdomain' );

// Include necessary files
// Autoload classes
spl_autoload_register(function(string $className) {
    if (false === strpos($className, 'AcceptMyCookies\\')) {
        return;
    }
 
    // Replace MK\MyPlugin in the class name with the path to src:
    $className = str_replace('AcceptMyCookies\\', ACCEPT_MY_COOKIES_DIR . '/include/', $className);
 
    // Replace the remaining backslashes with directory separators 
    $classFile =  str_replace('\\', '/', $className) . '.php';
 
    // Load class file
    require_once $classFile;
});

require_once ACCEPT_MY_COOKIES_DIR . 'activate.php';

register_activation_hook( __FILE__, 'accept_my_cookies_activate' );

// Initialize the plugin
function accept_my_cookies_init() {
    // Initialize AdminController for backend functionality
    new AdminController();

    // Initialize PublicController for frontend functionality
    new PublicController();
}
add_action( 'plugins_loaded', 'accept_my_cookies_init' );