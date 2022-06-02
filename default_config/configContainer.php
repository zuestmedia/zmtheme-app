<?php

namespace ZMT\Theme\DefaultConfig;

class configContainer extends BuildModule {

  public $type = 'Container';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['module_element'] = 'div';

  }

  //module settings

  //moduleouter
  protected function moduleouter(){
    $this->args['moduleouter_element'] = 'div';
    $this->args['moduleouter_class'] = '';
    $this->args['moduleouter_attrs'] = '';
  }
  protected function moduleouter_section(){
    $this->args['moduleouter_class_section'] = 'uk-section uk-section-medium';
  }
  protected function moduleouter_background(){
    $this->args['moduleouter_class_color_background'] = 'uk-section-transparent';
    $this->args['moduleouter_class_color_helpers'] = array();
  }
  protected function moduleouter_background_img(){
    $this->args['moduleouter_background_image'] = NULL;
    $this->args['moduleouter_background_image_size'] = 'full';
    $this->args['moduleouter_class_background_img'] = '';
    $this->args['moduleouter_class_background_pos'] = '';
    $this->args['moduleouter_class_background_mods'] = array();
  }
  protected function moduleouter_gridchild(){
    $this->args['moduleouter_class_width'] = array('uk-width-expand');
    $this->args['moduleouter_class_flex_order'] = array();
  }
  protected function moduleouter_layout_helper(){
    $this->args['moduleouter_class_text_align'] = '';
    $this->args['moduleouter_class_margin_vertical'] = array();
  }

  //module --> in BuildModule

  //moduleinner
  protected function moduleinner(){
    $this->args['moduleinner_element'] = 'div';
    $this->args['moduleinner_attrs'] = '';
    $this->args['moduleinner_class'] = '';
    $this->args['moduleinner_wrap'] = '';
  }
  protected function moduleinner_grid(){
    $this->args['moduleinner_attrs_grid'] = '';
    $this->args['moduleinner_class_child_width'] = array();
    $this->args['moduleinner_class_grid_mods'] = array();
    $this->args['moduleinner_attrs_scrollspy_animation'] = '';
  }
  protected function moduleinner_grid_main(){
    $this->args['moduleinner_attrs_grid'] = '{"uk-grid":""}';
    $this->args['moduleinner_class_child_width'] = array('uk-child-width-expand');
    $this->args['moduleinner_class_grid_mods'] = array();
    $this->args['moduleinner_attrs_scrollspy_animation'] = '';
  }
  protected function moduleinner_grid_article_list(){
    $this->args['moduleinner_attrs_grid'] = '{"uk-grid":""}';
    $this->args['moduleinner_class_child_width'] = array('uk-child-width-1-1');
    $this->args['moduleinner_class_grid_mods'] = array('uk-grid-divider');
    $this->args['moduleinner_attrs_scrollspy_animation'] = '';
  }
  protected function moduleinner_grid_offcanvas(){
    $this->args['moduleinner_attrs_grid'] = '{"uk-grid":""}';
    $this->args['moduleinner_class_child_width'] = array('uk-child-width-1-1');
    $this->args['moduleinner_class_grid_mods'] = array('uk-grid-divider');
    $this->args['moduleinner_attrs_scrollspy_animation'] = '';
  }

  //traits vorlagen
  protected function moduleinner_grid_default(){
    $this->args['moduleinner_element'] = 'div';
    $this->args['moduleinner_attrs_grid'] = '{"uk-grid":""}';
    $this->args['moduleinner_class_child_width'] = array('uk-child-width-1-2@s','uk-child-width-1-1');
    $this->args['moduleinner_class_grid_mods'] = array();
    $this->args['moduleinner_attrs_scrollspy_animation'] = '';
  }


}
