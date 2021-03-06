<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>			
<!-- <div class="block-footer1">
	<div class=" center clear-auto">
		<a href="<?php home_url(); ?>" class="logofooter">
			<img src="<?php echo get_template_directory_uri(); ?>/images/logo_gray.png" />
		</a>
		<div class="footermenu">
			<?php wp_nav_menu( array('menu' => 'footer-menu')); ?>
		</div>
	</div>
</div> -->
<div class="block-footer2">
	<div class="defaultWidth center clear-auto block-footer2-wrap">
		<div class="footcountry">
			<h3 class="footlabel">Countries</h3>
			<?php echo do_shortcode( '[footer_country]' ); ?>
		</div>
		<div class="footcategory">
			<h3 class="footlabel">Categories</h3>
			<div>
				<h4>Menu</h4>
				<?php echo do_shortcode( '[footer_category]' ) ?>
				<!-- footer static -->
			</div>
		</div>
	</div>
	
	<div class="defaultWidth center clear-auto">
		<ul class="sm-list-footer">
			<li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt=""></a></li>
			<li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt=""></a></li>
			<li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/gplus.png" alt=""></a></li>
			<li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/hatena.png" alt=""></a></li>
		</ul>
	</div>
	<div class="defaultWidth center clear-auto">
		<div class="footer-menu">
			<?php wp_nav_menu( array('menu' => 'footer-menu')); ?>
		</div>
	</div>
	<div class="defaultWidth center clear-auto">
		<div class="footer-copyright">
			&copy; Copyright Kura-Star 2015. All Right Reserved.
		</div>
	</div>
</div>		
	</div>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/lightbox/js/lightbox-plus-jquery.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
	<?php wp_footer(); ?>

	<script type="text/javascript">

	  $(document).ready(function() {

	    $(".form-send-like").submit(function(){
	        console.log('test');
	        $.ajax({
	            type: "POST",
	            dataType: "json",
	            url: ajaxurl,
	            data: $('.form-send-like').serializeArray(),
	            success: function(response) {
	                console.log(response);

	                if(response.success){

	                    location.reload();
	                }else{
	                	$(".message").addClass('alert alert-danger').html('you already liked this article');
	                }
	            },
	            error: function(){

	                 $(".message").addClass('alert alert-danger').html('Please try again.');
	            }
	        });

	        return false;
	    });


	});

	</script>
	</body>
	<!-- Mirrored from 10.20.150.92/template/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Apr 2015 04:22:38 GMT -->
</html>