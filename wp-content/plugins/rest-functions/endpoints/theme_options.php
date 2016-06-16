<?php
/*
Description: Adds an API endpoint at /rest-functions/v1/theme-options
Version: 0.1
*/

class ThemeOptionsController {
    protected $base = 'theme-options';
    protected $version = 'v1';
    protected $namespaceBase = 'rest-functions';

    public function __construct() {
        $this->namespace = $this->namespaceBase . '/' . $this->version;
        add_action('rest_api_init', [$this, 'register_routes']);
    }

    public function register_routes() {
        register_rest_route($this->namespace, "/{$this->base}", [
            'methods' => \WP_REST_Server::READABLE,
            'callback' => [$this, 'themeOptions']
            // 'permission_callback' => [$this, ?]
        ]);
    }

    public function themeOptions() {
        $response['key'] = 'theme-options';
        $response['data'] = get_theme_mods();

        return new \WP_REST_Response($response);
    }
}

new ThemeOptionsController();
