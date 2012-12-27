<?php
/**
 * The functions file is used to initialize everything in the theme.  It controls how the theme is loaded and 
 * sets up the supported features, default actions, and default filters.  If making customizations, users 
 * should create a child theme and make changes to its functions.php file (not this one).  Friends don't let 
 * friends modify parent theme files. ;)
 *
 * Child themes should do their setup on the 'after_setup_theme' hook with a priority of 11 if they want to
 * override parent theme features.  Use a priority of 9 if wanting to run before the parent theme.
 *
 * @package Marketing
 * @subpackage Functions
 * @version 1.0
 * @author Patrick Daly <pdaly@santanderconsumerusa.com>
 * @copyright (c) 2012 Santander Consumer USA Inc. All Rights Reserved
 */

/* Load the core theme framework. */
require_once( trailingslashit( TEMPLATEPATH ) . 'library/hybrid.php' );
$theme = new Hybrid();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'marketing_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since 0.1.0
 */
function marketing_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();
	
	require_once ( get_stylesheet_directory() . '/admin/theme-options.php' );

	/* Add theme support for core framework features. */
	add_theme_support( 'hybrid-core-menus', array( 'primary', 'secondary', 'subsidiary' ) );
	add_theme_support( 'hybrid-core-sidebars', array( 'primary', 'secondary', 'header', 'subsidiary', 'after-singular' ) );
	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-shortcodes' );
	add_theme_support( 'hybrid-core-theme-settings', array( 'about', 'footer' ) );
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* Add theme support for framework extensions. */
	add_theme_support( 'theme-layouts', array( '1c', '2c-r' ) );
	add_theme_support( 'dev-stylesheet' );
	add_theme_support( 'loop-pagination' );
	add_theme_support( 'get-the-image' );
	//add_theme_support( 'breadcrumb-trail' );
	add_theme_support( 'cleaner-gallery' );
	
	/* Adds custom stylesheet to the TinyMCE editor. */
	add_editor_style( 'style-editor.css' );

	/* Add theme support for WordPress features. */
	add_theme_support( 'automatic-feed-links' );
	
	/* Load CSS and scripts. */
	add_action( 'wp_enqueue_scripts', 'marekting_load_files' );
	
	/* Embed width/height defaults. */
	add_filter( 'embed_defaults', 'marekting_embed_defaults' );

	/* Filter the sidebar widgets. */
	add_filter( 'sidebars_widgets', 'marekting_disable_sidebars' );
	add_action( 'template_redirect', 'marekting_columns' );
	
	/* Set the content width. */
	hybrid_set_content_width( 720 );
}

/**
 * Queues up CSS and JS in the right locations.
 *
 * @since 0.1.0
 */
function marekting_load_files() {
	$theme  = wp_get_theme();
	
	wp_enqueue_style( 'bootstrap', trailingslashit ( get_template_directory_uri() ) .'css/less/bootstrap.less', '', $theme->version );
	//$swatch = hybrid_get_setting( 'pm_theme_swatch' );
	//if ( $swatch ) {
	//	wp_enqueue_style( 'bootstrap', trailingslashit ( get_template_directory_uri() ) .'swatches/'. $swatch, '', $theme->version );
	//} else {
	//	wp_enqueue_style( 'bootstrap', trailingslashit ( get_template_directory_uri() ) .'swatches/bootstrap.min.css', '', $theme->version );
	//}
		
	wp_enqueue_style( 'bitter', 'http://fonts.googleapis.com/css?family=Bitter', array(), $theme->version );
	wp_enqueue_style( 'style', trailingslashit ( get_template_directory_uri() ) .'style.css', array(), $theme->version );
	
    wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap', trailingslashit ( get_template_directory_uri() ) .'js/bootstrap.min.js', array(), $theme->version, false );
	wp_deregister_script('historyjs');
	wp_register_script( 'historyjs', get_bloginfo( 'stylesheet_directory' ) . '/js/jquery.history.js', array( 'jquery' ), '1.7.1' );
	wp_enqueue_script( 'historyjs' );
	wp_enqueue_script( 'app', trailingslashit ( get_template_directory_uri() ) .'js/app.js', array( 'jquery' ), $theme->version, false );

}

function custom_upload_mimes ( $existing_mimes = array() ) {
    $existing_mimes['psd'] = 'image/vnd.adobe.photoshop';
    return $existing_mimes;
}


/**
 * Function for deciding which pages should have a one-column layout.
 *
 * @since 0.1.0
 */
function marekting_columns() {
	
	if ( !is_active_sidebar( 'primary' ) && !is_active_sidebar( 'secondary' ) )
		add_filter( 'get_theme_layout', 'marekting_theme_layout_one_column' );

	
	elseif ( is_attachment() && 'layout-default' == theme_layouts_get_layout() )
		add_filter( 'get_theme_layout', 'marekting_theme_layout_one_column' );
}

/**
 * Filters 'get_theme_layout' by returning 'layout-1c'.
 *
 * @since 0.2.0
 */
function marekting_theme_layout_one_column( $layout ) {
	return 'layout-1c';
}

/**
 * Filters 'get_theme_layout' by returning 'layout-3c'.
 *
 * @since 0.2.0
 */
