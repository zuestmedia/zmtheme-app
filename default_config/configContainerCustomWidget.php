<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerCustomWidget extends configContainer {

  use traitWidget;

  protected function default() {

    $this->args['presets'] = 'default';
    //must have last element in sections / modules with custom_section_content choices
    //wrap always around last el. don't use content wrap when has /section_content/custom_section_content
    $this->section_content = 'default';

    //$this->args['moduleouter_element'] = 'div';
    parent::moduleouter();//as surrounding div for grids / slider
    parent::moduleouter_layout_helper();

    parent::moduleinner();
    $this->args['moduleinner_element'] = '';
    parent::moduleinner_grid();

    $this->widget_area();
    $this->sidebar['module_element'] = 'hide';//hide to use grid
    //module_element / _class can not be used here because its deactivated in com_custom_widget! (its not necessary as well to use :) just to know)
  }


}
