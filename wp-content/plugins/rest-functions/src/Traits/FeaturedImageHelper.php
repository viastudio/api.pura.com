<?php
/*
Description: Used to pull in featured images for posts, pages, homepage, etc.php
Version: 0.1
*/

namespace RestFunctions\Traits;

trait FeaturedImageHelper {
    function getFeaturedImage($post_id) {
        if (empty($post_id)) {
            return new \WP_Error('Missing or invalid post / page id', 200);
        }

        $data = [];

        if (has_post_thumbnail($post_id)) {
            $thumbnail_id = (int) get_post_thumbnail_id($post_id);
        }

        if (!is_integer($thumbnail_id) || empty($thumbnail_id)) {
            return $data;
        }

        $data['featured_media'] = $thumbnail_id;
        $data['featured_image_tag'] = get_the_post_thumbnail($post_id);
        return $data;
    }
}
