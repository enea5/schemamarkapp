<?php
function ma_get_page_ancestors(\WP_Post $post)
{
    $ancestors = [];
    try {
        $ancestorsId = array_reverse(get_ancestors($post->ID, 'post'));

        foreach ($ancestorsId as $id) {
            $ancestors[] = get_post($id);
        }

        $ancestors[] = $post;
    } finally {
        return $ancestors;
    }
}