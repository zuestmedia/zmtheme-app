<?php

namespace ZMT\Theme;

use ZMT\Theme\Namespaces;
use ZMT\Theme\Build;

#[\AllowDynamicProperties]

class ExtendTemplates {

  /**
    *
    */
    public function extendTemplates(){

      global $zmextensiontemplates;

      if(is_array($zmextensiontemplates)){

        if(count($zmextensiontemplates) != 0){

          foreach($zmextensiontemplates as $objectname => $values){

            $namespace = $values['namespace'];

            $n = new Namespaces( '\\'.$namespace.'\Config\Templates\\', array( '\ZMT\Theme\Child\Config\\', '\ZMT\Theme\Config\\' ) );//inverse order in array! first loads child, then theme

            $objectname = str_replace('-', '_', $objectname);

            if(class_exists('\\'.$namespace.'\Config\Templates\\'.$objectname)){

              $this->$objectname = Build::newClass( $n->getClass( $objectname ) );

            }

          }

        }

      }

    }



}
