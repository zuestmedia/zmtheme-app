<?php

namespace ZMT\Theme;

class Config {

  /**
    * Construct Function
    */
    function __construct(){

      //start function
      $this->createThemeObjects();

    }

  /**
    * Creates all global objects to edit & render theme
    */
    public function createThemeObjects() {

      global $zmtheme;

    /**
      * Theme Components Create and Set Objects as $zmtheme[ $com_id ]
      */
      foreach( $zmtheme['default_components'] as $key1 => $componentsarray ){

        foreach( $componentsarray as $key2 => $component ){

          if( is_object( $component ) ){

            $com_id = $key1.'__'.$key2;

          /**
            * dynamic module Classes!
            * possilbe creating modules without registering separatly!!!
            * just load in same namespace and use via default_components
            */
            if( property_exists( $component, 'type' ) && $component->type !== NULL ){

            /**
              * get Modules with Namespace and Alt-Namespace(s)
              */
              if( property_exists( $component, 'namespace' ) ){

                $ns_modules = new \ZMT\Theme\Namespaces( '\\'.$component->namespace.'\Modules\\', array( '\ZMT\Theme\Child\Modules\\', '\ZMT\Theme\Modules\\') );//inverse order in array! first loads child, then theme

              } else {

                $ns_modules = new \ZMT\Theme\Namespaces( '\ZMT\Theme\Modules\\', '\ZMT\Theme\Child\Modules\\' );

              }

              $full_classname = $ns_modules->getClass('mod'.$component->type);

              $zmtheme[ $com_id ] = new $full_classname($com_id, $zmtheme['theme']->getSettingsStatus() );


            } else {//general module class

              $zmtheme[ $com_id ] = new \ZMT\Theme\Modules\Module($com_id, $zmtheme['theme']->getSettingsStatus() );

            }

            if( method_exists( $zmtheme[ $com_id ], 'setOptGroup' ) ){
              $zmtheme[ $com_id ]->setOptGroup( $zmtheme['theme']->getOptGroup() );
            }

            if( method_exists( $zmtheme[ $com_id ], 'setIsStartObj' ) ){
              if( property_exists( $component, 'isstartobj' ) ){
                $zmtheme[ $com_id ]->setIsStartObj( $component->isstartobj );
              }
            }

            //sets static ParentContainer Value from file, not connected to db!!!
            //but available even if com_status is off! needed here--> in getAddComMenu
            if( method_exists( $zmtheme[ $com_id ], 'setParentContainerStatic' ) ){
              if( property_exists( $component, 'args' ) && is_array( $component->args ) ){
                if( array_key_exists( 'parent_container', $component->args ) ){
                  $zmtheme[ $com_id ]->setParentContainerStatic( $component->args['parent_container'] );
                }
              }
            }

            if( method_exists( $zmtheme[ $com_id ], 'setComLockStatus' ) ){
              if( property_exists( $component, 'com_lock_status' ) ){
                $zmtheme[ $com_id ]->setComLockStatus( $component->com_lock_status );
              }
            }

            if( method_exists( $zmtheme[ $com_id ], 'setComLabel' ) ){
              if( property_exists( $component, 'com_label' ) ){
                $zmtheme[ $com_id ]->setComLabel( $component->com_label );
              }
            }

            $com_status = '1';
            if( method_exists( $zmtheme[ $com_id ], 'setComStatus' ) ){
              if( property_exists( $component, 'com_status' ) ){
                $zmtheme[ $com_id ]->setComStatus( $component->com_status );
              } else {
                $zmtheme[ $com_id ]->setComStatus( '1' );
              }
              $com_status = $zmtheme[ $com_id ]->getComStatus();
            }
            if($com_status == '1'){

              if( method_exists( $zmtheme[ $com_id ], 'setSectionContentType' ) && property_exists( $component, 'section_content' ) ){
                $zmtheme[ $com_id ]->setSectionContentType( $component->section_content );
              }

              //add default sidebar to section if its not another component
              //TODO if sections are split only create sidebar with section_block
              if( property_exists( $component, 'section_content' ) && $component->section_content == 'default' ){

                $zmtheme[ $com_id.'_defsidebar' ] = new \ZMT\Theme\Modules\modSidebar($com_id.'_defsidebar', $zmtheme['theme']->getSettingsStatus() );

                if( method_exists( $zmtheme[ $com_id.'_defsidebar' ], 'setOptGroup' ) ){
                  $zmtheme[ $com_id.'_defsidebar' ]->setOptGroup( $zmtheme['theme']->getOptGroup() );
                }

                if( property_exists( $component, 'com_label' ) ){
                  $zmtheme[ $com_id.'_defsidebar' ]->setComLabel( $component->com_label );
                }

                if ( property_exists( $component, 'sidebar' ) && is_array( $component->sidebar ) ) {
                  $zmtheme[ $com_id.'_defsidebar' ]->setArgs( $component->sidebar );
                }

              }

              if ( property_exists( $component, 'view_status' ) ) {
                $zmtheme[ $com_id ]->setViewStatus( $component->view_status );
              }
              if ( property_exists( $component, 'view_conditions' ) ) {
                $zmtheme[ $com_id ]->setViewConditions( $component->view_conditions );
              }

              if ( property_exists( $component, 'args' ) && is_array( $component->args ) ) {
                $zmtheme[ $com_id ]->setArgs( $component->args );
              }

            }

          }

        }

      }

    }


}
