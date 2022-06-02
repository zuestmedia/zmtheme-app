<?php

namespace ZMT\Theme\DefaultConfig;

class configReadMore extends BuildModule {

  public $type = 'ReadMore';

  protected function default() {

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_layout_helper_article();

    $this->args['read_more'] = __( 'Read More', 'zmtheme' );
    $this->args['link_class'] = array('uk-button uk-button-text', 'uk-button-small');

  }

}
