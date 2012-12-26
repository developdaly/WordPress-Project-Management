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

		<p><a href="<?php echo home_url(); ?>/new-task/" class="btn btn-block">New task</a></p>
	
		<?php $current_user = wp_get_current_user(); ?>	
		<ul id="task-assignees" class="nav nav-tabs nav-stacked">
			<li><a href="/tasks">My tasks</a></li>
			<li><a href="/tasks">Everyone's tasks</a></li>
			<li><a href="<?php echo get_author_posts_url( $current_user->ID ); ?>">Created by you</a></li>
		</ul>

		<div class="well" style="padding: 8px 0;">
			<ul class="nav nav-list">
	            		
			<?php
			$terms = get_terms( 'pm_status' );
			$count = count($terms);
			if ( $count > 0 ){
				echo '<li class="nav-header">Status</li>';
				foreach ( $terms as $term ) {
					echo '<li><a href="'. home_url() .'/?post_type=pm_task&pm_status='. $term->slug .'">' . $term->name . '</a></li>';
				}
			}
	
			$terms = get_terms( 'pm_label' );
			$count = count($terms);
			if ( $count > 0 ){
				echo '<li class="nav-header">Label</li>';
				foreach ( $terms as $term ) {
					echo '<li><a href="'. home_url() .'/?post_type=pm_task&pm_label='. $term->slug .'">' . $term->name . '</a></li>';
				}
			}
	
			$terms = get_terms( 'pm_priority' );
			$count = count($terms);
			if ( $count > 0 ){
				echo '<li class="nav-header">Priority</li>';
				foreach ( $terms as $term ) {
					echo '<li><a href="'. home_url() .'/?post_type=pm_task&pm_priority='. $term->slug .'">' . $term->name . '</a></li>';
				}
			}			
			?>
			</ul>
		</div>
		
	</div><!-- #task-organization.span3 -->

	<section id="content" role="main" class="span9">

		<?php do_atomic( 'open_content' ); // marketing_open_content ?>

		<div class="hfeed">

			<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>
		
			<?php if ( have_posts() ) : ?>
		
			<div class="entry-content">

				<ul>
					<?php if( ( get_query_var( 'order' ) == 'DESC' ) && ( get_query_var( 'orderby' ) == 'date' ) ): ?>
						<li><a href="<?php echo add_query_arg( array( 'orderby' => 'date', 'order' => 'ASC' ) ); ?>">Submitted <small>&#x25B2;</small></a></li>
					<?php elseif( ( get_query_var( 'order' ) == 'ASC' ) && ( get_query_var( 'orderby' ) == 'date' ) ): ?>
						<li><a href="<?php echo add_query_arg( array( 'orderby' => 'date', 'order' => 'DESC' ) ); ?>">Submitted <small>&#x25BC;</small></a></li>
					<?php else: ?>
						<li><a href="<?php echo add_query_arg( array( 'orderby' => 'date', 'order' => 'DESC' ) ); ?>">Submitted</a></li>
					<?php endif; ?>

					<?php if( ( get_query_var( 'order' ) == 'DESC' ) && ( get_query_var( 'orderby' ) == 'modified' ) ): ?>
						<li><a href="<?php echo add_query_arg( array( 'orderby' => 'modified', 'order' => 'ASC' ) ); ?>">Updated <small>&#x25B2;</small></a></li>
					<?php elseif( ( get_query_var( 'order' ) == 'ASC' ) && ( get_query_var( 'orderby' ) == 'modified' ) ): ?>
						<li><a href="<?php echo add_query_arg( array( 'orderby' => 'modified', 'order' => 'DESC' ) ); ?>">Updated <small>&#x25BC;</small></a></li>
					<?php else: ?>
						<li><a href="<?php echo add_query_arg( array( 'orderby' => 'modified', 'order' => 'DESC' ) ); ?>">Updated</a></li>
					<?php endif; ?>
				</ul>
				
				<table id="table-tasks" class="table table-striped">
					
					<tbody>
					
					<?php while ( have_posts() ) : the_post(); ?>
		
						<tr id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<td><?php echo get_the_term_list( $post->ID, 'pm_status', '<span class="label task-status">', ', ', '</span>' ); ?></td>
							
							<td>
								<strong><a href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a></strong><br>
								<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( 'by [entry-author] on [entry-published]', hybrid_get_parent_textdomain() ) . '</div>' ); ?>
							</td>							
							
							<td><?php echo get_the_term_list( $post->ID, 'pm_priority', '<span class="task-priority">', ', ', '</span>' ); ?></td>
							
							<td><?php echo get_the_term_list( $post->ID, 'pm_label', '<span class="task-label">', ', ', '</span>' ); ?></td>

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