<?php

namespace AcceptMyCookies\Controller;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class SettingsHandler
{
    /**
     * Get the default options.
     *
     * @return array
     */
    private function getOptionsSchema()
    {
        return include ACCEPT_MY_COOKIES_DIR . '/include/options.php';
    }

    /**
     * Get the value of a specific option.
     *
     * @param string $option_name The option name (e.g., 'sample_option').
     * @return mixed
     */
    public function getOption($option_name)
    {
        $schema = $this->getOptionsSchema();
        if (isset($schema[ $option_name ])) {
            $key = $schema[ $option_name ]['key'];
            return get_option($key, $schema[ $option_name ]['default']);
        }
        return '';
    }

    /**
     * Save the value of a specific option.
     *
     * @param string $option_name The option name (e.g., 'sample_option').
     * @param mixed  $value       The value to save.
     * @return bool
     */
    public function saveOption($option_name, $value)
    {
        $schema = $this->getOptionsSchema();
        if (isset($schema[ $option_name ])) {
            $key = $schema[ $option_name ]['key'];
            return update_option($key, sanitize_text_field($value));
        }
        return false;
    }

    /**
     * Save default options on plugin activation.
     */
    public function saveDefaultOptions($translations)
    {
        $schema = $this->getOptionsSchema();
        foreach ($schema as $key => $option) {
            if (! get_option($option['key'])) {
                $default = isset($translations[$option['default']]) ? $translations[$option['default']]->translations[0] : $option['default'];
                update_option($option['key'], $default);
            }
        }
    }

    /**
     * Delete all plugin options.
     */
    public function deleteAllOptions()
    {
        $schema = $this->getOptionsSchema();
        foreach ($schema as $key => $option) {
            delete_option($option['key']);
        }
    }
}
