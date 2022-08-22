<?php

namespace ZMT\Theme\DefaultConfig;

class BuildModule extends BuildComponent {

  function __construct(
      $key = 'default',
      $item_position = 0,
      $parent_container = NULL,
      $is_static_clone = true
    ){

    parent::__construct($key,$item_position,$parent_container,$is_static_clone);

  }

  protected function module(){
    $this->args['module_element'] = 'div';
    $this->args['module_class'] = '';
    $this->args['module_attrs'] = '';
  }
  protected function module_container(){
    $this->args['module_class_container'] = 'uk-container uk-container-default';
  }
  protected function module_background(){
    $this->args['module_class_color_background'] = 'uk-section-transparent';
    $this->args['module_class_color_helpers'] = array();
  }
  protected function module_body(){
    $this->args['module_class_card_body'] = '';
    $this->args['module_class_margin_vertical'] = array();
    $this->args['module_class_card_helpers'] = array();
  }
  protected function module_layout_helper(){
    //$this->args['module_class_text_align'] = '';//only align options
    $this->args['module_class_margin_vertical'] = array();
  }
  protected function module_layout_helper_article(){
    $this->args['module_class_text_helpers_string'] = array();
    $this->args['module_class_margin_vertical'] = array();
  }
  protected function module_text_helper(){
    $this->args['module_class_margin_vertical'] = array();
    $this->args['module_class_text_helpers'] = array();//all text options: align, size, color, dropcap
  }
  protected function module_image_helper(){
    $this->args['module_class_image_background_color'] = '';
    $this->args['module_class_image_container_size'] = array();
    $this->args['module_class_margin_vertical'] = array();
    $this->args['module_class_card_helpers'] = array();
  }

}
