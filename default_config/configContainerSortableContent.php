<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerSortableContent extends configContainerSortable {

  protected function default() {

    $this->args['sortable'] = '1';

    $this->args['presets'] = 'default';

    //child of grid!  expands by default!
    parent::moduleouter();
    parent::moduleouter_gridchild();

    parent::module();
    parent::module_background();
    parent::module_body();

  }

}
