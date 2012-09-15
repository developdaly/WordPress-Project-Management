<?php
/*
 * Plugin Name: Project Manager
 * Description: Add project management features to your theme.
 * Author: Patrick Daly
 * Author URI: http://developdaly.com/
 * Version: 0.1
 * 
 * Copyright 2012 Develop Daly.
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 * 
 */

require_once( WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__)) . '/register.php' );
require_once( WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__)) . '/comments.php' );
require_once( WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__)) . '/template-tags.php' );
require_once( WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__)) . '/new-task.php' );
require_once( WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__)) . '/admin/options.php' );

// Register post types.
add_action( 'init', 'pm_register_post_types' );

// Register taxonomies.
add_action( 'init', 'pm_register_taxonomies' );

// Update post subscribers.
add_action( 'init', 'pm_update_subscribers' );

// Add fields to the comment form.
add_action( 'comment_form_logged_in_after', 'pm_comment_before_fields' );

// Add fields to the comment form.
add_action( 'comment_form_after_fields', 'pm_comment_before_fields' );

// Insert a comment.
add_action( 'comment_post', 'pm_insert_comment', 10, 1 );

// Require login.
add_action( 'get_header', 'walled_garden' );

// Load custom templates.
add_action( 'template_redirect', 'pm_templates' );

// Add WYSISYG editor to comment form.
add_filter( 'comment_form_field_comment', 'pm_comment_editor' );

// Populate the new task form with users.
add_filter( 'gform_pre_render_1', 'pm_users' );

// Creates the shortcut to output the archive of tasks.
add_shortcode( 'pm_tasks', 'pm_tasks' );

function walled_garden() {
	if( ! is_user_logged_in() )
		wp_redirect( '/wp-login.php' );
}
