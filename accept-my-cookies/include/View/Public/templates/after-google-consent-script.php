<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

ob_start();
?>
    gtag('js', new Date());
    gtag('config', '<?php echo esc_attr($ga_id); ?>');

    // Update consent based on stored values
    updateStoredConsent();
<?php
return ob_get_clean();
