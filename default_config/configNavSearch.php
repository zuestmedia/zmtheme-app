<?php

namespace ZMT\Theme\DefaultConfig;

class configNavSearch extends configNav {

  public $type = 'Search';

  protected function default() {

    parent::default();

    $this->args['presets'] = 'default';

    $this->args['placeholder'] = __( 'Search' , 'zmtheme' );
    $this->args['search_icon'] = '{"tag":"span","attributes":{"uk-search-icon":""},"close":true}';
    $this->args['form_class'] = 'uk-search uk-search-default uk-width-1-1';
    $this->args['input_class'] = 'uk-search-input';
    $this->args['autofocus'] = 0;

    $this->args['module_wrap'] = '';
    $this->args['module_attrs'] = '';

    $this->args['content_wrap'] = '';

  }

  protected function nav() {

    parent::nav();

    $this->args['form_class'] = 'uk-search uk-search-default uk-width-1-1';
    $this->args['input_class'] = 'uk-search-input';

  }
  protected function navbar() {

    parent::navbar();

    $this->args['form_class'] = 'uk-search uk-search-navbar uk-width-small';

  }


}
