<?php

namespace ZMT\Theme\DefaultConfig;

class configTitle extends BuildModule {

  public $type = 'Title';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['title_element'] = 'h1';
    $this->args['title_class'] = array();
    $this->args['linked'] = 0;
    $this->args['link_class'] = array('uk-link-reset');

  }

  protected function singular() {

    $this->default();

    $this->args['title_element'] = 'h1';
    $this->args['title_class'] = array('uk-article-title');
    $this->args['linked'] = 0;

  }

  protected function posts() {

    $this->default();

    $this->args['title_element'] = 'h2';
    $this->args['linked'] = 1;

  }

}
