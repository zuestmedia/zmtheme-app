<?php

namespace ZMT\Theme\DefaultConfig;

class configCommentsCounter extends BuildModule {

  public $type = 'CommentsCounter';

  protected function default() {

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_layout_helper_article();

    $this->args['content_wrap'] = '{"tag":"span","content":[{"tag":"i","attributes":{"uk-icon":"icon:comments","class":"uk-margin-small-right","aria-hidden":"true"},"close":true},{"tag":"span","attributes":{"class":"screen-reader-text"},"content":"__label__","close":true}],"content_end":""}';

    $this->args['linked'] = 1;
    $this->args['link_class'] = array();

  }
  protected function inline() {

    $this->default();

    $this->args['module_class_text_helpers_string'] = array('uk-display-inline', 'uk-text-small', 'uk-margin-right');

    $this->args['link_class'] = array('uk-link-text');

  }

}
