<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>
<div class="accept-my-cookies-banner-overlay" style="display: none;"></div>
<div id="accept-my-cookies-banner" class="accept-my-cookies-banner accept-my-cookies-banner--<?php echo esc_attr($banner_position); ?> accept-my-cookies-banner-size--<?php echo esc_attr($banner_size); ?> accept-my-cookies-banner-button-size--<?php echo esc_attr($banner_button_size); ?> accept-my-cookies-banner--<?php echo esc_attr($banner_color_style); ?>" style="display: none;">
    <div class="accept-my-cookies-banner-close-button">×<span> <?php esc_html_e('Close Banner', 'accept-my-cookies'); ?></span></div>
    <div class="accept-my-cookies-banner__content">
        <div class="accept-my-cookies-banner__info">
            <p class="accept-my-cookies-banner__title"><?php echo esc_html($banner_title); ?></p>
            <p class="accept-my-cookies-banner__text">
                <?php echo esc_html($consent_text); ?>
                <a href="<?php echo esc_url($learn_more_url); ?>" class="accept-my-cookies-banner__link" target="_blank">
                    <?php echo esc_html($learn_more_text); ?>
                </a>
            </p>
            <div id="accept-my-cookies-banner__toggles" style="display: none;">
                    <label class="accept-my-cookies-banner__toggle-label-essentials">
                        <input type="checkbox" class="accept-my-cookies-banner__toggle_essentials" disabled checked>
                        <span class="accept-my-cookies-banner__toggle-slider"></span>
                        <?php esc_html_e('Essentials', 'accept-my-cookies'); ?>
                    </label>
                <?php if ($analytics_storage) : ?>
                    <label class="accept-my-cookies-banner__toggle-label">
                        <input type="checkbox" class="accept-my-cookies-banner__toggle" data-consent-type="analytics_storage" disabled checked>
                        <span class="accept-my-cookies-banner__toggle-slider"></span>
                        <?php esc_html_e('Analytics Storage', 'accept-my-cookies'); ?>
                    </label>
                <?php endif; ?>
                <?php if ($ad_storage) : ?>
                    <label class="accept-my-cookies-banner__toggle-label">
                        <input type="checkbox" class="accept-my-cookies-banner__toggle" data-consent-type="ad_storage" disabled checked>
                        <span class="accept-my-cookies-banner__toggle-slider"></span>
                        <?php esc_html_e('Ad Storage', 'accept-my-cookies'); ?>
                    </label>
                <?php endif; ?>
                <?php if ($ad_user_data) : ?>
                    <label class="accept-my-cookies-banner__toggle-label">
                        <input type="checkbox" class="accept-my-cookies-banner__toggle" data-consent-type="ad_user_data" disabled checked>
                        <span class="accept-my-cookies-banner__toggle-slider"></span>
                        <?php esc_html_e('Ad User Data', 'accept-my-cookies'); ?>
                    </label>
                <?php endif; ?>
                <?php if ($ad_personalization) : ?>
                    <label class="accept-my-cookies-banner__toggle-label">
                        <input type="checkbox" class="accept-my-cookies-banner__toggle" data-consent-type="ad_personalization" disabled checked>
                        <span class="accept-my-cookies-banner__toggle-slider"></span>
                        <?php esc_html_e('Ad Personalization', 'accept-my-cookies'); ?>
                    </label>
                <?php endif; ?>
                <?php if ($clarity_tracking && $clarity_consent_enabled) : ?>
                    <label class="accept-my-cookies-banner__toggle-label">
                        <input type="checkbox" class="accept-my-cookies-banner__toggle" data-consent-type="clarity_tracking" disabled checked>
                        <span class="accept-my-cookies-banner__toggle-slider"></span>
                        <?php esc_html_e('Clarity Tracking', 'accept-my-cookies'); ?>
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
