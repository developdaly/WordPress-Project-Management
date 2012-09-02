<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

	<div id="content" role="main">

	<?php if ( have_posts() ) : ?>
		
		<div class="entry-content">
						
			<table class="table table-striped table-bordered">
				
				<thead>
					<tr>
						<th>Title</th>
						<th>Status</th>
						<th>Priority</th>
						
						<th>Assigned To</th>
						<th>Created</th>
						<th>Last Updated</th>
					</tr>
				</thead>
				
				<tbody>
				
				<?php while ( have_posts() ) : the_post(); ?>
	
					<tr id="post-<?php the_ID(); ?>" class="<?php post_class(); ?><?php echo pm_task_classes(); ?>">
						
						<td><a href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a></td>
														
						<td><?php echo get_the_term_list( $post->ID, 'pm_statuses', '<span class="label task-status">', ', ', '</span>' ); ?></td>
						
						<td><?php echo get_the_term_list( $post->ID, 'pm_priority', '<span class="task-priority">', ', ', '</span>' ); ?></td>
								
						<td><?php echo get_the_term_list( $post->ID, 'pm_people', '', ', ', '' ); ?></td>
						
						<td><?php echo( '<abbr title="'. get_the_date("l, F jS, Y, g:i a", strtotime( $date )) . '">'. get_the_date("M jS @ g:i a", strtotime( $date )) . '</abbr>' ); ?></td>
						
						<td>
							<?php
							$args = array(
								'post_id' => $post->ID,
								'number' => '1'
							);
							$comments = get_comments($args);
							foreach($comments as $comment) :
								$date = $comment->comment_date;
								echo( '<abbr title="'. date("l, F jS, Y, g:i a", strtotime( $date )) . '">'. date("M jS @ g:i a", strtotime( $date )) . '</abbr>' );
							endforeach;
							?>
						</td>

					</tr>
	
				<?php endwhile; ?>
				
				</tbody>
				
			</table>
		
		</div>

		<?php if ( is_attachment() ) : ?>
	
			<div class="loop-nav">
				<?php previous_post_link( '%link', '<span class="previous left">' . __( '&larr; Return to entry', 'pm_task' ) . '</span>' ); ?>
			</div><!-- .loop-nav -->
	
		<?php elseif ( is_singular( 'post' ) ) : ?>
	
			<div class="loop-nav">
				<?php previous_post_link( '<div class="previous left">' . __( 'Previous Entry: %link', 'pm_task' ) . '</div>', '%title' ); ?>
				<?php next_post_link( '<div class="next right">' . __( 'Next Entry: %link', 'pm_task' ) . '</div>', '%title' ); ?>
			</div><!-- .loop-nav -->
	
		<?php elseif ( !is_singular() && current_theme_supports( 'loop-pagination' ) ) : loop_pagination( array( 'before' => '<div class="pagination pagination-centered">', 'type' => 'list' ) ); ?>
	
		<?php elseif ( !is_singular() && $nav = get_posts_nav_link( array( 'sep' => '', 'prelabel' => '<span class="previous left">' . __( '&larr; Previous', 'pm_task' ) . '</span>', 'nxtlabel' => '<span class="next right">' . __( 'Next &rarr;', 'pm_task' ) . '</span>' ) ) ) : ?>
	
			<div class="loop-nav">
				<?php echo $nav; ?>
			</div><!-- .loop-nav -->
	
		<?php endif; ?>

	<?php else : ?>

		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-0 -->

	<?php endif; ?>

	</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>