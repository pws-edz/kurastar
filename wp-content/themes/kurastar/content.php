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
	<div class="defaultWidth center clear-auto bodycontent">
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

                 //Returns All Term Items for "my_taxonomy"
                $category = wp_get_post_terms($post->ID, 'article_cat', array("fields" => "names"));
                $countries  = wp_get_post_terms($post->ID, 'article_country_cat', array("fields" => "names"));

                $authorID = get_the_author_meta($post->ID);
                $curator_profile = get_cupp_meta($authorID, 'thumbnail');

               # $custom_image = get_post_meta($post->ID, '_custom_image_link', false);

                //diplay reference post data
                $custom_image_link =  get_post_meta( $post->ID, '_custom_image_link', true);
                $tab_1_text = get_post_meta( $post->ID, '_tab_1_text', true);
                $tab_3_desc = get_post_meta( $post->ID, '_tab_3_desc', true);
                $tab_3_url = get_post_meta( $post->ID, '_tab_3_url', true);
                $tab_4_link = get_post_meta( $post->ID, '_tab_4_link', true);
                $twitter_url = get_post_meta( $post->ID, '_tab_5_twitter_url', true);
                $youtube_url = get_post_meta( $post->ID, '_tab_6_youtube_url', true);
                $heading = get_post_meta( $post->ID, '_tab_7_heading', true);
                $tag_title = get_post_meta( $post->ID, '_tab_7_tag_title', true);
                
               ?>
				<div class="postimg postimg2" style="background-image:url(<?php echo ($custom_image_link != '') ? $custom_image_link : $curator_profile ;  ?>);"></div>
				<div class="labels">
					<?php if($countries): ?>
	                    <?php foreach($countries as $country): ?>
	                      <span class="countrylabel"><i class="fa fa-map-marker"></i> <?php echo $country; //フィリピン ?></span>
	                    <?php endforeach; ?>
	                  <?php else: ?>
	                    <span class="countrylabel"><i class="fa fa-map-marker"> No Country</i></span>
	                  <?php endif; ?>

	                  <?php if($category): ?>
	                    <?php foreach($category as $cat): ?>
	                      <span class="catlabel"><i class="fa fa-hotel"></i> <?php echo $cat; //観光 ?> </span>
	                    <?php endforeach; ?>
	                  <?php else: ?>
	                    <span class="catlabel"><i class="fa fa-hotel"></i> No Category</span>
	                  <?php endif; ?>  
				</div>
				<div class="curator-info">
					<h4><?php the_title(); ?></h4>
					<p><?php the_content();  ?></p>
				</div>
				<div class="infobelow">
					<span class="smallpoints smallpoints-left">

						<form class="form-send-like" method="POST">
							<p class="message"></p>
                            <div class="form-group">
                         	    <input type="hidden" name="postid" value="<?php echo $post->ID ?>">
                         	    <input type="hidden" name="owned" value="<?php echo get_current_user_id() == get_the_author_meta( 'ID' ) ? 'yes' : 'no';  ?>">
                         	    <input type="hidden" name="author" value="<?php echo get_the_author_meta( 'ID' ) ?>">                   	    
                         	    <input type="hidden" name="user" value="<?php echo get_current_user_id() ?>">
                         	    <input type="hidden" name="action" value="send-like">
                                <button type="submit" class="btn btn-default">Like Me</button>
                            </div>
                        </form>
                        	
					</span>
					<div class="profile-thumb-wrap">
						<img src="<?php echo $curator_profile ?>">
						<div class="curator">
							<span>CURATOR</span><br>
							<h3><?php the_author() ?></h3>
						</div>
					</div>
				</div>
				<div class="points-detail">
					<?php echo do_shortcode( '[post_view]' ); ?><span>points</span>
				</div>
				<div class="clear"></div>
			</div>
			<div class="curator-detail-wrap article-detail-wrap">
							<ul class="post-detail-list">
								<li>
									<div class="detail-title">
										<h2 class="<?php echo $heading ?>"><?php echo $tag_title ?></h2>
									</div>
									<div class="detail-content">
										<img src="<?php echo ($custom_image_link != '') ? $custom_image_link : $curator_profile ;  ?>" />
										<a class="weblink" href="<?php echo $tab_3_url ?>" target="_blank"><?php echo $tab_3_desc ?></a>
										<p><?php echo $tab_1_text ?></p>
										<p><a href="<?php echo $youtube_url ?>">Youtube</a></p>
										<p><a href="<?php echo $twitter_url ?>">Twitter</a></p>
									</div>
								</li>
							</ul>
							
							<div class="article-curator">
								<!-- <span class="social-sample"><img src="<?php echo get_template_directory_uri(); ?>/images/social-sample.png"></span> -->
								<a href="#" class="curator-detail-wrap" style="box-shadow:none; border:solid 1px #ee7500; margin-top:50px;">
									<img src="<?php echo ($custom_image_link != '') ? $custom_image_link : $curator_profile ;  ?>">
									<div class="labels labels2">
										<span class="countrylabel"><b><?php echo count_user_posts(get_the_author_meta( 'ID' ), 'acme_article') ?></b> Articles</span>
										<span class="catlabel"><b><?php echo count_user_favorites(get_the_author_meta( 'ID' )) ?></b> Favorites</span>
									</div>
									<div class="curator-info">
										<h4><?php the_author() ?></h4>
										<p><?php echo get_the_author_meta( 'description' ) ?></p>
										<div class="clear"></div>
									</div>
									<div class="points-detail">
										<?php echo do_shortcode( '[post_view]' ); ?><span>points</span>
									</div>
									<div class="clear"></div>
								</a>
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
				<img src="<?php echo get_template_directory_uri(); ?>/images/300x300.jpg" />
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
		// if ( is_single() && get_the_author_meta( 'description' ) ) :
		// 	get_template_part( 'author-bio' );
		// endif;
	?>

<!-- 	<footer class="entry-footer">
		<?php twentyfifteen_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>-->
	<!-- .entry-footer --> 

</article><!-- #post-## -->
