<?php

function blog_filter_init($query)
{
    if ($query->is_home() && $query->is_main_query() && !is_admin()) {
        $params = isset($_GET['cats']) && $_GET['cats']  ? wp_strip_all_tags($_GET['cats']) : "";
        $offset = isset($_GET['offset']) && $_GET['offset']  ? wp_strip_all_tags($_GET['offset']) : "12";

        $query->set('post_status', 'publish');

        if ($params) {
            $params_slit = explode('-', $params);
            $query->set('category__in', $params_slit);
        }

        if ($offset) {
            $query->set('posts_per_page', $offset);
        }
    }
}
add_action('pre_get_posts', 'blog_filter_init');
