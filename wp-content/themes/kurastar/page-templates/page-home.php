<?php 

/*Template Name: Home*/
global $wp;
get_header(); ?>
	<div class="banner">
		<div class="category-search">
			<form action="">
				<select name="" id="country">
					<option value="hide">- Select Country -</option>
					<option value="hide">Asia</option>
					<option value="india">India</option>
					<option value="indonesia">Indonesia</option>
					<option value="cambodia"> Cambodia</option>
					<option value="singapore">Singapore</option>
					<option value="thailand">Thailand</option>
					<option value="philippines">Philippines</option>
					<option value="vietnam">Vietnam</option>
					<option value="malaysia">Malaysia</option>
					<option value="china">China</option>
					<option value="taiwan">Taiwan</option>
					<option value="japan">Japan</option>
					<option value="southkorea">South Korea</option>
					<option value="hk_macau">Hong Kong / Macau</option>

				</select>
				<select name="" id="category">
					<option value="">- Select Category -</option>
					<option value="business">Business</option>
					<option value="buzz">Buzz</option>
					<option value="fashion">Fashion</option>
					<option value="gourmet">Gourmet</option>
					<option value="hotel">Hotel</option>
					<option value="leisure">Leisure</option>
					<option value="study">Study</option>

				</select>
				<span class="search-text">Search</span>
			</form>

		</div>
	</div>
	<div class="defaultWidth center clear-auto bodycontent bodycontent-index ">
		<div class="contentbox">
			<h2 class="whatsnew">ー最新情報ー</h2>
			<ul class="post-list-thumb post-list-default">

				<div class="post-publish-wrapper">
				<?php

				 	 //query_posts(array( 'post_type' => 'acme_article','posts_per_page' => 9, 'post_status' => 'publish', 'paged' => get_query_var('page')) );
				     $paged = ( get_query_var('page') > 1 ) ? get_query_var('page') : 1;

		            $param = array( 
		                    'post_type'       => 'acme_article', 
		                    'posts_per_page'  => 9, 
		                    'paged'           => $paged, 
		                    'post_status'     => 'publish',
		                    'orderby'         => 'post_date',
		                    'order'           => 'DESC');

		            $wp_query = new WP_Query( $param );

					 if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();

					 	//Returns All Term Items for "my_taxonomy"
						$category          = wp_get_post_terms($post->ID, 'article_cat', array("fields" => "names"));
						$countries         = wp_get_post_terms($post->ID, 'article_country_cat', array("fields" => "names"));
						$authorID          = get_the_author_meta($post->ID);
						$curator_profile   = get_cupp_meta($authorID, 'thumbnail');
						$custom_image_link = get_post_meta( $post->ID, '_custom_image_link', true);

				    ?>
					<li id="post-<?php echo the_ID() ?>" class="post-<?php echo the_ID() ?> post">

						<a href="<?php echo get_permalink(); ?>" class="post-list-thumb-wrap">
							<div class="postimg" style="background: url(<?php echo getArticleImage($post->ID); ?>)"></div>
						</a>

						<div class="labels ">
						<?php if($countries): ?>
							<?php foreach($countries as $country): ?>
								<a href="<?php echo '/search-results/?country='.$country.'&category=select+category&post_type=post+type+curators-cat'; ?>" class="countrylabel">
									<i class="fa fa-map-marker"></i> 
									<span class="label-post"><?php echo $country; //フィリピン ?></span>
									
								</a>
							<?php endforeach; ?>
						<?php else: ?>
							<a href="#" class="countrylabel"><i class="fa fa-map-marker"> No Country</i></a>
						<?php endif; ?>

						<?php if($category): ?>
							<?php foreach($category as $cat): ?>
								<a href="<?php echo '/search-results/?country=select+country&category='.$cat.'&post_type=post+type+curators-cat'; ?>" class="catlabel">
									<i class="<?php echo categoryLogo(array('category' => $cat)); ?>"></i>
									<span class="label-post"><?php echo $cat; //観光 ?> </span> 
								</a>
							<?php endforeach; ?>
						<?php else: ?>
							<!-- <a href="#" class="catlabel"><i class="fa fa-hotel"></i> No Category</a> -->
						<?php endif; ?>               
						</div>

					</li>
				<?php endwhile ;  endif;  
				 wp_reset_postdata();?>
			 	 </div>
				<?php if ( $wp_query->have_posts() ) : ?>
					<p>
						<a class="custom-defaultpagi custom-publish" href="#" data-slug="home" data-post-type="acme_article" data-post-per-page="9" data-paged="1" data-status="publish" data-orderby="post_date" data-order="DESC">
						Load More</a>
						<input type="hidden" class="custom-publish-pp" value="<?php echo $paged ?>">
					</p>
				<?php  endif; ?>
			</ul>
		

		</div>
		<!-- start sidebar -->

		<div class="sidebox">
			<div class="socketlabs">
				<a href="#">
					<img src="<?php echo get_template_directory_uri(); ?>/images/socketlabs.jpg" alt="">
				</a>
			</div>

			<a href="<?php echo bloginfo() ?>/curators/"><button type="button" class="btn btn-default curators">See Curators</button></a>
			<?php echo do_shortcode( '[most_view]' ); ?> 
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
<?php get_footer(); ?>