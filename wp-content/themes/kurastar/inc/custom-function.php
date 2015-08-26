<?php 

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