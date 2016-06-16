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

$restFunctions = new \RestFunctions\Loader();