function marekting_theme_layout_three_columns( $layout ) {
	return 'layout-3c';
}

/**
 * Disables sidebars if viewing a one-column page.
 *
 * @since 0.1.0
 */
function marekting_disable_sidebars( $sidebars_widgets ) {
	global $wp_query;

	if ( current_theme_supports( 'theme-layouts' ) ) {

		if ( 'layout-1c' == theme_layouts_get_layout() ) {
			$sidebars_widgets['primary'] = false;
			$sidebars_widgets['secondary'] = false;
		}
		if ( 'layout-2c-r' == theme_layouts_get_layout() ) {
			$sidebars_widgets['secondary'] = false;
		}
	}
	
	if ( is_singular( array( 'pm_task' ) ) ) {
		$sidebars_widgets['primary'] = false;
		$sidebars_widgets['secondary'] = false;
	}

	return $sidebars_widgets;
}

/**
 * Overwrites the default widths for embeds.  This is especially useful for making sure videos properly
 * expand the full width on video pages.  This function overwrites what the $content_width variable handles
 * with context-based widths.
 *
 * @since 0.1.0
 */
function marekting_embed_defaults( $args ) {

	if ( current_theme_supports( 'theme-layouts' ) ) {

		$layout = theme_layouts_get_layout();

		if ( 'layout-3c-l' == $layout || 'layout-3c-r' == $layout || 'layout-3c-c' == $layout )
			$args['width'] = 500;
		elseif ( 'layout-1c' == $layout )
			$args['width'] = 928;
		else
			$args['width'] = 720;
	}
	else
		$args['width'] = 720;

	return $args;
}

function namespace_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'software', 'nav_menu_item', 'process', 'style_guide'
		));
	  return $query;
	}
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );

/**
 * Hooks the WP cpt_post_types filter 
 *
 * @param array $post_types An array of post type names that the templates be used by
 * @return array The array of post type names that the templates be used by
 **/
function my_cpt_post_types( $post_types ) {
    $post_types[] = 'style_guide';
    return $post_types;
}
add_filter( 'cpt_post_types', 'my_cpt_post_types' );

function fb_change_mce_options($initArray) {
    $ext = 'script[charset|defer|language|src|type]';

    if ( isset( $initArray['extended_valid_elements'] ) ) {
        $initArray['extended_valid_elements'] .= ',' . $ext;
    } else {
        $initArray['extended_valid_elements'] = $ext;
    }

    return $initArray;
}
add_filter('tiny_mce_before_init', 'fb_change_mce_options');

add_action( 'after_setup_theme', 'bootstrap_setup' );

if ( ! function_exists( 'bootstrap_setup' ) ):

	function bootstrap_setup(){

		class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {


			function start_lvl( &$output, $depth ) {

				$indent = str_repeat( "\t", $depth );
				if ($depth == 1) {
					$output	   .= "\n$indent<ul class=\"dropdown-menu sub-menu\">\n";
				} elseif ($depth == 2) {
					$output	   .= "\n$indent<ul class=\"dropdown-menu sub-sub-menu\">\n";
				} else {
					$output	   .= "\n$indent<ul class=\"dropdown-menu\">\n";
				}
			}

			function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$li_attributes = '';
				$class_names = $value = '';

				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = ($args->has_children) ? 'dropdown' : '';
				$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
				$classes[] = 'menu-item-' . $item->ID;


				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
				$class_names = ' class="' . esc_attr( $class_names ) . '"';

				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
				$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

				$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$attributes .= (($args->has_children) && ($depth == 0))	    ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= (($args->has_children) && ($depth == 0)) ? ' <b class="caret"></b></a>' : '';
				$item_output .= (($args->has_children) && ($depth != 0)) ? ' <i class="icon-arrow-right"></i></a>' : '</a>';
				$item_output .= $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}

			function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

				if ( !$element )
					return;

				$id_field = $this->db_fields['id'];

				//display this element
				if ( is_array( $args[0] ) )
					$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
				else if ( is_object( $args[0] ) )
					$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'start_el'), $cb_args);

				$id = $element->$id_field;

				// descend only when the depth is right and there are childrens for this element
				if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

					foreach( $children_elements[ $id ] as $child ){

						if ( !isset($newlevel) ) {
							$newlevel = true;
							//start the child delimiter
							$cb_args = array_merge( array(&$output, $depth), $args);
							call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
						}
						$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
					}
						unset( $children_elements[ $id ] );
				}

				if ( isset($newlevel) && $newlevel ){
					//end the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
				}

				//end this element
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'end_el'), $cb_args);

			}

                }

	}

endif;








add_filter( 'template_include', 'var_template_include', 1000 );
function var_template_include( $t ){
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}

function get_current_template( $echo = false ) {
    if( !isset( $GLOBALS['current_theme_template'] ) )
        return false;
    if( $echo )
        echo $GLOBALS['current_theme_template'];
    else
        return $GLOBALS['current_theme_template'];
}

// add category nicenames in body and post class
function category_id_class($classes) {
    global $post;
	foreach( ( get_the_category( $post->ID ) ) as $category )
        $classes[] = $category->category_nicename;
	foreach( ( get_the_terms( $post->ID, 'pm_status' ) ) as $term )
		$classes[] = $term->slug;
        return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');