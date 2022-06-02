<?php

namespace ZMT\Theme\DefaultConfig;

class configTheContent extends BuildModule {

  public $type = 'TheContent';

  protected function default() {

    $this->args['presets'] = 'default';
    $this->args['excerpt'] = 0;//0=content
    $this->args['excerpt_length'] = 55;//55=default

    parent::module();
    parent::module_text_helper();

    //do not remove! defines the wp-block-container
    //used in style.css to define equal margins in editor and frontend
    $this->args['module_class_disabled'] = 'zm-wp-block-container';

  }

  protected function singular() {

    $this->default();

    //$this->args['excerpt'] = 0;//0=content

    $this->args['module_class_margin_vertical'] = array('uk-margin');
    //$this->args['module_class_text_helpers'] = array('uk-clearfix');

  }

  protected function posts() {

    $this->default();

    $this->args['excerpt'] = 1;//1=excerpt

    $this->args['module_element'] = 'p';



  }


}
