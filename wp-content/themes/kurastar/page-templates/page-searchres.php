<?php 

/*Template Name: Search Results*/

get_header(); ?>

<?php  
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = args_func($_GET, $paged); 
    $query = new WP_Query($args);

    //static 9 is used because the value of post_per_page is 9;    
    $startpost=1;
    $startpost=9*($paged - 1)+1;
    $endpost = (9*$paged < $query->found_posts ? 9*$paged : $query->found_posts);

 ?>
<?php if (  $query->have_posts() ) : ?>
<div class="defaultWidth center clear-auto bodycontent bodycontent-index result-page ">
    <div class="contentbox">
    <!-- Nav tabs -->
            <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
          
                }?>
            </div>
            <span class="search-results">
            フィリピン, グルメ <?php echo $query->post_count > 1 ? 'results' : 'result'?> (<?php echo $startpost.'-'.$endpost.' of '.$query->found_posts ?> <?php echo $query->post_count > 1 ? 'items' : 'item' ?>):

            </span>

            <!-- Tab panes -->
            <ul class="post-list-thumb">
              <?php
                while (  $query->have_posts() ) : $query->the_post(); 
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
                    
                  ?>
                  <div class="postimg" style="background: url(<?php echo $src[0]; ?> )"></div>
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
                  </a>
              </li>
              <?php  
                endwhile;

                //wp pagenavi plugin for pagination   
                if(function_exists("wp_pagenavi")):

                 wp_pagenavi( array( 'query' => $query ) ); 

                endif;  

               wp_reset_query();?>
              ?>
            </ul>

    </div>
    <div class="sidebox">
      <div class="socketlabs">
        <a href="#">
          <img src="<?php echo get_template_directory_uri(); ?>/images/socketlabs.jpg" alt="">
        </a>
      </div>
      <a href="?<?php echo site_url() ?>/curator/"><button type="button" class="btn btn-default curators">See Curators</button></a>
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
// Previous/next page navigation.
the_posts_pagination( array(
    'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
    'next_text'          => __( 'Next page', 'twentyfifteen' ),
    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
) );

// If no content, include the "No posts found" template.
else :
get_template_part( 'content', 'none' );

endif;
        ?>


<?php get_footer(); ?>