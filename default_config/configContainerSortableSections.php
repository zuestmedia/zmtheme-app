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

  protected function header() {
    $this->default();
    $this->args['moduleouter_element'] = 'header';
  }
  protected function main() {
    $this->default();
    $this->args['moduleouter_element'] = 'main';
    $this->args['moduleouter_attrs'] = '{"id":"content"}';
  }
  protected function footer() {
    $this->default();
    $this->args['moduleouter_element'] = 'footer';
  }

}
