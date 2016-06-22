<?php
namespace RestFunctions;

use RestFunctions\Endpoints\BloginfoController;
use RestFunctions\Endpoints\ThemeOptionsController;
use RestFunctions\Endpoints\HomePageController;
use RestFunctions\Endpoints\PagesController;

class Loader {
    public function __construct() {
        add_action('rest_api_init', [$this, 'init_routes'], 0);
    }

    public function init_routes() {
        (new BloginfoController())->register_routes();
        (new ThemeOptionsController())->register_routes();
        (new HomePageController())->register_routes();
        (new PagesController())->register_routes();
    }
}
