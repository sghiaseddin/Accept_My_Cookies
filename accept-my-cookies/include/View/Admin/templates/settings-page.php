<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Get the active tab from the URL
// $active_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : 'general';
$active_tab = 'general';
?>

<div class="wrap">
    <div id="message" class="notice is-dismissible" style="display:none">
        <p></p>
        <button type="button" class="notice-dismiss">
            <span class="screen-reader-text"><?php echo esc_html(__('Dismiss this notice.', 'accept-my-cookies')); ?></span>
        </button>
    </div>

    <h1><?php echo esc_html(__('Accept My Cookies Settings', 'accept-my-cookies')); ?></h1>

    <!-- Tab Navigation -->
    <h2 class="nav-tab-wrapper">
        <a href="#general" class="nav-tab <?php echo $active_tab === 'general' ? 'nav-tab-active' : ''; ?>" data-tab="general">
            <?php esc_html_e('General', 'accept-my-cookies'); ?>
        </a>
        <a href="#google_property" class="nav-tab <?php echo $active_tab === 'google_property' ? 'nav-tab-active' : ''; ?>" data-tab="google_property">
            <?php esc_html_e('Google Property', 'accept-my-cookies'); ?>
        </a>
        <a href="#styling" class="nav-tab <?php echo $active_tab === 'styling' ? 'nav-tab-active' : ''; ?>" data-tab="styling">
            <?php esc_html_e('Styling', 'accept-my-cookies'); ?>
        </a>
    </h2>

    <!-- Tab Content -->
    <form id="accept-my-cookies-settings-form" method="post" action="options.php">
        <?php
        settings_fields('accept_my_cookies_options_group');
        ?>

        <!-- General Tab Content -->
        <div id="general-tab" class="tab-content" style="<?php echo $active_tab === 'general' ? 'display: block;' : 'display: none;'; ?>">
            <?php include ACCEPT_MY_COOKIES_DIR . '/include/View/Admin/templates/general-tab.php'; ?>
        </div>

        <!-- Google Property Tab Content -->
        <div id="google_property-tab" class="tab-content" style="<?php echo $active_tab === 'google_property' ? 'display: block;' : 'display: none;'; ?>">
            <?php include ACCEPT_MY_COOKIES_DIR . '/include/View/Admin/templates/google-property-tab.php'; ?>
        </div>

        <!-- Styling Tab Content -->
        <div id="styling-tab" class="tab-content" style="<?php echo $active_tab === 'styling' ? 'display: block;' : 'display: none;'; ?>">
            <?php include ACCEPT_MY_COOKIES_DIR . '/include/View/Admin/templates/styling-tab.php'; ?>
        </div>

        <?php submit_button(__('Save Settings', 'accept-my-cookies')); ?>
    </form>
</div>