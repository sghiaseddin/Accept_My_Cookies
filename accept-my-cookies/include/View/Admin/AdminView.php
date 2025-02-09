<?php

namespace AcceptMyCookies\View\Admin;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class AdminView
{
    /**
     * Render an option input field.
     *
     * @param array $args The field arguments.
     */
    public function renderOptionField($args)
    {
        $option_name = $args['option_name'];
        $schema = include ACCEPT_MY_COOKIES_DIR . '/include/options.php';
        $option = $schema[ $option_name ];
        $value = get_option($option['key'], $option['default']);

        // Add a wrapper div for styling and dynamic visibility
        echo '<div class="accept-my-cookies-field"';

        // Add data attributes for dynamic visibility
        if (isset($option['data-depends-on'])) {
            echo ' data-depends-on="' . esc_attr($option['data-depends-on']) . '"';
        }
        if (isset($option['data-depends-value'])) {
            echo ' data-depends-value="' . esc_attr($option['data-depends-value']) . '"';
        }

        echo '>';

        // Render the input based on type
        switch ($option['type']) {
            case 'text':
                ?>
                <input type="text" 
                       id="<?php echo esc_attr($option['key']); ?>" 
                       name="<?php echo esc_attr($option['key']); ?>" 
                       value="<?php echo esc_attr($value); ?>" 
                       class="regular-text" 
                       placeholder="<?php echo esc_attr($option['placeholder'] ?? ''); ?>">
                <?php
                break;

            case 'textarea':
                ?>
                <textarea id="<?php echo esc_attr($option['key']); ?>" 
                          name="<?php echo esc_attr($option['key']); ?>" 
                          class="large-text" 
                          placeholder="<?php echo esc_attr($option['placeholder'] ?? ''); ?>"><?php echo esc_textarea($value); ?></textarea>
                <?php
                break;

            case 'number':
                ?>
                <input type="number" 
                       id="<?php echo esc_attr($option['key']); ?>" 
                       name="<?php echo esc_attr($option['key']); ?>" 
                       value="<?php echo esc_attr($value); ?>" 
                       class="regular-text" 
                       placeholder="<?php echo esc_attr($option['placeholder'] ?? ''); ?>"
                       step="<?php echo esc_attr($option['step'] ?? '1'); ?>"
                       min="<?php echo esc_attr($option['min'] ?? ''); ?>"
                       max="<?php echo esc_attr($option['max'] ?? ''); ?>">
                <?php
                break;

            case 'checkbox':
                ?>
                <input type="checkbox" 
                       id="<?php echo esc_attr($option['key']); ?>" 
                       name="<?php echo esc_attr($option['key']); ?>" 
                       value="1" <?php checked($value, '1'); ?>>
                <?php
                break;

            case 'select':
                ?>
                <select id="<?php echo esc_attr($option['key']); ?>" 
                        name="<?php echo esc_attr($option['key']); ?>">
                    <?php foreach ($option['options'] as $option_value => $option_label) : ?>
                        <option value="<?php echo esc_attr($option_value); ?>" <?php selected($value, $option_value); ?>>
                            <?php echo esc_html($option_label); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php
                break;

            case 'color':
                ?>
                <div class="color-picker-wrapper">
                    <input type="text" 
                           id="<?php echo esc_attr($option['key']); ?>" 
                           name="<?php echo esc_attr($option['key']); ?>" 
                           value="<?php echo esc_attr($value); ?>" 
                           class="color-picker-hex" 
                           placeholder="<?php echo esc_attr($option['placeholder'] ?? ''); ?>">
                    <input type="color" 
                           class="color-picker" 
                           value="<?php echo esc_attr($value); ?>">
                </div>
                <?php
                break;

            default:
                ?>
                <input type="text" 
                       id="<?php echo esc_attr($option['key']); ?>" 
                       name="<?php echo esc_attr($option['key']); ?>" 
                       value="<?php echo esc_attr($value); ?>" 
                       class="regular-text" 
                       placeholder="<?php echo esc_attr($option['placeholder'] ?? ''); ?>">
                <?php
                break;
        }

        // Render the description
        if (! empty($option['description'])) {
            echo '<p class="description">' . esc_html($option['description']) . '</p>';
        }

        // Close the wrapper div
        echo '</div>';
    }
    /**
     * Enqueue scripts and styles for the admin area.
     */
    public function enqueueScripts()
    {
        wp_register_script(
            'accept-my-cookies-deactivate',
            ACCEPT_MY_COOKIES_URL . 'assets/js/deactivate.js',
            array( 'jquery' ),
            ACCEPT_MY_COOKIES_VERSION,
            true
        );

        wp_register_script(
            'accept-my-cookies-save-settings',
            ACCEPT_MY_COOKIES_URL . 'assets/js/save-settings.js',
            array( 'jquery' ),
            ACCEPT_MY_COOKIES_VERSION,
            true
        );

        wp_register_script(
            'accept-my-cookies-tabs',
            ACCEPT_MY_COOKIES_URL . 'assets/js/tabs.js',
            array( 'jquery' ),
            ACCEPT_MY_COOKIES_VERSION,
            true
        );

        wp_register_style(
            'accept-my-cookies-admin',
            ACCEPT_MY_COOKIES_URL . 'assets/css/admin.css',
            array(),
            ACCEPT_MY_COOKIES_VERSION
        );

        wp_register_script(
            'accept-my-cookies-dynamic-inputs',
            ACCEPT_MY_COOKIES_URL . 'assets/js/dynamic-inputs.js',
            array( 'jquery' ),
            ACCEPT_MY_COOKIES_VERSION,
            true
        );

        wp_localize_script(
            'accept-my-cookies-save-settings',
            'acceptMyCookiesSaveSettings',
            array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('accept_my_cookies_save_settings_nonce'),
                'saving'  => __('Saving...', 'accept-my-cookies'),
                'saved'   => __('Setting Saved!', 'accept-my-cookies'),
                'failed'  => __('Saving failed!', 'accept-my-cookies'),
                'save'    => __('Save Settings', 'accept-my-cookies'),
            )
        );

        wp_localize_script(
            'accept-my-cookies-deactivate',
            'acceptMyCookiesCleanup',
            array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('accept_my_cookies_cleanup_nonce')
            )
        );

        // Get the current screen object
        $screen = get_current_screen();

        // Check if we are on the plugin settings page
        if ($screen && $screen->id === 'settings_page_accept-my-cookies') {
            wp_enqueue_script('accept-my-cookies-save-settings');
            wp_enqueue_script('accept-my-cookies-tabs');
            wp_enqueue_script('accept-my-cookies-dynamic-inputs');
        }
        wp_enqueue_script('accept-my-cookies-deactivate');
        wp_enqueue_style('accept-my-cookies-admin');
    }
}