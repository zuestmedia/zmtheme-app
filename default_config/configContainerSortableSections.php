<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerSortableSections extends configContainerSortable {

  protected function default() {

    $this->args['sortable'] = '1';

    $this->args['presets'] = 'default';

    parent::moduleouter();
    parent::moduleouter_background();
    parent::moduleouter_background_img();

  }

}
