<?php 
/*Template Name: Curator Page
*/
get_header(); 

 $user_id = $_GET['id'];

 if(!$user_id) {
    wp_redirect( '/curators' ); exit();
 } 

$user = get_userdata( $user_id );
if ( $user === false ) {
  wp_redirect( '/curators' ); exit();
} 


$user_posts = count_user_posts($user->ID, 'acme_article');


$args = array(
      'post_type'      => 'acme_article',
      'author'         => $user->ID,
      'orderby'        => 'post_date',
      'order'          => 'ASC',
      'posts_per_page' => -1
    );

$posts = get_posts($args);
$curator_profile = get_avatar_url(get_avatar( $user->ID ));


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
<div class="defaultWidth center clear-auto bodycontent bodycontent-index ">
  <div class="contentbox">

      <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
          <?php echo function_exists('custom_breadcrumb') ? custom_breadcrumb() : ''; ?>
     </div><!-- .breadcrumb -->';

      <div class="curator-detail-wrap">

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="pointer2"></div>
        <?php $profile = getCurrentProfile(array( 'user_id' => $user->ID )); ?>
        
          <?php 
            $current_user_id = get_current_user_id();
            if($current_user_id == $user->ID){ 
          ?>
            <div class="img-round cur-pic">
                  <img id="uploaded_image"  src="<?php echo $profile; ?>" class="avatar avatar-96 photo " >
                  <span class="icon-cam-holder">
                    <img src="<?php echo get_template_directory_uri().'/images/icons/camera.png'; ?>" id="change-image" class="avatar avatar-96 photo">
                  </span>
            </div>
          <?php }else{ ?>
            <div class="img-round">
                <img id="uploaded_image"  src="<?php echo $profile; ?>" class="avatar avatar-96 photo " height="96" width="96" >
            </div>
          <?php } ?>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-8">

            <div class="article-content">
              <div class="labels labels2">
              <span class="countrylabel"><b><?php echo $user_posts ?></b> <?php echo $user_posts > 1 ? 'Articles' : 'Article'?></span>
              <span class="catlabel"><b><?php echo count_user_favorites($user->ID) ?></b> Favorites </span>
            </div>

            <div class="curator-info">
              <form method="POST" id="edit-custom-form" enctype="multipart/form-data">
                <div class="display_details">
                  <span id="edit-form">
                    <h4>
                        <?php echo $user->display_name ?> 
                    </h4>
                    <p> <?php echo get_the_author_meta( 'description', $user->ID ) ?></p>
                  </span>
                  <?php 

                    $current_user    = wp_get_current_user(); 
                  ?>
                  <?php if(is_user_logged_in() && $current_user->ID == $user->ID) : ?>
                    <span class="catlabel"><a href="#" class="edit-custom-form">Edit</a> </span>
                  <?php endif; ?>
                </div>

                <!-- <div style="display:none;" class="userinfo_section"> -->
                


                <div style="display:none;" class="display_section">
                  <div class="row">
                    <div class="form-grp form-placeholder-offset input-user">
                      <input type="file" name="profile" id="post_image" accept="image/*" class="form-control form-control-stroked" style="visibility: hidden;">
                      <input type="text" name="full_name" class="form-control form-control-stroked" id="full_name" placeholder="Full Name" value="<?php echo $user->display_name ?>">

                    </div>
                  </div>
                   <div class="row">
                    <div class="form-grp form-placeholder-offset desc-user">
                      <textarea name="user_description" placeholder="Information" class="form-control form-control-stroked"><?php echo get_the_author_meta( 'description', $user->ID ) ?></textarea>
                    </div>
                  </div>
                   <input type="hidden" name="update_user_info" value="_update_user_info">
                   <input type="hidden" name="user_id" value="<?php echo $user->ID ?>">
                   <a href="#" class="btn catlabel update_process"><?php _e('Save', 'wp') ?></a>
                   <a href="#" class="btn catlabel cancel_process"><?php _e('Cancel', 'wp') ?></a>
                </div>
                <div class="clear"></div>
              </form>
            </div>
            <div class="clear"></div>
              </div>
            </div>
            </div>
            
            
        

          
      </div>
        

    <div class="tab-form-panel">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs curator-tabs" role="tablist">
        <li role="presentation" class="<?php echo $_GET['status'] == 'publish' ? 'active' : $_GET['status'] == '' ? 'active' : ''; ?> curator-tab-list">
          <a href="#1" aria-controls="1" role="tab" data-toggle="tab">Articles</a>
        </li>
        <li role="presentation" class="curator-tab-list">
          <a href="#2" aria-controls="2" role="tab" data-toggle="tab">Favorites</a>
        </li>
        <li role="presentation" class="<?php echo $_GET['status'] == 'draft' ? 'active' : ''; ?> curator-tab-list">
          <a href="#3" aria-controls="3" role="tab" data-toggle="tab">Drafts</a>
        </li>
      </ul>


      <!-- ARTICLES -->

      <!-- Tab panes -->
      <div class="tab-content curator-tab-content curator-tab-content">
        <div role="tabpanel" class="tab-pane <?php echo $_GET['status'] == 'publish' ? 'active' : $_GET['status'] == '' ? 'active' : ''; ?>" id="1">
          <ul class="post-list-thumb post-publish">
             <div class="post-publish-wrapper"> 
          <?php

            $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
            $param = array( 
                    'post_type'       => 'acme_article', 
                    'posts_per_page'  => 2, 
                    'paged'           => $paged, 
                    'author'          => $user->ID, 
                    'post_status'     => 'publish',
                    'orderby'         => 'post_date',
                    'order'           => 'DESC');

            $wp_query = new WP_Query( $param );


              if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
          ?>
           
              <li id="post-publish-<?php echo the_ID() ?>" class="post-publish-<?php echo the_ID() ?> post-publish-list list-thumb">
                <a href="<?php echo get_permalink(); ?>" class="post-list-thumb-wrap post-id<?php echo $post->ID ?>">
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
                          <?php echo $country; //フィリピン ?>
                        </a>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <!-- <a href="#" class="countrylabel"><i class="fa fa-map-marker"> No Country</i></a> -->
                    <?php endif; ?>

                    <?php if($category): ?>
                      <?php foreach($category as $cat): ?>
                        <a href="<?php echo '/search-results/?country=select+country&category='.$cat.'&post_type=post+type+curators-cat'; ?>" class="catlabel">
                          <i class="<?php echo categoryLogo(array('category' => $cat)); ?>"></i> 
                          <?php echo $cat; //観光 ?> 
                        </a>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <!-- <a href="#" class="catlabel"><i class="fa fa-hotel"></i> No Category</a> -->
                    <?php endif; ?>               
                  </div>
              </li>
          
             
          
          <?php 
          endwhile ;   
          else:?>
          <li><p> No available articles.</p></li>
          <?php endif;   
           wp_reset_postdata();
           ?>
             </div>
             <?php if ( $wp_query->have_posts() ) : ?>
             <p>
              <a class="custom custom-publish" href="#" data-slug="curator-detail" data-post-type="acme_article" data-post-per-page="2" data-paged="1" data-author="<?php echo $user->ID ?>" data-status="publish" data-orderby="post_date" data-order="DESC">
                Load More</a>
                <input type="hidden" class="custom-publish-pp" value="<?php echo $paged ?>">
              </p>
            <?php endif; ?>
          </ul>
        </div>
        
        
        <!-- FAVORITES -->
        <!--tab 1-->
        <div role="tabpanel" class="tab-pane" id="2">

            <ul class="post-list-thumb post-favorite">
             <div class="post-favorite-wrapper">
           <?php 
            $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

            $fav_args = array(
                  'post_type'       => 'acme_article', 
                  'posts_per_page'  => 2, 
                  'paged'           => $paged, 
                  'meta_query'        => array(
                    'relation'  => 'AND',
                      array(
                          'key' => '_user_liked',
                          'value' => $user->ID,
                          'compare' => '='
                      )
                  )
              );

              //    query_posts( $fav_args );
              // if ( have_posts() ) : while ( have_posts() ) : the_post();

              $query_favorite = new WP_Query( $fav_args );

              if ( $query_favorite->have_posts() ) : while ( $query_favorite->have_posts() ) : $query_favorite->the_post();
              //Returns All Term Items for "my_taxonomy"
                $category          = wp_get_post_terms($post->ID, 'article_cat', array("fields" => "names"));
                $countries         = wp_get_post_terms($post->ID, 'article_country_cat', array("fields" => "names"));
                $authorID          = get_the_author_meta($post->ID);
                // $curator_profile   = get_cupp_meta($authorID, 'thumbnail');
                $curator_profile   = get_avatar( $authorID );
                $custom_image_link = get_post_meta( $post->ID, '_custom_image_link', true);

              ?>  
              <li id="post-favorite-<?php echo the_ID() ?>" class="post-favorite-<?php echo the_ID() ?> post-favorite-list list-thumb">
              <a href="<?php echo get_permalink(); ?>" class="post-list-thumb-wrap post-id<?php echo $post->ID ?>">
              <div class="postimg" style="background: url(<?php echo getArticleImage($post->ID); ?>)"></div>
                
              </a>
              <div class="labels">
                  <?php if($countries): ?>
                    <?php foreach($countries as $country): ?>
                      <a href="<?php echo '/search-results/?country='.$country.'&category=select+category&post_type=post+type+curators-cat'; ?>" class="countrylabel">
                        <i class="fa fa-map-marker"></i> 
                        <?php echo $country; //フィリピン ?>
                      </a>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <a href="#" class="countrylabel"><i class="fa fa-map-marker"> No Country</i></a>
                  <?php endif; ?>
                  <?php if($category): ?>
                    <?php foreach($category as $cat): ?>
                      <a href="<?php echo '/search-results/?country=select+country&category='.$cat.'&post_type=post+type+curators-cat'; ?>" class="catlabel">
                        <i class="<?php echo categoryLogo(array('category' => $cat)); ?>"></i> 
                        <?php echo $cat; //観光 ?> 
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
              <li><p> No available articles.</p></li>
              <?php endif;  

               wp_reset_postdata();
               ?>
                </div>
                <?php if($query_favorite->have_posts()): ?>
                 <p>
                  <a class="custom-favpagi custom-favorite" href="#" data-slug="curator-detail" data-author="<?php echo $user->ID ?>" data-status="favorite">
                    Load More</a>
                    <input type="hidden" class="custom-favorite-pp" value="<?php echo $paged ?>">
                  </p>
                <?php endif; ?>
            </ul>
        </div>
        
        <!-- DRAFT -->
        <!--tab 2-->
        <div role="tabpanel" class="tab-pane <?php echo $_GET['status'] == 'draft' ? 'active' : ''; ?>" id="3">
           <ul class="post-list-thumb post-draft">
            <div class="post-draft-wrapper">
          <?php
  
            $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
            $param = array( 
                    'post_type'       => 'acme_article', 
                    'posts_per_page'  => 2, 
                    'paged'           => $paged, 
                    'author'          => $user->ID, 
                    'post_status'     => 'draft',
                    'orderby'         => 'post_date',
                    'order'           => 'DESC');


            $query_draft = new WP_Query( $param );

              if ( $query_draft->have_posts() ) : while ( $query_draft->have_posts() ) : $query_draft->the_post();

               //Returns All Term Items for "my_taxonomy"
                $category = wp_get_post_terms($post->ID, 'article_cat', array("fields" => "names"));
                $countries  = wp_get_post_terms($post->ID, 'article_country_cat', array("fields" => "names"));

                $authorID = get_the_author_meta($post->ID);
                $curator_profile = get_cupp_meta($authorID, 'thumbnail');

                $custom_image_link =  get_post_meta( $post->ID, '_custom_image_link', true);

            ?>
            <li id="post-draft-<?php echo the_ID() ?>" class="post-draft-<?php echo the_ID() ?> post-draft-list list-thumb">
              <a href="<?php echo get_permalink(); ?>" class="post-list-thumb-wrap post-id<?php echo $post->ID ?>">
              <div class="postimg" style="background: url(<?php echo getArticleImage($post->ID); ?>)"></div>
                
              </a>
              <div class="labels">

                  <?php if($countries): ?>
                    <?php foreach($countries as $country): ?>
                      <a href="<?php echo '/search-results/?country='.$country.'&category=select+category&post_type=post+type+curators-cat'; ?>" class="countrylabel">
                        <i class="fa fa-map-marker"></i> 
                        <?php echo $country; //フィリピン ?>
                      </a>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <a href="#" class="countrylabel"><i class="fa fa-map-marker"> No Country</i></a>
                  <?php endif; ?>

                  <?php if($category): ?>
                    <?php foreach($category as $cat): ?>
                      <a href="<?php echo '/search-results/?country=select+country&category='.$cat.'&post_type=post+type+curators-cat'; ?>" class="catlabel">
                        <i class="<?php echo categoryLogo(array('category' => $cat)); ?>"></i> 
                        <?php echo $cat; //観光 ?> 
                      </a>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <a href="#" class="catlabel"><i class="fa fa-hotel"></i> No Category</a>
                  <?php endif; ?>               
                </div>
            </li>

          
          <?php 
          endwhile ;   
          else:?>
          <li><p> No available articles.</p></li>
          <?php endif;  
           wp_reset_postdata();?>
            </div>
            <?php if ( $query_draft->have_posts() ) : ?>
             <p>
              <a class="custom custom-draft" href="#" data-slug="curator-detail" data-post-type="acme_article" data-post-per-page="2" data-paged="1" data-author="<?php echo $user->ID ?>" data-status="draft" data-orderby="post_date" data-order="DESC">
                Load More</a>
                <input type="hidden" class="custom-draft-pp" value="<?php echo $paged ?>">
              </p>
             <?php  endif; ?>
          </ul>
        </div><!--tab 3-->
      </div>
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
<script type="text/javascript">


</script>
<?php 
get_footer();