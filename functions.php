<?php 

add_filter( 'show_admin_bar', '__return_false' );

add_theme_support( 'nav_menus' );
add_theme_support( 'post-thumbnails', array( 'page' ) );

register_nav_menu( 'jqm_nav', "Main navigation menu" );

add_action( 'wp_enqueue_scripts', 'jqm_enqueues' );

function jqm_enqueues() {

	if ( is_admin() ) return;
	
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', "http://code.jquery.com/jquery-1.6.1.min.js" );
	wp_enqueue_script( 'jquery-mobile', "http://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.js",
		array( 'jquery' ) );
	wp_enqueue_script( 'mobile-scripts', get_stylesheet_directory_uri().'/lib/mobile-scripts.js',
		array( 'jquery', 'jquery-mobile' ) );
	wp_localize_script( 'mobile-scripts', 'siteData', array( 'siteUrl', home_url() ) );
}

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

