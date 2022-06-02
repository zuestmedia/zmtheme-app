<?php

namespace ZMT\Theme\Templates;

class _offcanvas extends \ZMT\Theme\ExtendModules {

  function __construct(){

    //sections container
    $this->offcanvascontainer = new \ZMT\Theme\DefaultConfig\configOffcanvasContainer( 'offcanvas',false );
    $this->offcanvascontainer->isstartobj = 'offcanvascontainer';

      $this->site_logo  = new \ZMT\Theme\DefaultConfig\configNavLogo( 'nav', 0, 'offcanvascontainer',false );
      $this->menu  = new \ZMT\Theme\DefaultConfig\configNavMenu( 'nav', 0, 'offcanvascontainer',false );
      $this->search  = new \ZMT\Theme\DefaultConfig\configNavSearch( 'nav', 0, 'offcanvascontainer',false );

      $this->blocks  = new \ZMT\Theme\DefaultConfig\configNavSidebar( 'nav', 0, 'offcanvascontainer',false );
      $this->blocks->com_status = 0;

      $this->custom_container  = new \ZMT\Theme\DefaultConfig\configContainerSortableCustomContainer( 'default', 0,'offcanvascontainer',false );
      $this->custom_container->com_status = 0;
      $this->custom_html  = new \ZMT\Theme\DefaultConfig\configContainerCustomHTML( 'default', 0,'offcanvascontainer',false );
      $this->custom_html->com_status = 0;
      $this->custom_queryloop  = new \ZMT\Theme\DefaultConfig\configContainerCustomQueryloop( 'default', 0,'offcanvascontainer',false );
      $this->custom_queryloop->com_status = 0;


    $this->extendModules('offcanvas');

  }

}
