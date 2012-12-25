<?php

function pm_register_post_types() {

    $task_labels = array( 
        'name' => _x( 'Tasks', 'pm_task' ),
        'singular_name' => _x( 'Task', 'pm_task' ),
        'add_new' => _x( 'Add New', 'pm_task' ),
        'add_new_item' => _x( 'Add New Task', 'pm_task' ),
        'edit_item' => _x( 'Edit Task', 'pm_task' ),
        'new_item' => _x( 'New Task', 'pm_task' ),
        'view_item' => _x( 'View Task', 'pm_task' ),
        'search_items' => _x( 'Search Tasks', 'pm_task' ),
        'not_found' => _x( 'No tasks found', 'pm_task' ),
        'not_found_in_trash' => _x( 'No tasks found in Trash', 'pm_task' ),
        'parent_item_colon' => _x( 'Parent task:', 'pm_task' ),
        'menu_name' => _x( 'Tasks', 'pm_task' ),
    );
    $task_args = array( 
        'labels' => $task_labels,
        'hierarchical' => true,        
        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'discussion' ),
        'taxonomies' => array( 'category', 'post_tag' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
		'rewrite' => array(
			'slug' => 'tasks'
		),
        'capability_type' => 'post'
    );
	
	register_post_type( 'pm_task', $task_args );
}

function pm_register_taxonomies() {

    $status_labels = array( 
        'name' => _x( 'Statuses', 'pm_status' ),
        'singular_name' => _x( 'Status', 'pm_status' ),
        'search_items' => _x( 'Search Statuses', 'pm_status' ),
        'popular_items' => _x( 'Popular Statuses', 'pm_status' ),
        'all_items' => _x( 'All Statuses', 'pm_status' ),
        'parent_item' => _x( 'Parent Status', 'pm_status' ),
        'parent_item_colon' => _x( 'Parent Status:', 'pm_status' ),
        'edit_item' => _x( 'Edit Status', 'pm_status' ),
        'update_item' => _x( 'Update Status', 'pm_status' ),
        'add_new_item' => _x( 'Add New Status', 'pm_status' ),
        'new_item_name' => _x( 'New Status', 'pm_status' ),
        'separate_items_with_commas' => _x( 'Separate statuses with commas', 'pm_status' ),
        'add_or_remove_items' => _x( 'Add or remove statuses', 'pm_status' ),
        'choose_from_most_used' => _x( 'Choose from the most used statuses', 'pm_status' ),
        'menu_name' => _x( 'Statuses', 'pm_status' ),
    );

    $status_args = array( 
        'labels' => $status_labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => array( 
            'slug' => 'statuses', 
            'with_front' => true,
            'hierarchical' => true
        ),
        'query_var' => true
    );

    $priority_labels = array( 
        'name' => _x( 'Priorities', 'pm_priority' ),
        'singular_name' => _x( 'Priority', 'pm_priority' ),
        'search_items' => _x( 'Search Priorities', 'pm_priority' ),
        'popular_items' => _x( 'Popular Priorities', 'pm_priority' ),
        'all_items' => _x( 'All Priorities', 'pm_priority' ),
        'parent_item' => _x( 'Parent Priority', 'pm_priority' ),
        'parent_item_colon' => _x( 'Parent Priority:', 'pm_priority' ),
        'edit_item' => _x( 'Edit Priority', 'pm_priority' ),
        'update_item' => _x( 'Update Priority', 'pm_priority' ),
        'add_new_item' => _x( 'Add New Priority', 'pm_priority' ),
        'new_item_name' => _x( 'New Priority', 'pm_priority' ),
        'separate_items_with_commas' => _x( 'Separate priorities with commas', 'pm_priority' ),
        'add_or_remove_items' => _x( 'Add or remove priorities', 'pm_priority' ),
        'choose_from_most_used' => _x( 'Choose from the most used priorities', 'pm_priority' ),
        'menu_name' => _x( 'Priorities', 'pm_priority' ),
    );

    $priority_args = array( 
        'labels' => $priority_labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => array( 
            'slug' => 'priority', 
            'with_front' => true,
            'hierarchical' => true
        ),
        'query_var' => true
    );

    $label_labels = array( 
        'name' => _x( 'Labels', 'pm_label' ),
        'singular_name' => _x( 'Label', 'pm_label' ),
        'search_items' => _x( 'Search Labels', 'pm_label' ),
        'popular_items' => _x( 'Popular Labels', 'pm_label' ),
        'all_items' => _x( 'All Labels', 'pm_label' ),
        'parent_item' => _x( 'Parent Label', 'pm_label' ),
        'parent_item_colon' => _x( 'Parent Label:', 'pm_label' ),
        'edit_item' => _x( 'Edit Label', 'pm_label' ),
        'update_item' => _x( 'Update Label', 'pm_label' ),
        'add_new_item' => _x( 'Add New Label', 'pm_label' ),
        'new_item_name' => _x( 'New Label', 'pm_label' ),
        'separate_items_with_commas' => _x( 'Separate labels with commas', 'pm_label' ),
        'add_or_remove_items' => _x( 'Add or remove labels', 'pm_label' ),
        'choose_from_most_used' => _x( 'Choose from the most used labels', 'pm_label' ),
        'menu_name' => _x( 'Labels', 'pm_label' ),
    );

    $label_args = array( 
        'labels' => $label_labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => array( 
            'slug' => 'label', 
            'with_front' => true,
            'hierarchical' => true
        ),
        'query_var' => true
    );
			
	register_taxonomy( 'pm_status', array('pm_task'), $status_args );
	register_taxonomy( 'pm_priority', array('pm_task'), $priority_args );
	register_taxonomy( 'pm_label', array('pm_task'), $label_args );

}

register_sidebar(array(
	'name' => __( 'Task Sidebar' ),
	'id' => 'pm_task',
	'description' => __( 'Widgets in this area will be shown on the task page.' ),
	'before_title' => '<h1>',
	'after_title' => '</h1>'
));