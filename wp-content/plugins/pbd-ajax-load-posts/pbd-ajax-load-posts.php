<?php
/**
 * Plugin Name: PBD AJAX Load Posts
 * Plugin URI: http://www.problogdesign.com/
 * Description: Load the next page of posts with AJAX.
 * Version: 0.1
 * Author: Pro Blog Design
 * Author URI: http://www.problogdesign.com/
 */
 
 /**
  * Initialization. Add our script if needed on this page.
  */
 function pbd_alp_init() {

	// Queue JS and CSS
	wp_enqueue_script(
		'pbd-alp-load-posts',
		plugin_dir_url( __FILE__ ) . 'js/load-posts.js',
		array('jquery'),
		'1.0',
		true
	);
	
	// wp_enqueue_style(
	// 	'pbd-alp-style',
	// 	plugin_dir_url( __FILE__ ) . 'css/style.css',
	// 	false,
	// 	'1.0',
	// 	'all'
	// );
 		

	$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
	
	// Add some parameters for the JS.
	wp_localize_script(
		'pbd-alp-load-posts',
		'pbd_alp',
		array(
			'startPage' => $paged,
			'maxPages' => $_SESSION['custom_max_pages'],
			'nextLink' => next_posts($_SESSION['custom_max_pages'], false)
		)
	);
 	
 }
 add_action('template_redirect', 'pbd_alp_init');
 
 ?>