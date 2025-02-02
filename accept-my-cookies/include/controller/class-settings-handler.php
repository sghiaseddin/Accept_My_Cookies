<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class AcceptMyCookies_Settings_Handler {

    /**
     * Get the default options.
     *
     * @return array
     */
    private function get_options_schema() {
        return include ACCEPT_MY_COOKIES_DIR . '/include/options.php';
    }

    /**
     * Get the value of a specific option.
     *
     * @param string $option_name The option name (e.g., 'sample_option').
     * @return mixed
     */
    public function get_option( $option_name ) {
        $schema = $this->get_options_schema();
        if ( isset( $schema[ $option_name ] ) ) {
            $key = $schema[ $option_name ]['key'];
            return get_option( $key, $schema[ $option_name ]['default'] );
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
    public function save_option( $option_name, $value ) {
        $schema = $this->get_options_schema();
        if ( isset( $schema[ $option_name ] ) ) {
            $key = $schema[ $option_name ]['key'];
            return update_option( $key, sanitize_text_field( $value ) );
        }
        return false;
    }

    /**
     * Save default options on plugin activation.
     */
    public function save_default_options() {
        $schema = $this->get_options_schema();
        foreach ( $schema as $option ) {
            if ( ! get_option( $option['key'] ) ) {
                update_option( $option['key'], $option['default'] );
            }
        }
    }

    /**
     * Delete all plugin options.
     */
    public function delete_all_options() {
        $schema = $this->get_options_schema();
        foreach ( $schema as $option ) {
            delete_option( $option['key'] );
        }
    }
}
