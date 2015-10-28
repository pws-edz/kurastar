<?php 
/*Template Name: Register
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
	<div class="defaultWidth center clear-auto bodycontent registration-page">
	<div class="contentbox nosidebar">
		<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
        <?php if(function_exists('bcn_display'))
        {
            bcn_display();
        }?>
    </div>
	  <div class="row">
		  <div class="col-md-6 form-left">
		  	<h2>User registration:</h2>
		  	<div class="user-register">
			  	<p class="reg-copy">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
				  <?php echo do_shortcode('[do_registration]'); ?>


				</div>
		  </div>
		  <div class="col-md-6 form-right">
		  	<div class="user-login">
		  		<h2>Login:</h2>
			 	<?php echo do_shortcode( '[do_login]') ?>
			</div>
			<?php if ( !is_user_logged_in() ) { ?>
			<div class="sns-login sns-desktop">
				<div></div>
				<h2>SNS Login:</h2>
				<ul class="list-inline">
					<?php $row = 1; if(get_field('sns_log_in_list')): ?>
	      				<?php while(has_sub_field('sns_log_in_list')): ?>
							<li>
								<?php the_sub_field('sns_social_link'); ?>
									<?php the_sub_field('sns_social'); ?>
								</a>
							</li>
						<?php $row++; endwhile; ?>
					<?php endif; ?>
				</ul>
			</div>
			<div class="sns-login sns-mobile">

				<h2>SNS Login:</h2>

				<ul class="list-inline">
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				</ul>
			</div>
			<?php } ?>
		  </div>
	  </div>
</div>
</div>
<?php get_footer(); ?>