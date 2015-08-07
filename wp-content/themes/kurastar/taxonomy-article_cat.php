<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
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
              フィリピン, グルメ result (6 items):
            </span>

            <!-- Tab panes -->
            <ul class="post-list-thumb">
              <?php
            // Start the Loop.
            while ( have_posts() ) : the_post(); ?>
                <li>
                    <a href="<?php echo get_permalink(); ?>" class="post-list-thumb-wrap">
                    <?php
                      $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
                    ?>
                    <div class="postimg" style="background: url(<?php echo $src[0]; ?> )"></div>
                      <div class="labels">
                        <span class="countrylabel"><i class="fa fa-map-marker"></i> フィリピン</span>
                        <span class="catlabel"><i class="fa fa-hotel"></i> 観光</span>
                      </div>
                      <div class="desc">
                        <h2><?php the_title(); ?></h2>
                        <p><?php the_content(); ?></p>
                      </div>
                      <div class="infobelow">
                        <i class="fa fa-heart"></i>
                        <span class="smallpoints smallpoints-left">14,091 likes</span>
                        <div class="profile-thumb-wrap">
                          <span class="smallpoints smallpoints-left">999 views</span>
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
                 <?php  endwhile;?>
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
    <div class="sidebox">
      <div class="socketlabs">
        <a href="#">
          <img src="<?php echo get_template_directory_uri(); ?>/images/socketlabs.jpg" alt="">
        </a>
      </div>
      <a href="http://wpkurastar.local/curators-cat/curators/"><button type="button" class="btn btn-default curators">See Curators</button></a>
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
