<?php

namespace ZMT\Theme\DefaultConfig;

trait traitBlocks {

  protected function blocks_area() {

    // ---> add in section blocks!! $this->sidebar['module_element'] = 'hide';//needed to use grid from section!!!!!!! otherwise one div around sidebars in customizer

    $this->sidebar['widget_element'] = 'div';//only use for child grid! = outer element with default classes
    $this->sidebar['widget_class'] = '';

    $this->sidebar['widgetinner_element'] = 'div';
    $this->sidebar['widgetinner_class'] = '';

    $this->sidebar['widgetinner_class_card_color_background'] = 'uk-card-transparent';
    $this->sidebar['widgetinner_class_card_body'] = '';
    $this->sidebar['widgetinner_class_card_helpers'] = array();

    //old widget title
    $this->sidebar['widgettitle_wrap'] = '{"tag":"h4","attributes":{"class":"uk-heading-divider"}}';

  }


}
