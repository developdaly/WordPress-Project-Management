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

get_header();
 // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // marketing_before_content ?>
		
	<div id="task-organization" class="sidebar span3">

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
				
				<div class="task-controls">
	
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#">Open Tasks</a>
						</li>
						<li>
							<a href="#">Closed Tasks</a>
						</li>
					</ul>

					<div class="btn-group pull-right">
						<?php if( ( get_query_var( 'order' ) == 'DESC' ) && ( get_query_var( 'orderby' ) == 'date' ) ): ?>
							<a class="btn btn-mini active" href="<?php echo add_query_arg( array( 'orderby' => 'date', 'order' => 'ASC' ) ); ?>">Submitted <span class="caret"></span></a>
						<?php elseif( ( get_query_var( 'order' ) == 'ASC' ) && ( get_query_var( 'orderby' ) == 'date' ) ): ?>
							<a class="btn btn-mini dropup active" href="<?php echo add_query_arg( array( 'orderby' => 'date', 'order' => 'DESC' ) ); ?>">Submitted <span class="caret"></span></a>
						<?php else: ?>
							<a class="btn btn-mini" href="<?php echo add_query_arg( array( 'orderby' => 'date', 'order' => 'DESC' ) ); ?>">Submitted</a>
						<?php endif; ?>
						
						<?php if( ( get_query_var( 'order' ) == 'DESC' ) && ( get_query_var( 'orderby' ) == 'modified' ) ): ?>
							<a class="btn btn-mini active" href="<?php echo add_query_arg( array( 'orderby' => 'modified', 'order' => 'ASC' ) ); ?>">Updated <span class="caret"></span></a>
						<?php elseif( ( get_query_var( 'order' ) == 'ASC' ) && ( get_query_var( 'orderby' ) == 'modified' ) ): ?>
							<a class="btn btn-mini dropup active" href="<?php echo add_query_arg( array( 'orderby' => 'modified', 'order' => 'DESC' ) ); ?>">Updated <span class="caret"></span></a>
						<?php else: ?>
							<a class="btn btn-mini" href="<?php echo add_query_arg( array( 'orderby' => 'modified', 'order' => 'DESC' ) ); ?>">Updated</a>
						<?php endif; ?>
					</div>
				
				</div><!-- .task-controls -->
				
				<div id="tasks-list">
										
					<?php while ( have_posts() ) : the_post(); ?>
		
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<?php if ( get_post_meta( get_the_ID(), 'pm_task_assign_to', true) ) :
								$user_id = get_post_meta( get_the_ID(), 'pm_task_assign_to', true );
								$user = get_userdata( $user_id );
								if( $user )
									echo get_avatar( $user->ID, 25, '', $user->display_name );
							endif; ?>
							
							<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
							<?php echo apply_atomic_shortcode( 'byline', '<span class="byline">' . __( 'by [entry-author] on [entry-published]', hybrid_get_parent_textdomain() ) . '</span>' ); ?><br>
							<?php echo get_the_term_list( get_the_ID(), 'pm_priority', ' <span class="label-priority">', ', ', '</span>' ); ?>
							<?php echo get_the_term_list( get_the_ID(), 'pm_status', '<span class="label-status">', ', ', '</span>' ); ?>

						</div>
		
					<?php endwhile; ?>
										
				</div><!-- #tasks-list -->
			
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