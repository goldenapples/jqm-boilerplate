<?php
/**
 * 
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>
		<ul data-role="listview">

			<?php while ( have_posts() ) : the_post(); ?>
				<li>
					<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) the_post_thumbnail(); ?>
						<h2><?php the_title(); ?></h2>
						<p><?php the_excerpt(); ?></p>
					</a>
				</li>

			<?php endwhile; ?>
		</ul>

	<?php endif; ?>

<?php get_footer(); ?>