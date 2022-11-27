<?php

namespace ZMT\Theme\DefaultConfig;

class configSectionNewNav extends configSectionNew {

  protected function default_config() {
    $this->args['presets'] = 'default';
    $this->section_content = 'custom';//if custom, needs custom_section_content!
    $this->args['custom_section_content'] = 'nav__navcontainer';//is the default nav
    $this->args['section_class_section'] = 'uk-section uk-padding-remove-vertical';
  }

  //section in sections
  protected function sections() {
    parent::sections();//group of most default sections controlls
    parent::section_sticky();//sticky controlls
    parent::section_height();//viewportheight controlls
    $this->default_config();
  }
  //section in main
  protected function main() {
    parent::main();//group of most default main controlls
    parent::section_sticky();//sticky controlls
    $this->default_config();
  }
  //section in content
  protected function content() {
    parent::content();//group of most default content controlls
    $this->default_config();
  }



}
