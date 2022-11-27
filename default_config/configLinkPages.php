<?php

namespace ZMT\Theme\DefaultConfig;

class configLinkPages extends BuildModule {

  public $type = 'LinkPages';

  protected function default() {

    $this->args['presets'] = 'default';

    /*$this->args['module_element'] = 'div';
    $this->args['module_class'] = 'uk-link-text uk-text-right';*/

    parent::module();
    parent::module_layout_helper_article();
    $this->args['module_class_text_helpers_string'] = array('uk-text-right', 'uk-text-small');

    $this->args['content_wrap'] = '{"tag":"nav","attributes":{"aria-label":"__label__","class":"uk-link-text"},"content":{"tag":"span","attributes":{"class":"screen-reader-text"},"content":"__label__","close":true},"content_end":""}';

    $this->args['next_or_number'] = 'number';
    $this->args['text_separator'] = ', ';

  }

}
