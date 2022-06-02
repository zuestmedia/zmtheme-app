<?php

namespace ZMT\Theme\DefaultConfig;

class configQueryLoop extends BuildModule {

  public $type = 'QueryLoop';

  //not in use anymore --> use section_queryloop or custom_queryloop

  protected function default() {

    $this->args['presets'] = 'default';

    //$this->section_content = 'get_query_loop';
    $this->args['query_args_json'] = '{"post_type":"docs","tax_query":{"0":{"taxonomy":"documentation","field":"slug","terms":["setup"],"operator":"IN"},"relation":"AND"}}';
    $this->args['posts_templates_object'] = 'posts_theme';

    $this->args['module_element'] = 'div';

  }

}
