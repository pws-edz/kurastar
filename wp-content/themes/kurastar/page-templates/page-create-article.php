<?php 
/*Template Name: Create Article
*/
get_header(); ?>

<?php 
	global $wp_query;

	if (!is_user_logged_in()):
		wp_redirect( '/user-registration' ); exit();
	endif;
?>

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
		    	<?php $result =  ''; ?>	
	    		<?php 
	    		  if(!empty( $_POST['action'] )):
	    			//this will save the data in the 'acme_article' custom post type.
					$result =  post_acme_article($_POST);
	    		  endif;
	    		?>
		  	    <?php if($result): ?>
	    		  <span class="search-results <?php echo $result['status'] ?>">
	    		  	<?php echo $result['msg']; ?>	
	    		  </span>
    		    <?php endif; ?>
    		</div>
    	</div>

    </div>
</div>
<div class="container">
	<form data-toggle="validator" role="form" class="createform" id="acme-article-post-type" name="acme_article_post_type" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
		<div class="form-content">
	    	<p class="text-center title">fill up  custom post below</p>
	    	<div class="gap-30"></div>
	    	<div class="col-md-4">
	    		<p>image preview</p>
	    		<div class="img-holder">
	    		<?php if($result && $result['image_url'] != ''): ?>
	  				<img src="<?php echo $result['image_url'] ?>" alt="">
	  			<?php else: ?>
	  				<img src="<?php echo site_url() ?>/wp-content/themes/kurastar/images/blank-img.png" alt="">
	  			<?php endif; ?>
	  			</div>

	    		<div class="fileUpload">
				    <input type="file" class="upload" id="upload-image" name="post_featured_img"/>
				</div>
				<p>or paste image link below</p>
				<div class="fileUpload">
				    <input type="text" class="link"/>
				</div>
	    	</div>
	    	<div class="col-md-8">
	    		<div class="form-grp">
	    			<div class="select-form">
	    				<p>select country</p>
						<?php //wp_nav_menu( array('menu' => 'country-menu')); ?>
						<select id="cty" name="post_country">
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
					          
				        	<option value="<?php echo $sub->term_id ?>"><?php echo $sub->name ?></option>
					        <?php
					        endforeach;

						endforeach;
						?>

						</select>
					</div>
					<div class="select-form">
						<p>select category</p>
						<select id="cat" name="post_category">
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
								<option value="<?php echo $category->term_id?>"><?php echo $category->name ?></option>
							<?php 		
							endforeach;
							?>
					    </select>
					</div>
	    		</div>
	    		<div class="form-grp">
					<p>details <span>(required)</span></p>
					<input type="text" name="post_title" required="required"  placeholder="Title">
				</div>
				<div class="form-grp">
					<p>limit to 150 characters only</p>
					<textarea name="post_desc" class="text-height" placeholder="Description"></textarea>
				</div>
	    	</div>
    	
    		<?php wp_nonce_field( '_wp_custom_post','_wp_custom_post_nonce_field' ); ?>
			<input type="hidden" name="custom_post_type" id="post-type" value="acme_article" />
			<input type="hidden" name="action" value="save_custom_post" />
			<input type="hidden" name="trigger_set_image" id="trigger-set-image"/>
			<?php if($result): ?>
  				<input type="hidden" name="featured_img" id="featured_image" value="<?php echo $result['set_image'] == '' ? '' : $result['featured_img']; ?>" />
  			<?php else: ?>
  				<input type="hidden" name="featured_img" id="featured_image" value=""/>
  			<?php endif; ?>
			
		
			<?php if($result): ?>
  				<input type="hidden" name="post_id" value="<?php echo $result['set_image'] == '' ? '' : $result['post_id']; ?>" />
  			<?php else: ?>
  				<input type="hidden" name="post_id" value="" />
  			<?php endif; ?>

  			<!-- <a href="#" class="btn btn-default save pull-right">Publish</a> -->
			<a href="#" class="btn btn-default save pull-right">Save</a>
			
	    </div>
	    
	    <div class="form-content">
    	<p class="text-center title">or fill up reference post below</p>
    	<div class="tab-form-panel">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#text" aria-controls="home" role="tab" data-toggle="tab">Text</a>
				</li>
				<li role="presentation">
					<a href="#picture" aria-controls="picture" role="tab" data-toggle="tab">Picture</a>
				</li>
				<li role="presentation">
					<a href="#reference" aria-controls="reference" role="tab" data-toggle="tab">Reference</a>
				</li>
				<li role="presentation">
					<a href="#link" aria-controls="link" role="tab" data-toggle="tab">Link</a>
				</li>
				<li role="presentation">
					<a href="#twitter" aria-controls="twitter" role="tab" data-toggle="tab">Twitter</a>
				</li>
				<li role="presentation">
					<a href="#youtube" aria-controls="youtube" role="tab" data-toggle="tab">Youtube</a>
				</li>
				<li role="presentation">
					<a href="#h2-tag" aria-controls="h2-tag" role="tab" data-toggle="tab">H2 Tag</a>
				</li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="text">
					<textarea name="tab_1_text" placeholder="Put your text here" class="form-control texts text-height"></textarea>
					<a href="#" class="btn btn-default tab_add">Add</a>
					<a href="#" class="btn btn-default tab_cancel">Cancel</a>
				</div>
				<div role="tabpanel" class="tab-pane" id="picture">
					<?php if($result): ?>
						<p><img src="<?php echo $result['image_url'] ?>"></p>
					<?php else: ?>
						<p><img src="<?php echo site_url() ?>/wp-content/themes/kurastar/images/blank-img.png" alt=""></p>
					<?php endif; ?>
				</div>
				<div role="tabpanel" class="tab-pane" id="reference">
					<textarea name="tab_3_desc" class="form-control ref-desc text-height" name="ref-desc" placeholder="Add a description"></textarea>
					<input name="tab_3_url" type="text" placeholder="Please put the URL of the reference" class="form-control ref-url">
					<a href="#" class="btn btn-default tab_add">Add</a>
					<a href="#" class="btn btn-default tab_cancel">Cancel</a>
				</div>
				<div role="tabpanel" class="tab-pane" id="link">
					<div class="link-wrap">
						<input name="tab_4_link" type="text" class="form-control ref-url" placeholder="URL of the Link">
						<a href="#" class="btn btn-default tab_add">Add</a>
						<a href="#" class="btn btn-default tab_cancel">Cancel</a>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="twitter">
					<input type="text" name="tab_5_twitter_url" class="form-control ref-url" placeholder="Put the URL of a tweet here">
					<a href="javascript:void(0)" class="search-twitter" onclick="addclass_modal('new-tweet', 0)" data-toggle="modal" data-target="#twitterSearch">
						<span class="glyphicon glyphicon-search"></span>Search for tweets.
					</a><br><br>
					<a href="#" class="btn btn-default tab_add">Add</a>
					<a href="#" class="btn btn-default tab_cancel">Cancel</a>
				</div>
				<div role="tabpanel" class="tab-pane" id="youtube">				
					<div class="vid-url-container">
						<input name="tab_6_youtube_url" type="text" class="ref-url form-control" placeholder="Video URL">
						<a href="#" class="btn btn-default tab_add">Add</a>
						<a href="#" class="btn btn-default tab_cancel">Cancel</a>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="h2-tag">
					<select class="form-control tag-heading ref-url" name="tab_7_heading">
						<option value="normal">Normal Heading</option>
						<option value="sub">Subheading</option>
					</select>
					<!-- <span class="tag-bullet" style="color: rgba(237, 113, 0, 1);">■</span> -->
					<input name="tab_7_tag_title" type="text" class="form-control ref-url" placeholder="Tag Title">
					<hr class="tag-hr" style="border-color: rgba(237, 113, 0, 1)">
					<a href="#" class="btn btn-default tab_add">Add</a>
					<a href="#" class="btn btn-default tab_cancel">Cancel</a>
				</div>
			</div>
		</div>
    </div>
	</form>
</div>


<?php
get_footer();?>
<script type="text/javascript">

$('#upload-image').change(function(e) {
  var files = e.target.files; 

  for (var i = 0, file; file = files[i]; i++) {
    console.log(file);
  }

  $('#trigger-set-image').val('1');
  $('#acme-article-post-type').submit();

});

$('.setImage').click(function() {

  $('#trigger-set-image').val('1');
  $('#acme-article-post-type').submit();

});

$('.save').click(function() {

  $('#trigger-set-image').val('');
  $('#acme-article-post-type').submit();

});

$('.tab_add').click(function(){

	$('#acme-article-post-type').submit();
});
</script>