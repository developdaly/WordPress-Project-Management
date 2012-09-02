<?php
/**
 * Post Template
 *
 * This is the default post template.  It is used when a more specific template can't be found to display
 * singular views of the 'post' post type.
 *
 * @package Marketing
 * @subpackage Template
 */
if ($_FILES) {
  foreach ($_FILES as $file => $array) {
    $newupload = insert_attachment($file,$post->ID);
    // $newupload returns the attachment id of the file that
    // was just uploaded. Do whatever you want with that now.
  }
}
 
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

			<ul class="nav nav-pills">
				<li><a href="<?php echo bloginfo( 'home' ); ?>/tasks/">&larr; All Tasks</a></li>
				<li class="active pull-right"><a href="<?php echo bloginfo( 'home' ); ?>/new-task/"><i class="icon-plus-sign icon-white"></i> New Task</a></li>
			</ul>
			
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // marketing_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?> <?php echo pm_task_classes(); ?>">

						<?php do_atomic( 'open_entry' ); // marketing_open_entry ?>
						
						<div class="row-fluid">
	
							<div class="task-header span12">
								
								<?php 
								$user_story = get_post_meta( $post->ID, 'pm_user_story', true );
								$user_story_link = get_post_meta( $post->ID, 'pm_user_story_link', true );
								
								if( $user_story_link && $user_story ) echo '<a href="'. $user_story_link .'" class="user-story" target="_blank">';
								if( $user_story ) echo $user_story;
								if( $user_story_link && $user_story ) echo '</a>';
								?>
								
								<?php echo get_the_term_list( $post->ID, 'pm_statuses', '<span class="task-status">', ', ', '</span>' ); ?>
								
								<h1><?php echo the_title_attribute(); ?></h1>
										
							</div>
							
						</div>
			
						<div class="row-fluid">
							
							<div id="task-main" class="span8">
								
								<div class="entry-content">
								
									<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', hybrid_get_parent_textdomain() ) ); ?>
									<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', hybrid_get_parent_textdomain() ), 'after' => '</p>' ) ); ?>
									
									<?php $pm_file = get_post_meta( $post->ID, 'pm_file', true ); if ( $pm_file ) echo '<a href="'. $pm_file .'" class="btn">Download Attachment</a>'; ?>
							
								</div><!-- .entry-content -->
								
								<?php comments_template( '/comments-pm_task.php', true ); // Loads the comments.php template. ?>
								
							</div><!-- .span8 -->
							
							<aside id="sidebar-task" class="span4">
															
								<ul class="task-meta">
									
									<li><?php echo get_the_term_list( $post->ID, 'pm_people', '<strong>', ', ', '</strong>' ); ?><?php echo apply_atomic_shortcode( 'byline', '' . __( ' by [entry-author]', hybrid_get_parent_textdomain() ) .'' ); ?></li>
									<li><strong><?php echo apply_atomic_shortcode( 'byline', '' . __( 'Created on [entry-published]', hybrid_get_parent_textdomain() ) .'' ); ?></strong></li>	
									<li><?php echo get_the_term_list( $post->ID, 'pm_priority', '<strong>Priority: ', ', ', '</strong>' ); ?></li>																
									<?php
									$args = array(
										'post_id' => $post->ID,
										'number' => '1'
									);
									$comments = get_comments($args);
									if ( $comments ) echo '<li>';
									foreach($comments as $comment) :
										$date = $comment->comment_date;
										echo( '<strong>Updated '. date("F j, Y",strtotime( $date )) . '</strong> at <strong>'. date("g:i a",strtotime( $date )) . '</strong><br />by ' . $comment->comment_author );
									endforeach;
									if ( $comments ) echo '</li>';
									?>
									<?php if (class_exists('wp_subscribe_reloaded')) { ?>
									<li>
										<strong>People to notify of updates...</strong>
										<?php
	 									$subscribers = $wp_subscribe_reloaded->get_subscriptions(array('post_id'), array('equals'), array($post->ID), 'dt', 'DESC', 0 );
										
										if ( $subscribers ) {
											echo '<ul class="task-subscribers">';
											foreach ( $subscribers as $subscriber ) {
												echo '<li><a href="mailto:'. $subscriber->email .'">'. $subscriber->email .'</a></li>';
											}
											echo '</ul>';
										}
										
										?>
										<form action="" method="post" id="update_address_form" class="form-inline" onsubmit="if (this.srp.value == '' || this.sre.value == '') return false;">
											<input type="text" size="30" name="sre" value="">
											<input type="submit" class="subscribe-form-button" value="Add">
											<input type="hidden" name="srp" value="<?php echo $post->ID; ?>">
											<input type="hidden" name="srs" value="Y" />
											<input type="hidden" name="sra" value="add">
										</form>
									</li>
									<?php } ?>
								</ul>
																						
								<ul class="unstyled">
									<li><a href="<?php echo bloginfo( 'home' ); ?>/tasks/"><i class="icon-arrow-left"></i> Back to all tasks</a></li>
									<li><a href="<?php echo bloginfo( 'home' ); ?>/new-task/"><i class="icon-plus"></i> New Task</a></li>
								</ul>
								
							</aside>
						
						</div>

						<?php do_atomic( 'close_entry' ); // marketing_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // marketing_after_entry ?>

					<?php get_sidebar( 'after-singular' ); // Loads the sidebar-after-singular.php template. ?>

					<?php do_atomic( 'after_singular' ); // marketing_after_singular ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // marketing_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</section><!-- #content -->
	
	<?php do_atomic( 'after_content' ); // marketing_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>