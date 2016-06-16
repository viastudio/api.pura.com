<?php
/**
 * Plugin Name: REST Functions
 * Description: Wrappers for WP functions accessible over the REST API
 * Author: VIA Studio
 * Author URI: http://viastudio.com
 * Version: 0.1
*/

if (!class_exists('BloginfoController')) {
    require_once dirname(__FILE__) . '/endpoints/bloginfo.php';
}

if (!class_exists('ThemeOptionsController')) {
    require_once dirname(__FILE__) . '/endpoints/theme_options.php';
}

add_action('rest_api_init', 'init_routes', 0);

if (!function_exists('init_routes')) {
    function init_routes() {
        (new BloginfoController())->register_routes();
        (new ThemeOptionsController())->register_routes();
    }
}
