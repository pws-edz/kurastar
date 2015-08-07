<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="ja"> <!--<![endif]-->
    
<!-- Mirrored from 10.20.150.92/template/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Apr 2015 04:21:48 GMT -->
<head>
        <!-- Le Meta Config -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="ですくりぷしょんですくりぷしょんですくりぷしょん">
        <meta name="keywords" content="キーワード1,キーワード2,キーワード3,キーワード4">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Le Favicons -->
        <link href="<?php echo get_template_directory_uri(); ?>/ico/favicon.ico" rel="icon" type="image/x-icon" />
        <link href="<?php echo get_template_directory_uri(); ?>/ico/apple-touch-icon-144-precomposed.png" rel="apple-touch-icon-precomposed" />
        <link href="<?php echo get_template_directory_uri(); ?>/ico/apple-touch-icon-114-precomposed.png" rel="apple-touch-icon-precomposed" />
        <link href="<?php echo get_template_directory_uri(); ?>/ico/apple-touch-icon-72-precomposed.png" rel="apple-touch-icon-precomposed" />
        <link href="<?php echo get_template_directory_uri(); ?>/ico/apple-touch-icon-57-precomposed.png" rel="apple-touch-icon-precomposed" />
        
        <!-- Le Assets -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/reset.css" />
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/common.css" />
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bonix.css" />
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/vendor/font-awesome-4.3.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.mCustomScrollbar.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/flexslider.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/custom.css" />
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css" />

		<?php wp_head(); ?>
</head>
	<body>
		<div class="box100 mainWrap">
			<div class="contentWrap">
				<div class="head1">
					<div class="defaultWidth center headwrap">
						<a class="menu-sp"></a>
						<div class="logo">
							<a href="/"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="株式会社 デュナレイト" title="株式会社 デュナレイト" /></a>
						</div>
						<div class="actions">
							<a href="<?php the_permalink(); ?>user-registration"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_login.png" />LOGIN</a>
							<a href="<?php the_permalink(); ?>user-registration"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_signup.png" />REGISTER</a>
							<a href="<?php the_permalink(); ?>user-registration"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_write.png" />POST</a>
						</div>
					</div>
				</div>
				<div class="head2">
					<div class="defaultWidth center menuwrap">
						<?php wp_nav_menu( array('menu' => 'header-menu')); ?>
					</div>
				</div>
<div class="mainbanner">
		<div class="flexslider">
			<ul class="slides">
				<?php $row = 1; if(get_field('home_slider')): ?>
				 <?php while(has_sub_field('home_slider')): ?>
				 	<li><img src="<?php the_sub_field('slider_image'); ?>" /></li>
				 <?php $row++; endwhile; ?>
			<?php endif; ?>
			</ul>
		</div>
		<div class="defaultWidth center searchwrap">
		<form>
			<div class="searchwrap-inner">
				<div class="transwrap">
					<input id="cty" type="text" value="select country" readonly />
				</div>
				<div class="transwrap">
					<input id="cat" type="text" value="select category" readonly />
				</div>
				<input type="submit" class="search-btn" value="" />
				
				<div class="dropcountry">
				<div class="pointer"></div>
				
				<div class="mCustomScrollbar light" data-mcs-theme="minimal-dark">
					<div class="droplistcountry">
						<div>
							<?php wp_nav_menu( array('menu' => 'country-menu')); ?>
						</div>
					</div>
				</div>
				</div>

				<div class="dropcategory">
				<div class="pointer"></div>
				<div class="mCustomScrollbar light" data-mcs-theme="minimal-dark">
					<div class="droplistcategory">
						<div>
							<?php wp_nav_menu( array('menu' => 'category-menu')); ?>
						</div>
						<div></div>
					</div>
				
				</div>
				</div>
			</div>
		</form>
		</div>
	</div>