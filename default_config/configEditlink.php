<?php

namespace ZMT\Theme\DefaultConfig;

class configEditlink extends BuildModule {

  public $type = 'EditLink';

  protected function default() {

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_layout_helper_article();

    //$this->args['content_wrap'] = '{"tag":"span","content":" "}';//leerschlag vor edit...
    $this->args['content_wrap'] = '{"tag":"span","content":{"tag":"i","attributes":{"uk-icon":"icon:pencil","class":"uk-margin-small-right","aria-hidden":"true"},"close":true},"content_end":""}';

    $this->args['link_class'] = array();

  }

  protected function inline() {

    $this->default();

    $this->args['module_class_text_helpers_string'] = array('uk-display-inline', 'uk-text-small', 'uk-margin-right');

    $this->args['link_class'] = array('uk-link-text');

  }


}
