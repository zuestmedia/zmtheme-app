<?php

namespace ZMT\Theme\DefaultConfig;

class configEditlink extends BuildModule {

  public $type = 'EditLink';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['module_element'] = 'span';

    $this->args['link_class'] = array();
    $this->args['link_text'] = __( 'Edit This'  , 'zmtheme' );

  }

  protected function inline() {

    $this->args['presets'] = 'default';

    /*$this->args['module_element'] = 'div';
    $this->args['module_class'] = 'uk-display-inline uk-text-small';*/

    parent::module();
    parent::module_layout_helper_article();
    $this->args['module_class_text_helpers_string'] = array('uk-display-inline', 'uk-text-small');

    $this->args['content_wrap'] = '{"tag":"span","content":" "}';//leerschlag vor edit...

    $this->args['link_class'] = array();
    $this->args['link_text'] = __( 'Edit'  , 'zmtheme' );

  }


}
