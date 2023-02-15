<?php

namespace ZMT\Theme\DefaultConfig;

class configSectionNewHTML extends configSectionNew {

  public $section_content;

  protected function default_config() {
    $this->args['presets'] = 'default';
    $this->section_content = 'get_static_html';//if custom, needs custom_section_content!
    //$this->args['static_content'] = '';//is empty by default
    //$this->args['static_content'] = '{"tag":"hr","close":false}';//is empty by default
    $this->args['static_content'] = '{"tag":"div","content":"Custom HTML content","close":true}';//is empty by default
  }

  //section in sections
  protected function sections() {
    parent::sections();//group of most default sections controlls
    $this->default_config();
  }
  //section in main
  protected function main() {
    parent::main();//group of most default main controlls
    $this->default_config();
  }

  //section in content
  protected function content() {
    parent::content();//group of most default content controlls
    $this->default_config();
  }


}
