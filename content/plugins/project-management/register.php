<?php

function pm_register_post_types() {

	/* Register 'task'. */
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

    $statuses_labels = array( 
        'name' => _x( 'Statuses', 'pm_statuses' ),
        'singular_name' => _x( 'Status', 'pm_statuses' ),
        'search_items' => _x( 'Search Statuses', 'pm_statuses' ),
        'popular_items' => _x( 'Popular Statuses', 'pm_statuses' ),
        'all_items' => _x( 'All Statuses', 'pm_statuses' ),
        'parent_item' => _x( 'Parent Status', 'pm_statuses' ),
        'parent_item_colon' => _x( 'Parent Status:', 'pm_statuses' ),
        'edit_item' => _x( 'Edit Status', 'pm_statuses' ),
        'update_item' => _x( 'Update Status', 'pm_statuses' ),
        'add_new_item' => _x( 'Add New Status', 'pm_statuses' ),
        'new_item_name' => _x( 'New Status', 'pm_statuses' ),
        'separate_items_with_commas' => _x( 'Separate statuses with commas', 'pm_statuses' ),
        'add_or_remove_items' => _x( 'Add or remove statuses', 'pm_statuses' ),
        'choose_from_most_used' => _x( 'Choose from the most used statuses', 'pm_statuses' ),
        'menu_name' => _x( 'Statuses', 'pm_statuses' ),
    );

    $statuses_args = array( 
        'labels' => $statuses_labels,
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

    $people_labels = array( 
        'name' => _x( 'People', 'pm_people' ),
        'singular_name' => _x( 'Person', 'pm_people' ),
        'search_items' => _x( 'Search People', 'pm_people' ),
        'popular_items' => _x( 'Popular People', 'pm_people' ),
        'all_items' => _x( 'All People', 'pm_people' ),
        'parent_item' => _x( 'Parent Person', 'pm_people' ),
        'parent_item_colon' => _x( 'Parent Person:', 'pm_people' ),
        'edit_item' => _x( 'Edit Person', 'pm_people' ),
        'update_item' => _x( 'Update Person', 'pm_people' ),
        'add_new_item' => _x( 'Add New Person', 'pm_people' ),
        'new_item_name' => _x( 'New Person', 'pm_people' ),
        'separate_items_with_commas' => _x( 'Separate people with commas', 'pm_people' ),
        'add_or_remove_items' => _x( 'Add or remove people', 'pm_people' ),
        'choose_from_most_used' => _x( 'Choose from the most used people', 'pm_people' ),
        'menu_name' => _x( 'People', 'pm_people' ),
    );

    $people_args = array( 
        'labels' => $people_labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => array( 
            'slug' => 'people', 
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
		
	register_taxonomy( 'pm_statuses', array('pm_task'), $statuses_args );
	register_taxonomy( 'pm_people', array('pm_task'), $people_args );
	register_taxonomy( 'pm_priority', array('pm_task'), $priority_args );
}

register_sidebar(array(
  'name' => __( 'Task Sidebar' ),
  'id' => 'pm_task',
  'description' => __( 'Widgets in this area will be shown on the task page.' ),
  'before_title' => '<h1>',
  'after_title' => '</h1>'
));