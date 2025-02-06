<?php
namespace AcceptMyCookies\Controller;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class InputValidator {
    public static function validate($type, $value, $options = array() ) {
        switch ($type) {
            case 'text':
                return self::isText($value);
            case 'url':
                return self::isUrl($value);            
            case 'number':
                return self::isNumber($value);
            case 'unit_interval':
                return self::isUnitInterval($value);
            case 'boolean':
                return self::isBoolean($value);
            case 'options':
                return self::isOptions($value, $options);
            case 'color':
                return self::isColor($value);
            case 'ga_id':
                return self::isGaId($value);
            case 'html':
                return self::isHtml($value);
            default:
                return true;
        }
    }

    private static function isText($value) {
        return sanitize_text_field($value);
    }

    private static function isUrl($value) {
        if ( wp_http_validate_url($value) ) {
            return $value;
        } else {
            return false;
        }
    }

    private static function isNumber($value) {
        if ( preg_match('/^[\d\.\,]+$/', $value) ) {
            return $value;
        } else {
            return false;
        }
    }

    private static function isUnitInterval($value) {
        // check if the value is between 0 to 1
        if ( preg_match('/^(0(\.\d+)?|1(\.0*)?)$/', $value) ) {
            return $value;
        } else {
            return false;
        }
    }

    private static function isBoolean($value) {
        if ( preg_match('/^(0|1)$/', $value) ) {
            return $value;
        } else {
            return false;
        }
    }
    
    private static function isOptions($value, $options) {
        if ( in_array($value, $options) ) {
            return $value;
        } else {
            return false;
        }
    }

    private static function isColor($value) {
        // Check if value matches hex color format (# followed by 3 or 6 hex digits)
        if ( preg_match('/^#[0-9A-Fa-f]{3,6}$/', $value) || ! $value ) {
            return $value;
        } else {
            return false;
        }
    }

    private static function isGaId($value) {
        // Google Analytics ID format: UA-XXXXX-Y
        if ( preg_match('/(G-\w{10}|UA-\d{4,9}-\d{1,3})/', $value) || ! $value ) {
            return $value;
        } else {
            return false;
        }
    }

    private static function isHtml($value) {
        // Basic HTML validation using DOM parser
        if ( preg_match('/<[^>]+>/', $value) || ! $value ) {
            return $value;
        } else {
            return false;
        }
    }
}

