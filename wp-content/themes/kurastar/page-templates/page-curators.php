<?php 
/*Template Name: Curators Page
*/
get_header(); ?>
<div class="defaultWidth center clear-auto bodycontent bodycontent-index ">
	<div class="contentbox">
		<div class="contentbox">
            <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
            </div>
<!-- 
            <span class="search-results">
              Curator:
            </span> -->

            <!-- Tab panes -->
            <ul class="post-list-thumb curator-list-thumb">
              	<?php

				$users = get_users( 'orderby=nicename&role=subscriber&post_per_page=2' );

           		// Start the Loop.
           		foreach($users as $user):
           			$curator_profile = get_cupp_meta($user->ID, 'thumbnail');
           			$post_count = count_user_posts($user->ID, 'acme_article');
           		?>
                <li>
                  <a href="<?php echo site_url(); ?>/curator-detail/?id=<?php echo $user->ID ?>" class="post-list-thumb-wrap curator-list">
                  <div class="infobelow">
                    <?php
                      $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
                    ?>
                    <div class="postimg user-<?php echo $user->ID ?>" style="background: url(<?php echo $curator_profile; ?> )"></div>
                      <div class="curator-info">
                        <h4><?php echo $user->display_name; ?></h4>
                        <p><?php echo get_user_meta($user->ID, 'description', true); ?></p>
                        <div class="clear"></div>
                      </div>
                    <span class="article-views smallpoints-right"><?php echo $post_count ?> <?php echo $post_count > 1 ? 'articles' : 'article'; ?></span>
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

		<a href="<?php echo site_url() ?>/curator/"><button type="button" class="btn btn-default curators">See Curators</button></a>
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
		?>
	</div>	

	
</div>
get_footer();
