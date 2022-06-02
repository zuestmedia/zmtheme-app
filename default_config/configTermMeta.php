<?php

namespace ZMT\Theme\DefaultConfig;

class configTermMeta extends BuildModule {

  public $type = 'TermMeta';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['meta_key'] = '';
    $this->args['meta_wrap'] = '{"tag":"span","content":{"tag":"strong","content":"%1$s: ","close":true},"content_end":"%2$s","close":true}';
    $this->args['list_wrap'] = '{"tag":"ul","attributes":{"class":"uk-list uk-list-striped"},"content":"%s","close":true}';
    $this->args['list_item'] = 'li';
    $this->args['text_separator'] = ', ';

    parent::module();
    parent::module_layout_helper();
    $this->args['module_class_margin_vertical'] = array('uk-margin');


  }

}
