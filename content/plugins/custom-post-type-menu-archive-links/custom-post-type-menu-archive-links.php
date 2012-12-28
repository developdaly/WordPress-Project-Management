<?php
/*
Plugin Name: Custom Post Type Archive Menu Links
Plugin URI: http://codeseekah.com/2012/03/01/custom-post-type-archives-in-wordpress-menus-2/
Description: Easily Add Custom Post Type Archives to the Nav Menus
Version: 1.0
Author: soulseekah
Author URI: http://codeseekah.com
License: GPL2
 
    Copyright 2012  soulseekah  (twitter: @soulseekah)
 
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
 
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
 
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 
    This code comes with no guarantees 
*/
 
 
// don't load directly
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}
 
 
if (!class_exists("Custom_Post_Type_Archive_Menu_Links")) :
 
class Custom_Post_Type_Archive_Menu_Links {
 
  /* boot'er up */
  function init(){
 
    // Set-up Action and Filter Hooks
    add_action( 'admin_head-nav-menus.php', array(__CLASS__,'inject_cpt_archives_menu_meta_box' ));
    add_filter( 'wp_get_nav_menu_items', array(__CLASS__,'cpt_archive_menu_filter'), 10, 3 );
  }
  
  /* inject cpt archives meta box */
  
  function inject_cpt_archives_menu_meta_box() {
    add_meta_box( 'add-cpt', __( 'CPT Archives', 'default' ), array(__CLASS__,'wp_nav_menu_cpt_archives_meta_box'), 'nav-menus', 'side', 'default' );
  }
 
  /* render custom post type archives meta box */
  function wp_nav_menu_cpt_archives_meta_box() {
    /* get custom post types with archive support */
    $post_types = get_post_types( array( 'show_in_nav_menus' => true, 'has_archive' => true ), 'object' );
 
    /* hydrate the necessary object properties for the walker */
    foreach ( $post_types as &$post_type ) {
        $post_type->classes = array();
        $post_type->type = $post_type->name;
        $post_type->object_id = $post_type->name;
        $post_type->title = $post_type->labels->name . ' ' . __( 'Archive', 'default' );
        $post_type->object = 'cpt-archive';
    }
 
 
    $walker = new Walker_Nav_Menu_Checklist( array() );
 
    ?>
    <div id="cpt-archive" class="posttypediv">
      <div id="tabs-panel-cpt-archive" class="tabs-panel tabs-panel-active">
        <ul id="ctp-archive-checklist" class="categorychecklist form-no-clear">
          <?php
            echo walk_nav_menu_tree( array_map('wp_setup_nav_menu_item', $post_types), 0, (object) array( 'walker' => $walker) );
          ?>
        </ul>
      </div><!-- /.tabs-panel -->
    </div>
    <p class="button-controls">
      <span class="add-to-menu">
        <img class="waiting" src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" alt="" />
        <input type="submit"<?php disabled( $nav_menu_selected_id, 0 ); ?> class="button-secondary submit-add-to-menu" value="<?php esc_attr_e('Add to Menu'); ?>" name="add-ctp-archive-menu-item" id="submit-cpt-archive" />
      </span>
    </p>
    <?php
  }
 
 
  /* take care of the urls */
  function cpt_archive_menu_filter( $items, $menu, $args ) {
    /* alter the URL for cpt-archive objects */
    foreach ( $items as &$item ) {
      if ( $item->object != 'cpt-archive' ) continue;
      $item->url = get_post_type_archive_link( $item->type );
      
      /* set current */
      if ( get_query_var( 'post_type' ) == $item->type ) {
        $item->classes []= 'current-menu-item';
        $item->current = true;
      }
    }
 
    return $items;
  }
 
 
} // end class
endif;
 
/**
* Launch the whole plugin
*/
if (class_exists("Custom_Post_Type_Archive_Menu_Links")) Custom_Post_Type_Archive_Menu_Links::init(); 