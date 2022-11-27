<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerSortableCommentsContainer extends configContainerSortable {

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['sortable'] = '1';

    /*$this->args['module_element'] = 'div';

    $this->args['module_class'] = 'uk-margin-large-top uk-card uk-card-small uk-card-body uk-card-default';
    $this->args['module_attrs'] = '{"id":"comments"}';*/

    parent::module();
    $this->args['module_attrs'] = '{"id":"comments"}';
    parent::module_background();
    parent::module_body();

  }

}
