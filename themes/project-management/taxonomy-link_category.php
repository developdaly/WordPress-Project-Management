<?php
/**
 * Link Category Taxonomy Template
 *
 * This template is used when a link category is shown.  Individual link categories can also have
 * their own templates using taxonomy-link_category-$term.php.
 *
 * @package Hybrid
 * @subpackage Template
 */

get_header(); // Loads the header.php template. ?>

	<div id="content" class="hfeed content">

		<?php do_atomic( 'before_content' ); // hybrid_before_content ?>

		<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>

		<div class="<?php hybrid_entry_class(); ?>">

			<?php do_atomic( 'before_entry' ); // hybrid_before_entry ?>

			<div class="entry-content">

				<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

				$args = array(
					'title_li' => false,
					'title_before' => false,
					'title_after' => false,
					'category_name' => $term->name,
					'category_before' => false,
					'category_after' => false,
					'categorize' => false,
					'show_description' => true,
					'between' => '<br />',
					'show_images' => false,
					'show_rating' => false,
				); ?>
				<ul class="xoxo bookmarks">
					<?php wp_list_bookmarks( $args ); ?>
				</ul><!-- .xoxo .bookmarks -->

			</div><!-- .entry-content -->

			<?php do_atomic( 'after_entry' ); // hybrid_after_entry ?>

		</div><!-- .hentry -->

		<?php do_atomic( 'after_content' ); // hybrid_after_content ?>

	</div><!-- .content .hfeed -->

<?php get_footer(); // Loads the footer.php template. ?>