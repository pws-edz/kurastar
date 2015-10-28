<?php 

/*Template Name: Home*/
global $wp;
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
			<h2 class="whatsnew">ー最新情報ー</h2>
			<ul class="post-list-thumb post-list-default">

				<div class="post-publish-wrapper">
				<?php

				 	 //query_posts(array( 'post_type' => 'acme_article','posts_per_page' => 9, 'post_status' => 'publish', 'paged' => get_query_var('page')) );
				     $paged = ( get_query_var('page') > 1 ) ? get_query_var('page') : 1;

		            $param = array( 
		                    'post_type'       => 'acme_article', 
		                    'posts_per_page'  => 9, 
		                    'paged'           => $paged, 
		                    'post_status'     => 'publish',
		                    'orderby'         => 'post_date',
		                    'order'           => 'DESC');

		            $wp_query = new WP_Query( $param );

					 if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();

					 	//Returns All Term Items for "my_taxonomy"
						$category          = wp_get_post_terms($post->ID, 'article_cat', array("fields" => "names"));
						$countries         = wp_get_post_terms($post->ID, 'article_country_cat', array("fields" => "names"));
						$authorID          = get_the_author_meta($post->ID);
						$curator_profile   = get_cupp_meta($authorID, 'thumbnail');
						$custom_image_link = get_post_meta( $post->ID, '_custom_image_link', true);

				    ?>
					<li id="post-<?php echo the_ID() ?>" class="post-<?php echo the_ID() ?> post">

						<a href="<?php echo get_permalink(); ?>" class="post-list-thumb-wrap">
							<div class="postimg" style="background: url(<?php echo getArticleImage($post->ID); ?>)"></div>
						</a>

						<div class="labels ">
						<?php if($countries): ?>
							<?php foreach($countries as $country): ?>
								<a href="<?php echo '/search-results/?country='.$country.'&category=select+category&post_type=post+type+curators-cat'; ?>" class="countrylabel">
									<i class="fa fa-map-marker"></i> 
									<span class="label-post"><?php echo $country; //フィリピン ?></span>
									
								</a>
							<?php endforeach; ?>
						<?php else: ?>
							<a href="#" class="countrylabel"><i class="fa fa-map-marker"> No Country</i></a>
						<?php endif; ?>

						<?php if($category): ?>
							<?php foreach($category as $cat): ?>
								<a href="<?php echo '/search-results/?country=select+country&category='.$cat.'&post_type=post+type+curators-cat'; ?>" class="catlabel">
									<i class="<?php echo categoryLogo(array('category' => $cat)); ?>"></i>
									<span class="label-post"><?php echo $cat; //観光 ?> </span> 
								</a>
							<?php endforeach; ?>
						<?php else: ?>
							<!-- <a href="#" class="catlabel"><i class="fa fa-hotel"></i> No Category</a> -->
						<?php endif; ?>               
						</div>

					</li>
				<?php endwhile ;  endif;  
				 wp_reset_postdata();?>
			 	 </div>
				<?php if ( $wp_query->have_posts() ) : ?>
					<p>
						<a class="custom-defaultpagi custom-publish" href="#" data-slug="home" data-post-type="acme_article" data-post-per-page="9" data-paged="1" data-status="publish" data-orderby="post_date" data-order="DESC">
						Load More</a>
						<input type="hidden" class="custom-publish-pp" value="<?php echo $paged ?>">
					</p>
				<?php  endif; ?>
			</ul>
		

		</div>
		<!-- start sidebar -->

		<div class="sidebox">
			<div class="socketlabs">
				<a href="#">
					<img src="<?php echo get_template_directory_uri(); ?>/images/socketlabs.jpg" alt="">
				</a>
			</div>

			<a href="<?php echo bloginfo() ?>/curators/"><button type="button" class="btn btn-default curators">See Curators</button></a>
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
<?php get_footer(); ?>