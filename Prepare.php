<?php

namespace ZMT\Theme;

class Prepare {

  /**
    * Construct Function
    */
    function __construct($optgroup, $settings_status = '1' ){

      $this->optgroup = $optgroup;
      $this->settings_status = $settings_status;

      //start function
      $this->prepareDefaultComponents();

    }

  /**
    * OptionsGroupName
    * @var string
    * @access private
    */
    private $optgroup;

  /**
    * Settings Status
    * @var int
    * @access private
    */
    private $settings_status;

  /**
    * OptGroup Präfix Getters n Setters
    *
    * only necessary if has options / option_mod
    */
    public function setOptGroup($optgroup) {

      $this->optgroup = $optgroup;

    }
    protected function getOptGroup() {

      return $this->optgroup;

    }

  /**
    * Settings-Status
    */
    public function setSettingsStatus($settings_status) {

      $this->settings_status = $settings_status;

    }
    public function getSettingsStatus() {

      return $this->settings_status;

    }

  /**
    * Create Virtual Components/Modules
    */
    public function getVirtualComOptionsModName() {

      return $this->getOptGroup().'_virtual_com';

    }
    static function getVirtualComOptionsModNamewithoutOptGroup() {

      return '_virtual_com';

    }
    public function getVirtualComDefaultValue() {

      return NULL;

    }
    public function getVirtualCom( $com_id ) {

      return Helpers::getOptionNew(
        $com_id,
        $this->getVirtualComDefaultValue(),
        $this->getSettingsStatus(),
        'option_mod',
        $this->getVirtualComOptionsModName()
      );

    }
    public function getVirtualComsArray() {

      return Helpers::getOptionNew(
        $this->getVirtualComOptionsModName(),
        NULL,
        $this->getSettingsStatus(),
        'option'
      );

    }

  /**
    * Create Virtual Components/Modules
    */
    public function getTemplateConfigOptionsModName() {

      return $this->getOptGroup().'_template_config';

    }
    static function getTemplateConfigOptionsModNamewithoutOptGroup() {

      return '_template_config';

    }
    public function getTemplateConfigDefaultValue() {

      return NULL;

    }
    public function getTemplateConfig( $template_group ) {

      return Helpers::getOptionNew(
        $template_group,
        $this->getTemplateConfigDefaultValue(),
        $this->getSettingsStatus(),
        'option_mod',
        $this->getTemplateConfigOptionsModName()
      );

    }
    public function getTemplateConfigsArray() {

      return Helpers::getOptionNew(
        $this->getTemplateConfigOptionsModName(),
        NULL,
        $this->getSettingsStatus(),
        'option'
      );

    }

  /**
    * CleaningThemeMods
    */
    public function getCleaningThemeModsOptionsModName() {

      return $this->getOptGroup().'_cleaning_thememods';

    }
    static function getCleaningThemeModsOptionsModNamewithoutOptGroup() {

      return '_cleaning_thememods';

    }
    public function getCleaningThemeModsDefaultValue() {

      return NULL;

    }
    public function getCleaningThemeMods( $com_id ) {

      return Helpers::getOptionNew(
        $com_id,
        $this->getCleaningThemeModsDefaultValue(),
        $this->getSettingsStatus(),
        'option_mod',
        $this->getCleaningThemeModsOptionsModName()
      );

    }
    public function getCleaningThemeModsArray() {

      return Helpers::getOptionNew(
        $this->getCleaningThemeModsOptionsModName(),
        NULL,
        $this->getSettingsStatus(),
        'option'
      );

    }
    private function checkThemeModKey($key){

      $expired_theme_mod_keys_array = $this->getCleaningThemeModsArray();

      foreach($expired_theme_mod_keys_array as $key_praefix => $value){

        $key_praefix = $key_praefix.'_args_';

        if(strpos($key, $key_praefix) !== false){

          return true;

        }

      }

    }
    //analog logic from remove_theme_mod taken
    private function cleanExpiredThemeMods(){

      $expired_theme_mod_keys_array = $this->getCleaningThemeModsArray();

      if($expired_theme_mod_keys_array){

        $theme_mods_array = get_theme_mods();

        foreach( $theme_mods_array  as $key => $value){

          if( $this->checkThemeModKey($key) ){

            //remove single theme_mod from array
            if ( isset( $theme_mods_array[ $key ] ) ) {
              unset( $theme_mods_array[ $key ] );
            }

          }

        }

        //update all theme_mods
        $theme = get_option( 'stylesheet' );
        update_option( "theme_mods_$theme", $theme_mods_array );

        delete_option( $this->getCleaningThemeModsOptionsModName() );

      }

    }

    public function addCustomTemplatesProgramaticallyatInit(){
      add_action('init', array( $this, 'addCustomTemplatesProgramatically' ));
    }

    public function addCustomTemplatesProgramatically(){

      add_action( 'theme_page_templates', array( $this, 'CustomTemplatesProgramatically') );
      add_action( 'theme_post_templates', array( $this, 'CustomTemplatesProgramatically') );

      $args = array(
        'public' => true,
        '_builtin' => false, //without builtin posttypes!
        'capability_type' => 'post', //only post like posttypes... not forums or woocommerce...
      );

      $posttypesarr = get_post_types($args);
      //var_dump($posttypesarr);
      foreach($posttypesarr as $post_type){

        add_action( "theme_{$post_type}_templates", array( $this, 'CustomTemplatesProgramatically') );

      }

    }
    public function CustomTemplatesProgramatically($templates){

      global $zmtheme;

      foreach($zmtheme['default_components'] as $key => $value){

        if(strpos($key, 'singular_') !== false ){

          if(!array_key_exists($key,$templates)){

            $templates[$key] = \ZMT\Theme\Helpers::transformObjectKeystoLabel($key);

          }

        }

      }

      return $templates;

    }

