<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

</div><!-- data-role="content" -->

<div data-role="footer">
	<div data-role="navbar">
		<?php wp_nav_menu( array( 
				'theme_location' => 'jqm_footernav',
				'container' => '',
				'depth' => 1,
				'items_wrap' => '<ul id="%1$s" class="main-nav" data-theme="a">%3$s</ul>'
					) ); ?>
	</div>
	<h6>Copyright &copy;<?php echo date('Y'); ?> <?php bloginfo('name'); ?></h6>
</div><!-- data-role="footer" -->

</div><!-- data-role="page" -->

<?php wp_footer(); ?>

</body>
</html>