<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\View as View;
use ZMT\Theme\Helpers as Helpers;

class modSection extends \ZMT\Theme\Component {

  public function isSection() {
    return 1;
  }

  public function setArgs($args){

    parent::setArgs($args);

    if(array_key_exists( 'block_template', $args )){

      global $zmtblockassignment;

      $zmtblockassignment[ $this->getId() ] = $this->getArg('block_template');

    }

  }

/**
  * Create / add Items of Container / Section only once!!!
  */
  private $oncecreating = 1;

/**
  * Set, Get Most Outer Element of Module
  */
  public function setOnceCreating($oncecreating) {

    $this->oncecreating = $oncecreating;

  }
  public function getOnceCreating() {

    return $this->oncecreating;

  }

  //can be empty or hidden module!
  public function getHiddenSectionTemplate(){

    $result = NULL;
    if(is_customize_preview() && $this->getComLockStatus() == false){
      if (class_exists('\ZMP\Plugin\ThemeCustomizer\CustomizerHelpers') && $this->getSettingsStatus() >= 2) {

        $result = \ZMP\Plugin\ThemeCustomizer\CustomizerHelpers::getHiddenSectionTemplate($this->getId());

      }
    }
    return $result;

  }

  public function getMostInnerElement(){

    $mostinnerelement = NULL;

    if( $this->getArg( 'grid_element' ) ){

      $mostinnerelement = 'grid';

    } elseif( $this->getArg( 'container_element' ) ){

      $mostinnerelement = 'container';

    } elseif( $this->getArg( 'section_element' ) ){

      $mostinnerelement = 'section';

    } elseif( $this->getArg( 'gridchild_element' ) ){

      $mostinnerelement = 'gridchild';

    }

    return $mostinnerelement;

  }

  /**
   * [getSectionElementsStart description]
   * @return string [description]
   */
  public function getSectionElementsStart($mostinner_el) {

    $result = NULL;

    if($mostinner_el != NULL){

      $result .= $this->getElementStart('gridchild',$mostinner_el);

        $result .= $this->getElementStart('section',$mostinner_el);

          $result .= $this->getElementStart('container',$mostinner_el);

            $result .= $this->getElementStart('grid',$mostinner_el);

    }

    return $result;

  }
  /**
   * [getSectionElementsEnd description]
   * @return string [description]
   */
  public function getSectionElementsEnd($mostinner_el) {

    $result = NULL;

    if($mostinner_el != NULL){

            $result .= $this->getElementEnd('grid');

          $result .= $this->getElementEnd('container');

        $result .= $this->getElementEnd('section');

      $result .= $this->getElementEnd('gridchild');

    }

    return $result;

  }

  /**
  * Get complete > Section > Container and optional > Grid with custom > Content
  * Section is only shown, if content and slug is not NULL!
  */
  public function getSection(){

    $result = NULL;

    if( View::checkStatus( $this->getViewStatus(), $this->getViewConditions() ) == 1) {

      $content = $this->getContent();

      if( $content ) {

        $mostinner_el = $this->getMostInnerElement();

        $result .= $this->getSectionElementsStart($mostinner_el);

          $result .= $content;

        $result .= $this->getSectionElementsEnd($mostinner_el);

      }

    }

    return $result;

  }

  public function getModule(){

    if( $this->getOnceCreating() === 1 ){

      \ZMT\Theme\Render::setContent( $this->getId() );

      $this->setOnceCreating(NULL);

    }

    $section = $this->getSection();

    if($section){

      return $section;

    } else {

      return $this->getHiddenSectionTemplate();//for customizer dummy element

    }


  }

  /**
  * Get header half of > Section > Container and optional > Grid with custom > Content and > Sidebars
  * Section is only shown, if content and slug is not NULL!
  */
  public function getSectionStart(){

    $result = NULL;

    if( View::checkStatus( $this->getViewStatus(), $this->getViewConditions() ) == 1) {

      $mostinner_el = $this->getMostInnerElement();

      $result .= $this->getSectionElementsStart($mostinner_el);

    }

    return $result;

  }
  /**
  * Get header half of > Section > Container and optional > Grid with custom > Content and > Sidebars
  * Section is only shown, if content and slug is not NULL!
  */
  public function getSectionEnd(){

    $result = NULL;

    if( View::checkStatus( $this->getViewStatus(), $this->getViewConditions() ) == 1) {

      $mostinner_el = $this->getMostInnerElement();

      $result .= $this->getSectionElementsEnd($mostinner_el);

    }

    return $result;

  }

  //used for partial render callback of articlelists in __articlelistcontainer, (queryloop), section
  public function getInnerContent() {

    if( $this->getOnceCreating() === 1 ){

      \ZMT\Theme\Render::setContent( $this->getId() );

      $this->setOnceCreating(NULL);

    }

    return parent::getInnerContent();

  }


}
