<?php
/*
Description: Adds an API endpoint at /rest-functions/v1/bloginfo
Version: 0.1
*/

class BloginfoController {
    protected $base = 'bloginfo';
    protected $version = 'v1';
    protected $alphaRegex = '(?P<info>\S+)';
    protected $namespaceBase = 'rest-functions';

    public function __construct() {
        $this->namespace = $this->namespaceBase . '/' . $this->version;
    }

    public function register_routes() {
        // GET /rest-functions/v1/bloginfo

        register_rest_route($this->namespace, "/{$this->base}", [
            'methods' => \WP_REST_Server::READABLE,
            'callback' => [$this, 'blogInfo']
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

        if (empty($info)) {
            return new WP_Error('rest_bloginfo_no_param', __('You must specify what data to return.'));
        }

        $data = get_bloginfo($info);

        $response['key'] = $info;
        $response['value'] = $data;

        return new \WP_REST_Response($response);
    }
}
