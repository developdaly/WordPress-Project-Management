<?php

function pm_comment_before_fields() {
	global $post;
	
	if ( 'pm_task' != get_post_type() )
		return;
	?>
	
<div class="form-horizontal">

	<div id="task-status-steps" class="control-group">
		<label class="control-label" for="cat">Status</label>
		<div class="controls">
		<?php
			$statuses = get_the_terms( $post->ID, 'pm_status' );			
			if ( $statuses && ! is_wp_error( $statuses ) ) :
				
				$selected_statuses = array();
			
				foreach ( $statuses as $category ) {
					$selected_statuses[] = $category->term_id;
				}

				$selected_statuses = join( ", ", $selected_statuses );
			
			endif;
			$status_args = array(
				'taxonomy'		=>'pm_status',
				'hide_empty'	=> 0,
				'orderby'		=> 'name',
				'name'			=> 'pm_status[]',
				'id'			=> 'pm_status',
				'selected'		=> $selected_statuses
			);
			wp_dropdown_categories( $status_args );
		?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="category">Category</label>
		<div class="controls">
		<?php
			$categories = get_the_terms( $post->ID, 'category' );			
			if ( $categories && ! is_wp_error( $categories ) ) :
				
				$selected_categories = array();
			
				foreach ( $categories as $category ) {
					$selected_categories[] = $category->term_id;
				}

				$selected_categories = join( ", ", $selected_categories );
			
			endif;
			$cat_args = array(
				'taxonomy'		=>'category',
				'hide_empty'	=> 0,
				'orderby'		=> 'name',
				'name'			=> 'category[]',
				'id'			=> 'cat',
				'selected'		=> $selected_categories
			);
			wp_dropdown_categories( $cat_args );
		?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="pm_task_assign_to">Assigned to</label>
		<div class="controls">
		<?php

			// Get the user assigned to the task
			$assigned = get_post_meta( $post->ID, 'pm_task_assign_to', true );
			
			// Get all registered users
			$users = get_users();
			if ( $users && ! is_wp_error( $users ) ) :
				
				echo '<select name="pm_task_assign_to">';

				foreach ( $users as $user ) {
					if( $assigned == $user->ID )
						$selected = ' selected="selected"';
					
					echo  '<option id="pm_task_assign_to_'. $user->ID .'" name="pm_task_assign_to" value="'. $user->ID .'" '. $selected .'>'. $user->display_name .'</option>';
					$selected = '';
				}
				
				echo '</select>';

			endif;

			?>
		</div>
	</div>

</div>

    <?php
}

function pm_insert_comment( $comment_id ) {
	global $post;

	if ( 'pm_task' != get_post_type() )
		return;
		
    //users are allowed to choose category
    $post_category = $_POST['category'];

    //users are allowed to assign people
    $post_assigned = $_POST['pm_task_assign_to'];

    //users are allowed to choose statuses
    $post_statuses = $_POST['pm_status'];	
	
	// Get the statuses
	$statuses = get_the_terms( $post->ID, 'pm_status' );
		
	if ( $statuses && ! is_wp_error( $statuses ) ) :
		
		$comment_statuses = array();
		$comment_statuses_id = array();
		$comment_statuses_slug = array();
	
		foreach ( $statuses as $status ) {
			$comment_statuses_id[] = $status->term_id;
			$comment_statuses[] = $status->name;
			$comment_statuses_slug[] = $status->slug;
		}
			
		$comment_statuses_id = join( ", ", $comment_statuses_id );					
		$comment_statuses = join( ", ", $comment_statuses );
		$comment_statuses_slug = join( ", ", $comment_statuses_slug );
	
	endif;
	
	// set $post_id to the id of the post you want to attach
	// these uploads to (or 'null' to just handle the uploads
	// without attaching to a post)
		
	wp_set_post_terms( $post->ID, $post_category, 'category' );
	wp_set_post_terms( $post->ID, $post_statuses, 'pm_status' );
	update_post_meta( $post->ID, 'pm_task_assign_to', $post_assigned );

	$pm_status = get_term( $post_statuses, 'pm_status' );

	// If the status has changed, add its meta
	if ( $post_statuses != $comment_statuses_id )
		update_comment_meta( $comment_id, 'pm_status', $pm_status->slug );

}

function pm_comment_editor( $field ) {

	if (!is_single()) return $field; //only on single post pages.
	global $post;

	ob_start();

	wp_editor( '', 'comment', array(
		'textarea_rows' => 15
	) );

	$editor = ob_get_contents();

	ob_end_clean();

	//make sure comment media is attached to parent post

	$editor = str_replace( 'post_id=0', 'post_id='.get_the_ID(), $editor );

	return $editor;

}

function pm_update_subscribers() {
	global $wp_subscribe_reloaded;
	if ( !isset( $_POST['srp'] ) || !isset( $_POST['srp'] ) || !isset( $_POST['srp'] ) )
		return;

	$wp_subscribe_reloaded->add_subscription( $_POST['srp'], $_POST['sre'], $_POST['srs'] );
	if (strpos($status, 'C') !== false)
		$wp_subscribe_reloaded->confirmation_email($post_id, $email);
		
}
