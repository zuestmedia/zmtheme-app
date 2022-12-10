<?php

namespace ZMT\Theme\Modules;

class modOffcanvasContainer extends modContainerSortable {

  public function getAttrs($section_element_type) {

    $result = parent::getAttrs($section_element_type);

    $attr = $this->getArg($section_element_type.'_attrs');

    if( strpos( $attr, 'uk-offcanvas' ) !== false || strpos( $attr, 'uk-modal' ) !== false || strpos( $attr, 'togglecontainer' ) !== false ){

      $result .= ' id="'.esc_attr( $this->getId() ).'"';

    }

    return $result;

  }

  public function getModule() {

    $result = parent::getModule();

    $label_close = \ZMT\Theme\Helpers::getTrStr('OffcanvasContainer_label_close');//Author:

    $result = str_replace(
      array( '__label_close__' ),
      array(  esc_html( $label_close ) ),
      $result
    );

    return $result;

  }

}
