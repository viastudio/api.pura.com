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
    die('The REST API plugin must be activated for this plugin.');
}

$restFunctions = new \RestFunctions\Loader();
