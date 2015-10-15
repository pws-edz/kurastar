<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<div id="primary" class="content-area container">
	<main id="main" class="site-main" role="main">
	<?php
	// Start the loop.
	while ( have_posts() ) : the_post();
		the_title(); //echo $post->post_name;
		// Include the page content template.

		// if($post->post_name == 'user-login') {

		// 	get_template_part( 'content', 'page' );

		// } else {

		// 	get_template_part( 'content', 'custom' );

		// }

		get_template_part( 'content', 'custom' );
		
	// End the loop.
	endwhile;
	?>
	</main><!-- .site-main -->
</div><!-- .content-area -->
<?php get_footer(); ?>
