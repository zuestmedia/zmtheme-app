<?php

namespace ZMT\Theme\DefaultConfig;

class configTemplate extends BuildComponent {

  public $type = 'Template';

  function __construct( $key = 'default' ){

  /**
    * loads only the specific arguments in child config files
    */
    if($key){
      if(method_exists($this, $key)){
        $this->$key();
      }
    }

  }

  protected function default() {

    $this->section_content = 'get_the_post';
    $this->args['template_part'] = 'default';

  }

}
