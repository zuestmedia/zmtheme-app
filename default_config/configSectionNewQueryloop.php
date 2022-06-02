<?php

namespace ZMT\Theme\DefaultConfig;

class configSectionNewQueryloop extends configSectionNew {

  protected function default_config() {
    $this->args['presets'] = 'default';
    $this->section_content = 'get_query_loop';//no other content choices
    $this->args['query_args_json'] = '{"post_type":"post"}';
    $this->args['posts_templates_object'] = 'posts';
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
