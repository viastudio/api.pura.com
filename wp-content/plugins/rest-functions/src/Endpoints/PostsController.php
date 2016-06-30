<?php
/*
Description: Adds an API endpoint at /rest-functions/v1/posts/:slug. That gets a page by slug
Version: 0.1
*/

namespace RestFunctions\Endpoints;

class PostsController extends \WP_REST_Posts_Controller {
    protected $base = 'posts';
    protected $version = 'v1';
    protected $alphaRegex = '(?P<slug>\S+)';
    protected $namespaceBase = 'rest-functions';
    protected $post_type;

    // The Post type is used for the schema from the API Posts Controller
    public function __construct($post_type = 'post') {
        $this->namespace = $this->namespaceBase . '/' . $this->version;
        $this->post_type = $post_type;
    }

    public function register_routes() {
        // GET /rest-functions/v1/Posts/slug
        register_rest_route($this->namespace, "/{$this->base}/{$this->alphaRegex}", [
            'methods' => \WP_REST_Server::READABLE,
            'callback' => [$this, 'postBySlug'],
            'args' => [
                'slug' => [
                    'validate_callback' => function ($param) {
                        return is_string($param);
                    }
                ]
            ],
            'schema' => array($this, 'get_public_item_schema')
        ]);
    }

    public function postBySlug($request) {
        $slug = $request->get_param('slug');
        $args = [
            'name' => $slug,
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 1
        ];

        $post = get_posts($args);
        $data = $this->prepare_item_for_response($post[0], $request);
        return rest_ensure_response($data);
    }
}
