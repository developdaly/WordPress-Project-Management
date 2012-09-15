<?php

add_action( 'admin_menu', 'pm_theme_admin_setup' );

function pm_theme_admin_setup() {

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* Create a settings meta box only on the theme settings page. */
	add_action( 'load-appearance_page_theme-settings', 'pm_theme_settings_meta_boxes' );

	/* Add a filter to validate/sanitize your settings. */
	add_filter( "sanitize_option_{$prefix}_theme_settings", 'pm_theme_validate_settings' );
}

/* Adds custom meta boxes to the theme settings page. */
function pm_theme_settings_meta_boxes() {

	/* Add a custom meta box. */
	add_meta_box(
		'pm-theme-meta-box',			// Name/ID
		__( 'Project Management Settings', 'project-management' ),	// Label
		'pm_theme_meta_box',			// Callback function
		'appearance_page_theme-settings',		// Page to load on, leave as is
		'normal',					// Which meta box holder?
		'high'					// High/low within the meta box holder
	);

	/* Add additional add_meta_box() calls here. */
}

/* Function for displaying the meta box. */
function pm_theme_meta_box() { ?>

	<table class="form-table">
		
		<?php
		$dir = get_stylesheet_directory() .'/swatches/';
		$swatches = scandir($dir);
		
		if ( $swatches ) {
		?>
		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'pm_theme_swatch' ); ?>"><?php _e( 'Color Swatch', 'project-management' ); ?></label>
			</th>
			<td>

				<p><select id="<?php echo hybrid_settings_field_id( 'pm_theme_swatch' ); ?>" name="<?php echo hybrid_settings_field_name( 'pm_theme_swatch' ); ?>">
						<option value="bootstrap.min.css">Default</option>
						<?php
						foreach ( $swatches as $swatch ) {
							echo '<option value="'. $swatch .'">'. $swatch .'</option>';
						}
						?>
					</select>
				</p>
				<p><?php _e( 'Project Management Description', 'project-management' ); ?></p>
			</td>
		</tr>
		<?php } ?>

	</table><!-- .form-table -->
	<?php
}

/* Validates theme settings. */
function pm_theme_validate_settings( $input ) {

	$input['pm_theme_swatch'] = wp_filter_nohtml_kses( $input['pm_theme_swatch'] );

	return $input;
}