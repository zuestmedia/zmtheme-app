<?php

namespace ZMT\Theme\DefaultConfig;

class configNav extends BuildModule {

  protected function default() {

    $this->args['module_element'] = 'div';
    $this->args['module_class'] = '';

    $this->args['module_class_visibility'] = array();
    $this->args['module_class_width'] = array();

    $this->args['moduleinner_element'] = '';
    $this->args['moduleinner_class'] = '';
  }

  /**
  * Only nav and navbar!
  * subnav = navbar!
  */

  protected function nav() {

    $this->default();

  }
  protected function navbar() {

    $this->default();

    $this->args['module_class'] = 'zmnavitems';//used with overlay search!!!

    //only in navbar --> navcontainer, not in offcanvascontainer
    //--> always use "navbar" for _nav and "nav" for _offcanvas to create defaults
    $this->args['module_class_navbar_item_pos'] = '';
    $this->args['module_class_flex_horizontal'] = '';

    $this->args['moduleinner_element'] = 'div';
    $this->args['moduleinner_class'] = 'uk-navbar-item uk-padding-remove-horizontal';

  }


}
