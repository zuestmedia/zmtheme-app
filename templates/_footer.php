<?php

namespace ZMT\Theme\Templates;

class _footer extends \ZMT\Theme\ExtendModules {

  function __construct(){

    //sections container
    $this->sections = new \ZMT\Theme\DefaultConfig\configContainerSortableSections('default',false);
    $this->sections->isstartobj = 'sections';

      $this->section_nav  = new \ZMT\Theme\DefaultConfig\configSectionNewNav('sections',0,'sections',false);
      $this->section_nav->com_status = 0;

      $this->section_blocks  = new \ZMT\Theme\DefaultConfig\configSectionNewBlocks('sections_w_bgimg',0,'sections',false);
      //$this->section_blocks->com_status = 0;

      $this->section_queryloop  = new \ZMT\Theme\DefaultConfig\configSectionNewQueryloop('sections',0,'sections',false);
      $this->section_queryloop->com_status = 0;

      $this->section_html  = new \ZMT\Theme\DefaultConfig\configSectionNewHTML('sections',0,'sections',false);
      $this->section_html->com_status = 0;

      $this->section_extensions  = new \ZMT\Theme\DefaultConfig\configSectionNewExtensions('sections',0,'sections',false);
      $this->section_extensions->com_status = 0;

      $this->section_offcanvas  = new \ZMT\Theme\DefaultConfig\configSectionNewOffcanvas('sections',0,'sections',false);
      //$this->section_offcanvas->com_status = 0;

    $this->extendModules('footer');

  }

}
