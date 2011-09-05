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

require( 'functions.class-filters.php' );

function jqm_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<a>
			<?php echo get_avatar($comment,$size='80',$default='<path_to_url>' ); ?>
			<h3 class="ul-li-heading"><?php echo $comment->comment_author; ?></h3>
			<?php comment_text(); ?>
			<p class="ul-li-aside"><?php echo $comment->comment_date; ?></p>
		</a>
		<a href="/reply.html" class="ui-li-link-alt ui-btn" data-rel="dialog" title="Reply to this comment" ></a>
		<?php //comment_reply_link( );
}

//add_filter( 'get_avatar', 'jqm_thumb_data_role' );

function jqm_thumb_data_role( $avatar ) {
	return str_replace( 'class="avatar', 'class="ui-li-thumb avatar', $avatar );
}