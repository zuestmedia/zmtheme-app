<?php

namespace ZMT\Theme;

class ExtendModules {

  /**
    *
    */
    public function extendModules($key = 'extensions'){

      global $zmextensionmodules;

      if(is_array($zmextensionmodules)){

        if(count($zmextensionmodules) != 0){

          foreach($zmextensionmodules as $extension => $values){

            $toextendingobjects = $values['extend'];

            if( array_key_exists( $key, $toextendingobjects ) ){

              $namespace = $values['namespace'];
              $config = $values['config'];

              $function = 'default';
              if( array_key_exists( 'function', $values ) ){
                $function = $values['function'];
              }

              $full_classname = '\\'.$namespace.'\Config\Modules\\'.$config;

              if(class_exists($full_classname)){

                $extension = str_replace('-', '_', $extension);

                if($key == 'extensions'){

                $this->$extension = new $full_classname( $function, false );

                } else {

                  $objtoext = $toextendingobjects[$key];

                  $parent_container = NULL;
                  if( array_key_exists( 'parent_container', $objtoext ) ){
                    $parent_container = $objtoext['parent_container'];
                  }
                  $is_static_clone = false;
                  if( array_key_exists( 'is_static_clone', $objtoext ) ){
                    $is_static_clone = $objtoext['is_static_clone'];
                  }

                  $this->$extension = new $full_classname( $function, false, $parent_container, $is_static_clone);
                  $this->$extension->com_status = 0;//only for not-extensions

                }

                //always add namespace to extensions so config finds the right module
                $this->$extension->namespace = $namespace;

              }

            }

          }

        }

      }

    }



}
