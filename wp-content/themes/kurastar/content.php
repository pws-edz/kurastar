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
							<span class="countrylabel"><i class="fa fa-map-marker"></i> フィリピン</span>
							<span class="catlabel"><i class="fa fa-hotel"></i> 観光</span>
						</div>
						<div class="curator-info">
							<h4><?php the_title(); ?></h4>
							<p><?php the_content(); ?></p>
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
								<span class="smallpoints smallpoints-left-views">966 views</span>
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
			<ul class="post-list-thumb related">
				<h2>もう一つの関連記事</h2>
				<?php
				  query_posts( array( 'post_type' => 'acme_article', 'posts_per_page' => '3' ) );
				  if ( have_posts() ) : while ( have_posts() ) : the_post();
				?>
				<li>
				  <a href="<?php echo get_permalink(); ?>" class="post-list-thumb-wrap">
	                    <?php
	                      $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
	                    ?>
	                    <div class="postimg" style="background: url(<?php echo $src[0]; ?> )"></div>
	                      <div class="labels">
	                        <span class="countrylabel"><i class="fa fa-map-marker"></i> フィリピン</span>
	                        <span class="catlabel"><i class="fa fa-hotel"></i> 観光</span>
	                      </div>
	                      <div class="desc">
	                        <h2><?php the_title(); ?></h2>
	                        <p><?php the_content(); ?></p>
	                      </div>
	                      <div class="infobelow">
	                        <i class="fa fa-heart"></i>
	                        <span class="smallpoints smallpoints-left">14,091 likes</span>
	                        <div class="profile-thumb-wrap">
	                          <span class="smallpoints smallpoints-left">999 views</span>
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
	                    </a>
				</li>
			<?php endwhile; endif; wp_reset_query(); ?>	
			</ul>
			<!----- start pagination ------>
						
			<ul class="pagination pagination-desktop">
				<a href="#" aria-label="Previous">
			        <span aria-hidden="true"><i class="fa fa-angle-left"></i> Previous</span>
			    </a>
				<a href="#" class="selected">1</a>
				<a href="#">2</a>
				<a href="#">3</a>
				<a href="#">4</a>
				<a href="#" aria-label="Next">
					<span aria-hidden="true">Next <i class="fa fa-angle-right"></i></span>
				</a>
			</ul>

			<ul class="pagination pagination-mobile">
				<a href="#" aria-label="Previous">
			        <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
			    </a>
				<a href="#" class="selected">1</a>
				<a href="#">2</a>
				<a href="#">3</a>
				<a href="#">4</a>
				<a href="#" aria-label="Next">
					<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
				</a>
			</ul>
	<!----- start pagination ------>
	</div>
	<div class="sidebox">
		<div class="socketlabs">
			<a href="#">
				<img src="<?php echo get_template_directory_uri(); ?>/images/socketlabs.jpg" alt="">
			</a>
		</div>
		<a href="http://wpkurastar.local/curators-cat/curators/"><button type="button" class="btn btn-default curators">See Curators</button></a>
		<div class="sideboxcontent ad300">
			<img src="images/300x300.jpg" />
		</div>
		<div class="sideboxcontent rankwrap">
				<h3 class="sidetitle">Ranking Article</h3>
				<ul class="rankarticle">
					<?php
					  query_posts( array( 'post_type' => 'acme_article', 'posts_per_page' => '5' ) );
					  if ( have_posts() ) : while ( have_posts() ) : the_post();
					?>
					<li>
						<a href="<?php echo get_permalink(); ?>">
							<span class="rank rank1">1</span>
							<?php
		                      $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
		                    ?>
							<div class="siderankimage"style="background-image:url(<?php echo $src[0]; ?>);"></div>
							<h4 class="ranktitle"><?php the_title(); ?></h4>
							<span class="smallpoints smallpoints-right">14,091 views</span>
						</a>
					</li>
				<?php endwhile; endif; wp_reset_query(); ?>	
				</ul>
			</div>
			<div class="sideboxcontent rankwrap">
				<h3 class="sidetitle">Ranking Country</h3>
				<ul class="rankarticle rankcountry">
					<?php
					  query_posts( array( 'post_type' => 'acme_country', 'posts_per_page' => '5' ) );
					  if ( have_posts() ) : while ( have_posts() ) : the_post();
					?>
					<li>
						<a href="<?php echo get_permalink(); ?>">
							<span class="rank rank1">1</span>
							<?php
		                      $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
		                    ?>
							<div class="siderankimage"style="background-image:url(<?php echo $src[0]; ?>);"></div>
							<h4 class="ranktitle"><?php the_title(); ?></h4>
							<span class="smallpoints smallpoints-right">9 articles</span>
						</a>
					</li>
				<?php endwhile; endif; wp_reset_query(); ?>	
				</ul>
			</div>
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
