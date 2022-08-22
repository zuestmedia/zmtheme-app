<?php

namespace ZMT\Theme\Templates;

class _center extends \ZMT\Theme\ExtendModules {

  function __construct(){

    //Container: section
    $this->sections = new \ZMT\Theme\DefaultConfig\configContainerSortableSections('default', false);
    $this->sections->isstartobj = 'sections';

      $this->section_nav  = new \ZMT\Theme\DefaultConfig\configSectionNewNav('sections',0,'sections',false);
      $this->section_nav->com_status = 0;

      $this->section_block_template  = new \ZMT\Theme\DefaultConfig\configSectionNewTemplateBlock('sections_w_bgimg',0,'sections',false);
      $this->section_block_template->com_status = 0;

      $this->section_widget  = new \ZMT\Theme\DefaultConfig\configSectionNewWidget('sections_w_bgimg',0,'sections',false);
      $this->section_widget->com_status = 0;

      $this->section_queryloop  = new \ZMT\Theme\DefaultConfig\configSectionNewQueryloop('sections',0,'sections',false);
      $this->section_queryloop->com_status = 0;

      $this->section_html  = new \ZMT\Theme\DefaultConfig\configSectionNewHTML('sections',0,'sections',false);
      $this->section_html->com_status = 0;

      $this->section_extensions  = new \ZMT\Theme\DefaultConfig\configSectionNewExtensions('sections',0,'sections',false);
      $this->section_extensions->com_status = 0;

      $this->section_offcanvas  = new \ZMT\Theme\DefaultConfig\configSectionNewOffcanvas('sections',0,'sections',false);
      $this->section_offcanvas->com_status = 0;

      //Container: main_section
      $this->main = new \ZMT\Theme\DefaultConfig\configContainerSortableMain('default',0,'sections');

        $this->main_section_nav  = new \ZMT\Theme\DefaultConfig\configSectionNewNav('main',0,'main',false);
        $this->main_section_nav->com_status = 0;

        $this->main_section_block_template  = new \ZMT\Theme\DefaultConfig\configSectionNewTemplateBlock('main_w_bgimg',0,'main',false);
        $this->main_section_block_template->com_status = 0;

        $this->main_section_widget  = new \ZMT\Theme\DefaultConfig\configSectionNewWidget('main_w_bgimg',0,'main',false);
        $this->main_section_widget->com_status = 0;

        $this->main_section_queryloop  = new \ZMT\Theme\DefaultConfig\configSectionNewQueryloop('main',0,'main',false);
        $this->main_section_queryloop->com_status = 0;

        $this->main_section_html  = new \ZMT\Theme\DefaultConfig\configSectionNewHTML('main',0,'main',false);
        $this->main_section_html->com_status = 0;

        $this->main_section_extensions  = new \ZMT\Theme\DefaultConfig\configSectionNewExtensions('main',0,'main',false);
        $this->main_section_extensions->com_status = 0;

        $this->main_section_offcanvas  = new \ZMT\Theme\DefaultConfig\configSectionNewOffcanvas('main',0,'main',false);
        $this->main_section_offcanvas->com_status = 0;

        //Container: content_section
        $this->content = new \ZMT\Theme\DefaultConfig\configContainerSortableContent('default',0,'main');

          $this->content_section_nav  = new \ZMT\Theme\DefaultConfig\configSectionNewNav('content',0,'content',false);
          $this->content_section_nav->com_status = 0;

          $this->content_section_block_template  = new \ZMT\Theme\DefaultConfig\configSectionNewTemplateBlock('content_w_bgimg',0,'content',false);
          $this->content_section_block_template->com_status = 0;

          $this->content_section_widget  = new \ZMT\Theme\DefaultConfig\configSectionNewWidget('content_w_bgimg',0,'content',false);
          $this->content_section_widget->com_status = 0;

          $this->content_section_queryloop  = new \ZMT\Theme\DefaultConfig\configSectionNewQueryloop('content',0,'content',false);
          $this->content_section_queryloop->com_status = 0;

          $this->content_section_html  = new \ZMT\Theme\DefaultConfig\configSectionNewHTML('content',0,'content',false);
          $this->content_section_html->com_status = 0;

          $this->content_section_extensions  = new \ZMT\Theme\DefaultConfig\configSectionNewExtensions('content',0,'content',false);
          $this->content_section_extensions->com_status = 0;

          $this->content_section_offcanvas  = new \ZMT\Theme\DefaultConfig\configSectionNewOffcanvas('content',0,'content',false);
          $this->content_section_offcanvas->com_status = 0;

          //active by default
          $this->index = new \ZMT\Theme\DefaultConfig\configSectionIndex('default',0,'content');



    $this->extendModules('center');

  }

}
