<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<!-- <div class="mainbanner">
            <div class="flexslider">
              <ul class="slides">
                <li><img src="<?php echo get_template_directory_uri(); ?>/images/main_image.jpg" /></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/images/main_image2.jpg" /></li>
              </ul>
            </div>
            <div class="defaultWidth center searchwrap">
            <form>
              <div class="searchwrap-inner">
                <div class="transwrap">
                  <input id="cty" type="text" value="select country" readonly />
                </div>
                <div class="transwrap">
                  <input id="cat" type="text" value="select category" readonly />
                </div>
                <input type="submit" class="search-btn" value="" />
                
                <div class="dropcountry">
                <div class="pointer"></div>
                
                <div class="mCustomScrollbar light" data-mcs-theme="minimal-dark">
                  <div class="droplistcountry">
                    <div>
                      <?php wp_nav_menu( array('menu' => 'country-menu')); ?>
                    </div>
                  </div>
                </div>
                </div>

                <div class="dropcategory">
                <div class="pointer"></div>
                <div class="mCustomScrollbar light" data-mcs-theme="minimal-dark">
                  <div class="droplistcategory">
                    <div>
                      <?php wp_nav_menu( array('menu' => 'category-menu')); ?>
                    </div>
                    <div></div>
                  </div>
                
                </div>
                </div>
              </div>
            </form>
            </div>
</div> -->
	<div id="primary" class="content-area container">
		<main id="main" class="site-main" role="main">adasdasdasdasdasdadsa
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post(); echo 'adasd';

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'twentyfifteen' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'twentyfifteen' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php get_footer(); ?>
