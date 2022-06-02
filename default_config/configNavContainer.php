<?php

namespace ZMT\Theme\DefaultConfig;

class configNavContainer extends configNav {

  public $type = 'ContainerSortable';

  protected function default() {

    $this->args['sortable'] = '1';
    $this->args['presets'] = 'default';

    parent::default();

    $this->args['content_wrap'] = '';

  }

  protected function nav() {

    parent::nav();

  }
  protected function navbar() {

    parent::navbar();
    $this->args['moduleinner_wrap'] = '';

  }


}
