<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerSortableArchiveContainer extends configContainerSortable {

  protected function default() {

    $this->args['sortable'] = '1';

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_background();
    parent::module_body();

  }

}
