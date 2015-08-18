<?php 

/*Template Name: Home*/

get_header(); ?>

	<div class="mainbanner">
						<div class="flexslider">
							<ul class="slides">
								<?php $row = 1; if(get_field('home_slider')): ?>
									 <?php while(has_sub_field('home_slider')): ?>
									 	<li><img src="<?php the_sub_field('slider_image'); ?>" /></li>
									 <?php $row++; endwhile; ?>
								<?php endif; ?>
							</ul>
						</div>
						<div class="defaultWidth center searchwrap">
						<form method="POST" action="search-results/">
							<div class="searchwrap-inner">
								<div class="transwrap">
									<input id="cty" type="text" name="country" value="select country" readonly />
								</div>
								<div class="transwrap">
									<input id="cat" type="text" name="category" value="select category" readonly />
								</div>
								<input type="submit" class="search-btn" value="post type curators-cat" name="post_type" />
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
				</div>
	<div class="defaultWidth center clear-auto bodycontent bodycontent-index ">
		<div class="contentbox">
			<h2 class="whatsnew">ー最新情報ー</h2>

			<!----- start pagination ------>

			<ul class="post-list-thumb">
			<?php
				  get_wpposts();
				  query_posts( array( 'post_type' => 'acme_article', '' => '' ) );
				  if ( have_posts() ) : while ( have_posts() ) : the_post();
			?>
				<li>
				  <a href="<?php echo get_permalink(); ?>" class="post-list-thumb-wrap">
	                    <?php
	                      $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
	                    ?>
	                    <div class="postimg" style="background: url(<?php echo $src[0]; ?> )"></div>
	                      <div class="labels">
	                        <span class="countrylabel"><i class="fa fa-map-marker"></i> <?php the_field('select_country'); //フィリピン ?></span>
	                        <span class="catlabel"><i class="fa fa-hotel"></i> <?php the_field('category'); //観光 ?> </span>
	                      </div>
	                      <div class="desc">
	                        <h2><?php the_title(); ?> </h2>
	                        <p><?php the_content(); ?></p>
	                      </div>
	                      <div class="infobelow">
	                        <i class="fa fa-heart"></i>
	                        <span class="smallpoints smallpoints-left">14,091 likes</span>
	                        <div class="profile-thumb-wrap">
	                          <span class="smallpoints smallpoints-left"><?php echo do_shortcode( '[post_view]' ); ?> views</span>
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
			
			<?php endwhile ; endif; wp_reset_query();?>
			</ul>

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
		<!---- start sidebar ---->



		<div class="sidebox">
			<div class="socketlabs">
				<a href="#">
					<img src="<?php echo get_template_directory_uri(); ?>/images/socketlabs.jpg" alt="">
				</a>
			</div>

			<a href="http://wpkurastar.local/curators-cat/curators/"><button type="button" class="btn btn-default curators">See Curators</button></a>
			<?php echo do_shortcode( '[most_view]' ); ?> 
			<div class="sideboxcontent ad300">
				<img src="<?php echo get_template_directory_uri(); ?>/images/300x300.jpg" />
			</div>
			<div class="sideboxcontent rankwrap">

				<h3 class="sidetitle">Ranking Article</h3>
				<ul class="rankarticle">

					<?php
					  query_posts( array( 'post_type' => 'acme_article', 
					  	'orderby' => 'meta_value', 
					  	'meta_key' => '_count-views_all',
 						'order' => 'DESC', 
 						'posts_per_page' => '5' ) );

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
							<span class="smallpoints smallpoints-right"><?php echo do_shortcode( '[post_view]' ); ?> views</span>
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
							<?php $row = 1; if(get_field('features')): ?>
      							<?php while(has_sub_field('features')): ?>
									<div class="siderankimage2"style="background-image:url(<?php the_sub_field('featured_image');?>);"></div>
								<?php $row++; endwhile; ?>
							<?php endif; ?>
							<h4 class="ranktitle">
							<?php the_title(); ?>
							</h4>
							<span class="smallpoints smallpoints-right">9 articles</span>
						</a>
					</li>
				<?php endwhile; endif; wp_reset_query(); ?>
				</ul>
			</div>
		</div>	
	</div>

<?php get_footer(); ?>