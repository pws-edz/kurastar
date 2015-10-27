<?php 
/*Template Name: Curators Page
*/
get_header(); ?>
<div class="mainbanner">
  <div class="flexslider">
    <ul class="slides">
      <?php $row = 1; if(get_field('home_slider', 6)): ?>
         <?php while(has_sub_field('home_slider', 6)): ?>
          <li><img src="<?php the_sub_field('slider_image'); ?>" /></li>
         <?php $row++; endwhile; ?>
      <?php endif; ?>
    </ul>
  </div>
  <div class="defaultWidth center searchwrap">
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
<div class="defaultWidth center clear-auto bodycontent bodycontent-index ">
	<div class="contentbox">
		<div class="contentbox">
            <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
            </div>
            <span class="search-results">
              Curator:
            </span>


            <!-- Tab panes -->
            <ul class="post-list-thumb curator-list-thumb">
            	<?php

              $users = get_users('orderby=nicename&post_per_page=2');   
           		// Start the Loop.
           		foreach($users as $user):
                
                $profile = getCurrentProfile(array('user_id' => $user->ID));
           			$post_count = count_user_posts($user->ID, 'acme_article');
           		?>
                <li>
                  <a href="<?php echo site_url(); ?>/curator-detail/?id=<?php echo $user->ID ?>" class="post-list-thumb-wrap curator-list">
                  <div class="infobelow">
                    <div class="postimg user-<?php echo $user->ID ?>" style="background: url(<?php echo $profile; ?> ) no-repeat; background-size: cover; background-position: center; max-width: 100%;"></div>
                      
                     <div class="curator-info-div">
                       <div class="curator-info">
                          <h4><?php echo $user->display_name; ?></h4>
                          <p><?php $description = get_user_meta($user->ID, 'description', true); 
                             if (strlen($description) > 80) {echo mb_strimwidth($description, 0, 65). '...'; } else {echo $description;}?></p>
                          <div class="clear"></div>


                        </div>

                        <span class="article-views smallpoints-right"><?php echo $post_count ?> <?php echo $post_count > 1 ? 'articles' : 'article'; ?></span>

                     </div>
                      


                  </div>
                </a>
                </li>
                 <?php endforeach;?>
            </ul>
		</div>
	</div>


	<div class="sidebox">
		<div class="socketlabs">
			<a href="#">
				<img src="<?php echo get_template_directory_uri(); ?>/images/socketlabs.jpg" alt="">
			</a>
		</div>

		<a href="<?php echo site_url() ?>/curators/"><button type="button" class="btn btn-default curators">See Curators</button></a>
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
<?php  get_footer(); ?>