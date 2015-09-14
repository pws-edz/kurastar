<?php 
/*Template Name: Create Article
*/
get_header(); ?>
<style type="text/css">
/*	img.featured {
		  width: 100%;
	}
*/</style>
<?php 
	global $wp_query;

	if (!is_user_logged_in()):
		wp_redirect( '/user-registration' ); exit();
	endif;

?>
<div class="defaultWidth center clear-auto bodycontent">
	<div class="contentbox nosidebar">
            <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
            </div>

            <div class="divider"><span>fill up custom post below</span></div>

	 
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
    	
			
		<form class="createform" id="acme-article-post-type" name="acme_article_post_type" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
			<div class="custompost">
				<div class="linewrap">
					<div class="leftbox">
						<label>image preview</label>
						<?php if($result && $result['image_url'] != ''): ?>
			  				<!-- <img class="featured" src="<?php echo $result['set_image'] == '' ? '/wp-content/uploads/2015/07/img1.jpg' : $result['image_url'] ?>"> -->
			  				<div class="imgplaceholder" style="background: url(<?php echo $result['image_url'] ?>) center center no-repeat #e2e2e2;  width: 100%;height: 240px;background-size: cover;margin-bottom: 4px;"></div>
			  			<?php else: ?>
			  				<div class="imgplaceholder"></div>
			  			<?php endif; ?>
						
					  	<input type="file" id="upload-image" name="post_featured_img" />
						<label>or paste image link below</label>
						<input type="text" id="inputFile2" class="urllink" />
					</div>
					<div class="rightbox">
					
						<div class="linewrap">
							<div class="leftbox leftbox2">
								<label>select country</label>

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
							<div class="leftbox leftbox2">
								<label>select category</label>
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
							
						<label>details</label>
						<input type="text" placeholder="Title" name="post_title">
					</div>
					<div class="rightbox">
						<label>limit to 150 characters only</label>
						<textarea placeholder="Description" maxlength="150" name="post_desc"></textarea>
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

				<a href="#" class="btn btn-default save">Save</a>
				<a href="#" class="btn btn-default save">Publish</a>
			</div>

			<div class="divider"><span>or fill up reference post below</span></div>	

			<div class="referpost">
									
								
		<!-- 		<div id="tabs" class="tab1 tab2">
					<ul>
						<li><a href="#tabs-1">TEXT</a></li>
						<li><a href="#tabs-2">PICTURE</a></li>
						<li><a href="#tabs-3">REFERENCE</a></li>
						<li><a href="#tabs-4">LINK</a></li>
						<li><a href="#tabs-5">TWITTER</a></li>
						<li><a href="#tabs-6">YOUTUBE</a></li>
						<li><a href="#tabs-7">H2 TAG</a></li>
					</ul>
					
					<div class="post-list-thumb">
					
						<div id="tabs-1">
								<form method="POST" action="http://kurastar.com/addon/new" accept-charset="UTF-8" name="text"><input name="_token" type="hidden" value="mtZ6Khq6VWMElrQphPwayqmVkoSsEgSmNTcT9nSn"><textarea placeholder="Put your text here" class="form-control texts"></textarea><input type="button" value="Add" class="btn btn-default add" onclick="addItem('0', 'text', 'new')"><input type="button" class="btn btn-default cancel" value="Cancel" onclick="cancel_add('0', 'text', 'new')"><input type="hidden" class="type" value="0"></form>										</div>
						<div id="tabs-2">
							<p>content</p>
						</div>
						<div id="tabs-3">
							<form method="POST" action="http://kurastar.com/addon/new" accept-charset="UTF-8" name="reference"><input name="_token" type="hidden" value="mtZ6Khq6VWMElrQphPwayqmVkoSsEgSmNTcT9nSn"><textarea class="form-control ref-desc" name="ref-desc" placeholder="Add a description"></textarea><input type="text" placeholder="Please put the URL of the reference" class="form-control ref-url"><input type="button" class="btn btn-default" value="Add" onclick="addItem('0', 'reference', 'new')"><input type="button" class="btn btn-default" value="Cancel" onclick="cancel_add('0', 'reference', 'new')"></form>
						</div>
						<div id="tabs-4">
							<form method="POST" action="http://kurastar.com/addon/new" accept-charset="UTF-8" name="link"><input name="_token" type="hidden" value="mtZ6Khq6VWMElrQphPwayqmVkoSsEgSmNTcT9nSn"><div class="link-wrap"><input type="text" class="form-control link-url" placeholder="URL of the Link"><input type="button" class="btn btn-default check-link" value="Check" onclick="link_check('0', 'link', 'new')"><input type="button" class="btn btn-default cancel-link" onclick="cancel_add('0', 'link', 'new')" value="Cancel"></div></form>
						</div>
						<div id="tabs-5">
							<form method="POST" action="http://kurastar.com/addon/new" accept-charset="UTF-8" name="twitter"><input name="_token" type="hidden" value="mtZ6Khq6VWMElrQphPwayqmVkoSsEgSmNTcT9nSn"><input type="text" class="form-control url-tweet" placeholder="Put the URL of a tweet here"><a href="javascript:void(0)" onclick="addclass_modal('new-tweet', 0)" data-toggle="modal" data-target="#twitterSearch"><span class="glyphicon glyphicon-search"></span>Search for tweets.</a><br><br><input type="button" class="btn btn-default check-tweet" onclick="addItem('0', 'twitter', 'new')" value="Add"><input type="button" class="btn btn-default" onclick="cancel_add('0', 'twitter', 'new')" value="Cancel"></form>
						</div>
						<div id="tabs-6">
							<form method="POST" action="http://kurastar.com/addon/new" accept-charset="UTF-8" name="video"><input name="_token" type="hidden" value="mtZ6Khq6VWMElrQphPwayqmVkoSsEgSmNTcT9nSn"><div class="vid-url-container"><input type="text" class="vid-url form-control" placeholder="Video URL"><input type="button" value="Check" class="btn btn-default add" onclick="extract_video('0', 'video', 'new')"><input type="button" value="Cancel" class="btn btn-default" onclick="cancel_add('0', 'video', 'new')"></div></form>
						</div>
						<div id="tabs-7">
							<form method="POST" action="http://kurastar.com/addon/new" accept-charset="UTF-8" name="tag"><input name="_token" type="hidden" value="mtZ6Khq6VWMElrQphPwayqmVkoSsEgSmNTcT9nSn"><select class="form-control tag-heading" onchange="select_htype('0', 'tag', 'new')"><option value="normal">Normal Heading</option><option value="sub">Subheading</option></select><span class="tag-bullet" style="color: rgba(237, 113, 0, 1);">■</span><input type="text" class="form-control tag" placeholder="Tag Title"><hr class="tag-hr" style="border-color: rgba(237, 113, 0, 1)"><input type="button" value="Add" class="btn btn-default add" onclick="addItem('0', 'tag', 'new')"><input type="button" class="btn btn-default cancel" onclick="cancel_add('0', 'tag', 'new')" value="Cancel"></form>
						</div>
					
					</div>
					
				</div>	 -->					
				
			</div>

	  	</form>	
		  	
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