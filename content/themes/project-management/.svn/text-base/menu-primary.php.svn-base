<?php
/**
 * Primary Menu Template
 *
 * Displays the Primary Menu if it has active menu items.
 *
 * @package Marketing
 * @subpackage Template
 */

if ( has_nav_menu( 'primary' ) ) : ?>

	<?php do_atomic( 'before_menu_primary' ); // marketing_before_menu_primary ?>

	<div id="menu-primary" class="menu-container">

		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">

				<?php do_atomic( 'open_menu_primary' ); // marketing_open_menu_primary ?>
	
				<?php wp_nav_menu( array(
					'theme_location' => 'primary',
					'depth'	=> 0,
					'container'	=> false,
					'menu_class'	=> 'nav',
					'walker'	=> new Bootstrap_Walker_Nav_Menu() ) );
				?>
	
				<form method="get" class="navbar-form pull-right" action="<?php echo trailingslashit( home_url() ); ?>">
					<input class="span2 search-query" type="text" name="s" placeholder="Search this site..." />
				</form><!-- .navbar-form -->
								
				<?php do_atomic( 'close_menu_primary' ); // marketing_close_menu_primary ?>

				</div>
			</div>
		</div>

	</div><!-- #menu-primary .menu-container -->

	<?php do_atomic( 'after_menu_primary' ); // marketing_after_menu_primary ?>

<?php endif; ?>