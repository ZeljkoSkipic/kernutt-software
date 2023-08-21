<?php

add_action( 'wp_enqueue_scripts', 'elegant_enqueue_css' );

function elegant_enqueue_css() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

	$cache_buster = date("YmdHi", filemtime( get_stylesheet_directory() . '/main.css'));
	wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/main.css', array(), $cache_buster, 'all' );
    wp_enqueue_script('flickity', get_stylesheet_directory_uri() . "/js/vendor/flickity.js", array('jquery'), "1.0", true);

}




// Our custom post type function
function ks_cpt() {

    register_post_type( 'webinar',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Webinar' ),
                'singular_name' => __( 'Webinar' ),
				'view_item'             => __( 'View Webinar', 'textdomain' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'webinar'),
			'menu_icon'           => 'dashicons-playlist-video',
			'menu_position'       => 5
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'ks_cpt' );

//======================================================================
// Remove Action Scheduled Notice
add_filter( 'action_scheduler_pastdue_actions_check_pre', '__return_false' );
///END HERE
//


// ACF Options Page


if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Site General Settings',
        'menu_title'    => 'Site Settings',
        'menu_slug'     => 'site-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Global Sections',
        'menu_title'    => 'Globals',
        'parent_slug'   => 'site-general-settings',
    ));

}


function my_acf_json_save_point( $path ) {
    return get_stylesheet_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'my_acf_json_save_point' );



function my_acf_json_load_point( $paths ) {
    // Remove the original path (optional).
    unset($paths[0]);

    // Append the new path and return it.
    $paths[] = get_stylesheet_directory() . '/acf-json';

    return $paths;
}
add_filter( 'acf/settings/load_json', 'my_acf_json_load_point' );
