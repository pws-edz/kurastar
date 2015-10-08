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
                $category        = wp_get_post_terms($post->ID, 'article_cat', array("fields" => "names"));
                $countries       = wp_get_post_terms($post->ID, 'article_country_cat', array("fields" => "names"));
                $authorID        = get_the_author_meta($post->ID);
 
                $fb_user_access_token =  get_user_meta( get_the_author_meta( 'ID' ), 'fb_user_access_token', true ); 
                $fb_profile_picture =  get_user_meta( get_the_author_meta( 'ID' ), 'fb_profile_picture', true ); 
        

               if($fb_user_access_token != '') {

                $profile =  get_user_meta( get_the_author_meta( 'ID' ), 'fb_profile_picture', true ); 

               } else {

                  $profile = get_cupp_meta(get_the_author_meta( 'ID' ), 'thumbnail');
             
               }


                //diplay reference post data
                $custom_image_link = get_post_meta( $post->ID, '_custom_image_link', true);
       
               ?>
				<div class="postimg postimg2" style="background-image:url(<?php echo ($custom_image_link != '') ? $custom_image_link : $src[0] ;  ?>);"></div>
				<div class="labels">
					<?php if($countries): ?>
	                    <?php foreach($countries as $country): ?>
	                      <a href="<?php echo '/search-results/?country='.$country.'&category=select+category&post_type=post+type+curators-cat'; ?>" class="countrylabel">
	                      	<i class="fa fa-map-marker"></i> 
	                      	<?php echo $country; ?>
	                      </a>
	                    <?php endforeach; ?>
	                  <?php else: ?>
	                    <a href="#" class="countrylabel"><i class="fa fa-map-marker"> No Country</i></a>
	                  <?php endif; ?>

	                  <?php if($category): ?>
	                    <?php foreach($category as $cat): ?>
	                        <a href="<?php echo '/search-results/?country=select+country&category='.$cat.'&post_type=post+type+curators-cat'; ?>" class="catlabel">
								<i class="fa fa-hotel"></i> 
								<?php echo $cat; ?> 
		                    </a>
	                    <?php endforeach; ?>
	                  <?php else: ?>
	                    <a href="#" class="catlabel"><i class="fa fa-hotel"></i> No Category</a>
	                  <?php endif; ?>  
				</div>
				<div class="curator-info">
					<h4><?php the_title(); ?></h4>
					<p><?php the_content();  ?></p>
				</div>
				<div class="infobelow">

					<span class="smallpoints smallpoints-left">
						<?php if (is_user_logged_in() && get_post_meta($post->ID, '_user_liked', true) != get_current_user_id() ): ?>

							<form class="form-send-like" method="POST">
								<p class="message"></p>
	                            <div class="form-group">
	                         	    <input type="hidden" name="postid" value="<?php echo $post->ID ?>">
	                         	    <input type="hidden" name="owned" value="<?php echo get_current_user_id() == get_the_author_meta( 'ID' ) ? 'yes' : 'no';  ?>">
	                         	    <input type="hidden" name="author" value="<?php echo get_the_author_meta( 'ID' ) ?>">                   	    
	                         	    <input type="hidden" name="user" value="<?php echo get_current_user_id() ?>">
	                         	    <input type="hidden" name="action" value="send-like">
	                         	    <i class="fa fa-heart"></i>
	                                <button type="submit" class="smallpoints smallpoints-left">Likes(<?php echo count_total_favorites($post->ID) ?>)</button>
	                            </div>
	                        </form>

                    	<?php else: ?>

	                    	<i class="fa fa-heart"></i>
	                    	<span class="smallpoints smallpoints-left"><?php echo count_total_favorites($post->ID) ?>  likes</span>

                        <?php endif; ?>	

            <br><br>

            <a class = "social-media" href="https://twitter.com/home?status=<?php echo the_title() ?>+<?php echo get_permalink( $post->ID ); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="twitter"><i class="fa fa-twitter"></i>  Twitter (<span class="share-count"><?php echo kura_twitter_count(get_permalink( $post->ID )) ?></span>) </a>
						<a class = "social-media googleplus" href="https://plus.google.com/share?url=<?php the_permalink($post->ID); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="google-plus" ><i class="fa fa-google-plus"></i>  Google+ (<span class="share-count"><?php echo kura_gplus_count(get_permalink( $post->ID )) ?></span>)</a>
						
					</span>

					<div class="profile-thumb-wrap">
						<img src="<?php echo $profile ?>">
						<div class="curator">
							<span>CURATOR</span><br>
							<a href="<?php echo site_url() ?>/curator-detail/?id=<?php echo get_the_author_meta( 'ID' ) ?>"><h3><?php the_author() ?></h3></a>
						</div>
					</div>
				</div>
				<div class="points-detail">
					<?php echo do_shortcode( '[post_view]' ); ?><span>points</span>
				</div>
				<div class="clear"></div>
			</div>


			<!-- RELATED POSTS -->

			<div class="curator-detail-wrap article-detail-wrap related-posts">

				<div class="detail-title">
						<h2 class="<?php echo $heading ?>">Yet Another Related Posts</h2>
					</div>
						<ul class="post-detail-list">
					    <?php
			             # get_wpposts();					    
			            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			            $param = array( 
			                    'post_type'       => 'acme_article', 
			                    'posts_per_page'  => 6, 
			                    'paged'           => $paged, 
			                    'author'          => get_the_author_meta( 'ID' ), 
			                    'post__not_in' => array($post->ID),
			                    'orderby'         => 'post_date',
			                    'order'           => 'DESC');

			              query_posts( $param );
			              if ( have_posts() ) : 
			              	while ( have_posts() ) : the_post();
			              ?>
			              	<li>
							  <a href="<?php echo get_permalink(); ?>" class="post-list-thumb-wrap">
		                    <?php
		                  	$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
			                  
			                 	//Returns All Term Items for "my_taxonomy"
												$category = wp_get_post_terms($post->ID, 'article_cat', array("fields" => "names"));
												$countries  = wp_get_post_terms($post->ID, 'article_country_cat', array("fields" => "names"));

												$authorID = get_the_author_meta($post->ID);
												$curator_profile = get_cupp_meta($authorID, 'thumbnail');

												$custom_image_link =  get_post_meta( $post->ID, '_custom_image_link', true);

					                ?>

                  <div class="postimg" style="background: url(<?php echo ($custom_image_link != '') ? $custom_image_link : $src[0] ;  ?>)"></div>
                    
                    <!-- <div class="desc">
                      <h2><?php the_title(); ?></h2>
                      <p><?php the_content(); ?></p>
                    </div> -->
                    <!-- <div class="infobelow">
                      <i class="fa fa-heart"></i>
                      <span class="smallpoints smallpoints-left"><?php echo count_total_favorites($post->ID) ?>  likes</span>
                      <div class="profile-thumb-wrap">

                    		<span class="smallpoints smallpoints-left"><?php echo do_shortcode( '[post_view]' ); ?> views</span>

            				<img src="<?php echo $curator_profile ?>">
                          <div class="curator">
                              <span>CURATORS</span><br>
                              <a href="<?php echo site_url() ?>/curator-detail/?id=<?php echo get_the_author_meta( 'ID' ) ?>"><h3><?php the_author() ?></h3></a>
                          </div>
                      </div>
                    </div> -->
                </a>
                <div class="labels">
                	<?php if($countries): ?>
                		<?php foreach($countries as $country): ?>
                			<a href="<?php echo '/search-results/?country='.$country.'&category=select+category&post_type=post+type+curators-cat'; ?>" class="countrylabel">
                				<i class="fa fa-map-marker"></i> 
                				<?php echo $country; ?>
                			</a>
                		<?php endforeach; ?>
                	<?php else: ?>
                		<a href="#" class="countrylabel"><i class="fa fa-map-marker"> No Country</i></a>
                	<?php endif; ?>

                	<?php if($category): ?>
                		<?php foreach($category as $cat): ?>
                			<a href="<?php echo '/search-results/?country=select+country&category='.$cat.'&post_type=post+type+curators-cat'; ?>" class="catlabel">
                				<i class="fa fa-hotel"></i> 
                				<?php echo $cat; ?> 
                			</a>
                		<?php endforeach; ?>
                	<?php else: ?>
                		<a href="#" class="catlabel"><i class="fa fa-hotel"></i> No Category</a>
                	<?php endif; ?>               
                </div>
							</li>
			              <?php 
				          	endwhile;   
				          else:?>
				          
				          	<li><p> No related posts yet.</p></li>
				          
				          <?php 
				          endif;  

							//wp pagenavi plugin for pagination   
							if(function_exists("wp_pagenavi")):

							wp_pagenavi(); 

							endif;  

				           wp_reset_query();
				        ?>
					
				</ul>

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
