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
 * @tag      fix text-domain loading
 */

/*
Plugin Name: Accept My Cookies
Plugin URI: http://wordpress.org/plugins/accept-my-cookies/
Description: Accept My Cookies is a lightweight and customizable WordPress plugin that helps you comply with GDPR and other privacy regulations. It displays a user-friendly consent modal, allowing visitors to accept or reject tracking cookies. The plugin supports Google Consent Mode for seamless integration with Google Analytics, Ads, and Tag Manager.
Author: Shayan Ghiaseddin
Version: 0.4.3
Author URI: https://sghiaseddin.com/
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

use AcceptMyCookies\Controller\AdminController;
use AcceptMyCookies\Controller\PublicController;
use AcceptMyCookies\Controller\GoogleConsentController;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define useful constants
define('ACCEPT_MY_COOKIES_VERSION', '0.4.3');
define('ACCEPT_MY_COOKIES_DIR', plugin_dir_path(__FILE__));
define('ACCEPT_MY_COOKIES_URL', plugin_dir_url(__FILE__));

/**
 * Load text domain for translations
 *
 * @return void
 */
function Accept_My_Cookies_Load_textdomain()
{
    load_plugin_textdomain('accept-my-cookies', false, dirname(plugin_basename(__FILE__)) . '/languages/');
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

// Activation actions: loading translation and saving default data
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

    // Initialize GoogleConsentController for Google Consent Mode
    new GoogleConsentController();
}
add_action('plugins_loaded', 'Accept_My_Cookies_init');

/**
 * Add settings page link in plugins listing
 *
 * @return array
 */
function Accept_My_Cookies_Add_settings_link( $actions ) {
    $settings_link = array('<a href="' . admin_url( 'options-general.php?page=accept-my-cookies' ) . '">' . esc_html__('Settings', 'accept-my-cookies') . '</a>');
    return array_merge( $actions, $settings_link );
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'Accept_My_Cookies_Add_settings_link' );
