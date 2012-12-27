<?php
// ===================================================
// Load database info and local development parameters
// ===================================================
if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
	define( 'WP_LOCAL_DEV', true );
	include( dirname( __FILE__ ) . '/local-config.php' );
} else {
	define( 'WP_LOCAL_DEV', false );
	define( 'DB_NAME',		'devdal1_pm_prod' );
	define( 'DB_USER',		'devdal1_pm' );
	define( 'DB_PASSWORD',	'N1kdlJMu),W@' );
	define( 'DB_HOST',		'184.173.232.56' );
}

// ========================
// Custom Content Directory
// ========================
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content' );

// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ==============================================================
// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
// ==============================================================
define( 'AUTH_KEY',         'l4y2p<T{T1n9i5 ]]qK},Je ^L6$jQj4,h/E|-`;c%dDw2fg,{]$k~UjFU+%>lpU' );
define( 'SECURE_AUTH_KEY',  '?ZhjC+S*tNt+OULMC?[I;bx&J~EK++mf`wE _-|4U6cRdrD^mOVj5a,nRRQ;OjcM' );
define( 'LOGGED_IN_KEY',    'Ud-yg}B@ZI6qcgsS-kf)Z,VjTtq%H:(JTk#g)1;EE40IQ)tE}tu6<,Q=-Y,x7/&k' );
define( 'NONCE_KEY',        'd5Yh^OIK2VBS?8M!|}XrV+F6|=b^>G>^L=YBn4ilC=w2:]q8F`%j&N7$Z||H,X(5' );
define( 'AUTH_SALT',        'op ?uF*B)T:o+0AF_!r7+)CH|zaQkMLr}OtrD }SiCDHG<PNI_8w6O(`xo*h y2V' );
define( 'SECURE_AUTH_SALT', 'b%7]UWXz(bNELdI-pEa:n*ZczPI`d/#DgD5i97wU8F40N;(:xQIeGV.|[khx-<ZB' );
define( 'LOGGED_IN_SALT',   'F`}KN` 9RdksT]BfdKXIWz<Oa%dQ,b087pQr5dy @u>*qVkQUu1lEyy4LvR42`/b' );
define( 'NONCE_SALT',       '&u&IVz,q-j~j:7byt6%M/^z3Ogp/b7?/G`ooxOu76ZfofTMX0)NqhG{&eb>:o,|{' );

// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
$table_prefix  = 'wp_';

// ================================
// Language
// Leave blank for American English
// ================================
define( 'WPLANG', '' );

// ===========
// Hide errors
// ===========
ini_set( 'display_errors', 0 );
define( 'WP_DEBUG_DISPLAY', false );

// ===================
// Bootstrap WordPress
// ===================
if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
require_once( ABSPATH . 'wp-settings.php' );
