<?php
/**
 * Subsidiary Menu Template
 *
 * Displays the Subsidiary Menu if it has active menu items.
 *
 * @package Marketing
 * @subpackage Template
 */

if ( has_nav_menu( 'subsidiary' ) ) : ?>

	<?php do_atomic( 'before_menu_subsidiary' ); // marketing_before_menu_subsidiary ?>

	<div id="menu-subsidiary" class="menu-container">

		<div class="wrap">

			<?php do_atomic( 'open_menu_subsidiary' ); // marketing_open_menu_subsidiary ?>

			<?php wp_nav_menu( array( 'theme_location' => 'subsidiary', 'container_class' => 'menu', 'menu_class' => '', 'menu_id' => 'menu-subsidiary-items', 'depth' => 1, 'fallback_cb' => '' ) ); ?>

			<?php do_atomic( 'close_menu_subsidiary' ); // marketing_close_menu_subsidiary ?>

		</div>

	</div><!-- #menu-subsidiary .menu-container -->

	<?php do_atomic( 'after_menu_subsidiary' ); // marketing_after_menu_subsidiary ?>

<?php endif; ?>