  /**
    * prepareDefaultComponents according to wp-admin settings
    * @var object
    * @access private
    */
    public function prepareDefaultComponents() {

      //delete theme mods if there is an entry in options _cleaning_thememods
      $this->cleanExpiredThemeMods();

      $virtualcoms_arr = $this->getVirtualComsArray();

      $templateconfig_arr = $this->getTemplateConfigsArray();

      if( $virtualcoms_arr || $templateconfig_arr ){

        global $zmtheme;

        $object = $zmtheme['default_components'];

        if($templateconfig_arr){

          //var_dump($templateconfig_arr);

          foreach($templateconfig_arr as $key => $com_arr){

            if($key == 'archives'){

              foreach($com_arr as $key2 => $new_clone){

                $component = $object->archive; //'archive' has to exist always, no check!
                $new_clone = \ZMT\Theme\Helpers::modifyTaxandPostTypeSlugtoObject($new_clone); //make lowercase and replace dashes to underscore
                $object->$new_clone = clone $component; //here the clone is created highest object level

              }

            } elseif($key == 'posts'){

              foreach($com_arr as $key2 => $new_clone){

                $component = $object->posts; //'posts' has to exist always, no check!
                $new_clone = \ZMT\Theme\Helpers::modifyTaxandPostTypeSlugtoObject($new_clone);
                $object->$new_clone = clone $component; //here the clone is created highest object level

              }

            } elseif($key == 'single'){

              foreach($com_arr as $key2 => $new_clone){

                $key = \ZMT\Theme\Helpers::checkDefComsObjExists('single', 'posts');
                $component = $object->$key; //'posts' has to exist always, no check!
                $new_clone = \ZMT\Theme\Helpers::modifyTaxandPostTypeSlugtoObject($new_clone);
                $object->$new_clone = clone $component; //here the clone is created highest object level

              }

            } elseif($key == 'page'){

              foreach($com_arr as $key2 => $new_clone){

                $key = \ZMT\Theme\Helpers::checkDefComsObjExists('page', 'posts');
                $component = $object->$key; //'posts' has to exist always, no check!
                $new_clone = \ZMT\Theme\Helpers::modifyTaxandPostTypeSlugtoObject($new_clone);
                $object->$new_clone = clone $component; //here the clone is created highest object level

              }

            } elseif($key == 'singular'){

              foreach($com_arr as $key2 => $new_clone){

                $key = \ZMT\Theme\Helpers::checkDefComsObjExists('single', 'posts');
                $component = $object->$key; //'posts' has to exist always, no check!
                $new_clone = \ZMT\Theme\Helpers::modifyTaxandPostTypeSlugtoObject($new_clone);
                $object->$new_clone = clone $component; //here the clone is created highest object level

              }

              //once is enough, has own loop.
              //$this->addCustomTemplatesProgramatically();
              $this->addCustomTemplatesProgramaticallyatInit();

            } elseif($key == 'nav'){

              foreach($com_arr as $key2 => $new_clone){

                $component = $object->nav; //'nav' has to exist always, no check!
                $new_clone = \ZMT\Theme\Helpers::modifyTaxandPostTypeSlugtoObject($new_clone); //make lowercase and replace dashes to underscore
                $object->$new_clone = clone $component; //here the clone is created highest object level

              }

            } elseif($key == 'offcanvas'){

              foreach($com_arr as $key2 => $new_clone){

                $component = $object->offcanvas; //'nav' has to exist always, no check!
                $new_clone = \ZMT\Theme\Helpers::modifyTaxandPostTypeSlugtoObject($new_clone); //make lowercase and replace dashes to underscore
                $object->$new_clone = clone $component; //here the clone is created highest object level

              }

            }

          }

        } //templateconfig

        if($virtualcoms_arr){

          foreach($virtualcoms_arr as $com_id => $value){

            //$component_type first part before _
            //$component_type = strtok($com_id, '__');
            $component_type = substr($com_id, 0, strpos($com_id, '__'));

            //$component_name second part after _
            $component_name = substr($com_id, strpos($com_id, '__') + 2);

            //old com name
            //$old_component_name = strtok($component_name, '__');
            $old_component_name = substr($component_name, 0, strpos($component_name, '__'));

            if( property_exists( $object, $component_type ) ){

              $com_types_object = $object->$component_type;

              if( property_exists( $com_types_object, $old_component_name ) ){

                $component = $com_types_object->$old_component_name;

                //here the clone is created!
                //$com_types_object->$component_name = $component;
                $com_types_object->$component_name = clone $component;

                $com_types_object->$component_name->is_virtual_com = 1;
                $com_types_object->$component_name->com_status = 1;
                $com_types_object->$component_name->args['item_position'] = 0;

              }

            }

          }

        }

      }

    } //end of func prepareDefaultComponents


}
