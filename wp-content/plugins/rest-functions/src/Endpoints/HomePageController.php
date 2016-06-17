<?php
/*
Description: Adds an API endpoint at /rest-functions/v1/homepage
Version: 0.1
*/

namespace RestFunctions\Endpoints;

class HomePageController {
    protected $base = 'homepage';
    protected $version = 'v1';
    protected $namespaceBase = 'rest-functions';

    public function __construct() {
        $this->namespace = $this->namespaceBase . '/' . $this->version;
    }

    public function register_routes() {
        register_rest_route($this->namespace, "/{$this->base}", [
            'methods' => \WP_REST_Server::READABLE,
            'callback' => [$this, 'homePage']
            // 'permission_callback' => [$this, ?]
        ]);
    }

    public function homePage() {
        $frontpage_id = get_option('page_on_front');
        $response['key'] = 'homepage';
        $response['data'] = get_post($frontpage_id);

        return new \WP_REST_Response($response);
    }
}
