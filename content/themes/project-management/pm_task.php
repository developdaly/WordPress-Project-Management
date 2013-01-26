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
global $post;
if ($_FILES) {
  foreach ($_FILES as $file => $array) {
    $newupload = insert_attachment($file,$post->ID);
    // $newupload returns the attachment id of the file that
    // was just uploaded. Do whatever you want with that now.
  }
}

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // marketing_before_content ?>

	<div class="span12">
		<?php $current_user = wp_get_current_user(); ?>
		<div class="btn-group">
			<a href="<?php echo home_url(); ?>/new-task/" class="btn btn-primary"><i class="icon-plus icon-white"></i> New task</a>
			<a href="/tasks" class="btn">My tasks</a></li>
			<a href="/tasks" class="btn">Everyone's tasks</a></li>
			<a href="<?php echo get_author_posts_url( $current_user->ID ); ?>" class="btn">Created by you</a></li>
		</div>
	</div>
		
	<section id="content" role="main" class="span6">

		<?php do_atomic( 'open_content' ); // marketing_open_content ?>
				
		<div class="hfeed">
			
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // marketing_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>" data-spy="affix" data-offset-top="54">
		
						<?php do_atomic( 'open_entry' ); // marketing_open_entry ?>
							
						<div class="task-header">

							<?php if ( get_post_meta( get_the_ID(), 'pm_task_assign_to', true) ) :
								$user_id = get_post_meta( get_the_ID(), 'pm_task_assign_to', true );
								$user = get_userdata( $user_id );
								if( $user )
									echo get_avatar( $user->ID, 50, '', $user->display_name );
							endif; ?>
														
							<?php 
							$user_story = get_post_meta( $post->ID, 'pm_user_story', true );
							$user_story_link = get_post_meta( $post->ID, 'pm_user_story_link', true );
							
							if( $user_story_link && $user_story ) echo '<a href="'. $user_story_link .'" class="user-story" target="_blank">';
							if( $user_story ) echo $user_story;
							if( $user_story_link && $user_story ) echo '</a>';
							?>
							
							<h1><?php echo the_title_attribute(); ?></h1>
							
							<p class="byline">
								<?php
								echo apply_atomic_shortcode( 'byline', '' . __( 'Created by [entry-author] | [entry-published]', hybrid_get_parent_textdomain() ) .'' );
	
								$args = array(
									'post_id' => $post->ID,
									'number' => '1'
								);
								$comments = get_comments($args);
								foreach($comments as $comment) :
									$date = $comment->comment_date;
									echo( ' | Last modified by <span rel="tooltip" title="'. date("g:i a",strtotime( $date )) .' at '. date("F j, Y",strtotime( $date )) . '">' . $comment->comment_author . '</span>' );
								endforeach;
								?>
							</p>
														
							<?php echo get_the_term_list( get_the_ID(), 'pm_priority', ' <span class="label-priority">', ', ', '</span>' ); ?>
							<?php echo get_the_term_list( get_the_ID(), 'pm_status', '<span class="label-status">', ', ', '</span>' ); ?>

						</div><!-- .task-header -->
						
						<div id="task-main">
							
							<div class="entry-content">
															
								<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', hybrid_get_parent_textdomain() ) ); ?>
								<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', hybrid_get_parent_textdomain() ), 'after' => '</p>' ) ); ?>
								
								<?php $pm_file = get_post_meta( $post->ID, 'pm_file', true ); if ( $pm_file ) echo '<a href="'. $pm_file .'" class="btn">Download Attachment</a>'; ?>
						
							</div><!-- .entry-content -->
							
						</div><!-- .span8 -->
						
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
		
	<aside id="sidebar-task" class="sidebar span6">
		
		<form id="assign-user" class="form-horizontal" action="" method="post" enctype="multipart/form-data">

			<div id="pm-response"></div>
		
			<p><select class="chzn-select" data-placeholder="Assign someone to the task"></p>';
			<?php
			$users = get_users();
				echo '<option></option>';			
			foreach( $users as $user) { 
				echo '<option name="pmassignto" id="pmassignto" value="'. $user->ID .'">'. $user->display_name .'</option>';
			}
			?>
			</select></p>
			
			<p><button type="button" data-loading-text="Loading..." class="btn btn-primary" onclick="pmassignuser(pmassignto);">Assign Task</button></p>
			<div id="loading" class="hide">loading</div>
					
		</form>
		
		<?php comments_template( '/comments-pm_task.php', true ); // Loads the comments.php template. ?>
	</div>
	
	<?php do_atomic( 'after_content' ); // marketing_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>