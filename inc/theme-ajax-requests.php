<?php
// Posts load more

add_action('wp_ajax_posts_load_more', 'posts_load_more');
add_action('wp_ajax_nopriv_posts_load_more', 'posts_load_more');

function posts_load_more()
{

    if (!wp_verify_nonce($_POST['nonce'], 'ajax-call-token')) {
        die('Nonce key is invalid!');
    }

    $offset = (isset($_POST['offset']) && $_POST['offset'] ? (int) wp_strip_all_tags($_POST['offset']) : "");
    $user = (isset($_POST['user']) && $_POST['user'] ? wp_strip_all_tags($_POST['user']) : "");
    $category = (isset($_POST['cat']) && $_POST['cat'] ? wp_strip_all_tags($_POST['cat']) : "");

    if ($offset) {

        if ($user) {
            $author_posts = new WP_Query(array(
                'post_type'         => 'post',
                'posts_per_page'    => 4,
                'offset'            => $offset,
                'author_name'         => get_the_author_meta('user_nicename', $user),
                'orderby'           => 'date',
                'order'             => "DESC",
            ));

            if ($author_posts->have_posts()) {

                ob_start();
                foreach ($author_posts->posts as $author_post) {

                    global $post;
                    $post = $author_post;
                    setup_postdata($post);
                    get_template_part('template-parts/author', 'posts');
                }

                wp_reset_postdata();

                echo ob_get_clean();
            }
        } elseif ($category) {

            $posts = get_posts([
                'posts_per_page' => 4,
                'offset'            => $offset,
                'post_type'     => 'post',
                'orderby'       => 'date',
                'order'         => 'DESC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'post_id',
                        'terms'    => $category,
                    ),
                ),
            ]);

            if ($posts) {

                ob_start();
                foreach ($posts as $post_single) {

                    global $post;
                    $post = $post_single;
                    setup_postdata($post);
                    get_template_part('template-parts/content', 'recent-post');
                }

                wp_reset_postdata();

                echo ob_get_clean();
            }
        }
    }

    die();
}

// Posts Filter

add_action('wp_ajax_posts_filter', 'posts_posts_filter');
add_action('wp_ajax_nopriv_posts_filter', 'posts_posts_filter');

function posts_posts_filter()
{

    if (!wp_verify_nonce($_POST['nonce'], 'ajax-call-token')) {
        die('Nonce key is invalid!');
    }

    $categories = (isset($_POST['categories']) && $_POST['categories'] ? wp_strip_all_tags($_POST['categories']) : "");
    $offset = (isset($_POST['offset']) && $_POST['offset'] ? wp_strip_all_tags($_POST['offset']) : "");
    $categories_children = (isset($_POST['categoriesChildren']) && $_POST['categoriesChildren'] ? wp_strip_all_tags($_POST['categoriesChildren']) : "");

    // Media Type Category

    $media_type_cat = get_term_by('slug', 'media-type', 'category');
    (int)  $media_type_ID = $media_type_cat ?  $media_type_cat->term_id : "";

    if ($categories || $categories_children) {


        $args = [
            'post_type'         => 'post',
            'posts_per_page'    =>  12,
            'orderby'           => 'date',
            'order'             => 'DESC',
            'post_status'       => 'publish'
        ];

        // Add parents to query

        if($categories || $media_type_ID) {

            $categories = explode(',', $categories);

            array_push($categories, $media_type_ID);

            $categories = array_filter($categories, function($term) {
                return $term;
            });

            $categories = array_values($categories);

            $args['tax_query'] [] = [
                'taxonomy' => 'category',
                'field'    => 'post_id',
                'terms'    => $categories,
            ];
        }

        // Add Children to query

        if($categories_children) {

            $categories_children = explode(',', $categories_children);

            $args['tax_query'] [] = [
                'taxonomy' => 'category',
                'field'    => 'post_id',
                'terms'    => $categories_children,
            ];
        }

        if(count($args['tax_query']) > 1) {
            $args['tax_query']['relation'] = "AND";
        }

        // Add offset for pagination

        $offset ? $args['offset'] =  $offset : "";

        $offset ? $load_more = true :  $load_more = false;

        $posts = new WP_Query ($args);

        if ($posts->have_posts()) {
            ob_start();
            while ($posts->have_posts()) {
                $posts->the_post();
                get_template_part('template-parts/content', 'post');
            }

            wp_reset_query();

            $posts_html = ob_get_clean();

            // Find Child Categories

            $child_categories = [];

            foreach ($categories as $category) {
                $get_children = get_term_children($category, 'category');

                if ($get_children) {
                    foreach ($get_children as $child) {
                        $child_object = get_term($child, 'category');

                        if ($child_object) {
                            $child_categories[$category] [] = $child_object;
                        }
                    }
                }
            }


            // Delete empty terms

            if ($child_categories) {

                foreach($child_categories as $key => $child_cat_array) {
                    $child_cat_array = array_filter($child_cat_array, function ($child_term) {
                        return $child_term->count !== 0;
                    });

                    $child_categories[$key] = $child_cat_array;
                }
            }

            // Sort By Name

            if($child_categories) {
                foreach($child_categories as $key => $child_cat_array) {
                    usort($child_cat_array, function($a, $b) {return strcmp($b->name, $a->name);});
                    $child_categories[$key] = $child_cat_array;
                }

            }

            $response = [
                'posts_html'        =>  $posts_html,
                'child_categories'  =>  $child_categories,
                'load_more'         =>  $load_more,
                'total'             =>  $posts->found_posts
            ];

            wp_send_json($response, 200);
        }
        else {

            $response = [
                'posts_html'        =>  [],
                'child_categories'  =>  [],
                'load_more'         =>  $load_more,
                'total'             =>  $posts->found_posts
            ];

            wp_send_json($response, 200);
        }

    } else {

        $args = [
            'post_type'     => 'post',
            'posts_per_page' => 12,
            'orderby'       => 'date',
            'order'         => 'DESC',
            'post_status' => 'publish',
            'tax_query'     => [
                [
                    'taxonomy' => 'category',
                    'field'    => 'post_id',
                    'terms'    => [$media_type_ID]
                ]
            ]
        ];

        // Add offset for pagination

        $offset ? $args['offset'] =  $offset  : "";

        $offset ? $load_more = true :  $load_more = false;

        $posts = new WP_Query($args);

        if ($posts->have_posts()) {
            ob_start();
            while ($posts->have_posts()) {
                $posts->the_post();
                get_template_part('template-parts/content', 'post');
            }

            wp_reset_query();

            $posts_html = ob_get_clean();

            $response = [
                'posts_html'        =>  $posts_html,
                'child_categories'  =>  [],
                'load_more'         =>  $load_more,
                'total'             =>  $posts->found_posts,
                'offset'            =>  $offset
            ];

            wp_send_json($response, 200);
        }

        else {

            $response = [
                'posts_html'        =>  [],
                'child_categories'  =>  [],
                'load_more'         =>  $load_more,
                'total'             =>  $posts->found_posts
            ];

            wp_send_json($response, 200);

        }
    }
}
