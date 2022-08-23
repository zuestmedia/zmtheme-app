<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\Helpers as Helpers;

class modContainer extends \ZMT\Theme\Modules\Module {

  public function isContainer() {
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
    * Section Content Type
    */
    private $section_content_type = NULL;

  /**
    * Set, Get Most Outer Element of Module
    */
    public function setSectionContentType($section_content_type) {

      $this->section_content_type = $section_content_type;

    }
    public function getSectionContentType() {

      return $this->section_content_type;

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

  public function getModule() {

    if( $this->getOnceCreating() === 1 ){

      \ZMT\Theme\Render::setContent( $this->getId() );

      $this->setOnceCreating(NULL);

    }

    return parent::getModule();

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
