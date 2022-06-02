<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerSortableMain extends configContainerSortable {

  protected function default() {

    $this->args['sortable'] = '1';

    $this->args['presets'] = 'default';

    parent::moduleouter();
    $this->args['moduleouter_attrs'] = '{"uk-height-viewport":"expand: true"}';
    parent::moduleouter_section();
    parent::moduleouter_background();

    parent::module();
    parent::module_container();


    parent::moduleinner();
    parent::moduleinner_grid_main();

  }

}
