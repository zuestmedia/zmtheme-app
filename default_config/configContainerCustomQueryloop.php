<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerCustomQueryloop extends configContainer {

  public $section_content;

  protected function default() {

    $this->args['presets'] = 'default';
    //must have last element in sections / modules with custom_section_content choices
    //wrap always around last el. don't use content wrap when has /section_content/custom_section_content
    $this->section_content = 'get_query_loop';//no other content choices
    $this->args['query_args_json'] = '{"post_type":"post"}';
    $this->args['posts_templates_object'] = 'posts';

    $this->args['ajax_posts_loading'] = 1;
    $this->args['ajax_posts_loading_container_class'] = 'uk-width-1-1 uk-text-center';
    $this->args['ajax_posts_loading_button_class'] = 'uk-button uk-button-default uk-width-medium';

    //$this->args['moduleouter_element'] = 'div';
    parent::module();//as surrounding div for grids / slider
    parent::module_layout_helper();

    parent::moduleinner();
    $this->args['moduleinner_element'] = '';
    parent::moduleinner_grid();

  }


}
