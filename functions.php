<?php 

add_filter( 'show_admin_bar', '__return_false' );

add_theme_support( 'nav_menus' );
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 80, 80, true );

register_nav_menu( 'jqm_nav', "Main navigation menu", "Top navigation menu - Single level only, works best with up to five elements (otherwise it wraps onto multiple rows)" );

register_nav_menu( 'jqm_footernav', "Footer navigation menu", "Footer navigation menu - Single level only, works best with up to five elements (otherwise it wraps onto multiple rows)" );

add_action( 'wp_enqueue_scripts', 'jqm_enqueues' );

function jqm_enqueues() {

	if ( is_admin() ) return;
	
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', "http://code.jquery.com/jquery-1.6.2.min.js" );
	wp_enqueue_script( 'jquery-mobile', "http://code.jquery.com/mobile/latest/jquery.mobile.min.js",
		array( 'jquery' ) );
	wp_enqueue_script( 'mobile-scripts', get_stylesheet_directory_uri().'/lib/mobile-scripts.js',
		array( 'jquery', 'jquery-mobile' ) );
	wp_localize_script( 'mobile-scripts', 'siteData', array( 'siteUrl', home_url() ) );
	wp_enqueue_style( 'jquery-mobile', "http://code.jquery.com/mobile/latest/jquery.mobile.min.css" );
}


/*
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
*/
