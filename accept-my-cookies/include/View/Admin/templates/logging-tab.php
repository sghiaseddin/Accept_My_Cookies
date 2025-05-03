<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Render the option field for this tab
do_settings_sections('accept-my-cookies-logging');

?>
<div id="accept-my-cookies-charts" style="max-width: 1024px;" data-depends-on="accept_my_cookies_logging_enabled">
    <h2><?php echo esc_html(__('Log Summary', 'accept-my-cookies')); ?></h2>
    <p><?php echo sprintf( 
        __( 'User chioces on consent banner during %s.', 'accept-my-cookies' ), 
        date('M Y')
    ); ?></p>
</div>