<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

</head>

<body>
<div data-role="page" class="hfeed">
	
	<div data-role="header">
	
			<h1 id="sitehead"><?php bloginfo('title'); ?></h1>
			
			<a href="<?php bloginfo('home'); ?>" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-left jqm-home">Home</a>
			
			<?php global $posts; if ( $posts[0]->post_parent > 0 ) { ?>
				<a href="<?php echo get_permalink( $posts[0]->post_parent ); ?>" data-icon="back" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-back">Back</a>
			<?php } ?>
			
		<div data-role="navbar">
			<?php wp_nav_menu( array( 
				'theme_location' => 'jqm_nav',
				'container' => '',
				'depth' => 1,
				'items_wrap' => '<ul id="%1$s" class="main-nav" data-theme="a">%3$s</ul>'
					) ); ?>
		</div>

	</div><!-- data-role="header" -->

	<div data-role="content">
	
		<?php if (is_page_template('page-directions.php')) { ?>
			<div id="map-canvas" style="height: 100%; width: 100%; position: absolute;"></div>
		<?php } ?>