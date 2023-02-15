<?php

namespace ZMT\Theme\Templates;

class _archive extends \ZMT\Theme\ExtendModules {

  public $archivecontainer;
    public $archivetitle;
    public $archivedescription;
    public $articlelistcontainer;
    public $pagination;
    public $queryterm;
    public $termmeta;
    
    public $custom_container;
    public $custom_widget;
    public $custom_block_template;
    public $custom_html;
    public $custom_nav;
    public $custom_queryloop;

  function __construct(){

    //container
    $this->archivecontainer = new \ZMT\Theme\DefaultConfig\configContainerSortableArchiveContainer('default',false); //must be named archivecontainer!!!
    $this->archivecontainer->isstartobj = 'archivecontainer';

      //available modules & menu (coms are not loaded in customizer if com_status = 0 or com_lock_status = 0)

      //active by default
      $this->archivetitle  = new \ZMT\Theme\DefaultConfig\configArchiveTitle('default',0,'archivecontainer',false);
      $this->archivedescription  = new \ZMT\Theme\DefaultConfig\configArchiveDescription( 'default', 0,'archivecontainer',false );
      $this->articlelistcontainer  = new \ZMT\Theme\DefaultConfig\configContainerArticleList( 'default', 0,'archivecontainer',false );
      $this->pagination  = new \ZMT\Theme\DefaultConfig\configPagination( 'default', 0,'archivecontainer',false );

      //inactive by default
      /*$this->separator = new \ZMT\Theme\DefaultConfig\configSeparator('default',0,'archivecontainer',false );
      $this->separator->com_status = 0;*/

      $this->queryterm  = new \ZMT\Theme\DefaultConfig\configQueryTerm( 'default', 0,'archivecontainer',false );
      $this->queryterm->com_status = 0;

      $this->termmeta  = new \ZMT\Theme\DefaultConfig\configTermMeta( 'default', 0,'archivecontainer',false );
      $this->termmeta->com_status = 0;

      $this->custom_container  = new \ZMT\Theme\DefaultConfig\configContainerSortableCustomContainer( 'default', 0,'archivecontainer',false );
      $this->custom_container->com_status = 0;
      $this->custom_widget  = new \ZMT\Theme\DefaultConfig\configContainerCustomWidget( 'default', 0,'archivecontainer',false );
      $this->custom_widget->com_status = 0;
      $this->custom_block_template  = new \ZMT\Theme\DefaultConfig\configContainerCustomTemplateBlock( 'default', 0,'archivecontainer',false );
      $this->custom_block_template->com_status = 0;
      $this->custom_html  = new \ZMT\Theme\DefaultConfig\configContainerCustomHTML( 'default', 0,'archivecontainer',false );
      $this->custom_html->com_status = 0;
      $this->custom_nav  = new \ZMT\Theme\DefaultConfig\configContainerCustomNav( 'default', 0,'archivecontainer',false );
      $this->custom_nav->com_status = 0;
      $this->custom_queryloop  = new \ZMT\Theme\DefaultConfig\configContainerCustomQueryloop( 'default', 0,'archivecontainer',false );
      $this->custom_queryloop->com_status = 0;


    $this->extendModules('archive');

  }

}
