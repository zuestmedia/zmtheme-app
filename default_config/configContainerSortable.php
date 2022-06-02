<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerSortable extends configContainer {

  public $type = 'ContainerSortable';

  /**
    * default is always loaded
    * other child classes do use or overwrite default
    */
    protected function default() {

      parent::default();
      $this->args['sortable'] = '1';

    }

}
