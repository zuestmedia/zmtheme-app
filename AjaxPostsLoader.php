<?php

namespace ZMT\Theme;

class AjaxPostsLoader {

  function __construct( ){

    $this->addAJAX();

  }

  public function addAJAX(){

    //zmt_ajax_posts_loader
    add_action( 'wp_ajax_nopriv_zmt_ajax_posts_loader', array($this,'AjaxResponsePostsLoader') );
    add_action( 'wp_ajax_zmt_ajax_posts_loader', array($this,'AjaxResponsePostsLoader') );   

  }

  public function AjaxResponsePostsLoader(){

    $nonce_check = check_ajax_referer( 'zmt_global_ajax_validation', 'security' );

    if( $nonce_check != false ){

      $query_data = $_POST['query_data'];

      if( ( 
        isset($query_data['query']) && !empty($query_data['query']) ) 
        && ( isset($query_data['maxpages']) && !empty($query_data['maxpages']) ) 
        && ( isset($query_data['current']) && !empty($query_data['current']) ) 
        && ( isset($query_data['comid']) && !empty($query_data['comid']) ) 
      ){

        if( is_numeric($query_data['maxpages']) && is_numeric($query_data['current']) ){

          $query_args = json_decode( stripslashes( $query_data['query'] ), true );

          if(is_array($query_args)){

            $resulting_array = \ZMT\Theme\Render::getAjaxReloadQueryLoop($query_data['comid'],$query_args);

            $html_data = array(
              'html' => $resulting_array['html'],
              'next_post_id' => $resulting_array['next_post_id'],//to scroll to next article
              'comid' => esc_attr($query_data['comid']),
            );
  
            wp_send_json_success($html_data);

          }

        }

      }

    }

    wp_send_json_error();

  } 

}
