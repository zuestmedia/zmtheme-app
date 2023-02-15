<?php

namespace ZMT\Theme\DefaultConfig;

class configSectionNewWidget extends configSectionNew {

  use traitWidget;

  public $section_content;

  protected function default_config() {
    //parent::sidebar();
    $this->widget_area();
    $this->sidebar['module_element'] = 'hide';//hide to use grid
    $this->args['presets'] = 'default';
    $this->section_content = 'default';//if default, uses sidebar/widget area
  }

  //section in sections
  protected function sections() {
    parent::sections();//group of most default sections controlls
    parent::section_height();//viewportheight controlls
    parent::grid();//grid controlls
    $this->default_config();
  }

  //section in main
  protected function main() {
    parent::main();//group of most default main controlls
    parent::section_sticky();//sticky controlls
    parent::grid();//grid controlls
    $this->default_config();
  }

  //section in content
  protected function content() {
    parent::content();//group of most default content controlls
    parent::grid();//grid controlls
    $this->default_config();
  }



}
