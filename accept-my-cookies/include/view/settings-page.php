<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div class="wrap">
    <h1><?php echo esc_html( __( 'Accept My Cookies Settings', 'accept-my-cookies' ) ); ?></h1>
    <form method="post" action="options.php">
        <?php
        settings_fields( 'accept_my_cookies_options_group' );
        do_settings_sections( 'accept-my-cookies' );
        submit_button();
        ?>
    </form>
</div>