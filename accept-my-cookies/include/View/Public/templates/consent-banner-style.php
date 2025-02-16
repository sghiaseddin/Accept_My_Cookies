<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

ob_start();
?>
    /* Accept My Cookies styles */
    #accept-my-cookies-banner, .accept-my-cookies-banner__text {
        font-size: <?php echo esc_attr($banner_text_size); ?>px;
    }
    .accept-my-cookies-banner__title {
        font-size: <?php echo esc_attr($banner_title_text_size); ?>px;
    }
    .accept-my-cookies-banner__actions button {
        font-size: <?php echo esc_attr($banner_button_text_size); ?>px;
    }
    .accept-my-cookies-banner__button {
        font-size: <?php echo esc_attr($banner_button_text_size); ?>px;
    }
    .accept-my-cookies-banner, .accept-my-cookies-banner-overlay {
        z-index: <?php echo esc_attr($banner_z_index); ?>;
    }
    <?php if ($banner_color_style == 'custom') : ?>
    .accept-my-cookies-banner-overlay {
        background-color: <?php echo esc_attr($banner_overlay_color); ?>;
    }    
    .accept-my-cookies-banner--custom {
        background-color: <?php echo esc_attr($banner_background_color); ?>;
        color: <?php echo esc_attr($banner_text_color); ?>;
    }
    .accept-my-cookies-banner__toggle:checked + .accept-my-cookies-banner__toggle-slider {
        background-color: <?php echo esc_attr($banner_button_background_color); ?>;
    }
    .accept-my-cookies-banner__link {
        color: <?php echo esc_attr($banner_link_color); ?>;
    }
    .accept-my-cookies-banner__button--accept, .accept-my-cookies-banner__button--acceptall {
        background-color: <?php echo esc_attr($banner_button_background_color); ?>;
        color: <?php echo esc_attr($banner_button_text_color); ?>;
    }
    .accept-my-cookies-banner__button--customize {
        background-color: <?php echo esc_attr($banner_button_background_color); ?>;
        color: <?php echo esc_attr($banner_button_text_color); ?>;
    }    
    <?php endif; ?>
<?php
return ob_get_clean();