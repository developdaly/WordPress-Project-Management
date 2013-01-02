<?php
/**
 * Secondary Menu Template
 *
 * Displays the Secondary Menu if it has active menu items.
 *
 * @package Marketing
 * @subpackage Template
 */

if ( has_nav_menu( 'secondary' ) ) : ?>

	<?php do_atomic( 'before_menu_secondary' ); // marketing_before_menu_secondary ?>

	<div id="menu-secondary" class="menu-container">

		<div class="wrap">

			<?php do_atomic( 'open_menu_secondary' ); // marketing_open_menu_secondary ?>

			<?php wp_nav_menu( array(
				'theme_location' => 'secondary',
				'depth'	=> 0,
				'container'	=> false,
				'menu_class'	=> 'nav',
				'walker'	=> new Bootstrap_Walker_Nav_Menu() ) );
			?>			
			
			<?php do_atomic( 'close_menu_secondary' ); // marketing_close_menu_secondary ?>

		</div>

	</div><!-- #menu-secondary .menu-container -->

	<?php do_atomic( 'after_menu_secondary' ); // marketing_after_menu_secondary ?>

<?php endif; ?>