<?php
/*
Description: Adds an API endpoint at /rest-functions/v1/homepage
Version: 0.1
*/

namespace RestFunctions\Endpoints;

class HomePageController extends \WP_REST_Posts_Controller {
    protected $base = 'homepage';
    protected $version = 'v1';
    protected $namespaceBase = 'rest-functions';
    protected $post_type;

    public function __construct($post_type = 'page') {
        parent::__construct($post_type);
        $this->namespace = $this->namespaceBase . '/' . $this->version;
    }

    public function register_routes() {
        register_rest_route($this->namespace, "/{$this->base}", [
            'methods' => \WP_REST_Server::READABLE,
            'callback' => [$this, 'homePage']
        ]);
    }

    public function homePage() {
        $frontpage_id = get_option('page_on_front');
        $response['key'] = 'homepage';
        $post = get_post($frontpage_id);
        $data = $this->prepare_item_for_response($post, $request);
        return rest_ensure_response($data);
    }
}
