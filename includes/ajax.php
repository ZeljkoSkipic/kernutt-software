<?php

add_action('wp_ajax_blog_filter', 'blog_filter');
add_action('wp_ajax_nopriv_blog_filter', 'blog_filter');

function blog_filter () {

    $params = isset($_POST['params']) && $_POST['params']  ? wp_strip_all_tags($_POST['params']) : "";
    $offset = isset($_POST['offset']) && $_POST['offset']  ? wp_strip_all_tags($_POST['offset']) : "";

    $args =  [
        'posts_per_page'        => 12,
        'post_type'             => 'post',
        'orderby'               => ['date' => 'DESC'],
        'post_status'           => ['publish']
    ];

    if($params) $args['category__in'] = explode('-', $params);
    if($offset) $args['offset'] = $offset;

    $posts = new WP_Query($args);

    if($posts->have_posts()) {

        ob_start();

        while($posts->have_posts()) {
            $posts->the_post();
            get_template_part('template-parts/content', 'post');
        }

        $posts_html = ob_get_clean();

        wp_reset_query();

        wp_send_json([
            'status' => 1,
            'html'   => $posts_html,
            'total' => $posts->found_posts
        ]);
    }

    else {
        wp_send_json([
            'status' => 0,
            'total' => $posts->found_posts
        ]);
    }

    die();
}
