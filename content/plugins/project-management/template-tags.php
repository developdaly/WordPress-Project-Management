<?php

function pm_task_classes() {
	global $post;
	$statuses = get_the_terms( $post->ID, 'pm_statuses' );
							
	if ( $statuses && ! is_wp_error( $statuses ) ) {
	
		$display_status = array();
	
		foreach ( $statuses as $status ) {
			$display_status[] = $status->slug;
		}
							
		$display_status = join( " ", $display_status );
	
	}
	
	$priorities = get_the_terms( $post->ID, 'pm_priority' );
							
	if ( $priorities && ! is_wp_error( $priorities ) ) {
	
		$display_priority = array();
	
		foreach ( $priorities as $priority ) {
			$display_priority[] = $priority->slug;
		}
							
		$display_priority = join( " ", $display_priority );
	
	}
	
	echo ' '. $display_status .' '. $display_priority;
	
}

function pm_status_comment_classes( $comment_id ) {
	$comment_status = get_comment_meta( $comment_id, 'pm_statuses', true );
	echo ' '. $comment_status;
}

function pm_tasks( $atts ) {
	global $post;
	
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	
	$args = array(
		'paged'				=> $paged,
		'posts_per_page'	=> 2,
		'post_type'			=>	'pm_task'
	);
	
	$tasks = new WP_Query( $args );
	
	if ( $tasks ):
		
		$output = '<table>';
			$output .= '<thead>';
				$output .= '<tr>';
					$output .= '<th>Title</th>';
					$output .= '<th>Created</th>';
					$output .= '<th>Last Updated</th>';
					$output .= '<th>Priority</th>';
					$output .= '<th>Status</th>';
				$output .= '</tr>';
			$output .= '<thead>';
			$output .= '<tbody>';
		
			while ( $tasks->have_posts() ) : $tasks->the_post();
				$output .= '<tr>';
				$output .= '<td><a href="'. get_permalink() .'">'. get_the_title() .'</a></td>';
				$output .= '<td>'. get_the_date() .'</td>';
				$output .= '<td>'. get_the_modified_date() .'</td>';
				$output .= '<td>'. get_the_term_list( $post->ID, 'pm_priority', '<span class="label task-priority">', ', ', '</span>' ) .'</td>';
				$output .= '<td>'. get_the_term_list( $post->ID, 'pm_statuses', '<span class="label task-status">', ', ', '</span>' ) .'</td>';
				$output .= '</tr>';
			endwhile;

			$output .= '</tbody>';
		$output .= '</table>';
		
	endif;
	
	wp_reset_postdata();
	
	return $output;
}

function pm_templates() {
    if ( is_post_type_archive( 'pm_task' ) &! locate_template( 'archive-pm_task.php' ) ) {
        include ( WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__)) . '/templates/archive-pm_task.php');
        exit;
    }
    if ( is_tax( 'pm_status' ) &! locate_template( 'taxonomy-pm_status.php' ) ) {
        include ( WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__)) . '/templates/taxonomy-pm_status.php');
        exit;
    }
    if ( ( 'pm_task' == get_post_type() ) &! locate_template( 'pm_task.php' ) ) {
        include ( WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__)) . '/templates/pm_task.php');
        exit;
    }

    if ( is_singular( array( 'pm_task' ) ) &! locate_template( 'sidebar-pm_task.php' ) ) {
        include ( WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__)) . '/templates/sidebar-pm_task.php');
        exit;
    }
	
}
