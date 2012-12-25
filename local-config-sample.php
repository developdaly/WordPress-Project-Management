<?php
/*
 * This is a sample local-config.php file
 * 
 * 1) Copy this file to the same directory and rename it local-config.php.
 * 2) Change the WP_HOME and WP_SITEURL constants to match your local domain
*/

define( 'DB_NAME',		'devdal1_pm_prod' );
define( 'DB_USER',		'devdal1_pm' );
define( 'DB_PASSWORD',	'-5V.1734*^m6' );
define( 'DB_HOST',		'184.173.232.56' );

define( 'WP_HOME',		'http://pm.local' );
define( 'WP_SITEURL',	'http://pm.local/wp' );

// Enable WP_DEBUG mode
define( 'WP_DEBUG',		true );

// Enable Debug logging to the /wp-content/debug.log file
define( 'WP_DEBUG_LOG', true );

// Disable display of errors and warnings 
define( 'WP_DEBUG_DISPLAY', true );
@ini_set( 'display_errors', 1 );

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG',	false );