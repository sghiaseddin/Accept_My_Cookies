<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>
<div>
    <h2><?php echo esc_html(__('About This Plugin', 'accept-my-cookies')); ?></h2>
    <p><?php echo sprintf( 
        __( 'This plugin was created by %s, a developer.', 'accept-my-cookies' ), 
        '<a href="https://github.com/sghiaseddin" target="_blank">Shayan Ghiaseddin</a>'
    ); ?></p>
    <h3><?php echo esc_html(__('Need a Custom WordPress Solution?', 'accept-my-cookies')); ?></h3>
    <p><?php echo sprintf( 
        __('If you like this plugin, and need a custom WordPress development or plugin customization, feel free to %s.', 'accept-my-cookies' ), 
        '<a href="mailto:sghiaseddin@me.com">' . esc_html(__('get in touch', 'accept-my-cookies')) . '</a>'
    ); ?></p>
    <h3><?php echo esc_html(__('Support the Development', 'accept-my-cookies')); ?></h3>
    <p><?php echo esc_html(__('If this plugin has been helpful, consider supporting future updates by making a donation:', 'accept-my-cookies')); ?></p>
    <div id="donate-button-container">
        <div id="donate-button"></div>
    </div>
    <p><?php echo esc_html(__('Thank you for using this plugin! Your support helps keep it free and regularly updated.', 'accept-my-cookies')); ?></p>
    <p><?php echo sprintf(
        __('You can also support this plugin by writing a review on %s or submiting an issue in %s.', 'accept-my-cookies'),
        '<a href="http://wordpress.org/plugins/accept-my-cookies/" target="_blank">' . esc_html(__('plugin page', 'accept-my-cookies')) . '</a>',
        '<a href="https://github.com/sghiaseddin/accept-my-cookies" target="_blank">' . esc_html(__('Github repository', 'accept-my-cookies')) . '</a>'
    );?></p>
</div>