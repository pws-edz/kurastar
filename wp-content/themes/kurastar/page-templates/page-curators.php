<?php 
/*Template Name: Curators Page
*/
get_header(); ?>
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
                  <a href="<?php echo site_url(); ?>/curator-detail/?id=<?php echo $user->ID ?>" class="curator-list-thumb-wrap curator-list">
                    <div class="infobelow">
                      <div class="postimg user-<?php echo $user->ID ?>" style="background: url(<?php echo $profile; ?> )"></div>
                        <div class="curator-info">
                          <h4><?php echo $user->display_name; ?></h4>
                          <p><?php $description = get_user_meta($user->ID, 'description', true); 
                             if (strlen($description) > 80) {echo mb_strimwidth($description, 0, 65). '...'; } else {echo $description;}?></p>
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

		<a href="<?php echo site_url() ?>/curators/"><button type="button" class="btn btn-default curators">See Curators</button></a>
		<?php echo do_shortcode( '[most_view]' ); ?> 
		
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