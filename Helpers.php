<?php

namespace ZMT\Theme;

class Helpers {

  /**
    * Get Theme Details from in Style.css
    */
    static function getThemeDetails($key){

      $object = wp_get_theme();

      return $object->get( $key );

    }

  /**
    * Get Theme Directory URL
    */
    static function getThemeUrl() {

      return get_template_directory_uri();

    }

  /**
    * Get Child Theme Directory URL
    */
    static function getChildThemeUrl() {

      return get_stylesheet_directory_uri();

    }

  /**
    * String starts with
    */
    static function stringStartsWith($string,$startpart) {

      if( substr($string, 0, strlen($startpart)) === $startpart ) {
        return true;
      }
      return false;

    }

    static function checkDefComsObjExists( $obj_key, $default_key ){
      global $zmtheme;
      $result = $default_key;
      if( property_exists( $zmtheme['default_components'], $obj_key ) ){
        $result = $obj_key;
      }
      return $result;
    }

    static function modifyTaxandPostTypeSlugtoObject($old_name){

      $new_name = NULL;
      $new_name = strtolower( $old_name );
      $new_name = str_replace( '-', '_', $new_name );
      return $new_name;

    }

    static function transformObjectKeystoLabel($string){

      $string = str_replace( '__', ' ', $string );
      $string = str_replace( '_', ' ', $string );
      $string = ucwords( $string );
      return $string;

    }

  /**
    * Get Theme Slug
    */
    static function getSlug() {

      return basename( Helpers::getThemeUrl() );

    }
    static function getChildSlug() {

      return basename( Helpers::getChildThemeUrl() );

    }

  /**
    * GetTextDomain
    */
    static function getTextDomain() {

      if( Helpers::getThemeDetails('TextDomain') ) {

        $result = Helpers::getThemeDetails('TextDomain');

      } else {

        $result = Helpers::getSlug();

      }

      return $result;

    }

  /**
    * LoadTextdomain before Config Files!!
    */
    static function LoadTextDomainbeforeConfigFiles(){

     load_theme_textdomain( Helpers::getTextDomain(), get_template_directory().'/languages' );

     if( is_child_theme() ){
      load_child_theme_textdomain( Helpers::getChildSlug(), get_stylesheet_directory().'/languages' );
     }

   }

 /**
   * Function to get translated textstrings by key from textstrings.php
   */
   static function getTrStr( $key, $dummy = "Text String" ){

     global $zmtheme;

     if ( property_exists( $zmtheme['default_config'], 'textstrings' ) ) {

       $textstrings = $zmtheme['default_config']->textstrings;

       if( property_exists( $textstrings, $key ) ){

         return $textstrings->$key;

       }

     }


   }

  /**
    * Options or ThemeMods with default value and settingsstatus
    * If settings_status is not set, always returns default value! (or programmatically set value!)
    * If no default_value and no option_value is found, returns NULL
    * $settings_status = level of settings that are showed and used by theme
    * $type = theme_mods or options
    * $setting_level = setting uses only options or theme_mods if settings_status is higher or same as setting_level
    * $array_handling = NULL --> returns array
    * $array_handling = array('function' => 'implode', 'glue' => ' '); --> glue = verbinder / connector
    */
  static function getOptionNew(
    $options_name,
    $default_value = NULL,
    $settings_status = '1',
    $type = 'theme_mod',
    $option_mod = NULL,
    $setting_level = '2',
    $array_handling = NULL
  ){

      /**
        * PreCheck if SettingsStatus is = 2
        * if = 1, only programmatically set values in theme object will be used!
        */
        if( $settings_status >= $setting_level ) {

          if( $type == 'theme_mod' ) {

            $theme_mod = get_theme_mod( $options_name );

            if( $theme_mod !== false ){

              return \ZMT\Theme\Helpers::OptionValueHandling( $array_handling, $theme_mod );

            }

          } elseif( $type == 'option_mod' ) {

          /**
            * Check first if has optiontable value, if not, use default value defined in class or with setter
            */
            if($option_mod){

              $options = get_option( $option_mod );

              if( $options  !== false && is_array( $options ) ) {

                if( array_key_exists( $options_name, $options ) ) {

                  return \ZMT\Theme\Helpers::OptionValueHandling( $array_handling, $options[ $options_name ] );

                }

              }

            }

          } elseif( $type == 'option' ) {

          /**
            * Check first if has optiontable value, if not, use default value defined in class or with setter
            */
            if( get_option( $options_name )  !== false ) {

              return \ZMT\Theme\Helpers::OptionValueHandling( $array_handling, get_option( $options_name ) );

            } else {

              //add default value to options-table so its not quering for not existing entries
              add_option( $options_name , $default_value );

            }

          }

        }

        return \ZMT\Theme\Helpers::OptionValueHandling( $array_handling, $default_value );

    }

    //\ZMT\Theme\Helpers::OptionValueHandling( $array_handling,$value )
    static function OptionValueHandling($array_handling,$value){

      if ( $array_handling !== NULL ) {

        if( array_key_exists( 'function', $array_handling ) && $array_handling['function'] == 'implode' && array_key_exists( 'glue', $array_handling ) ){

          return \ZMT\Theme\Helpers::implodeIfArray( $value, $array_handling['glue'] );

        } else {

          return \ZMT\Theme\Helpers::implodeIfArray( $value );

        }

      } else {

        return $value;

      }

    }

