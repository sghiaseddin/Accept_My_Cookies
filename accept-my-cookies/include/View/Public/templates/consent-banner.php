<div id="accept-my-cookies-banner" class="accept-my-cookies-banner accept-my-cookies-banner--<?php echo esc_attr($banner_position); ?> accept-my-cookies-banner--<?php echo esc_attr($banner_color_style); ?>" style="display:none">
    <div class="accept-my-cookies-banner__content">
        <p class="accept-my-cookies-banner__text"><?php echo esc_html($consent_text); ?></p>
        <div class="accept-my-cookies-banner__actions">
            <a href="<?php echo esc_url($learn_more_url); ?>" class="accept-my-cookies-banner__link" target="_blank">
                <?php echo esc_html($learn_more_text); ?>
            </a>
            <button type="button" class="accept-my-cookies-banner__button accept-my-cookies-banner__button--accept">
                <?php echo esc_html($accept_button_text); ?>
            </button>
            <?php if ($customize_button_enabled) : ?>
                <button type="button" class="accept-my-cookies-banner__button accept-my-cookies-banner__button--customize">
                    <?php echo esc_html($customize_button_text); ?>
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>