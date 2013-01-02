<?php
/*
 * This is a sample local-config.php file. It is only necessary if you wish to connect to
 * your own database.
 * 
 * 1) Copy this file to the same directory and rename it local-config.php.
 * 2) Change the WP_HOME and WP_SITEURL constants to match your local domain
*/

define( 'DB_NAME',			'local_db_name' );
define( 'DB_USER',			'local_db_user' );
define( 'DB_PASSWORD',		'local_db_pass' );
define( 'DB_HOST',			'localhost' );

define( 'WP_HOME',			'http://nervetask.local' );
define( 'WP_SITEURL',		'http://nervetask.local/wp' );

// Enable WP_DEBUG mode
define( 'WP_DEBUG',			true );

// Enable Debug logging to the /wp-content/debug.log file
define( 'WP_DEBUG_LOG',		true );

// Disable display of errors and warnings 
define( 'WP_DEBUG_DISPLAY',	true );
@ini_set( 'display_errors',	1 );

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG',		true );