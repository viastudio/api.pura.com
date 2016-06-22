<?php
/*
Description: Adds an API endpoint at /rest-functions/v1/bloginfo
Version: 0.1
*/

namespace RestFunctions\Endpoints;

class BloginfoController {
    protected $base = 'bloginfo';
    protected $version = 'v1';
    protected $alphaRegex = '(?P<info>\S+)';
    protected $namespaceBase = 'rest-functions';
    protected $blogInfoAttrs = [
        'name',
        'description',
        'wpurl',
        'url',
        'admin_email',
        'charset',
        'version',
        'html_type',
        'text_direction',
        'language',
        'stylesheet_url',
        'stylesheet_directory',
        'template_url',
        'pingback_url',
        'atom_url',
        'rdf_url',
        'rss_url',
        'rss2_url',
        'comments_atom_url',
        'comments_rss2_url'
    ];

    public function __construct() {
        $this->namespace = $this->namespaceBase . '/' . $this->version;
    }

    public function register_routes() {
        // GET /rest-functions/v1/bloginfo
        register_rest_route($this->namespace, "/{$this->base}", [
            'methods' => \WP_REST_Server::READABLE,
            'callback' => [$this, 'blogInfo'],
            'args' => [
                'info' => [
                    'validate_callback' => function ($param) {
                        return is_string($param);
                    }
                ]
            ]
            // 'permission_callback' => [$this, ?]
        ]);

        // GET /rest-functions/v1/bloginfo/info_string
        register_rest_route($this->namespace, "/{$this->base}/{$this->alphaRegex}", [
            'methods' => \WP_REST_Server::READABLE,
            'callback' => [$this, 'blogInfo'],
            'args' => [
                'info' => [
                    'validate_callback' => function ($param) {
                        return is_string($param);
                    }
                ]
            ]
            // 'permission_callback' => [$this, ?]
        ]);
    }

    public function blogInfo($request) {
        $info = $request->get_param('info');

        if (!empty($info)) {
            $response = [
                'key' => $info,
                'data' => get_bloginfo($info)
            ];

            return new \WP_REST_Response($response);
        }

        $response['key'] = 'bloginfo';
        foreach ($this->blogInfoAttrs as $key => $info) {
            $response['data'][$info] = get_bloginfo($info);
        }

        return new \WP_REST_Response($response);
    }
}
