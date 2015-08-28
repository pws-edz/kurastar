<?php 
/*Template Name: Create Article
*/
get_header(); ?>
<style type="text/css">
	img.featured {
		  width: 100%;
	}
</style>
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

	    	<div class="row">
	    	<?php $result =  ''; ?>	
    		<?php if(!empty( $_POST['action'] )): ?>
    		<?php 

    			//this will save the data in the 'acme_article' custom post type.
				$result =  post_acme_article($_POST);
    		 ?>

			<?php endif; ?>
		  	  <?php if($result): ?>
	    		  <span class="search-results">
	    		  	<?php echo $result['msg']; ?>	
	    		  </span>
    		  <?php endif; ?>
    	
			
    		<form id="acme-article-post-type" name="acme_article_post_type" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">

	    		<div class="col-md-4">
				  	<div class="user-register">
				  		<p class="reg-copy">
				  			<?php if($result && $result['image_url'] != ''): ?>
				  				<img class="featured" src="<?php echo $result['set_image'] == '' ? '/wp-content/uploads/2015/07/img1.jpg' : $result['image_url'] ?>">
				  			<?php else: ?>
				  				<img class="featured" src="<?php echo site_url() ?>/wp-content/uploads/2015/07/img1.jpg">
				  			<?php endif; ?>
				  			
				  			<label>Upload Featured Image:</label>
						  	<input type="file" id="upload-image" name="post_featured_img" />
						  	<a href="#" class="btn btn-default setImage">Set</a>
						</p>
					</div>
			    </div>

			    <div class="col-md-8">
			  		<div class="user-register">
				  		<p class="reg-copy">
						  	 <label>Category:</label>
							<?php wp_dropdown_categories( 'show_option_none=Select Category&name=post_category&class=form-control&taxonomy=article_cat' ); ?>
							<label>Country:</label>
							<?php wp_dropdown_categories( 'show_option_none=Select Country&name=post_country&class=form-control&taxonomy=article_country_cat' ); ?>
							<label>Title:</label>
							<input type="text" class="form-control" name="post_title">
							<label>Description:</label>
							<textarea class="form-control" name="post_desc"></textarea>

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

							<p>
								<!-- <input type="submit" value="Save" class="btn btn-default" name="form_save"> -->
								<a href="#" class="btn btn-default save">Save</a>
								<a href="#" class="btn btn-default save">Publish</a>
								<!-- <input type="submit" value="Publish" class="btn btn-default" name="form_publish"> -->
							</p>

						</p>
					</div>
			  	</div>

		  	</form>	
		  	
		    </div>         
		</div>
	</div>

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
</script>