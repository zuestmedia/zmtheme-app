<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerSortableNav extends configContainerSortable {

  protected function default() {

    $this->args['sortable'] = '1';

    $this->args['presets'] = 'default';

    parent::module();
    $this->args['module_element'] = 'div';

    parent::module_background();
    parent::module_body();
    parent::moduleinner();

    $this->args['moduleinner_attrs_navbar'] = '{"uk-navbar":""}';

  }

  protected function nav() {

    $this->default();

    $this->args['moduleinner_class'] = 'uk-flex-wrap uk-flex-center uk-child-width-1-1';

  }

  protected function navbar() {

    $this->default();

    $this->args['moduleinner_class'] = 'uk-flex-between';

  }

}
