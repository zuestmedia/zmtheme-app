<?php

namespace ZMT\Theme\DefaultConfig;

class configNav extends BuildModule {

  protected function default() {

    $this->args['module_element'] = 'div';
    $this->args['module_class'] = '';

    $this->args['module_class_visibility'] = array();
    
    $this->args['module_class_navbar_item_pos'] = '';
    $this->args['module_class_flex_horizontal'] = '';
    $this->args['module_class_width'] = array();
    $this->args['module_class_margin_horizontal'] = array();

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

  }


}
