<?php

// Require login.
add_action( 'get_header', 'pm_walled_garden' );
add_action( 'admin_menu', 'pm_admin_menu' ); 
add_action( 'admin_init', 'pm_initialize_options' );

function pm_admin_menu() {  
  
    add_options_page(  
        'Project Manager',	// The title to be displayed in the browser window for this page.  
        'Project Manager',	// The text to be displayed for this menu item  
        'administrator',	// Which type of users can see this menu item  
        'pm_options',		// The unique ID - that is, the slug - for this menu item  
        'pm_display'		// The name of the function to call when rendering this menu's page  
    );
  
}

/** 
 * Renders a simple page to display for the theme menu defined above. 
 */ 
function pm_display() { 
?> 
    <!-- Create a header in the default WordPress 'wrap' container --> 
    <div class="wrap"> 
     
        <div id="icon-themes" class="icon32"></div> 
        <h2>Project Manager Options</h2> 
        <?php settings_errors(); ?> 
         
        <form method="post" action="options.php"> 
            <?php settings_fields( 'pm_display_options' ); ?> 
            <?php do_settings_sections( 'pm_display_options' ); ?>          
            <?php submit_button(); ?> 
        </form> 
         
    </div><!-- /.wrap --> 
<?php 
}
 
function pm_initialize_options() { 
 
    // If the theme options don't exist, create them.  
    if( false == get_option( 'pm_display_options' ) ) {
        add_option( 'pm_display_options' );
    } // end if  
  
    // First, we register a section. This is necessary since all future options must belong to a   
    add_settings_section(  
        'general_settings_section',			// ID used to identify this section and with which to register options  
        'Display Options',					// Title to be displayed on the administration page  
        'pm_general_options_callback',		// Callback used to render the description of the section  
        'pm_display_options'				// Page on which to add this section of options  
    );  
      
    // Next, we'll introduce the fields for toggling the visibility of content elements.  
    add_settings_field(   
        'walled_garden',					// ID used to identify the field throughout the theme 
        'Walled Garden',					// The label to the left of the option interface element 
        'pm_toggle_walled_garden_callback',	// The name of the function responsible for rendering the option interface 
        'pm_display_options',				// The page on which this option will be displayed 
        'general_settings_section',			// The name of the section to which this field belongs 
        array(								// The array of arguments to pass to the callback. In this case, just a description. 
            'Require users to be logged-in to access the site.' 
        ) 
    ); 

    // Finally, we register the fields with WordPress 
    register_setting( 
        'pm_display_options', 
        'pm_display_options' 
    ); 
     
}
 
function pm_general_options_callback() { 
    echo '<p>Select which areas of content you wish to display.</p>'; 
}
 
function pm_toggle_walled_garden_callback($args) { 
     
    // First, we read the options collection 
    $options = get_option('pm_display_options'); 
     
    // Next, we update the name attribute to access this element's ID in the context of the display options array  
    // We also access the show_header element of the options collection in the call to the checked() helper function  
    $html = '<input type="checkbox" id="walled_garden" name="pm_display_options[walled_garden]" value="1" ' . checked(1, $options['walled_garden'], false) . '/>';   

    // Here, we'll take the first argument of the array and add it to a label next to the checkbox  
    $html .= '<label for="walled_garden"> '  . $args[0] . '</label>';  
     
    echo $html; 
     
}

function pm_walled_garden() {
	if( ! is_user_logged_in() && $options['walled_garden'] )
		wp_redirect( '/wp-login.php' );
}
