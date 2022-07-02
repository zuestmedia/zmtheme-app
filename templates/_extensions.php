<?php

namespace ZMT\Theme\Templates;

class _extensions extends \ZMT\Theme\ExtendModules {

  function __construct(){

    if ( class_exists( 'woocommerce' ) ) {
      $this->woocommerce = new \ZMT\Theme\DefaultConfig\configWooCommerce('default',false);
    }

    if ( class_exists( 'bbPress' ) ) {
      $this->bbpress = new \ZMT\Theme\DefaultConfig\configBBPress('default',false);
    }


    $this->extendModules();

  }

}
