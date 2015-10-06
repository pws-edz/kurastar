<?php 

if ( ! function_exists( 'wp_handle_upload' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}

function getFacebookDetails($source_url){
  #  $source_url = 'https://www.facebook.com/stepblogging';
    $rest_url = "http://api.facebook.com/restserver.php?format=json&method=links.getStats&urls=".urlencode($source_url);
    $json = json_decode(file_get_contents($rest_url),true);
return $json;
}




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

  $get['category'] = $get['category'] == 'all' ? 'select category' : $get['category'];

  if($get['country'] == 'select country' && $get['category'] == 'select category'){

      $args = array(
          'post_type'      => 'acme_article',
          'posts_per_page' => '9', 
          'paged'          => $paged
      );

  }else{

      if($get['country'] != 'select country' && $get['category'] == 'select category'){

          $args = array(
            'post_type'      => 'acme_article',
            'posts_per_page' => '9', 
            'paged'          => $paged,
            'tax_query'      => array(
                                    'relation' => 'OR',
                                    array(
                                        'taxonomy' => 'article_country_cat',
                                        'field'    => 'name',
                                        'terms'    => $get['country'],
                                    ),
                                )
          );

      }elseif($get['country'] == 'select country' && $get['category'] != 'select category'){

          $args = array(
                  'post_type'      => 'acme_article',
                  'posts_per_page' => '9', 
                  'paged'          => $paged,
                  'tax_query'      => array(
                                          'relation' => 'OR',
                                          array(
                                              'taxonomy' => 'article_cat',
                                              'field'    => 'name',
                                              'terms'    =>  $get['category'],
                                          ),
                                      )
          );

      }else{

          $args = array(
              'post_type'      => 'acme_article',
              'posts_per_page' => '9', 
              'paged'          => $paged,
              'tax_query'      => array(
                                      'relation' => 'AND',
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
                                  )
          );

      }

  }

  return $args;
}


function post_acme_article($post){
   

  //if($post['post_title']) {


    $post_data = array(
        'post_title'    => wp_strip_all_tags( $post['post_title'] ),
        'post_content'  => $post['post_desc'],
        'tax_input'     => array( 'article_country_cat' => $post['post_country'], 'article_cat' => $post['post_category']),
        'post_status'   => $post['save'] != '' ? 'draft' : 'publish', 
        'post_type'     => $post['custom_post_type'],
        'post_author'   => get_current_user_id() // Use a custom post type if you want to
    );

      
    $post_id =  wp_insert_post( $post_data );

   // add_post_meta( $post_id, '_custom_image_link', $post['paste_featured_img'], true );

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

       $image_url = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
       
    } else {
      
       $image_url = '';
    }

   $result = array( 'status' => 'success', 'post_id' => $post_id, 'image_url' => $image_url, 'featured_img' => $image_url, 'msg' => 'Post Save.');
  // }

  // }  else {

  //   $result = array( 'status' => 'error', 'post_id' => $post_id, 'image_url' => $image_url, 'featured_img' => $image_url, 'msg' => 'Please fill-up the required fields.');
  // }
    

  return $result; 

}

function unset_post() {
  unset($_POST);
}


function count_user_favorites($user_id) {

     $fav_args = array(
                  'post_type'       => 'acme_article', 
                  'posts_per_page'  => -1, 
                  'meta_query'        => array(
                    'relation'  => 'AND',
                      array(
                          'key' => '_user_liked',
                          'value' => $user_id,
                          'compare' => '='
                      )
                  )
                  );

     return count(query_posts($fav_args));
}

function count_total_favorites($id) {
global $wpdb;

$fav = $wpdb->get_results(
    "SELECT DISTINCT * 
    FROM  $wpdb->postmeta
    WHERE $wpdb->postmeta.post_id = '$id'
    AND $wpdb->postmeta.meta_key ='_user_liked' ");

     return count($fav);
}


function kura_twitter_count( $url ) {
    /* build the pull URL */
    $url = 'http://cdn.api.twitter.com/1/urls/count.json?url=' . urlencode( $url );
  
    /* get json */
    $json = json_decode( file_get_contents( $url ), false );
    if( isset( $json->count ) ) return (int) $json->count;
  
    return 0; // else zed
}


function kura_gplus_count( $url ) {
    /* get source for custom +1 button */
    $contents = file_get_contents( 'https://plusone.google.com/_/+1/fastbutton?url=' .  $url );
 
    /* pull out count variable with regex */
    preg_match( '/window\.__SSR = {c: ([\d]+)/', $contents, $matches );
 
    /* if matched, return count, else zed */
    if( isset( $matches[0] ) ) 
        return (int) str_replace( 'window.__SSR = {c: ', '', $matches[0] );
    return 0;
}


add_action('init', 'update_user_info');

function update_user_info(){

  if(isset($_POST['update_user_info'])) {

    if($_FILES){
        $uploadedfile     = $_FILES['profile'];
        $upload_overrides = array( 'test_form' => false );
        $movefile         = wp_handle_upload( $uploadedfile, $upload_overrides );

        if ( $movefile && !isset( $movefile['error'] ) ) {
            // echo "File is valid, and was successfully uploaded.\n";
            $profile_url = $movefile['url'];
        } else {
            /**
             * Error generated by _wp_handle_upload()
             * @see _wp_handle_upload() in wp-admin/includes/file.php
             */
            echo $movefile['error'];
            $profile_url = null;
        }

        if(get_the_author_meta( 'profile_url', $_POST['user_id'] ) != NULL){
          update_user_meta( $_POST['user_id'], 'profile_url', $profile_url ); 
        }else{
          add_user_meta( $_POST['user_id'], 'profile_url', $profile_url);
        }
        // 'file' => string '/opt/lampp/htdocs/kurastar/wp-content/uploads/2015/10/nova.jpg' (length=62)
        // 'url'  => string 'http://kurastar.local/wp-content/uploads/2015/10/nova.jpg' (length=57)
        // 'type' => string 'image/jpeg' (length=10)

    }

    $userdata[] = array(
        'ID'            => $_POST['user_id'],
        'user_nicename' => $_POST['full_name'],
        'display_name'  => $_POST['full_name']
    );

       $result = wp_update_user( $userdata ); //update user info of the $userdata paramter

       update_user_meta( $_POST['user_id'], 'description', $_POST['user_description'] ); //update user meta description
        
    }

}
