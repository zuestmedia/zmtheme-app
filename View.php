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
    if($status == NULL) {//default = display

      $result = 1;

      //404page wants to be rid of sidebars n menus in default mode --> also in content php getThemeContent is a 404 hack!
      if( is_404() ) { $result = NULL; }

    } elseif ($status == '1') {//hidden

      $result = NULL;

    } elseif($status == '2') {//custom

      $result = NULL;
      if($conditions_array) {

        $result = self::checkConditions($conditions_array);

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

}
