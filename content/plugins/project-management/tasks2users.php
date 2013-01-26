<?php

add_action( 'p2p_init', 'pm_connection_types', 100 );
add_action( 'init', 'pm_assign_task' );
add_action( 'wp_ajax_nopriv_pm_addpost', 'pm_assign_task' );
add_action( 'wp_ajax_pm_addpost', 'pm_assign_task' );

// Register connections
function pm_connection_types() {
	p2p_register_connection_type( array(
	    'name' => 'assigned_tasks',
	    'from' => 'pm_task',
	    'to' => 'user'
	    //'admin_box' => false
	) );
}

// Create connection
function pm_assign_task( $post ) {
	$results = '';
	
	if( $_POST['pmassignto'] ) {
		$assignto = $_POST['pmassignto'];
	} else {
		return false;
	}
	
	p2p_type( 'assigned_tasks' )->connect( 1636, $assignto, array(
		'date' => current_time('mysql')
	) );
	
	// Return the String	
	die($results);
	
}
