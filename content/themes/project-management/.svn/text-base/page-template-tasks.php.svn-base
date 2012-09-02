<?php
/**
 * Template Name: Tasks
 *
 * Displays all tasks.
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

	<section id="content" role="main" class="span12">

		<?php do_atomic( 'open_content' ); // marketing_open_content ?>

		<div class="hfeed">

			<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>
				
			<?php query_posts( array( 'post_type' => array( 'pm_task' ), 'paged' => get_query_var('paged') ) ); ?>
			
			<?php if ( have_posts() ) : ?>
							
				<table class="table">
					
					<thead>
						<tr>
							<th>User Story</th>
							<th>Status</th>
							<th>Title</th>
							<th>Assigned To</th>
							<th>Created</th>
							<th>Last Updated</th>
						</tr>
					</thead>
					
					<tbody>
					
					<?php while ( have_posts() ) : the_post(); ?>
	
						<?php do_atomic( 'before_entry' ); // marketing_before_entry ?>
	
						<tr id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?> <?php echo pm_status_classes(); ?>">
	
							<?php do_atomic( 'open_entry' ); // marketing_open_entry ?>
							
							<td>
							<?php 
							$user_story = get_post_meta( $post->ID, 'pm_user_story', true );
							$user_story_link = get_post_meta( $post->ID, 'pm_user_story_link', true );
							
							if( $user_story_link && $user_story ) echo '<a href="'. $user_story_link .'" class="user-story">';
							if( $user_story ) echo 'US'. $user_story;
							if( $user_story_link && $user_story ) echo '</a>';
							?>
							</td>
							
							<?php echo get_the_term_list( $post->ID, 'pm_statuses', '<td><span class="task-status">', ', ', '</span></td>' ); ?>
							
							<?php echo apply_atomic_shortcode( 'entry_title', '<td>[entry-title]</td>' ); ?>
	
							<?php echo get_the_term_list( $post->ID, 'pm_people', '<td>', ', ', '</td>' ); ?>
							
							<?php echo apply_atomic_shortcode( 'byline', '' . __( '<td>[entry-published]</td>', hybrid_get_parent_textdomain() ) .'' ); ?>
							
							<td>
								<?php
								$args = array(
									'number' => '1'
								);
								$comments = get_comments($args);
								foreach($comments as $comment) :
									$date = $comment->comment_date;
									echo( '<abbr title="'. date("l, F jS, Y, g:i a", strtotime( $date )) . '">'. date("F j, g:i a", strtotime( $date )) .'</abbr> by ' . $comment->comment_author );
								endforeach;
								?>
							</td>

						</tr>
	
						<?php do_atomic( 'after_entry' ); // marketing_after_entry ?>
	
					<?php endwhile; ?>
					
					</tbody>
					
				</table>

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // marketing_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</section><!-- #content -->

	<?php do_atomic( 'after_content' ); // marketing_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>