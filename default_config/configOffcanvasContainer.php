<?php

namespace ZMT\Theme\DefaultConfig;

class configOffcanvasContainer extends configContainerSortable {

  public $type = 'OffcanvasContainer';

  protected function default() {

    $this->args['sortable'] = '1';

    $this->args['presets'] = 'default';

    parent::moduleouter();

    parent::module();
    parent::module_body();
    parent::module_background();
    //$this->args['module_element'] = 'nav';
    $this->args['module_wrap'] = '';

    parent::moduleinner();
    parent::moduleinner_grid_offcanvas();
    /*$this->args['moduleinner_class'] = 'uk-flex-wrap uk-child-width-1-1 uk-grid-divider';
    $this->args['moduleinner_attrs'] = '{"uk-grid":""}';*/

  }

  protected function offcanvas() {

    $this->default();

    $this->args['moduleouter_attrs'] = '{"uk-offcanvas":"overlay: true;"}';

    $this->args['module_wrap'] = '{"tag":"div","attributes":{"class":"uk-offcanvas-bar"},"content":{"tag":"button","attributes":{"type":"button","class":"uk-offcanvas-close","uk-close":""},"content":{"tag":"span","attributes":{"class":"screen-reader-text"},"content":"__label_close__","close":true},"close":true}}';

  }



}
