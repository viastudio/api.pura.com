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
        $post = get_post($frontpage_id);
        $post->title = [
            'raw' => $post->post_title,
            'rendered' => get_the_title($post->ID)
        ];

        $post->content = [
            'raw' => $post->post_content,
            'rendered' => apply_filters('the_content', $post->post_content)
        ];

        $response['data'] = $post;
        return new \WP_REST_Response($response);
    }
}
