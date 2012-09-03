<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the bottom of the file. It is used mostly as a closing
 * wrapper, which is opened with the header.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package Marketing
 * @subpackage Template
 */
?>
			<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>

			<?php get_sidebar( 'secondary' ); // Loads the sidebar-secondary.php template. ?>
			
			<?php get_sidebar( 'pm_task' ); // Loads the sidebar-after-singular.php template. ?>

			<?php do_atomic( 'close_main' ); // marketing_close_main ?>
			
			</div><!-- .row -->

		</div><!-- #main -->

		<?php do_atomic( 'after_main' ); // marketing_after_main ?>

		<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template. ?>

		<?php get_template_part( 'menu', 'subsidiary' ); // Loads the menu-subsidiary.php template. ?>

		<?php do_atomic( 'before_footer' ); // marketing_before_footer ?>

		<footer>

			<?php do_atomic( 'open_footer' ); // marketing_open_footer ?>

			<div class="wrap">

				<?php echo apply_atomic_shortcode( 'footer_content', hybrid_get_setting( 'footer_insert' ) ); ?>

				<?php do_atomic( 'footer' ); // marketing_footer ?>

			</div><!-- .wrap -->

			<?php do_atomic( 'close_footer' ); // marketing_close_footer ?>

		</footer>

		<?php do_atomic( 'after_footer' ); // marketing_after_footer ?>

	</div><!-- #container -->

	<?php do_atomic( 'close_body' ); // marketing_close_body ?>

	<?php wp_footer(); // wp_footer ?>

</body>
</html>