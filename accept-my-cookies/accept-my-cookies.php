<?php
/**
 * Accept My Cookies, a plugin for WordPress
 * 
 * PHP version 7.3 or later
 * 
 * @category Wordpress_Plugin
 * @package  Accept_My_Cookies
 * @author   Shayan Ghiaseddin <sghiaseddin@me.com>
 * @license  https://github.com/sghiaseddin/Accept_My_Cookies/blob/main/LICENSE GPL-3.0
 * @version  GIT: <https://github.com/sghiaseddin/Accept_My_Cookies>
 * @link     https://sghiaseddin.com
 * @tag      GitHub Action WordPress-Coding-Standards
 */
/*
Plugin Name: Accept My Cookies
Plugin URI: http://wordpress.org/plugins/accept-my-cookies/
Description: Accept My Cookies is a lightweight and customizable WordPress plugin that helps you comply with GDPR and other privacy regulations. It displays a user-friendly consent modal, allowing visitors to accept or reject tracking cookies. The plugin supports Google Consent Mode for seamless integration with Google Analytics, Ads, and Tag Manager.
Author: Shayan Ghiaseddin
Version: 0.2.2
Author URI: https://sghiaseddin.com/
*/

use AcceptMyCookies\Controller\AdminController;
use AcceptMyCookies\Controller\PublicController;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define useful constants
define('ACCEPT_MY_COOKIES_VERSION', '0.2.2');
define('ACCEPT_MY_COOKIES_DIR', plugin_dir_path(__FILE__));
define('ACCEPT_MY_COOKIES_URL', plugin_dir_url(__FILE__));

/** 
 * Load text domain for translations
 * 
 * @return void
 */
function Accept_My_Cookies_Load_textdomain()
{
    load_plugin_textdomain('accept-my-cookies', false, ACCEPT_MY_COOKIES_DIR . 'languages/');
}
add_action('init', 'Accept_My_Cookies_Load_textdomain');

// Include necessary files
// Autoload classes
spl_autoload_register(
    function (string $className) {
        if (false === strpos($className, 'AcceptMyCookies\\')) {
            return;
        }

        // Replace MK\MyPlugin in the class name with the path to src:
        $className = str_replace('AcceptMyCookies\\', ACCEPT_MY_COOKIES_DIR . '/include/', $className);

        // Replace the remaining backslashes with directory separators 
        $classFile =  str_replace('\\', '/', $className) . '.php';

        // Load class file
        include_once $classFile;
    }
);

require_once ACCEPT_MY_COOKIES_DIR . 'activate.php';

register_activation_hook(__FILE__, 'Accept_My_Cookies_Activate');

/** 
 * Initialize the plugin
 * 
 * @return void
 */
function Accept_My_Cookies_init()
{
    // Initialize AdminController for backend functionality
    new AdminController();

    // Initialize PublicController for frontend functionality
    new PublicController();
}
add_action('plugins_loaded', 'Accept_My_Cookies_init');
