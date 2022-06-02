<?php

namespace ZMT\Theme\DefaultConfig;

class configPagination extends BuildModule {

  public $type = 'Pagination';

  protected function default() {

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_layout_helper();
    $this->args['module_class_margin_vertical'] = array('uk-margin-top');

    $this->args['show_all']  = 0;
    $this->args['prev_next'] = 0;
    $this->args['prev_text'] = __( 'Previous'  , 'zmtheme' );
    $this->args['next_text'] = __( 'Next'  , 'zmtheme' );
    //$this->args['list_wrap'] = '[{"tag":"hr","attributes":{"class":"uk-margin-large-top"},"close":false},{"tag":"ul","attributes":{"class":"uk-pagination"},"content":"%s","close":true}]';
    $this->args['list_wrap'] = '{"tag":"ul","attributes":{"class":"uk-pagination"},"content":"%s","close":true}';

  }

}
