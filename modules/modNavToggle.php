<?php

namespace ZMT\Theme\Modules;

class modNavToggle extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $toggle_wrap = $this->getArg('toggle_wrap');
    $icon_type = $this->getArg('icon_type');
    $icon_ratio = $this->getArg('icon_ratio');
    $offcanvas_module = $this->getArg('offcanvas_module');

    $label = \ZMT\Theme\Helpers::getTrStr('NavToggle_label');//Open Menu

    $toggle_wrap_rendered = NULL;
    if($toggle_wrap){

      $toggle_wrap_rendered = \ZMT\Theme\Element::processHTMLElements(json_decode($toggle_wrap,true));

      //sprintf and vsprintf not working with more than two (2) variables
      //leads to errors in customizer ... ???!!!
      $toggle_wrap_rendered = str_replace(
        array(
          '__offcanvasid__',
          '__iconratio__',
          '__icontype__',
          '__label__'
        ),
        array(
          esc_attr( $offcanvas_module ),
          esc_attr( $icon_ratio ),
          esc_attr( $icon_type ),
          esc_html( $label )
        ),
        $toggle_wrap_rendered
      );

    }


    return $toggle_wrap_rendered;

  }

}
