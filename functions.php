<?php

add_action( 'wp_enqueue_scripts', 'elegant_enqueue_css' );

function elegant_enqueue_css() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

	$cache_buster = date("YmdHi", filemtime( get_stylesheet_directory() . '/main.css'));
	wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/main.css', array(), $cache_buster, 'all' );
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
