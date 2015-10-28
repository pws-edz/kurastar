<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
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

	<div id="primary" class="content-area container">
		<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part( 'content-curator', get_post_format() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'twentyfifteen' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'twentyfifteen' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php get_footer(); ?>
