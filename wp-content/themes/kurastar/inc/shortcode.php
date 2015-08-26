<?php

class MyShortcode {


	public static function ranking_country_func() {
				
		$taxonomy = 'article_country_cat';

		$args = array(
		    'orderby'           => 'count', 
		    'order'             => 'DESC',
		    'hide_empty'        => true, 
		    'number' => '5'
		); 

		$countries = get_terms($taxonomy, $args);

		ob_start();?>

			<div class="sideboxcontent rankwrap">
				<h3 class="sidetitle">Ranking Country</h3>
				<ul class="rankarticle rankcountry">
					<?php
					 foreach($countries as $key => $country):
					 	
						if($country->count > 0):
						?>
							<li>
								<a href="<?php echo get_term_link($country) ?>">
									<span class="rank rank1"><?php echo $key ?></span>
									<div class="siderankimage2"style="background-image:url(<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url($country->term_id); ?>);"></div>
									<h4 class="ranktitle">
									<?php echo $country->name; ?>
									</h4>
									<span class="smallpoints smallpoints-right"><?php echo $country->count ?> <?php echo $country->count > 1 ? 'articles' : 'article';?></span>
								</a>
							</li>
					<?php endif; ?>
				<?php endforeach; ?>
				</ul>
			</div>

		<?php 

		return ob_get_clean();
	}


	public static function ranking_article_func() {

		ob_start();
		?>

		<div class="sideboxcontent rankwrap">

			<h3 class="sidetitle">Ranking Article</h3>
			<ul class="rankarticle">

				<?php
				  query_posts( array( 'post_type' => 'acme_article', 
				  	'orderby' => 'post_view', 
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
			
		<?php 
		
		return ob_get_clean();

	}


	public static function dropdown_country_func() {
		ob_start();
		?>

		<div class="dropcountry">
			<div class="pointer"></div>
			
			<div class="mCustomScrollbar light" data-mcs-theme="minimal-dark">
				<div class="droplistcountry">
					<div>

						<?php //wp_nav_menu( array('menu' => 'country-menu')); ?>
						<ul id="menu-country-menu" class="menu">
							
						<?php

						$taxonomy = array( 
						    'article_country_cat'
						);

						$args = array(
						    'orderby'           => 'name', 
						    'order'             => 'ASC',
						    'hide_empty'        => false, 
						    'hierarchical'      => true, 
						    'pad_counts'        => false,
						    'parent'			=> 0
						); 

						$parents = get_terms($taxonomy, $args);

						foreach ($parents as $key => $parent):
						?>
								<li class="menu-continent disabled menu-item menu-item-type-custom menu-item-object-custom menu-item-<?php echo $parent->term_id ?>">
									<a><?php echo $parent->name ?></a>
								</li>


								<?php
								$param = array(
							 				'orderby'           => 'name', 
						    				'order'             => 'ASC',
						                    'taxonomy' => $taxonomy,
						                    'parent'   => $parent->term_id,
						                    'hide_empty'        => false, 
						                  );

						        $subcategories = get_categories($param);      
						        foreach($subcategories as $sub):
						        ?>
						           <li class="option menu-item menu-item-type-custom menu-item-object-custom menu-item-<?php echo $parent->term_id ?>"><a><?php echo $sub->name ?></a></li>
						        <?php
						        endforeach;

						endforeach;
						?>

						</ul>

					</div>
				</div>
			</div>
		</div>

		<?php
		return ob_get_clean();
	}

	public static function dropdown_category_func() {
		ob_start();
		?>
		<div class="dropcategory">
		<div class="pointer"></div>
			<div class="mCustomScrollbar light" data-mcs-theme="minimal-dark">
				<div class="droplistcategory">
					<div>
					<ul id="menu-category-menu" class="menu">
						
					<?php
					$taxonomy = '';
					$args = '';

					$taxonomy = array( 
					    'article_cat'
					);

					$args = array(
					    'orderby'           => 'name', 
					    'order'             => 'ASC',
					    'hide_empty'        => false, 
					    'hierarchical'      => true, 
					    'child_of'          => 0,
					    'childless'         => false,
					    'pad_counts'        => false
					); 

					$categories = get_terms($taxonomy, $args);


					foreach ($categories as $key => $category):
					?>
						<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-<?php echo $category->term_id ?>">
							<a><?php echo $category->name ?></a>
						</li>
					<?php 		
					endforeach;
					?>
					
					</ul>
					</div>
					<div></div>
				</div>
			
			</div>
		</div>

		<?php
		return ob_get_clean();
	}

 }
 
 add_shortcode( 'ranking_country', array( 'MyShortcode', 'ranking_country_func' ) );
 add_shortcode( 'ranking_article', array( 'MyShortcode', 'ranking_article_func' ) );
 add_shortcode( 'dropdown_country', array( 'MyShortcode', 'dropdown_country_func' ) );
 add_shortcode( 'dropdown_category', array( 'MyShortcode', 'dropdown_category_func' ) );