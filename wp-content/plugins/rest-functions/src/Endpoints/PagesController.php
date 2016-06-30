<?php
/*
Description: Adds an API endpoint at /rest-functions/v1/pages/:slug. That gets a page by slug
Version: 0.1
*/

namespace RestFunctions\Endpoints;

use RestFunctions\Traits\FeaturedImageHelper;

class PagesController extends \WP_REST_Posts_Controller {
    use FeaturedImageHelper;

    protected $base = 'pages';
    protected $version = 'v1';
    protected $alphaRegex = '(?P<slug>\S+)';
    protected $namespaceBase = 'rest-functions';

    public function __construct() {
        $this->namespace = $this->namespaceBase . '/' . $this->version;
    }

    public function register_routes() {
        // GET /rest-functions/v1/pages/slug
        register_rest_route($this->namespace, "/{$this->base}/{$this->alphaRegex}", [
            'methods' => \WP_REST_Server::READABLE,
            'callback' => [$this, 'pageBySlug'],
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

    public function pageBySlug($request) {
        $slug = $request->get_param('slug');
        $args = [
            'name' => $slug,
            'post_type' => 'page',
            'post_status' => 'publish',
            'posts_per_page' => 1
        ];

        $post = get_posts($args);
        $data = $this->prepare_item_for_response($post[0], $request);
        return rest_ensure_response($data);
    }
}
