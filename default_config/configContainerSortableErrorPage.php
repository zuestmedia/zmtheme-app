<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerSortableErrorPage extends configContainerSortable {

  protected function default() {

    $this->args['sortable'] = '1';

    $this->args['presets'] = 'default';

    //special values...
    $this->args['moduleouter_element'] = 'div';
    $this->args['moduleouter_class'] = 'uk-flex uk-flex-middle';
    $this->args['moduleouter_attrs'] = '{"uk-height-viewport":"expand: true"}';

    parent::moduleouter_section();
    parent::moduleouter_background();
    parent::moduleouter_background_img();

    parent::module();
    parent::module_container();


  }

}
