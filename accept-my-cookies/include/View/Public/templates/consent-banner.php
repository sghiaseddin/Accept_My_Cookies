<div class="accept-my-cookies-banner-overlay" style="display: none;"></div>
<div id="accept-my-cookies-banner" class="accept-my-cookies-banner accept-my-cookies-banner--<?php echo esc_attr($banner_position); ?> accept-my-cookies-banner-size--<?php echo esc_attr($banner_size); ?> accept-my-cookies-banner-button-size--<?php echo esc_attr($banner_button_size); ?> accept-my-cookies-banner--<?php echo esc_attr($banner_color_style); ?>" style="display: none;">
    <div class="accept-my-cookies-banner__content">
        <div class="accept-my-cookies-banner__info">
            <p class="accept-my-cookies-banner__text">
                <?php echo esc_html($consent_text); ?>
                <a href="<?php echo esc_url($learn_more_url); ?>" class="accept-my-cookies-banner__link" target="_blank">
                    <?php echo esc_html($learn_more_text); ?>
                </a>
            </p>
            <div id="accept-my-cookies-banner__toggles" style="display: none;">
                <?php if ($analytics_storage) : ?>
                    <label class="accept-my-cookies-banner__toggle-label">
                        <input type="checkbox" class="accept-my-cookies-banner__toggle" data-consent-type="analytics_storage" disabled checked>
                        <span class="accept-my-cookies-banner__toggle-slider"></span>
                        <?php _e('Analytics Storage', 'accept-my-cookies'); ?>
                    </label>
                <?php endif; ?>
                <?php if ($ad_storage) : ?>
                    <label class="accept-my-cookies-banner__toggle-label">
                        <input type="checkbox" class="accept-my-cookies-banner__toggle" data-consent-type="ad_storage" disabled checked>
                        <span class="accept-my-cookies-banner__toggle-slider"></span>
                        <?php _e('Ad Storage', 'accept-my-cookies'); ?>
                    </label>
                <?php endif; ?>
                <?php if ($ad_user_data) : ?>
                    <label class="accept-my-cookies-banner__toggle-label">
                        <input type="checkbox" class="accept-my-cookies-banner__toggle" data-consent-type="ad_user_data" disabled checked>
                        <span class="accept-my-cookies-banner__toggle-slider"></span>
                        <?php _e('Ad User Data', 'accept-my-cookies'); ?>
                    </label>
                <?php endif; ?>
                <?php if ($ad_personalization) : ?>
                    <label class="accept-my-cookies-banner__toggle-label">
                        <input type="checkbox" class="accept-my-cookies-banner__toggle" data-consent-type="ad_personalization" disabled checked>
                        <span class="accept-my-cookies-banner__toggle-slider"></span>
                        <?php _e('Ad Personalization', 'accept-my-cookies'); ?>
                    </label>
                <?php endif; ?>
            </div>
        </div>
        <div class="accept-my-cookies-banner__actions">
            <?php if ($customize_button_enabled) : ?>
                <button type="button" class="accept-my-cookies-banner__button accept-my-cookies-banner__button--customize">
                    <?php echo esc_html($customize_button_text); ?>
                </button>
            <?php endif; ?>
            <button type="button" class="accept-my-cookies-banner__button accept-my-cookies-banner__button--accept">
                <?php echo esc_html($accept_button_text); ?>
            </button>
            <?php if ($customize_button_enabled) : ?>
                <button type="button" class="accept-my-cookies-banner__button accept-my-cookies-banner__button--acceptall" style="display:none">
                    <?php echo esc_html($acceptall_button_text); ?>
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    /* Accept My Cookies styles */
    #accept-my-cookies-banner, .accept-my-cookies-banner__text {
        font-size: <?php echo esc_attr($banner_text_size); ?>px;
    }
    .accept-my-cookies-banner__actions button {
        font-size: <?php echo esc_attr($banner_button_text_size); ?>px;
    }
    .accept-my-cookies-banner__button {
        font-size: <?php echo esc_attr($banner_button_text_size); ?>px;
    }
    .accept-my-cookies-banner {
        z-index: <?php echo esc_attr($banner_z_index); ?>;
    }
    <?php if ( $banner_color_style == 'custom' ) : ?>
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
</style>