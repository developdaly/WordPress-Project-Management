<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the top of the file. It is used mostly as an opening
 * wrapper, which is closed with the footer.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package Hybrid
 * @subpackage Template
 */
?>
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	
	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width" />
  
	<title><?php hybrid_document_title(); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php wp_head(); // wp_head ?>
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700' rel='stylesheet' type='text/css'>

	<script type="text/javascript" src="//use.typekit.net/jtu5eap.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
  
</head>

<body class="<?php hybrid_body_class(); ?>">

	<?php do_atomic( 'open_body' ); // marketing_open_body ?>
	
	<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>

	<div id="container" class="container">

		<?php do_atomic( 'before_header' ); // marketing_before_header ?>

		<header id="header">

			<?php do_atomic( 'open_header' ); // marketing_open_header ?>

			<div class="row">

				<div id="branding" class="span9">
					<a href="<?php echo get_bloginfo( 'url' ); ?>"><img id="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/santander-logo-internal.png" alt="Santander Consumer USA" /></a>
					<?php hybrid_site_title(); ?>
					<?php hybrid_site_description(); ?>
				</div><!-- #branding -->

				<?php get_sidebar( 'header' ); // Loads the sidebar-header.php template. ?>

				<?php do_atomic( 'header' ); // marketing_header ?>

			</div><!-- .wrap -->

			<?php do_atomic( 'close_header' ); // marketing_close_header ?>

		</header>

		<?php do_atomic( 'after_header' ); // marketing_after_header ?>

		<?php do_atomic( 'before_main' ); // marketing_before_main ?>

		<div id="main">
			
			<div class="row-fluid">

			<?php do_atomic( 'open_main' ); // marketing_open_main ?>

			<?php if ( current_theme_supports( 'breadcrumb-trail' ) ) { ?>
				
				<div class="span12">
				<?php breadcrumb_trail( array( 'before' => __( 'You are here:', hybrid_get_parent_textdomain() ), 'front_page' => false ) ); ?>
				</div>
			
			<?php } ?>