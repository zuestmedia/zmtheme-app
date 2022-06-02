<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerSortableCustomContainer extends configContainerSortable {

    protected function default() {

      $this->args['sortable'] = '1';
      $this->args['presets'] = 'default';

      parent::module();
      //$this->args['module_element'] = '';
      parent::module_background();
      parent::module_body();

      parent::moduleinner();
      $this->args['moduleinner_element'] = '';
      parent::moduleinner_grid();

    }


}
