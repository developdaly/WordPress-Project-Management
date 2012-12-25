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
 * @since Twenty Eleven 1.0
 */

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // marketing_before_content ?>
		
	<div id="task-organization" class="span3">
		
		<div class="well">

			<?php $current_user = wp_get_current_user(); ?>	
			<ul id="task-assignees" class="nav nav-tabs nav-stacked">
				<li><a href="/tasks">Everyone's tasks</a></li>
				<li><a href="<?php echo get_author_posts_url( $current_user->ID ); ?>">Created by you</a></li>
			</ul>
			
			<?php
			$terms = get_terms( 'pm_status' );
			$count = count($terms);
			if ( $count > 0 ){
				echo '<p>Status</p>';
				echo '<ul id="task-statuses" class="nav nav-pills nav-stacked">';
				foreach ( $terms as $term ) {
					echo '<li><a href="'. home_url() .'/?post_type=pm_task&pm_status='. $term->slug .'">' . $term->name . '</a></li>';
				}
				echo '</ul>';
			}

			$terms = get_terms( 'pm_label' );
			$count = count($terms);
			if ( $count > 0 ){
				echo '<p>Label</p>';
				echo '<ul id="task-labels" class="nav nav-pills nav-stacked">';
				foreach ( $terms as $term ) {
					echo '<li><a href="'. home_url() .'/?post_type=pm_task&pm_label='. $term->slug .'">' . $term->name . '</a></li>';
				}
				echo '</ul>';
			}

			$terms = get_terms( 'pm_priority' );
			$count = count($terms);
			if ( $count > 0 ){
				echo '<p>Priority</p>';
				echo '<ul id="task-priorities" class="nav nav-pills nav-stacked">';
				foreach ( $terms as $term ) {
					echo '<li><a href="'. home_url() .'/?post_type=pm_task&pm_priority='. $term->slug .'">' . $term->name . '</a></li>';
				}
				echo '</ul>';
			}			
			?>
	
		</div><!-- .well -->
		
	</div><!-- #task-organization.span3 -->

	<section id="content" role="main" class="span9">

		<?php do_atomic( 'open_content' ); // marketing_open_content ?>

		<div class="hfeed">

			<?php //get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>
		
			<?php if ( have_posts() ) : ?>
		
			<div class="entry-content">
							
				<table class="table table-striped table-compressed">
					
					<thead>
						<tr>
							<th>Title</th>
							<th>Status</th>
							<th>Priority</th>
							<th>Labels</th>
							<th>Assigned To</th>
							<th>Created</th>
							<th>Last Updated</th>
						</tr>
					</thead>
					
					<tbody>
					
					<?php while ( have_posts() ) : the_post(); ?>
		
						<tr id="post-<?php the_ID(); ?>" class="<?php post_class(); ?><?php echo pm_task_classes(); ?>">
							
							<td><a href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a></td>
															
							<td><?php echo get_the_term_list( $post->ID, 'pm_status', '<span class="label task-status">', ', ', '</span>' ); ?></td>
							
							<td><?php echo get_the_term_list( $post->ID, 'pm_priority', '<span class="task-priority">', ', ', '</span>' ); ?></td>
							
							<td><?php echo get_the_term_list( $post->ID, 'pm_label', '<span class="task-label">', ', ', '</span>' ); ?></td>
							
							<td>
								<?php								
								$assigned = get_post_meta( $post->ID, 'pm_task_assign_to' );
								$users = get_users( array( 'include' => $assigned ) );
								echo '<ul class="unstyled">';
								foreach( $users as $user) { 
									echo  '<li><a href="#">'. $user->display_name .'</a></li>';
								}
								echo '</ul>';
								?>
							</td>
							
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
	
		<?php else : ?>
	
			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h2 class="entry-title"><?php _e( 'No tasks found', 'project-management' ); ?></h2>
				</header><!-- .entry-header -->
	
				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
	
		<?php endif; ?>
	
		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // marketing_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</section><!-- #content -->

	<?php do_atomic( 'after_content' ); // marketing_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>