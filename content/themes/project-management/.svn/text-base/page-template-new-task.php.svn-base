<?php
/**
 * Template Name: New Task
 *
 * This is the default page template.  It is used when a more specific template can't be found to display 
 * singular views of pages.
 *
 * @package Marketing
 * @subpackage Template
 */

add_filter( 'sidebars_widgets', 'pm_task_sidebars' );

 /**
 * Disables the primary sidebar
 *
 * @since 0.1
 */
function pm_task_sidebars( $sidebars_widgets ) {
	$sidebars_widgets['primary'] = false;
	
	return $sidebars_widgets;
}

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // marketing_before_content ?>

	<section id="content" role="main" class="span10">

		<?php do_atomic( 'open_content' ); // marketing_open_content ?>

		<div class="hfeed">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // marketing_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // marketing_open_entry ?>

						<?php if ( !is_front_page() ) echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>

						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', hybrid_get_parent_textdomain() ) ); ?>
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', hybrid_get_parent_textdomain() ), 'after' => '</p>' ) ); ?>
						</div><!-- .entry-content -->

						<?php do_atomic( 'close_entry' ); // marketing_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // marketing_after_entry ?>

					<?php get_sidebar( 'after-singular' ); // Loads the sidebar-after-singular.php template. ?>

					<?php do_atomic( 'after_singular' ); // marketing_after_singular ?>

					<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // marketing_close_content ?>

	</section><!-- #content -->

	<div class="span2">

		<div class="well" style="padding: 8px 0;">
			<ul class="nav nav-list">
				<li class="nav-header">Tasks</li>
				<li><a href="<?php echo bloginfo( 'home' ); ?>/tasks/">All tasks</a></li>
				<li class="active"><a href="<?php echo bloginfo( 'home' ); ?>/new-task/"><i class="icon-plus-sign icon-white"></i> New task</a></li>
			</ul>
		</div>

		<div class="well" style="padding: 8px 0;">
		<?php the_widget( 'Taxonomy_Drill_Down_Widget', array(
			'title' => '',
			'mode' => 'lists',
			'taxonomies' => array( 'pm_people', 'pm_statuses' )
			) ); ?>
					
		</div>
				
	</div>
	
	<?php do_atomic( 'after_content' ); // marketing_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>