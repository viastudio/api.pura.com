<?php
/**
 * Plugin Name: REST Functions
 * Description: Wrappers for WP functions accessible over the REST API
 * Author: VIA Studio
 * Author URI: http://viastudio.com
 * Version: 0.1
*/

if (!defined('WPINC')) {
    die;
}

require_once __DIR__ . '/vendor/autoload.php';

if (!class_exists('WP_REST_Controller')) {
    add_action('admin_notices', 'display_notice');
    display_notice();
}

$restFunctions = new \RestFunctions\Loader();

function display_notice() {
    $class = 'notice notice-error';
    $message = __('WP REST API plugin must be activated for REST Functions to work properly.', 'rest-functions');

    printf('<div class="%1$s"><p>%2$s</p></div>', $class, $message);
}
