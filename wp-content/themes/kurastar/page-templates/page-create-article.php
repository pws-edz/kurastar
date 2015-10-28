<?php 
/*Template Name: Create Article
*/
get_header(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<?php 
	global $wp_query;

	if (!is_user_logged_in()):
		wp_redirect( '/user-registration' ); exit();
	endif;

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
<div class="defaultWidth center clear-auto bodycontent bodycontent-index ">
	<div class="contentbox">
		
		<div class="contentbox">
            <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
            </div>

	    	<div class="form-results">
			<?php $result = false; ?>	
			<?php if(!empty( $_POST['action'] )): $result = post_acme_article($_POST); endif; ?>
			<?php if($result): ?>

					<?php $image_url = wp_get_attachment_url( get_post_thumbnail_id($result['post_id']) ); ?>
					<?php if($result['status'] == 'success'): ?>
						<div class="result-post alert result-post post-success" role="alert">
							<span class="glyphicon glyphicon-ok" aria-hidden="false"></span>
							<?php echo $result['msg'];  ?>	
						</div>
					<?php else: ?>
						<div class="result-post alert alert-danger" role="alert">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="false"></span>
							<?php echo $result['msg'];  ?>	
						</div>
					<?php endif; ?>

			<?php endif; ?>
    		</div>
    	</div>

    </div>
</div>
<div class="container">

	<form data-toggle="validator" role="form" class="createform" id="acme-article-post-type" name="acme_article_post_type" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">


		<div class="form-content">
	    	<p class="text-center title"><!-- fill up  custom post below --></p>
	    	<div class="gap-30"></div>
	    	<div class="col-md-4">
	    		<!-- <p>image preview</p> -->
	    		<div class="img-holder">
	    		<?php if(isset($image_url)): ?>
	  				<img id="article_featured_image_preview" src="<?php echo $image_url; ?>" alt="">
	  			<?php else: ?>
	  				<img id="article_featured_image_preview" src="<?php echo site_url() ?>/wp-content/themes/kurastar/images/blank-img.png" alt="">
	  			<?php endif; ?>
	  			</div>

	    		<div class="fileUpload">
					<input type="file" class="upload" id="upload-image" name="post_featured_img"/>
				</div>
	    	</div>
	    	<div class="col-md-8">
	    		<div class="form-grp">
	    			<div class="select-form">
	    				<p>select country</p>
						<select id="cty" name="post_country">
							<?php if(isset($result['country_id'])) : ?>
								<option value="<?php echo $result['country_id'].'@'.$result['country_name']; ?>"><?php echo $result['country_name']; ?></option>
							<?php endif;  ?>
						<?php

						$taxonomy = array( 
						    'article_country_cat'
						);

						$args = array(
						    'orderby'           => 'name', 
						    'order'             => 'ASC',
						    'hide_empty'        => false, 
						    'hierarchical'      => true, 
						    'pad_counts'        => false,
						    'parent'			=> 0
						); 

						$parents = get_terms($taxonomy, $args);

						foreach ($parents as $key => $parent):
						?>
							<option disabled>-----<?php echo $parent->name ?>-----</option>
							<?php
							$param = array(
						 				'orderby'           => 'name', 
					    				'order'             => 'ASC',
					                    'taxonomy' => $taxonomy,
					                    'parent'   => $parent->term_id,
					                    'hide_empty'        => false, 
					                  );

					        $subcategories = get_categories($param);      
					        foreach($subcategories as $sub):
					        ?>
					          
				        	<option value="<?php echo $sub->term_id.'@'.$sub->name ?>"><?php echo $sub->name ?></option>
					        <?php
					        endforeach;

						endforeach;
						?>

						</select>
					</div>
					<div class="select-form">
						<p>select category</p>
						<select id="cat" name="post_category">
							<?php if(isset($result['category_id'])) : ?>
								<option value="<?php echo $result['category_id'].'@'.$result['category_name']; ?>"><?php echo $result['category_name']; ?></option>
							<?php endif;  ?>

							<?php
							$taxonomy = '';
							$args = '';

							$taxonomy = array( 
							    'article_cat'
							);

							$args = array(
							    'orderby'           => 'name', 
							    'order'             => 'ASC',
							    'hide_empty'        => false, 
							    'hierarchical'      => true, 
							    'child_of'          => 0,
							    'childless'         => false,
							    'pad_counts'        => false
							); 

							$categories = get_terms($taxonomy, $args);


							foreach ($categories as $key => $category):
							?>
								<option value="<?php echo $category->term_id.'@'.$category->name; ?>"><?php echo $category->name ?></option>
							<?php 		
							endforeach;
							?>
					    </select>
					</div>
	    		</div>
	    		<div class="form-grp" style="display:none;" >
					<input type="text" name="post_id" id="post-id" placeholder="Post ID" value="<?php echo isset($result['post_id']) ? $result['post_id'] : ''  ?>">
				</div>
				<div class="form-grp">
					<textarea name="post_title" class="text-height" placeholder="Description"><?php echo isset($_POST['post_title']) ? $_POST['post_title'] : ''  ?></textarea>
				</div>
	    	</div>
    	
    		<?php wp_nonce_field( '_wp_custom_post','_wp_custom_post_nonce_field' ); ?>

			<input type="hidden" name="custom_post_type" id="post-type" value="acme_article" />
			<input type="hidden" name="action" value="save_custom_post" />
			<input type="hidden" name="image_action" id="image-action" value=""/>
			<input type="hidden" name="trigger_set_image" id="trigger-set-image"/>
			
			<input type="submit" name="publish" value="Publish" class="btn btn-default pull-right">
			<input type="submit" name="save" value="Save to Drafts" class="btn btn-default pull-right">
			
	    </div>
	</form>
</div>

<script type="text/javascript">
$(document).ready(function(){
	var maxField = 10; //Input fields increment limitation
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
	var fieldHTML = '<div><input type="text" name="title[]" value=""/><input type="file" name="image[]" value=""/><input type="text" name="body[]" value=""/><input type="text" name="reference[]" value=""/><img src="remove-icon.png"/></a></div>'; //New input field html 
	var x = 1; //Initial field counter is 1
	$(addButton).click(function(){ //Once add button is clicked
		if(x < maxField){ //Check maximum number of input fields
			x++; //Increment field counter
			$(wrapper).append(fieldHTML); // Add field html
		}
	});
	$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
</script>
<?php
get_footer();?>
<script type="text/javascript">

$('#upload-image').change(function() {

	getImageContent(this);

	$('#trigger-set-image').val('1');
	$('#image-action').val('upload_file');
	//$('.link_image').remove();

});

// Changes
function readURL(input) {

  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#article_featured_image_preview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
  }
}
$(document).on('change', "#upload-image", function(e) {
  readURL(this);
});


</script>