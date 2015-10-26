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

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="pointer2">
						</div>
						<?php
		                //Returns All Term Items for "my_taxonomy"
		                $category        = wp_get_post_terms($post->ID, 'article_cat', array("fields" => "names"));
		                $countries       = wp_get_post_terms($post->ID, 'article_country_cat', array("fields" => "names"));
		                $authorID        = get_the_author_meta($post->ID);
		 
		                $fb_user_access_token = get_user_meta( get_the_author_meta( 'ID' ), 'fb_user_access_token', true ); 
		                $fb_profile_picture   = get_user_meta( get_the_author_meta( 'ID' ), 'fb_profile_picture', true ); 
		        

		               if($fb_user_access_token != '') {

		                	$profile =  get_user_meta( get_the_author_meta( 'ID' ), 'fb_profile_picture', true ); 

		               } else {

				            if(get_the_author_meta( 'profile_url', get_the_author_meta( 'ID' ) )) {
				              	$profile = get_the_author_meta( 'profile_url', get_the_author_meta( 'ID' ) );
				            }else{
		                    	$profile = get_template_directory_uri()."/images/default-image.jpg";
				            }
		               }

		                //diplay reference post data
		       
		               ?>
						<div id="change-image-2" class="postimg postimg2" style="background-image:url(<?php echo getArticleImage($post->ID); ?>);">
						</div>

					</div>
					<div class="col-xs-12 col-sm-12 col-md-8">
						<div class="article-content">
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
								<i class="<?php echo categoryLogo(array('category' => $cat)); ?>"></i> 
								<?php echo $cat; ?> 
		                    </a>
	                    <?php endforeach; ?>
	                  <?php else: ?>
	                    <a href="#" class="catlabel"><i class="fa fa-question"></i> No Category</a>
	                  <?php endif; ?>  
				</div>
				<div class="curator-info">
					<!-- <div class="curator-info"> -->
					<!-- <p><?php the_title(); ?></p> -->
				<!-- </div> -->
				<form method="POST" id="edit-custom-form" enctype="multipart/form-data">
                <div class="display_details">
                  <span id="edit-form">
                    <p><?php the_title(); ?></p>
                  </span>
                  <?php if(is_user_logged_in() &&   get_the_author_meta( 'ID' ) == get_current_user_id() ) : ?>
                    <span class="catlabel"><a href="#" class="edit-custom-form">Edit</a> </span>
                  <?php endif; ?>
                </div>

                <div style="display:none;" class="display_section">
                	<div class="row">
	                    <div class="form-grp form-placeholder-offset">
							<textarea name="post_title" placeholder="Title" class="form-control form-control-stroked"><?php the_title(); ?></textarea>
	                    </div>
                    </div>
                    <img id="uploaded_image" src="<?php echo getArticleImage($post->ID); ?>" style="display:none">
                    <input type="file" name="post_image" id="post_image" accept="image/*" class="form-control form-control-stroked" style="visibility: hidden;">
                    <input type="hidden" name="update_article_info" value="_update_article_info">
                    <input type="hidden" name="post_id" value="<?php echo $post->ID ?>">
                    <a href="#" class="btn catlabel update_process"><?php _e('Save', 'wp') ?></a>
                    <a href="#" class="btn catlabel cancel_process"><?php _e('Cancel', 'wp') ?></a>

                </div>
                <div class="clear"></div>
              </form>

				</div>
				<div class="infobelow">

					<span class="smallpoints smallpoints-left">
						
						<ul class="socialmedia">
							<li class="like-button">

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
					                    <button type="submit" class="smallpoints "><span class="label-sm">Thank You</span> (<?php echo count_total_favorites($post->ID) ?>)</button>
					                </div>
					            </form>
		                    <?php else: ?>
			                	<i class="fa fa-heart"></i>
			                	<span class="smallpoints smallpoints-left likes-font"><?php echo 'Thank You ('.count_total_favorites($post->ID).')';?></span>
		                    <?php endif; ?>	

							</li>
							<li class="fb-button">
								<a class = "social-media" href="#" onclick="" class="twitter"><i class="fa fa-thumbs-o-up"></i> <span class="label-sm"> Facebook </span><span class="share-count">(<?php echo kura_twitter_count(get_permalink( $post->ID )) ?>)</span></a>
							</li>

							<li class="twit-button">
								<a class = "social-media" href="https://twitter.com/home?status=<?php echo the_title() ?>+<?php echo get_permalink( $post->ID ); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="twitter"><i class="fa fa-twitter"></i> <span class="label-sm">Twitter </span><span class="share-count">(<?php echo kura_twitter_count(get_permalink( $post->ID )) ?>)</span></a>
							</li>

							<li class="gplus-button">
								<a class = "social-media googleplus" href="https://plus.google.com/share?url=<?php the_permalink($post->ID); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="google-plus" ><i class="fa fa-google-plus"></i>  <span class="label-sm">Google+ </span><span class="share-count">(<?php echo kura_gplus_count(get_permalink( $post->ID )) ?>)</span></a>
							</li>
						</ul>

					</span>

					<div class="profile-thumb-wrap">
						<img src="<?php echo $profile; ?>">
						<div class="curator">
							<span>CURATOR</span><br>
							<a href="<?php echo site_url() ?>/curator-detail/?id=<?php echo get_the_author_meta( 'ID' ) ?>"><h3><?php the_author() ?></h3></a>
						</div>
					</div>


				</div>
				<div class="points-detail">
				<?php
					// $view = do_shortcode( '[post_view]' );
					// if ( $view == 1 ) {
					//  	# code...
					// 	echo $view.'<span>View</span>';
					//  } else
					//  {
					//  	echo $view.'<span>Views</span>';
					//  }
				 ?>
				</div>
				<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>


			<!-- RELATED POSTS -->

			<div class="curator-detail-wrap article-detail-wrap related-posts">

				<div class="detail-title">
						<h2 class="article-title">Yet Another Related Posts</h2>
					</div>
						<ul class="post-detail-list">
					    <?php
					    	$p = get_query_var('page') ? get_query_var('page') : 1;
				            $param = array( 
				                    'post_type'       => 'acme_article', 
				                    'posts_per_page'  => 6, 
				                    'paged'           => $p, 
				                    'author'          => get_the_author_meta( 'ID' ), 
				                    'post__not_in'    => array($post->ID),
				                    'orderby'         => 'post_date',
				                    'order'           => 'DESC');
			                $query = new WP_Query( $param );
			                if ( $query->have_posts() ) : 
			              		while ( $query->have_posts() ) : $query->the_post();
		              	?>
			              	<li>
							  <a href="<?php echo get_permalink(); ?>" class="post-list-thumb-wrap">
			                    <?php
	             					//Returns All Term Items for "my_taxonomy"
									$category = wp_get_post_terms($post->ID, 'article_cat', array("fields" => "names"));
									$countries  = wp_get_post_terms($post->ID, 'article_country_cat', array("fields" => "names"));
									$authorID = get_the_author_meta($post->ID);
									$curator_profile = get_cupp_meta($authorID, 'thumbnail');
									$custom_image_link =  get_post_meta( $post->ID, '_custom_image_link', true);

				                ?>
			                  		<div class="postimg" style="background: url(<?php echo getArticleImage($post->ID); ?>)"></div>
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
				                				<i class="<?php echo categoryLogo(array('category' => $cat)); ?>"></i> 
				                				<?php echo $cat; ?> 
				                			</a>
				                		<?php endforeach; ?>
				                	<?php else: ?>
				                		<a href="#" class="catlabel"><i class="fa fa-question"></i> No Category</a>
				                	<?php endif; ?>               
				                </div>
							</li>
			              <?php 
				          	endwhile;  
				          else:?>
				          	<li><p> No related posts yet.</p></li>
				          <?php 
				          endif;  
				        ?>
				</ul>
					<?php
							wp_reset_query(); 

							$total_page = ceil( $query->found_posts / 6);
							$current_link = get_permalink($post->ID);
							echo "<div class='wp-pagenavi'>";
							echo "<span class='pages'>Page ". $p ." of ". $total_page ."</span>";
							echo '<a class="first" href="'. $current_link .'">« First</a>';
							echo '<a class="previouspostslink" href="'. $current_link . ( $p > 1 ? $p - 1 : $p ) .'">«</a>';
							for ($i = 1; $i <= $total_page; $i++) {

								if ( $p == $i ) {
									echo '<span class="current">'. $i .'</span>';
								} else {
									echo '<a href="'. $current_link. $i. '">'. $i .'</a>';	
								}
							}
							

							if( $p != $total_page ) { //added to hide the last and next arrow when the page is already last.

								echo '<a class="nextpostslink" href="'. $current_link . ( $page < $total_page ? $p + 1 : $p ) .'">»</a>';
								echo '<a class="last" href="'. $current_link . $total_page .'/">Last »</a>';
							}
							
							echo '</div>';
		            ?>

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



</article><!-- #post-## -->
