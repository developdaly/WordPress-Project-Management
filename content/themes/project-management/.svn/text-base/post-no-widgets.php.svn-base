<?php
/**
 * Post Template: No Widgets
 *
 * A post template to use when wanting to disable all widget areas for an individual post.
 *
 * @package Hybrid
 * @subpackage Template
 */

get_header(); // Loads the header.php template. ?>

	<div id="content" class="hfeed content">

		<?php do_atomic( 'before_content' ); // hybrid_before_content ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

				<?php do_atomic( 'before_entry' ); // hybrid_before_entry ?>

				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<p class="page-links pages">' . __( 'Pages:', hybrid_get_parent_textdomain() ), 'after' => '</p>' ) ); ?>
				</div><!-- .entry-content -->

				<?php do_atomic( 'after_entry' ); // hybrid_after_entry ?>

			</div><!-- .hentry -->

			<?php do_atomic( 'after_singular' ); // hybrid_after_singular ?>

			<?php comments_template( '/comments.php', true ); // Loads the comments.php template ?>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

		<?php endif; ?>

		<?php do_atomic( 'after_content' ); // hybrid_after_content ?>

	</div><!-- .content .hfeed -->

<?php get_footer(); // Loads the footer.php template. ?>