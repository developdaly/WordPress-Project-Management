<?php
/**
 * Primary Sidebar Template
 *
 * Displays widgets for the Primary dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user.  Otherwise, nothing is displayed.
 *
 * @package Marketing
 * @subpackage Template
 */

if ( 'pm_task' == get_post_type() ) : ?>

<aside id="sidebar-task" class="span3">
															
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
		<li><a href="<?php echo bloginfo( 'url' ); ?>/tasks/"><i class="icon-arrow-left"></i> Back to all tasks</a></li>
		<li><a href="<?php echo bloginfo( 'url' ); ?>/new-task/"><i class="icon-plus"></i> New Task</a></li>
	</ul>
	
</aside>

<?php endif; ?>