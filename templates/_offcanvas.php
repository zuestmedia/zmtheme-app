<?php

namespace ZMT\Theme\Templates;

class _offcanvas extends \ZMT\Theme\ExtendModules {

  public $offcanvascontainer;
    public $site_logo;
    public $menu;
    public $search;
    public $widget;
    
    public $custom_container;
    public $custom_html;
    public $custom_queryloop;

  function __construct(){

    //sections container
    $this->offcanvascontainer = new \ZMT\Theme\DefaultConfig\configOffcanvasContainer( 'offcanvas',false );
    $this->offcanvascontainer->isstartobj = 'offcanvascontainer';

      $this->site_logo  = new \ZMT\Theme\DefaultConfig\configNavLogo( 'nav', 0, 'offcanvascontainer',false );
      $this->site_logo->com_status = 0;

      $this->menu  = new \ZMT\Theme\DefaultConfig\configNavMenu( 'nav', 0, 'offcanvascontainer',false );
      $this->menu->com_status = 0;

      $this->search  = new \ZMT\Theme\DefaultConfig\configNavSearch( 'nav', 0, 'offcanvascontainer',false );
      $this->search->com_status = 0;

      $this->widget  = new \ZMT\Theme\DefaultConfig\configNavSidebar( 'nav', 0, 'offcanvascontainer',false );
      $this->widget->com_status = 0;

      $this->custom_container  = new \ZMT\Theme\DefaultConfig\configContainerSortableCustomContainer( 'default', 0,'offcanvascontainer',false );
      $this->custom_container->com_status = 0;
      $this->custom_html  = new \ZMT\Theme\DefaultConfig\configContainerCustomHTML( 'default', 0,'offcanvascontainer',false );
      $this->custom_html->com_status = 0;
      $this->custom_queryloop  = new \ZMT\Theme\DefaultConfig\configContainerCustomQueryloop( 'default', 0,'offcanvascontainer',false );
      $this->custom_queryloop->com_status = 0;


    $this->extendModules('offcanvas');

  }

}
