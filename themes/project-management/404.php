<?php
/**
 * 404 Template
 *
 * The 404 template is used when a reader visits an invalid URL on your site. By default, the template will 
 * display a generic message.
 *
 * @package Marketing
 * @subpackage Template
 * @link http://codex.wordpress.org/Creating_an_Error_404_Page
 */

@header( 'HTTP/1.1 404 Not found', true, 404 );

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // marketing_before_content ?>

	<section id="content" role="main" class="span9">

		<?php do_atomic( 'open_content' ); // marketing_open_content ?>

		<div class="hfeed">

			<div id="post-0" class="<?php hybrid_entry_class(); ?>">

				<h1 class="error-404-title entry-title"><?php _e( 'Not Found', hybrid_get_parent_textdomain() ); ?></h1>

				<div class="entry-content">

					<p>
					<?php printf( __( 'You tried going to %1$s, and it doesn\'t exist. All is not lost! You can search for what you\'re looking for.', hybrid_get_parent_textdomain() ), '<code>' . home_url( esc_url( $_SERVER['REQUEST_URI'] ) ) . '</code>' ); ?>
					</p>

					<?php get_search_form(); // Loads the searchform.php template. ?>

				</div><!-- .entry-content -->

			</div><!-- .hentry -->

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // marketing_close_content ?>

	</section><!-- #content -->

	<?php do_atomic( 'after_content' ); // marketing_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>