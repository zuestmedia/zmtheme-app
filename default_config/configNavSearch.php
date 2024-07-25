<?php

namespace ZMT\Theme\DefaultConfig;

class configNavSearch extends configNav {

  public $type = 'Search';

  protected function default() {

    parent::default();

    $this->args['presets'] = 'default';

    //$this->args['search_icon'] = '{"tag":"button","attributes":{"uk-search-icon":"","class":""},"close":true,"content":{"tag":"span","attributes":{"class":"screen-reader-text"},"content":"__alabeltosethere__","close":true}}';
    $this->args['search_icon'] = '{"tag":"i","attributes":{"uk-search-icon":"","class":"","aria-hidden":"true"},"close":true}';
    $this->args['form_class'] = 'uk-search uk-search-default uk-width-1-1';
    $this->args['input_class'] = 'uk-search-input';
    $this->args['autofocus'] = 2;

    $this->args['module_wrap'] = '';
    $this->args['module_attrs'] = '';

    $this->args['content_wrap'] = '';

  }

  protected function nav() {

    parent::nav();

    $this->args['form_class'] = 'uk-search uk-search-default uk-width-1-1';
    $this->args['input_class'] = 'uk-search-input';

  }
  /* Old navbar searchform
  protected function navbar() {

    parent::navbar();

    $this->args['form_class'] = 'uk-search uk-search-navbar uk-width-small';

  }*/
  protected function navbar() {

    parent::navbar();

    $this->args['content_wrap'] = '[{"tag":"button","attributes":{"class":"uk-button uk-button-link uk-navbar-toggle"},"content":[{"tag":"i","attributes":{"style":"min-width:20px;","uk-search-icon":"{\"i18n\": {\"submit\": \"__label__\"}}","aria-hidden":"true"},"close":true},{"tag":"span","attributes":{"class":"screen-reader-text"},"content":"__label__","close":true}],"close":true},{"tag":"div","attributes":{"class":"uk-dropdown uk-padding-small","uk-drop":"mode: click; boundary: !.uk-navbar; stretch: x; flip: false; target-y: !.uk-navbar"}},{"tag":"div","attributes":{"class":"uk-grid-small uk-flex-middle","uk-grid":""},"content_end":{"tag":"div","attributes":{"class":"uk-width-auto"},"content":{"tag":"button","attributes":{"uk-close":"","class":"uk-button uk-button-link uk-drop-close"},"content":{"tag":"span","attributes":{"class":"screen-reader-text"},"content":"__label_close__","close":true},"close":true},"close":true}},{"tag":"div","attributes":{"class":"uk-width-expand"}}]';

    $this->args['form_class'] = 'uk-search uk-search-medium uk-width-1-1';
    $this->args['search_icon'] = '';
    $this->args['autofocus'] = 1;

  }


}
