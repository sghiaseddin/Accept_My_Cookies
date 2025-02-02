<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

return array(
    'sample_option' => array(
        'key'     => 'accept_my_cookies_sample_option',
        'default' => __( 'This is a sample option value.', 'accept-my-cookies' ),
        'label'   => __( 'Sample Option', 'accept-my-cookies' ),
    ),
    // Add more options here
);