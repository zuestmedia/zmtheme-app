<?php

namespace ZMT\Theme\DefaultConfig;

class configErrorPage extends BuildModule {

  public $type = 'ErrorPage';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['title_element'] = 'h1';
    $this->args['title_class'] = array('uk-heading-medium');

    parent::module();
    parent::module_layout_helper();

  }


}
