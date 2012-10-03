<?php

function pm_new_task_form( $allowNotLoggedInuser = 'yes' ) {
	if($allowNotLoggedInuser == 'no' &&  !is_user_logged_in()) {
		$output = 'Please Login to create new post';
		return;
	}

	$output = '<form id="pmform" class="form-horizontal" action="" method="post" enctype="multipart/form-data">';
	
		$output .= '<div id="pm-text">';
		
			$output .= '<div id="pm-response"></div>';
		
			$output .= '<div class="control-group"><label class="control-label" for="pmtitle">Title</label>';
			$output .= '<div class="controls"><input class="input-xxlarge" type="text" id="pmtitle" name="pmtitle" placeholder="Task title..."></div></div>';
			
			$output .= '<div class="control-group"><label class="control-label" for="pmcontents">Contents</label>';
			$output .= '<div class="controls"><textarea class="input-xxlarge" id="pmcontents" name="pmcontents" rows="10" cols="20" placeholder="Describe your task..."></textarea></div></div>';

			$output .= '<div class="control-group"><label class="control-label" for="pmassignto">Assign To</label>';
			$output .= '<div class="controls"><select multiple="multiple">';
		
			$users = get_users();
			foreach( $users as $user) { 
				$output .= '<option name="pmassignto" id="pmassignto" value="'. $user->ID .'">'. $user->display_name .'</option>';
			}
			$output .= '</select></div></div>';
			
			$output .= '<div class="control-group"><label class="control-label" for="pmcategorycheck">Category</label>';
			$output .= '<div class="controls"><select multiple="multiple">';
		
			$categories = get_categories(array('hide_empty'=> 0));
			foreach($categories as $category) { 
				$output .= '<option name="pmcategorycheck" id="pmcategorycheck" value="'. $category->term_id .'">'. $category->cat_name .'</option>';
			}
			$output .= '</select></div></div>';
			
			$output .= '<div class="form-actions">';
			$output .= '<a class="btn btn-primary" onclick="pmaddpost(pmtitle.value,pmcontents.value,pmcategorycheck,pmassignto);">Create Task</a>';
			$output .= '</div>';
			
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
	
	$title = $_POST['pmtitle'];
	$content =	$_POST['pmcontents'];
	$category = $_POST['pmcategory'];
	$assignto = $_POST['pmassignto'];
	
	// Create the task
	$post_id = wp_insert_post( array(
		'post_title'		=> $title,
		'post_content'		=> $content,
		'post_status'		=> 'publish',
		'post_category'		=> $category,
		'post_author'       => '1',
		'post_type'			=> 'pm_task'
	) );
	
	// Attach meta data
	update_post_meta( $post_id, 'pm_task_assign_to', $assignto );
	
	// Mail the assigned users
	$users = get_users( array( 'include' => $assignto ) );
	foreach ( $users as $user ) {
		$assigned[] = $user->user_email;
	}
	
	wp_mail( $assigned, 'New Task: '. get_the_title( $post_id ), 'The message' );
	
	if( $post_id != 0  ) {		
		$results = '<div class="alert alert-success">Task added successfully</div>';
		print_r( $_POST );
	} else {
		$results = '<div class="alert alert-error">An error occured while adding your task</div>';
	}
	// Return the String
	die($results);
}

// creating Ajax call for WordPress
add_action( 'wp_ajax_nopriv_pm_addpost', 'pm_addpost' );
add_action( 'wp_ajax_pm_addpost', 'pm_addpost' );
