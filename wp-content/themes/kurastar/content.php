<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="defaultWidth center clear-auto bodycontent article-detail-page">
	<div class="contentbox">
			<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
            </div>
		<div class="curator-detail-wrap article-detail-wrap">
			<div class="pointer2"></div>
			<?php
                 $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
               ?>
               <a class="example-image-link" href="<?php echo $src[0]; ?>" data-lightbox="example-1"><div class="postimg postimg2" style="background: url(<?php echo $src[0]; ?> )"></div></a>
			<div class="labels">
				<span class="countrylabel"><i class="fa fa-map-marker"></i>  <?php the_field('select_country'); ?></span>
				<span class="catlabel"><i class="fa fa-hotel"></i> <?php the_field('category'); ?></span>
			</div>
			<div class="curator-info">
				<h4><?php the_title(); ?></h4>
				<p><?php the_content();  ?></p>
			
			</div>
			<div class="infobelow">
				<ul class="social_reviews">
					<?php $row = 1; if(get_field('social_media_lists')): ?>
							<?php while(has_sub_field('social_media_lists')): ?>
							<li><a href="<?php the_sub_field('social_link'); ?>">
								<img src="<?php the_sub_field('social_image');?>">
								<img src="<?php the_sub_field('social_image_likes');?>"></a>
							</li>
						<?php $row++; endwhile; ?>
					<?php endif; ?>
				</ul>
				<div class="profile-thumb-wrap">
					<span class="smallpoints smallpoints-left-views"><?php echo do_shortcode( '[post_view]' ); ?> views</span>
					<a href="#"><i class="fa fa-heart"></i></a>
					<span class="smallpoints smallpoints-left">14,091 likes</span>
					<?php $row = 1; if(get_field('article_curator_profile')): ?>
							<?php while(has_sub_field('article_curator_profile')): ?>
							<img src="<?php the_sub_field('article_curator_profile_image'); ?>">
							<div class="curator">
								<span>CURATORS</span><br>
								<h3><?php the_sub_field('article_curator_profile_name'); ?></h3>
							</div>
						<?php $row++; endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="sidebox">
		<div class="socketlabs">
			<a href="#">
				<img src="<?php echo get_template_directory_uri(); ?>/images/socketlabs.jpg" alt="">
			</a>
		</div>
		<a href="<?php echo site_url() ?>/curator/"><button type="button" class="btn btn-default curators">See Curators</button></a>
		<div class="sideboxcontent ad300">
			<img src="images/300x300.jpg" />
		</div>
		
			<?php 
 				/*
 				* Ranking article sidebar
 				*  @hook: ranking_article_func
 				*/
 			 ?>
			<?php echo do_shortcode( '[ranking_article]' ) ?>
			<?php 
 				/*
 				* Ranking country sidebar
 				*  @hook: ranking_country_func
 				*/
 			 ?>
			<?php echo do_shortcode( '[ranking_country]' ) ?>

	</div>
</div>

	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<footer class="entry-footer">
		<?php twentyfifteen_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
