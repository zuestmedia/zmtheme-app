<?php

namespace ZMT\Theme;

class View {

/**
  * ZMThemeViewController
  *
  * To get Result use checkStatus with two parameters!
  * First Param is string, Second an Array of Values where to show
  * Conditions:
  * eg. ZMThemeViewController::checkStatus( get_option('zmtbm_settings_icons'), get_option('zmtbm_settings_else') );
  * returns 1 or NULL
  */

/**
  * checkStatus()
  * returns 1 or NULL
  */
  static function checkStatus( $status, $conditions_array = array() ){

    $result = 1;
    if( $status == NULL || $status == '' || $status == 0 ) {//default = display

      $result = 1;

      //404page wants to be rid of sidebars n menus in default mode --> also in content php getThemeContent is a 404 hack!
      if( is_404() ) { $result = NULL; }

    } elseif ($status == '1') {//hidden

      $result = NULL;

    } elseif($status == '2') {//custom

      $result = NULL;
      if($conditions_array) {

        // returns 0 = if not logged in, 1 = if loggedin is unique condition 2 = if loggedin and other conditions
        $loggedin = self::checkLoginStatus($conditions_array);

        //returns 0 = if not matched condition, 1 = if matched condition
        $conditions = self::checkConditions2($conditions_array);

        if($loggedin == 1){
          $result = 1;
        } elseif($loggedin == 2 && $conditions == 1){
          $result = 1;
        } elseif($conditions == 1 && !in_array( 'loggedin', $conditions_array ) ){
          $result = 1;
        }

      }

    } elseif($status == '3') {//custom

      $result = 1;
      if($conditions_array) {

        // returns 0 = if not logged in, 1 = if loggedin is unique condition 2 = if loggedin and other conditions
        $loggedin = self::checkLoginStatus($conditions_array);

        //returns 0 = if not matched condition, 1 = if matched condition
        $conditions = self::checkConditions2($conditions_array);

        $inverse_check = 0;
        if($loggedin == 1){
          $inverse_check = 1;
        } elseif($loggedin == 2 && $conditions == 1){
          $inverse_check = 1;
        } elseif($conditions == 1 && !in_array( 'loggedin', $conditions_array ) ){
          $inverse_check = 1;
        }

        if($inverse_check == 1){
          $result = NULL;
        }

      }

    }

    return $result;

  }

/**
  * Condition check
  * returns NULL or 1
  * if 1, value matches with one of the conditions
  */
  static function checkConditions( $conditions_array ){

    $result = NULL;

    /**
    * Loop Throug Conditions if has and check according conditions
    */
    if (!empty($conditions_array)) {

      foreach ($conditions_array as $key => $value){

        if($value == 'archive') {

          if( is_archive() ) { $result = 1; }

        }

        if($value == 'page') {

          if( is_page() && is_front_page() == false ) { $result = 1; }

        }

        if($value == 'single') {

          if( is_single() ) { $result = 1; }

        }

        if($value == 'frontpage') {

          if( is_front_page() ) { $result = 1; }

        }

        if($value == 'blogpage') {

          if( is_home() ) { $result = 1; }

        }

        if($value == 'errorpage') {

          if( is_404() ) { $result = 1; }

        }

        if($value == 'searchpage') {

          if( is_search() ) { $result = 1; }

        }

      }

    }

    return $result;

  }

  static function isWooorbbP( $conditions_array ){

    if ( class_exists( 'woocommerce' ) ) {
      if(is_woocommerce()){
        return 'woocommerce';
      }
    }

    if ( class_exists( 'bbPress' ) ) {
      /*
      * is_bbpress() not working properly!
      * when a bbpress shortcode is used, is_bbpress() returns also true!!!
      * not only when loaded as main content.
      * so use global $template here and bbpress.php template file to check
      * if bbpress template is loaded and use then only bbpress module.
      */
      global $template;
      if( basename( $template ) == 'bbpress.php' ){
        return 'bbpress';//lowercase!!!
      }
    }

    return false;

  }


  static function checkConditions2( $conditions_array ){

    $result = NULL;

    if (!empty($conditions_array)) {

      //check first if is woo or bbp, they meet myabe also default conditions if not checked before
      $wooorbbp = self::isWooorbbP( $conditions_array );
      if( $wooorbbp !== false ){

        if (in_array( $wooorbbp, $conditions_array )) {
          return 1;
        }

      }

      //frontpage
      if( is_front_page() ){

        if (in_array( 'frontpage', $conditions_array )) {
          return 1;
        }

      }

      //home = blogpage
      if( is_home() ){

        if (in_array( 'blogpage', $conditions_array )) {
          return 1;
        }

      }

      //search
      if( is_search() ){

        if (in_array( 'searchpage', $conditions_array )) {
          return 1;
        }

      }

      //404 - not in use...
      if( is_404() ){

        if (in_array( 'errorpage', $conditions_array )) {
          return 1;
        }

      }

      //singular
      if( is_singular() ){

        if( is_page_template( ) ) {
          $key = get_page_template_slug();
          if (in_array( $key, $conditions_array )) {
            return 1;
          }
        }

        if( is_page() ){

          $page_id = get_the_ID();
          $key = 'page_id_'.$page_id;
          if (in_array( $key, $conditions_array )) {
            return 1;
          }          

        }

        if( is_page() && is_front_page() == false ) {

          if (in_array( 'page', $conditions_array )) {
            return 1;
          }

        //single
        } elseif( is_single() ){

          //übergeordnet
          if (in_array( 'single_all', $conditions_array )) {
            return 1;
          }

          //single post or other single post types
          $key = 'single';
          if(get_post_type() !== 'post' ) {
            $key = 'single_'.get_post_type();
          }
          if (in_array( $key, $conditions_array )) {
            return 1;
          }

        }

        return $result;

      }

      //archive
      if( is_archive() ){

        //übergeordnet
        if (in_array( 'archive', $conditions_array )) {
          $result = 1;
        }

        if( is_category() ){
          if (in_array( 'category', $conditions_array )) {
            $result = 1;
          }
        } elseif( is_tag() ){
          if (in_array( 'tag', $conditions_array )) {
            $result = 1;
          }
        } elseif( is_author() ){
          if (in_array( 'author', $conditions_array )) {
            $result = 1;
          }
        } elseif( is_date() ){
          if (in_array( 'date', $conditions_array )) {
            $result = 1;
          }
        } elseif( is_tax() ){
          $key = 'taxonomy_'.get_query_var('taxonomy');
          if (in_array( $key, $conditions_array )) {
            $result = 1;
          }
        } elseif( is_post_type_archive() ){
          $key = 'archive_'.get_post_type();
          if (in_array( $key, $conditions_array )) {
            $result = 1;
          }
        }

        return $result;

      }

      //return NULL if no result...
      return $result;

    }

  }

  static function checkLoginStatus($conditions_array){

    $result = 0;

    if (!empty($conditions_array)) {

      if (in_array( 'loggedin', $conditions_array )) {
        if(is_user_logged_in()){
          if(count($conditions_array) == 1){
            $result = 1;//return 1 if is the only condition, so on all loggedin or not loggedin users is shown or hidden
          } else{
            $result = 2;//return 2 if has also other conditions to check!
          }         
        }        
      }

    }

    return $result;

  }

}
