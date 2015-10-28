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


<?php  

    $slug = my_get_menu_item_slug();

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = array(
              'post_type' => 'acme_article',
              'tax_query' => array(
                'relation' => 'OR',
                array(
                  'taxonomy' => 'article_country_cat',
                  'field'    => 'slug',
                  'terms'    => $slug,
                ),
              ),
               'posts_per_page' => '9', 'paged' => $paged
            );


    $query = new WP_Query($args);

    //static 9 is used because the value of post_per_page is 9;    
    $startpost = 1;
    $startpost = 9*($paged - 1)+1;
    $endpost   = (9*$paged < $query->found_posts ? 9*$paged : $query->found_posts);

 ?>

<div class="banner">
  
  <div class="category-search">
    
    <form action="">
      <div class="category-search-title">
        <p>どこの国の写真をみたい？</p>
      </div>
      <select name="" id="country">
        <option value="hide">-- 国を選ぶ --</option>
        <option value="india">インド</option>
        <option value="indonesia">インドネシア</option>
        <option value="cambodia"> カンボジア</option>
        <option value="singapore">シンガポール</option>
        <option value="thailand">タイ</option>
        <option value="philippines">フィリピン</option>
        <option value="vietnam">ベトナム</option>
        <option value="malaysia">マレーシア</option>
        <option value="china">中国</option>
        <option value="taiwan">台湾</option>
        <option value="japan">日本</option>
        <option value="korea">韓国</option>
        <option value="hongkong">香港/マカオ</option>
        <option value="egypt">エジプト</option>
        <option value="dubai">ドバイ</option>
        <option value="middleeast">中東</option>
        <option value="usa">アメリカ</option>
        <option value="argentina">アルゼンチン</option>
        <option value="canada">カナダ</option>
        <option value="brazil">ブラジル</option>
        <option value="bolivia">ボリビア</option>
        <option value="mexico">メキシコ</option>
        <option value="australia">オーストラリア</option>
        <option value="guam">グアム</option>
        <option value="saipan">サイパン</option>
        <option value="hawaii">ハワイ</option>
        <option value="newzealand">ニュージーランド</option>
        <option value="uk">イギリス</option>
        <option value="italy">イタリア</option>
        <option value="austria">オーストリア</option>
        <option value="greece">ギリシャ</option>
        <option value="croatia">クロアチア</option>
        <option value="switzerland">スイス</option>
        <option value="spain">スペイン</option>
        <option value="czech-republic">チェコ</option>
        <option value="germany">ドイツ</option>
        <option value="france">フランス</option>

      </select>
      <select name="" id="category">
        <option value="">-- ジャンルを選ぶ --</option>
        <option value="life">生活</option>
        <option value="fashion">ファッション</option>
        <option value="gourmet">グルメ</option>
        <option value="hotel">ホテル</option>
        <option value="leisure">観光スポット</option>

      </select>
      <input type="submit" value="検索">
    </form>

  </div>
</div>
<?php if ( $query->have_posts() ) : ?>
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
              
              <?php   
                echo 'Country: ';
                echo getSearchKeyword();
              ?> 
              <?php echo $query->post_count > 1 ? 'results' : 'result'?> (<?php echo $startpost.'-'.$endpost.' of '.$query->found_posts ?> <?php echo $query->post_count > 1 ? 'items' : 'item' ?>):
            </span>

            <!-- Tab panes -->
            <ul class="post-list-thumb">
            <?php
              // Start the Loop.
              query_posts( array( 
                'post_type' => 'acme_article', 
                '' => '', 
                // 'meta_value' => $menu_slug
              ));

              while( $query->have_posts() ) : $query->the_post(); 
            ?>

                <li>
                  <a href="<?php echo get_permalink(); ?>" class="post-list-thumb-wrap">
                              <?php
                                //Returns All Term Items for "my_taxonomy"
                                $category        = wp_get_post_terms($post->ID, 'article_cat', array("fields" => "names"));
                                $countries       = wp_get_post_terms($post->ID, 'article_country_cat', array("fields" => "names"));
                                $authorID        = get_the_author_meta($post->ID);
                                $curator_profile = get_cupp_meta($authorID, 'thumbnail');

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
                                    <!-- <a href="#" class="catlabel"><i class="fa fa-hotel"></i> No Category</a> -->
                                  <?php endif; ?>               
                                </div>
                </li>
                 <?php  endwhile;?>

                 <?php 
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
<?php 
// If no content, include the "No posts found" template.
else :
get_template_part( 'content', 'none' );

endif;
        ?>


<?php get_footer(); ?>
