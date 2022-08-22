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

  /**
    * Get Filenames from Folder TemplateParts
    */
    static function getTemplatePartsChoices( $default_label = 'Default' ) {

      $array = scandir( get_template_directory().'/template-parts' );
      $new_array = array();

      foreach($array as $key => $value){

        if ($value != '.' && $value != '..'){

          $name = str_replace('-', ' ', $value);
          $name = ucwords( str_replace('.php', '', $name) );

          $new_array[ $value ] =  $name;

        }

      }

      $new_array[ 'default' ] =  $default_label;

      return $new_array;

    }

  /**
    * Get Preset Choices
    */
    static function getPresetChoices( $preset_key = NULL, $default_label = '⬤ Default', $reset_to_default_label = '↺ Reset to Default' ) {

      $new_array = array();

      global $zmtheme;

      $new_array[ 'default' ] =  $default_label;

      if($preset_key){

        if( property_exists( $zmtheme['default_presets'], $preset_key ) ){

          foreach( $zmtheme['default_presets']->$preset_key as $key => $value ){

            $new_array[ $preset_key.'__'.$key ] =  '★ '.Helpers::transformObjectKeystoLabel($key);

          }

        }

      }

      //sort array by ASC
      asort($new_array);

      //prepends the default value after sorting
      $new_array = array('default' => $default_label) + $new_array;

      $new_array[ 'reset_to_default' ] =  $reset_to_default_label;

      return $new_array;

    }

  /**
    * Get PostTypesObjects Choices
    */
    static function getPostsTemplateObjectsChoices( $default_label = 'Posts' ) {

      $new_array = array();

      global $zmtheme;

      foreach($zmtheme['default_components'] as $key => $value){

        if($key == 'posts'){

          $new_array[ 'posts' ] =  $default_label;

        }

        if( strpos( $key, 'posts_' ) !== false ){

          $label = ucfirst( str_replace( 'posts_', '', $key ) );
          $new_array[ $key ] =  $label;

        }

      }

      return $new_array;

    }
  /**
    * Get PostTypesObjects Choices
    */
    static function getCustomSectionContentChoices( $default_label = 'Default', $query_loop_label = 'QueryLoop' ) {

      $new_array = array();

      global $zmtheme;

      $new_array[ 'default' ] =  $default_label;
      $new_array[ 'queryloop' ] =  $query_loop_label;

      foreach($zmtheme['default_components'] as $key => $value){

        $label = ucfirst( str_replace( 'nav_', '', $key ) );
        $label = ucfirst( str_replace( 'offcanvas_', '', $key ) );
        $label = ucfirst( str_replace( 'comgroup_', '', $key ) );
        if( $key == 'nav' || strpos( $key, 'nav_' ) !== false || $key == 'offcanvas' || strpos( $key, 'offcanvas_' ) !== false || strpos( $key, 'comgroup_' ) !== false ||  $key == 'extensions' ){

          foreach($value as $key2 => $value2){

            if( is_object($value2) && ( property_exists( $value2, 'isstartobj' ) || $key == 'extensions' ) ){

              if($key == 'extensions'){ $label = ucfirst($key2); }

              $new_array[ $key.'__'.$key2 ] =  $label;

            }

          }

        }

      }

      return $new_array;

    }
  /**
    * Get PostTypesObjects Choices
    */
    static function getCustomSectionContentExtensionsChoices() {

      $new_array = array();

      global $zmtheme;

      foreach($zmtheme['default_components'] as $key => $value){

        $label = ucfirst( str_replace( 'comgroup_', '', $key ) );
        if(strpos( $key, 'comgroup_' ) !== false ||  $key == 'extensions' ){

          foreach($value as $key2 => $value2){

            if( is_object($value2) && ( property_exists( $value2, 'isstartobj' ) || $key == 'extensions' ) ){

              if($key == 'extensions'){ $label = ucfirst($key2); }

              $new_array[ $key.'__'.$key2 ] =  $label;

            }

          }

        }

      }

      return $new_array;

    }
  /**
    * Get PostTypesObjects Choices
    */
    static function getCustomSectionContentNavChoices() {

      $new_array = array();

      global $zmtheme;

      foreach($zmtheme['default_components'] as $key => $value){

        $label = ucfirst( str_replace( 'nav_', '', $key ) );
        if( $key == 'nav' || strpos( $key, 'nav_' ) !== false ){

          foreach($value as $key2 => $value2){

            if( is_object($value2) && property_exists( $value2, 'isstartobj' ) ){

              $new_array[ $key.'__'.$key2 ] =  $label;

            }

          }

        }

      }

      return $new_array;

    }

  /**
    * Get PostTypesObjects Choices
    */
    static function getOffcanvasChoices() {

      $new_array = array();

      global $zmtheme;

      foreach($zmtheme['default_components'] as $key => $value){

        $label = ucfirst( str_replace( 'offcanvas_', '', $key ) );
        if( $key == 'offcanvas' || strpos( $key, 'offcanvas_' ) !== false ){

          foreach($value as $key2 => $value2){

            if( is_object($value2) && property_exists( $value2, 'isstartobj' ) ){

              $new_array[ $key.'__'.$key2 ] =  $label;
              //echo $key.'__'.$key2;

            }

          }

        }

      }

      return $new_array;

    }

    static function checkDefComsObjExists( $obj_key, $default_key ){
      global $zmtheme;
      $result = $default_key;
      if( property_exists( $zmtheme['default_components'], $obj_key ) ){
        $result = $obj_key;
      }
      return $result;
    }

    static function getTemplateBlockChoices( $default_label = '- Select a block template -' ){

      $args = array(
        'post_type'   => 'zm_blocks',
        'numberposts'   => -1,
      );

      $posts_array = get_posts($args);

      $new_array = array();

      $new_array[ '0' ] =  $default_label;

      if ( $posts_array ) {

          foreach ( $posts_array  as $post ) {
              $new_array[ $post->post_name ] =  $post->post_title;
          }

      }

      return $new_array;

    }

    static function getTaxonomiesChoices(){

      $args = array(
        'public'   => true
      );

      $taxonomies = Helpers::getCleanTaxonomies($args);

      $new_array = array();

      if ( $taxonomies ) {

          foreach ( $taxonomies  as $taxonomy ) {
              $new_array[ $taxonomy ] =  Helpers::transformObjectKeystoLabel($taxonomy);
          }

      }

      return $new_array;

    }

    static function getCleanTaxonomies( $args ){

      $taxonomies = get_taxonomies( $args );

      unset($taxonomies['post_format']);

      if ( class_exists( 'bbPress' ) ) {
        unset($taxonomies['topic-tag']);// do not use: 'topic-tag' (bbpress)
      }

      if ( class_exists( 'woocommerce' ) ) {
        unset(
          $taxonomies['product_cat'],// do not use: 'product_cat' (woocommerce)
          $taxonomies['product_tag'],// do not use: 'product_tag' (woocommerce)
          $taxonomies['product_shipping_class']// do not use: 'product_shipping_class' (woocommerce)
        );
      }

      return $taxonomies;

    }

    static function getViewConditionsChoices(){

      $result = array();

      $result['frontpage']    =  __( 'Front Page (front-page)', 'zmplugin' );
      $result['page']         =  __( 'Pages', 'zmplugin' );
      $result['blogpage']     =  __( 'Blog Page (home)', 'zmplugin' );
      $result['archive']      =  __( 'Default Archive', 'zmplugin' );
      $result['category']     =  __( '└ Category Archive', 'zmplugin' );
      $result['tag']          =  __( '└ Tag Archive', 'zmplugin' );
      $result['author']       =  __( '└ Author Archive', 'zmplugin' );
      $result['date']         =  __( '└ Date Archive', 'zmplugin' );

      //taxonomy archives
      $args = array(
        'public' => true,
        '_builtin' => false, //only not builtin posttypes!
      );
      $taxarr = Helpers::getCleanTaxonomies($args);
      foreach($taxarr as $key_1 => $value_1){
        $result[ 'taxonomy_'.$key_1 ] =  '└ '.__( 'Taxonomy Archive', 'zmplugin' ).': '.$value_1;
      }

      //get post_type_archives
      $args_has_archive = array(
        'public' => true,
        '_builtin' => false, //only not builtin posttypes!
        'has_archive' => true, //only posttypes with archive!
        'capability_type' => 'post', //only post like posttypes... not forums or woocommerce...
      );
      $posttypes_archive_arr = get_post_types($args_has_archive);
      foreach($posttypes_archive_arr as $key_2 => $value_2){
        $result[ 'archive_'.$key_2 ] =  '└ '.__( 'Post Type Archive', 'zmplugin' ).': '.$value_2;
      }


      $result['single']       =  __( 'Single Post', 'zmplugin' );


      //get post_types
      $args = array(
        'public' => true,
        '_builtin' => false, //without builtin posttypes!
        'capability_type' => 'post', //only post like posttypes... not forums or woocommerce...
      );
      $posttypesarr = get_post_types($args);
      foreach($posttypesarr as $key_3 => $value_3){
        $result[ 'single_'.$key_3 ] =  __( 'Single Post Type', 'zmplugin' ).': '.$value_3;
      }



      //get singular custom Templates (same for singular page = post = posttypes)
      $singular_custom_templates = wp_get_theme()->get_page_templates();
      foreach($singular_custom_templates as $key_4 => $value_4){
        $result[ $key_4 ] =  __( 'Singular Template', 'zmplugin' ).': '.$value_4;
      }


      $result['searchpage']   =  __( 'SearchPage', 'zmplugin' );
//      $result['errorpage']    =  __( 'ErrorPage', 'zmplugin' );//NOT IN USE


      if ( class_exists( 'woocommerce' ) ) {
        $result['woocommerce'] = __( 'Woocommerce', 'zmplugin' );
      }

      if ( class_exists( 'bbPress' ) ) {
        $result['bbPress'] = __( 'bbPress', 'zmplugin' );
      }

      $result['loggedin']   =  __( 'Logged in Users', 'zmplugin' );

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

     //load_theme_textdomain( Helpers::getTextDomain() , get_template_directory().'/core/languages' );
     load_theme_textdomain( Helpers::getTextDomain(), get_template_directory().'/languages' );

     //load zmtheme framework textdomain!
     $locale = get_locale();
     load_textdomain( 'zmtheme', get_template_directory().'/app/languages/zmtheme-'.$locale.'.mo' );

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
    * getBackgroundImage
    * @return string [description]
    */
    static function getBackgroundImage( $attachment_id, $background_image_size ) {

      $result = NULL;

      $size = 'full';
      if($background_image_size !== NULL){
        $size = $background_image_size;
      }

      $attachment_array = wp_get_attachment_image_src( $attachment_id, $size );

      //$result = Helpers::getAttribute( $attachment_array[0], NULL, ' style="background-image: url(%s);"' );
      //adds lazy loading to images!!! aber lädt 2 mal wenn background image && chrome webmaster tools cache is deactivated!, alles gut!
      $result = Helpers::getAttribute( $attachment_array[0], NULL, ' data-src="%s" uk-img' );

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


}
