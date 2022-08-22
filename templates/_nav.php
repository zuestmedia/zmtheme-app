<?php

namespace ZMT\Theme\Templates;

class _nav extends \ZMT\Theme\ExtendModules {

  function __construct(){

    //sections container
    $this->navcontainer = new \ZMT\Theme\DefaultConfig\configContainerSortableNav( 'navbar',false );
    $this->navcontainer->isstartobj = 'navcontainer';

      $this->site_logo  = new \ZMT\Theme\DefaultConfig\configNavLogo( 'navbar',0,'navcontainer',false );

      $this->menu  = new \ZMT\Theme\DefaultConfig\configNavMenu( 'navbar', 0,'navcontainer',false );
      $this->menu->com_status = 0;

      $this->offcanvas_toggle  = new \ZMT\Theme\DefaultConfig\configNavToggle( 'navbar', 0,'navcontainer',false );
      $this->offcanvas_toggle->com_status = 0;

      $this->search  = new \ZMT\Theme\DefaultConfig\configNavSearch( 'navbar', 0,'navcontainer',false );
      $this->search->com_status = 0;

      $this->widget  = new \ZMT\Theme\DefaultConfig\configNavSidebar( 'navbar', 0,'navcontainer',false );
      $this->widget->com_status = 0;

      $this->navcontainer_inner  = new \ZMT\Theme\DefaultConfig\configNavContainer( 'navbar', 0,'navcontainer',false );
      $this->navcontainer_inner->com_status = 0;

      $this->custom_container  = new \ZMT\Theme\DefaultConfig\configContainerSortableCustomContainer( 'default', 0,'navcontainer',false );
      $this->custom_container->com_status = 0;
      $this->custom_html  = new \ZMT\Theme\DefaultConfig\configContainerCustomHTML( 'default', 0,'navcontainer',false );
      $this->custom_html->com_status = 0;
      $this->custom_queryloop  = new \ZMT\Theme\DefaultConfig\configContainerCustomQueryloop( 'default', 0,'navcontainer',false );
      $this->custom_queryloop->com_status = 0;


    $this->extendModules('nav');

  }

}
