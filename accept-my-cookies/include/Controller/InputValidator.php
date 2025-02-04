<?php
namespace AcceptMyCookies\Controller;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class InputValidator {
    public static function validate($type, $value, $options = array() ) {
        switch ($type) {
            case 'text':
                return self::is_text($value);
            case 'url':
                return self::is_url($value);            
            case 'number':
                return self::is_number($value);
            case 'unit_interval':
                return self::is_unit_interval($value);
            case 'boolean':
                return self::is_boolean($value);
            case 'options':
                return self::is_options($value, $options);
            case 'color':
                return self::is_color($value);
            case 'ga_id':
                return self::is_ga_id($value);
            case 'html':
                return self::is_html($value);
            default:
                return true;
        }
    }

    private static function is_text($value) {
        return sanitize_text_field($value);
    }

    private static function is_url($value) {
        if ( wp_http_validate_url($value) ) {
            return $value;
        } else {
            return false;
        }
    }

    private static function is_number($value) {
        if ( preg_match('/^[\d\.\,]+$/', $value) ) {
            return $value;
        } else {
            return false;
        }
    }

    private static function is_unit_interval($value) {
        // check if the value is between 0 to 1
        if ( preg_match('/^(0(\.\d+)?|1(\.0*)?)$/', $value) ) {
            return $value;
        } else {
            return false;
        }
    }

    private static function is_boolean($value) {
        if ( preg_match('/^(0|1)$/', $value) ) {
            return $value;
        } else {
            return false;
        }
    }
    
    private static function is_options($value, $options) {
        if ( in_array($value, $options) ) {
            return $value;
        } else {
            return false;
        }
    }

    private static function is_color($value) {
        // Check if value matches hex color format (# followed by 3 or 6 hex digits)
        if ( preg_match('/^#[0-9A-Fa-f]{3,6}$/', $value) || ! $value ) {
            return $value;
        } else {
            return false;
        }
    }

    private static function is_ga_id($value) {
        // Google Analytics ID format: UA-XXXXX-Y
        if ( preg_match('/(G-\w{10}|UA-\d{4,9}-\d{1,3})/', $value) || ! $value ) {
            return $value;
        } else {
            return false;
        }
    }

    private static function is_html($value) {
        // Basic HTML validation using DOM parser
        if ( preg_match('/<[^>]+>/', $value) || ! $value ) {
            return $value;
        } else {
            return false;
        }
    }
}

