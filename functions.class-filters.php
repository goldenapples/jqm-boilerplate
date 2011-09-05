<?php

/* Filter WordPress's classes, to map more closely to the classes and data
	attributes used by jQuery Mobile */
	
add_filter( 'post_class', 'jqm_post_classes' );

function jqm_post_classes( $classes ) {
	if ( in_array( 'sticky', $classes ) )
		$classes[] = 'ui-bar-e';
		
	return $classes;
}


/* Important to remove inline dimensions from images, so that jQm can size them to fit the page */

add_filter( 'image_send_to_editor', 'remove_image_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}



add_filter( 'nav_menu_css_class', 'jqm_nav_menu_classes' );

function jqm_nav_menu_classes( $classes ) {
	if ( in_array( 'current-menu-item', $classes ) )
		$classes[] = 'ui-btn-active';
		
	return $classes;
}