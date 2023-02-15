<?php

namespace ZMT\Theme\DefaultConfig;

class configSectionNewOffcanvas extends configSectionNew {

  public $section_content;
  public $view_status_hidden;

  protected function default_config() {
    $this->view_status_hidden = 1; //no view settings!
    //$this->args['presets'] = 'default'; // --- has no presets, just choose offcanvas template
    $this->section_content = 'custom';//if custom, needs custom_section_content!
    $this->args['custom_section_content'] = 'offcanvas__offcanvascontainer';//is the default offcanvas
  }

  protected function sections() {
    $this->default_config();
  }
  protected function main() {
    $this->default_config();
  }
  protected function content() {
    $this->default_config();
  }



}
