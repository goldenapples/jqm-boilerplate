<?php
/**
 * 
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>
		<ul data-role="listview">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php if ( is_new_day() && ( !is_sticky() ) ) { ?>
				<li data-role="list-divider">
					<?php the_date(); ?>
				</li>
				<?php } ?>
				<li <?php post_class(); ?> >
					<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) the_post_thumbnail(); ?>
						<h2><?php the_title(); ?></h2>
						<p><?php the_excerpt(); ?></p>
						<?php if ( have_comments() ) { ?>
							<span class="ul-li-count"><?php comments_number( '', '%' ); ?></span>
						<?php } ?>
					</a>
				</li>

			<?php endwhile; ?>
		</ul>

	<?php endif; ?>

<?php get_footer(); ?>