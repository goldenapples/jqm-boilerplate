<?php
/**
 * 
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<div <?php post_class(); ?>>
			<a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
			<div class="post-content"><?php the_content(); ?></div>

		<?php comments_template(); ?>
		</div>
	<?php endwhile; ?>

	<?php endif; ?>

<?php get_footer(); ?>