<?php
/*
  Template Name: Curator
 */

get_header(); ?>
<div class="mainbanner">
            <div class="flexslider">
              <ul class="slides">
                <li><img src="<?php echo get_template_directory_uri(); ?>/images/main_image.jpg" /></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/images/main_image2.jpg" /></li>
              </ul>
            </div>
            <div class="defaultWidth center searchwrap">
            <form>
              <div class="searchwrap-inner">
                <div class="transwrap">
                  <input id="cty" type="text" value="select country" readonly />
                </div>
                <div class="transwrap">
                  <input id="cat" type="text" value="select category" readonly />
                </div>
                <input type="submit" class="search-btn" value="" />
                
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
<?php if ( have_posts() ) : ?>
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
              Curator:
            </span>

            <!-- Tab panes -->
            <ul class="post-list-thumb curator-list-thumb">
              <?php
            // Start the Loop.
            while ( have_posts() ) : the_post(); ?>
                <li>
                  <a href="<?php echo get_permalink(); ?>" class="post-list-thumb-wrap curator-list">
                  <div class="infobelow">
                    <?php
                      $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
                    ?>
                    <div class="postimg" style="background: url(<?php echo $src[0]; ?> )"></div>
                      <div class="curator-info">
                        <h4><?php the_title(); ?></h4>
                        <p><?php the_content(); ?></p>
                        <div class="clear"></div>
                      </div>
                    <span class="article-views">966 views</span><span class="smallpoints smallpoints-right"> <i class="fa fa-heart active"></i>3,456 likes</span> 
                  </div>
                </a>
                </li>
                 <?php  endwhile;?> 
            </ul>
              <!----- start pagination ------>
            
              <ul class="pagination pagination-desktop">
                <a href="#" aria-label="Previous">
                      <span aria-hidden="true"><i class="fa fa-angle-left"></i>Previous</span>
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
      <a href="<?php echo site_url() ?>/curator/"><button type="button" class="btn btn-default curators">See Curators</button></a>
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
<div class="pagination">
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
</div>


<?php get_footer(); ?>
