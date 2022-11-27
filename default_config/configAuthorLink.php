<?php

namespace ZMT\Theme\DefaultConfig;

class configAuthorLink extends BuildModule {

  public $type = 'AuthorLink';

/**
  * Available Text-Variables: __content_before__
  */
  protected function default() {

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_layout_helper_article();

    $this->args['content_wrap'] = '{"tag":"span","content":[{"tag":"i","attributes":{"uk-icon":"icon:user","class":"uk-margin-small-right","aria-hidden":"true"},"close":true},{"tag":"span","attributes":{"class":"screen-reader-text"},"content":"__label__","close":true}],"content_end":""}';

    $this->args['linked'] = 1;
    $this->args['link_class'] = array();

  }

  protected function inline() {

    $this->default();

    $this->args['module_class_text_helpers_string'] = array('uk-display-inline', 'uk-text-small', 'uk-margin-right');

    $this->args['link_class'] = array('uk-link-text');

  }

}
