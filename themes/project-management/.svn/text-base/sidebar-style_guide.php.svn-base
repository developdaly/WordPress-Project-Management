<?php
/**
 * Style Guide Sidebar Template
 *
 * Displays widgets for the Style Guide dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user.  Otherwise, nothing is displayed.
 *
 * @package Marketing
 * @subpackage Template
 */

?>

<section id="sidebar-style_guide" role="complementary" class="two columns">
	
	<p><a href="<?php echo site_url(); ?>">&larr; back to main site</a></p>	
				
	<ul class="nav-bar vertical">
	<?php
	if( $post->post_parent ) {
		echo '<li><a href="http://marketing/?p='. $post->post_parent .'">Getting Started</a></li>';
	    wp_list_pages('post_type=style_guide&title_li=&child_of='.$post->post_parent);
	}
	else {
		echo '<li class="active"><a href="http://marketing/?p='. $post->ID .'">Getting Started</a></li>';
	    wp_list_pages('post_type=style_guide&title_li=&child_of='.$post->ID);
	}
	?>
	</ul>
	
	<?php dynamic_sidebar( 'style_guide' ); ?>

</section><!-- #sidebar-style_guide .aside -->