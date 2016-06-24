<?php
/*
Description: Adds an API endpoint at /rest-functions/v1/pages/:slug. That gets a page by slug
Version: 0.1
*/

namespace RestFunctions\Endpoints;

use RestFunctions\Traits\FeaturedImageHelper;

class PagesController {
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
            ]
            // 'permission_callback' => [$this, ?]
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

        $post[0]->title = [
            'raw' => $post[0]->post_title,
            'rendered' => get_the_title($post[0]->ID)
        ];

        $post[0]->content = [
            'raw' => $post[0]->post_content,
            'rendered' => apply_filters('the_content', $post[0]->post_content)
        ];

        $response['key'] = $post[0]->ID;

        $featuredImage = $this->getFeaturedImage($post[0]->ID);

        $post[0]->featured_media = $featuredImage['featured_media'];
        $post[0]->featured_image_tag = $featuredImage['featured_image_tag'];

        $response['data'] = $post[0];

        return new \WP_REST_Response($response);
    }
}
