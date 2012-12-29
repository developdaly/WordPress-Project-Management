<?php

function pm_new_task_form( $allowNotLoggedInuser = 'yes' ) {
	if($allowNotLoggedInuser == 'no' &&  !is_user_logged_in()) {
		$output = 'Please Login to create new post';
		return;
	}

	$output = '<form id="pmform" class="form-horizontal" action="" method="post" enctype="multipart/form-data">';
	
		$output .= '<div id="pm-text">';
		
			// Response
			$output .= '<div id="pm-response"></div>';
		
			// Title
			$output .= '<p><input class="input-xxlarge" type="text" id="pmtitle" name="pmtitle" placeholder="Task title..."></p>';
			
			// Contents
			$output .= '<p><textarea class="input-xxlarge" id="pmcontents" name="pmcontents" rows="10" cols="20" placeholder="Describe your task..."></textarea></p>';

			// Assign to
			$output .= '<p><select class="chzn-select" data-placeholder="Assign someone to the task"></p>';
			$users = get_users();
				$output .= '<option></option>';			
			foreach( $users as $user) { 
				$output .= '<option name="pmassignto" id="pmassignto" value="'. $user->ID .'">'. $user->display_name .'</option>';
			}
			$output .= '</select></p>';
			
			// Categories
			$output .= '<p><select name="pmcategorycheck" class="chzn-select" data-placeholder="Organize into a single category">';
			$categories = get_categories(array('hide_empty'=> 0));
				$output .= '<option></option>';
			foreach($categories as $category) { 
				$output .= '<option name="pmcategorycheck" id="pmcategorycheck" value="'. $category->term_id .'">'. $category->cat_name .'</option>';
			}
			$output .= '</select></p>';

			// Statuses
			$output .= '<p><select name="pmstatuscheck" class="chzn-select" data-placeholder="How important is this task?">';
			$statuses = get_categories( array( 'hide_empty' => 0, 'taxonomy' => 'pm_status' ) );
				$output .= '<option></option>';
			foreach( $statuses as $status ) { 
				$output .= '<option name="pmstatuscheck" id="pmstatuscheck" value="'. $status->term_id .'">'. $status->cat_name .'</option>';
			}
			$output .= '</select></p>';

			// Priorities
			$output .= '<p><select name="pmprioritycheck" class="chzn-select" data-placeholder="Assign a priority">';
			$statuses = get_categories( array( 'hide_empty' => 0, 'taxonomy' => 'pm_priority' ) );
				$output .= '<option></option>';
			foreach( $statuses as $status ) { 
				$output .= '<option name="pmprioritycheck" id="pmprioritycheck" value="'. $status->term_id .'">'. $status->cat_name .'</option>';
			}
			$output .= '</select></p>';

			// Tags
			$output .= '<p><select name="pmtagcheck" multiple="multiple" class="chzn-select" data-placeholder="Organize with some tags">';
			$tags = get_tags( array( 'hide_empty'=> 0 ) );
				$output .= '<option></option>';
			foreach($tags as $tag) { 
				$output .= '<option name="pmtagcheck" id="pmtagcheck" value="'. $tag->name .'">'. $tag->name .'</option>';
			}
			$output .= '</select></p>';
						
			// Submit
			$output .= '<p><button type="button" data-loading-text="Loading..." class="btn btn-primary" onclick="pmaddpost(pmtitle.value,pmcontents.value,pmcategorycheck,pmstatuscheck,pmprioritycheck,pmassignto);">Create Task</button></p>';
			$output .= '<div id="loading" class="hide">loading</div>';
						
		$output .= '</div>';
		
	$output .= '</form>';
	
	return $output;

}

function pm_enqueuescripts() {
	wp_enqueue_script( 'pm', WP_PLUGIN_URL . '/' . basename(dirname(__FILE__)) . '/js/app.js', array('jquery') );
	wp_localize_script( 'pm', 'pmajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'pm_enqueuescripts' );

function pm_addpost() {
	$results = '';
	
	$title		= $_POST['pmtitle'];
	$content	= $_POST['pmcontents'];
	$category	= $_POST['pmcategory'];
	$tags		= $_POST['pmtags'];
	$statuses	= $_POST['pmstatus'];
	$priorities	= $_POST['pmpriority'];
	$assignto	= $_POST['pmassignto'];
	
	// Create the task
	$post_id = wp_insert_post( array(
		'post_title'		=> $title,
		'post_content'		=> $content,
		'post_status'		=> 'publish',
		'post_category'		=> $category,
		'tags_input'		=> $tags,
		'post_author'       => '1',
		'post_type'			=> 'pm_task'
	) );
	
	// Attach custom taxonomy terms
	wp_set_post_terms( $post_id, $statuses, 'pm_status' );
	wp_set_post_terms( $post_id, $priorities, 'pm_priority' );
	
	// Attach meta data
	update_post_meta( $post_id, 'pm_task_assign_to', $assignto );
	
	// Mail the assigned users
	$users = get_users( array( 'include' => $assignto ) );
	$assigned = array();
	foreach ( $users as $user ) {
		$assigned[] = $user->user_email;
	}
	// Uncomment when ready to mail tasks
	//wp_mail( $assigned, 'New Task: '. get_the_title( $post_id ), 'The message' );
	
	// Success?
	if( $post_id != 0  ) {		
		$results = '<div class="alert alert-success">Task added successfully</div>';
	} else {
		$results = '<div class="alert alert-error">An error occured while adding your task</div>';
	}
	
	// Return the String	
	die($results);
	
}

// creating Ajax call for WordPress
add_action( 'wp_ajax_nopriv_pm_addpost', 'pm_addpost' );
add_action( 'wp_ajax_pm_addpost', 'pm_addpost' );
