<?php 

if ( ! function_exists('array_get') ) {
  function array_get($arr, $key, $default = null, $echo = false) {
    $out = $default;

    if ( isset($arr[$key]) ) {
      $out = $arr[$key];
    } 

    if ( ! $echo ) {
      return $out;
    }

    echo $out;
  }
}


if ( ! function_exists(('check_form_nonce')) ) {
    function check_form_nonce($field) {

        $nonce = $_REQUEST['_wpnonce'];
                
        if ( !wp_verify_nonce( $nonce, $field ) ) {

           $flash_message = new Flash_Message();

           $flash_message->set(__('Cheating?', 'wpcdi'), 'error');

           $flash_message->flash_messages();

           return;
        }

    }
}


//allow redirection, even if my theme starts to send output to the browser
add_action('init', 'do_output_buffer');
function do_output_buffer() {
        ob_start();
}


function my_get_menu_item_slug() {
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


  $slug = trim($actual_link, "/");
  $link = explode("/", $slug);

  return end($link);
}

/*
* Custom args for search
*/
function args_func($get, $paged) {

	if($get['country'] == 'select country' && $get['category'] == 'select category') {

            $args = array('post_type' => 'acme_article','posts_per_page' => '9', 'paged' => $paged);

         } else {

            if($get['country'] != 'select country' && $get['category'] == 'select category') {

            	$args = array(
                  'post_type' => 'acme_article',
                  'tax_query' => array(
                    'relation' => 'OR',
                    array(
                      'taxonomy' => 'article_country_cat',
                      'field'    => 'name',
                      'terms'    => $get['country'],
                    ),
                  ),
                   'posts_per_page' => '9', 'paged' => $paged
                );



            } else if ($get['country'] == 'select country' && $get['category'] != 'select category') {

            	$args = array(
                  'post_type' => 'acme_article',
                  'tax_query' => array(
                    'relation' => 'OR',
                    array(
                      'taxonomy' => 'article_cat',
                      'field'    => 'name',
                      'terms'    =>  $get['category'],
                    ),
                  ),
                   'posts_per_page' => '9', 'paged' => $paged
                );


            }  else {

	    		$args = array(
	                  'post_type' => 'acme_article',
	                  'tax_query' => array(
	                    'relation' => 'OR',
	                    array(
	                      'taxonomy' => 'article_country_cat',
	                      'field'    => 'name',
	                      'terms'    => $get['country'],
	                    ),
	                    array(
	                      'taxonomy' => 'article_cat',
	                      'field'    => 'name',
	                      'terms'    =>  $get['category'],
	                    ),
	                  ),
	                   'posts_per_page' => '9', 'paged' => $paged
	                );

            }
               


         }


        return $args;

}


function post_acme_article($post){
       
   $set = $post['trigger_set_image']; 

      if( empty($post['post_id'])) {

       

          $post = array(
              'post_title' => wp_strip_all_tags( $post['post_title'] ),
              'post_content' => $post['post_desc'],
              'tax_input'      => array( 'article_country_cat' => $post['post_country'], 'article_cat' => $post['post_category']),
              'post_status' => 'publish',            // Choose: publish, preview, future, etc.
              'post_type' => $post['custom_post_type'],
              'post_author' => get_current_user_id() // Use a custom post type if you want to
          );

        
        $post_id =  wp_insert_post( $post );

      } else {

        
         // Add the content of the form to $post as an array
        $post = array(
          'ID' => $post['post_id'],
          'post_title' => wp_strip_all_tags( $post['post_title'] ),
          'post_content' => $post['post_desc'],
          'tax_input'      => array( 'article_country_cat' => $post['post_country'], 'article_cat' => $post['post_category']),
          'post_status' => 'publish',            // Choose: publish, preview, future, etc.
          'post_type' => $post['custom_post_type'],
          'post_author' => get_current_user_id() // Use a custom post type if you want to
        );

        $post_id =  wp_update_post( $post );

      }


      if(!empty($_FILES['post_featured_img']['name'])){

        $uploaddir = wp_upload_dir();
        $file = $_FILES["post_featured_img"]["name"];

        $uploadfile = $uploaddir['path'] . '/' . basename( $file );

        move_uploaded_file( $file , $uploadfile );
        $filename = basename( $uploadfile );

        $wp_filetype = wp_check_filetype(basename($filename), null );

        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
            'post_content' => '',
            'post_status' => 'inherit'
        );

        foreach($_FILES as $file => $value) {

          require_once(ABSPATH . "wp-admin" . '/includes/image.php');
          require_once(ABSPATH . "wp-admin" . '/includes/file.php');
          require_once(ABSPATH . "wp-admin" . '/includes/media.php');

          $attach_id = media_handle_upload( $file, $post_id );            
          set_post_thumbnail( $post_id , $attach_id);
          update_post_meta($post_id,'_thumbnail_id',$attach_id);
         

        }

      }

      $image_url = wp_get_attachment_url( get_post_thumbnail_id($post_id) );

     $result = array( 'status' => 'success', 'set_image' => $set, 'post_id' => $post_id, 'image_url' => $image_url, 'featured_img' => $image_url, 'msg' => 'Post Save.');
 

  return $result; 

}

function unset_post() {
  unset($_POST);
}