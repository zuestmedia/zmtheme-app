<?php

namespace ZMT\Theme;

class Head {

  /**
    * Construct Function
    */
    function __construct(){

      //start function
      $this->addHead();

    }

  /**
    *
    */
    public function HeadModules() {

      global $zmtheme;

      $head_modules = NULL;

      $head_modules = $zmtheme['theme']->getHeadModules();

      if( is_array($head_modules) ){

        foreach( $head_modules as $com_id ){

          echo $zmtheme[ $com_id ]->getModule();

        }

      }

    }

    public function addHead(){

      add_action('wp_head', array( $this, 'HeadModules' ));//to add in frontend
      add_action('admin_head', array( $this, 'HeadModules' ));//to add in gutenberg

    }


}
