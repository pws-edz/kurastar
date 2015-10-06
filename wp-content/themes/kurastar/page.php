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
<div class="mainbanner subpage-banner">
	<div class="flexslider">
		<ul class="slides">
			<?php $row = 1; if(get_field('home_slider', 6)): ?>
				 <?php while(has_sub_field('home_slider', 6)): ?>
				 	<li><img src="<?php the_sub_field('slider_image', 6); ?>" /></li>
				 <?php $row++; endwhile; ?>
			<?php endif; ?>
		</ul>
	</div>
	<div class="defaultWidth center searchwrap subpage-searchwrap">
		<form method="get" action="<?php echo site_url() ?>/search-results/">
			<div class="searchwrap-inner">
				<div class="transwrap">
					<input id="cty" type="text" name="country" value="select country" readonly />
				</div>
				<div class="transwrap">
					<input id="cat" type="text" name="category" value="select category" readonly />
				</div>
				<input type="submit" class="search-btn" value="post type curators-cat" name="post_type" />
				
				<?php 
					/*
					* Country Dropdown
					* @hook: dropdown_country_func
					*/
				 ?>
				 <?php echo do_shortcode( '[dropdown_country]' ) ?>


				 <?php 
					/*
					* Category Dropdown
					* @hook: dropdown_category_func
					*/
				 ?>
				 <?php echo do_shortcode( '[dropdown_category]' ) ?>

			</div>
		</form>
	</div>
</div>
	<div id="primary" class="content-area container">
		<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			the_title(); echo $post->post_name;
			// Include the page content template.

			if($post->post_name == 'user-login') {

				get_template_part( 'content', 'page' );

			} else {

				get_template_part( 'content', 'custom' );

			}
			

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
