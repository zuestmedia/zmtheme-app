<?php

namespace ZMT\Theme\Templates;

class _errorpage extends \ZMT\Theme\ExtendModules {

  public $errorpagecontainer;
    public $errorpage;
    public $search;

    public $custom_container;
    public $custom_html;

  function __construct(){

    //sections container
    $this->errorpagecontainer = new \ZMT\Theme\DefaultConfig\configContainerSortableErrorPage('default',false);
    $this->errorpagecontainer->isstartobj = 'sections';

      $this->errorpage  = new \ZMT\Theme\DefaultConfig\configErrorPage('default',0,'errorpagecontainer',false);
      $this->search  = new \ZMT\Theme\DefaultConfig\configNavSearch('nav',0,'errorpagecontainer',false);

      /*$this->separator = new \ZMT\Theme\DefaultConfig\configSeparator('default',0,'errorpagecontainer',false );
      $this->separator->com_status = 0;*/

      $this->custom_container  = new \ZMT\Theme\DefaultConfig\configContainerSortableCustomContainer( 'default', 0,'errorpagecontainer',false );
      $this->custom_container->com_status = 0;
      $this->custom_html  = new \ZMT\Theme\DefaultConfig\configContainerCustomHTML( 'default', 0,'errorpagecontainer',false );
      $this->custom_html->com_status = 0;


    $this->extendModules('errorpage');

  }

}
