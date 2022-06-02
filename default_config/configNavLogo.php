<?php

namespace ZMT\Theme\DefaultConfig;

class configNavLogo extends configNav {

  public $type = 'Logo';

  protected function default() {

    parent::default();

    $this->args['module_class_text_align'] = '';

    $this->args['presets'] = 'default';

    $this->args['logo_wrap'] = '[{"tag":"div","attributes":{"class":"uk-logo"},"content":"%1$s"},{"tag":"div","attributes":{"class":"uk-navbar-subtitle"},"content":"%2$s","close":true}]';
    $this->args['linked'] = 1;

    $this->args['link_class'] = array('uk-link-reset');

  }

  protected function nav() {

    parent::nav();

  }
  protected function navbar() {

    parent::navbar();

  }


}
