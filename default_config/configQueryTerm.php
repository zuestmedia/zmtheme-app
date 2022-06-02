<?php

namespace ZMT\Theme\DefaultConfig;

class configQueryTerm extends BuildModule {

  public $type = 'QueryTerm';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['taxonomy'] = 'post_tag';
    $this->args['list_wrap'] = '{"tag":"div","attributes":{"uk-grid":"","class":"uk-grid-small uk-child-width-auto"},"content":"%s","close":true}';
    $this->args['list_item'] = 'div';
    $this->args['link_class'] = array('uk-button uk-button-primary');
    $this->args['query_args_json'] = '';

    parent::module();
    parent::module_layout_helper();


  }

}