    static function implodeIfArray($variable,$glue = ' '){

      if( is_array($variable) ){

        return implode( $glue, $variable );

      }

      return $variable;

    }


    static function setOptionMod(
      $options_name,
      $value,
      $option_mod
    ) {

      $options = get_option( $option_mod );

      if( $options  !== false && is_array( $options ) ) {

        $options[ $options_name ] = $value;

      } else {

        $options = array();
        $options[ $options_name ] = $value;

      }

      update_option($option_mod, $options);

    }

  /**
    * if vartocheck us this var
    * if no vartocheck uses defvar if available
    * if not vars, return
    * $elpartstr -> use sprintf & %s -> $elpartstr = 'class="%s"'
    */
    static function getAttribute(

  		$vartocheck,
  		$defvarifemtpy = NULL, //optional
  		$elpartstr = '%s' //optional //when class use like $elpartstr = 'class="%s"' | if in opening element, add space before attributes!

  	) {

  		if((!isset($vartocheck) || $vartocheck === '') && !isset($defvarifemtpy)) {

  			return;

  		}

  		if(!isset($vartocheck)) {

  			$vartocheck = $defvarifemtpy;

  		}

  		$result = sprintf($elpartstr,esc_attr($vartocheck));

  		return $result;

  	}

    static function renderAttrs($attrs){

      $html = NULL;

      if(is_array($attrs) && !empty($attrs)){

        foreach($attrs as $key => $value){

          $html .= ' '.esc_attr( $key ).'="'.esc_attr( $value ).'"';

        }

      }

      return $html;

    }

  /**
    * getBackgroundImage...
    */
    static function getBackgroundImageNew( $attachment_id, $background_image_size, $featured ) {

      $result = NULL;

      $featured_image = Helpers::getBackgroundFeaturedImage( $featured, $background_image_size );
      if($featured_image){
        return $featured_image;
      }

      $size = 'full';
      if($background_image_size !== NULL){
        $size = $background_image_size;
      }

      $attachment_array = wp_get_attachment_image_src( $attachment_id, $size );

      if($attachment_array !== false){

        //$result = Helpers::getAttribute( $attachment_array[0], NULL, ' style="background-image: url(%s);"' );
        //adds lazy loading to images!!! aber lädt 2 mal wenn background image && chrome webmaster tools cache is deactivated!, alles gut!
        $result = Helpers::getAttribute( $attachment_array[0], NULL, ' data-src="%s" uk-img' );

      }

      

      return $result;

    }

    static function getBackgroundImageFromUrl( $url, $background_image_size, $featured ) {

      $result = NULL;
      $featured_image = NULL;

      $featured_image = Helpers::getBackgroundFeaturedImage( $featured, $background_image_size );
      if($featured_image){
        return $featured_image;
      }

      $result = Helpers::getAttribute( $url, NULL, ' data-src="%s" uk-img' );

      return $result;

    }

    static function getBackgroundFeaturedImage($featured,$background_image_size) {

      $result = NULL;

      $size = 'full';
      if($background_image_size !== NULL){
        $size = $background_image_size;
      }

      if($featured && is_singular()){

        $url = get_the_post_thumbnail_url(null, $size);

        if($url){

          $result = Helpers::getAttribute( $url, NULL, ' data-src="%s" uk-img' );

        }

      }

      return $result;

    }

  /**
    * getStringbtwSubStrings
    *  $string = 'class="xyz"'
    *  get everything between
    *  $bef_substr = 'class="' / $aft_substr = '"'
    *  returns
    *  $result = 'xyz'
    *  @param  string $string     [string input]
    *  @param  string $bef_substr [everything after first occurence of this substring]
    *  @param  string $aft_substr [everything before occurence of substring after first position]
    *  @return string             [the string between bef and aft substring]
    */
    static function getStringbtwSubStrings($string,$bef_substr,$aft_substr){

      $result = NULL;

      if($string){

        $length_bef_substr = strlen($bef_substr);
        $start  = strpos($string, $bef_substr);
        $start  = $start + $length_bef_substr;
        $end    = strpos($string, $aft_substr, $start);
        $length = $end - $start;


        if( $start !== false && $end !== false ){

          $result = substr($string, $start, $length);

        }

        $result = trim($result);

      }

      return $result;

    }


    static function convertHEXtoRGBA( $hex, $opacity = 1 ) {

    /**
      *
      * color_text_inverse is saved as hex color but needed in cssvar in form of a part of rgba style!
      *
      * https://mekshq.com/how-to-convert-hexadecimal-color-code-to-rgb-or-rgba-using-php/
      *
      * background / color: #ffffff !important;     --> ": #ffffff"            --> rgba(var, 1)
      * rgba(255, 255, 255, 0.5)                    --> "255, 255, 255"        --> rgba(var, 0.5)
      *
      * ==> rgba( var(--color_text_inverse, 255, 255, 255), 1 );
      *
      */
      $hex = str_replace( '#', '', $hex );

      // if in 3 digit format
      if( strlen( $hex ) == 3) {

        $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
        $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
        $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );

      } else {

        $r = hexdec( substr( $hex, 0, 2 ) );
        $g = hexdec( substr( $hex, 2, 2 ) );
        $b = hexdec( substr( $hex, 4, 2 ) );

      }

      //return 'rgba( '.$r.', '.$g.', '.$b.', '.$opacity.' )';
      return $r.', '.$g.', '.$b;

    }


}
