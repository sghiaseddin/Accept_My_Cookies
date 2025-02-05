<div id="accept-my-cookies-banner" class="accept-my-cookies-banner accept-my-cookies-banner--<?php echo esc_attr($banner_position); ?> accept-my-cookies-banner--<?php echo esc_attr($banner_color_style); ?>" style="display: none;">
    <div class="accept-my-cookies-banner__content">
        <p class="accept-my-cookies-banner__text"><?php echo esc_html($consent_text); ?></p>
        <div id="accept-my-cookies-banner__toggles" style="display: none;"><?php
            if ( $analytics_storage ) : ?>
            <label>
                <input type="checkbox" class="accept-my-cookies-banner__toggle" data-consent-type="analytics_storage" disabled checked>
                <?php _e('Analytics Storage', 'accept-my-cookies'); ?>
            </label><?php
            endif;
            if ( $ad_storage ) : ?>
            <label>
                <input type="checkbox" class="accept-my-cookies-banner__toggle" data-consent-type="ad_storage" disabled checked>
                <?php _e('Ad Storage', 'accept-my-cookies'); ?>
            </label><?php
            endif;
            if ( $ad_user_data ) : ?>
            <label>
                <input type="checkbox" class="accept-my-cookies-banner__toggle" data-consent-type="ad_user_data" disabled checked>
                <?php _e('Ad User Data', 'accept-my-cookies'); ?>
            </label><?php
            endif;
            if ( $ad_personalization ) : ?>
            <label>
                <input type="checkbox" class="accept-my-cookies-banner__toggle" data-consent-type="ad_personalization" disabled checked>
                <?php _e('Ad Personalization', 'accept-my-cookies'); ?>
            </label><?php
            endif; ?>
        </div>
        <div class="accept-my-cookies-banner__actions">
            <a href="<?php echo esc_url($learn_more_url); ?>" class="accept-my-cookies-banner__link" target="_blank">
                <?php echo esc_html($learn_more_text); ?>
            </a>
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