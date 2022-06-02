<?php

namespace ZMT\Theme\Modules;

class modQueryLoop extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    //here query can be ajdusted in child themes with extending app module classes!!!
    //$query_args_json = '{"post_type":"docs","tax_query":{"0":{"taxonomy":"documentation","field":"slug","terms":["setup"],"operator":"IN"},"relation":"AND"}}';
    //$query_args_json = NULL;

    //$this->setArg( $query_args_json, 'query_args_json' );

    return \ZMT\Theme\Render::getQueryLoop( $this->getId() );

  }

}
