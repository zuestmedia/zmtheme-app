<?php

namespace ZMT\Theme\DefaultConfig;

class configSectionNew extends BuildComponent {

  public $type = 'Section';

  protected function sections() {

    $this->args['section_class_visibility'] = array();

    $this->section();
    $this->section_sections();//vertical margin & bg-color

    $this->container();//horizontal margin

  }
  protected function main() {

    $this->args['gridchild_class_visibility'] = array();
    $this->args['section_class_disabled'] = 'zm-no-full-align';//activates jquery add class to body function

    $this->gridchild();//width & position

    $this->section();
    $this->section_main_inner();//margins & bg-color

  }
  protected function content() {

    $this->args['section_class_visibility'] = array();

    $this->section();
    $this->section_main_inner();//margins & bg-color

  }

  /**
  * Background Images config
  */
  protected function sections_w_bgimg() {
    $this->section_background_image();//adds background image controlls
    $this->sections();
  }
  protected function main_w_bgimg() {
    $this->section_background_image();//adds background image controlls
    $this->main();
  }
  protected function content_w_bgimg() {
    $this->section_background_image();//adds background image controlls
    $this->content();
  }

  /**
    * Most Default Preset Styles here, rest in ZMPro
    * - grid
    * - hero
    * - slider?
    * - slideshow?
    * - accordion?
    */
    //grids
    protected function default_grid() {
      $this->args['grid_element'] = 'div';
      $this->args['grid_attrs_grid'] = '{"uk-grid":""}';//req (default = uk-grid)
      $this->args['grid_class_child_width'] = array('uk-child-width-1-2@s','uk-child-width-1-1');
    }
    protected function sections_grid() {
      $this->sections();
      $this->default_grid();
    }
    protected function main_grid() {
      $this->main();
      $this->default_grid();
    }
    protected function content_grid() {
      $this->content();
      $this->default_grid();
    }

    //heros
    protected function default_hero() {
      $this->args['section_attrs_height'] = '{"uk-height-viewport":""}';
      $this->args['section_class_flex_vertical'] = 'uk-flex uk-flex-middle';
    }
    protected function sections_hero() {
      $this->sections();
      $this->default_hero();
    }
    protected function main_hero() {
      $this->main();
      $this->default_hero();
    }
    protected function content_hero() {
      $this->content();
      $this->default_hero();
    }

  /**
    * NEW Defaults ---> use functions for controll groups like
    * - gridchild
    * - section
    * - container
    * - grid
    * - sidebar
    */
    protected function gridchild(){
      $this->args['gridchild_element'] = 'div';
      $this->args['gridchild_class'] = '';
      $this->args['gridchild_class_width'] = array('uk-width-1-4@m');
      $this->args['gridchild_class_flex_order'] = array();
    }

    protected function section(){
      $this->args['section_element'] = 'div';
      $this->args['section_attrs'] = '';//json
      $this->args['section_class'] = '';
    }

    protected function section_sections(){
      $this->args['section_class_section'] = 'uk-section uk-section-small';
      $this->args['section_class_color_background'] = 'uk-section-transparent';
      $this->args['section_class_color_helpers'] = array();
    }

    protected function section_main_inner(){
      $this->args['section_class_color_background'] = 'uk-section-transparent';
      $this->args['section_class_color_helpers'] = array();
      $this->args['section_class_card_body'] = '';
      $this->args['section_class_card_helpers'] = array();
      $this->args['section_class_margin_vertical'] = array();
    }

    protected function section_background_image(){
      $this->args['section_background_status'] = '';
      $this->args['section_background_url'] = NULL;
      $this->args['section_background_image'] = NULL;
      $this->args['section_background_featured'] = 0;
      $this->args['section_background_image_size'] = 'full';
      $this->args['section_class_background_img'] = '';
      $this->args['section_class_background_pos'] = '';
      $this->args['section_class_background_mods'] = array();
    }

    protected function section_sticky(){
      $this->args['section_attrs_sticky'] = '';//json
    }

    protected function section_height(){
      $this->args['section_attrs_height'] = '';//json
      $this->args['section_class_flex_vertical'] = '';//use in container uk-width-1-1 when flex
    }

    protected function container(){
      $this->args['container_element'] = 'div';
      $this->args['container_class'] = '';
      $this->args['container_class_container'] = 'uk-container uk-container-small';
    }

    protected function grid(){
      //must have last element in sections / modules with custom_section_content choices
      //wrap always around last el. don't use content wrap when has custom_section_content
      $this->args['grid_wrap'] = '';//json wrap via -> class Element.php

      $this->args['grid_element'] = '';
      $this->args['grid_attrs'] = '';//json
      $this->args['grid_class'] = '';//keep... because of other _class_xy should be integrated in _attrs...


      $this->args['grid_attrs_grid'] = '';
      $this->args['grid_class_child_width'] = array();
      $this->args['grid_class_grid_mods'] = array();
      $this->args['grid_attrs_scrollspy_animation'] = '';
    }


}
