<?php

namespace ZMT\Theme\Templates;

class _comments extends \ZMT\Theme\ExtendModules {

  public $commentscontainer;
    public $commentslist;
    public $commentspagination;
    public $commentsform;

    public $custom_container;
    public $custom_html;

  function __construct(){

    //sortable container
    $this->commentscontainer = new \ZMT\Theme\DefaultConfig\configContainerSortableCommentsContainer('default',false);
    $this->commentscontainer->isstartobj = 'commentscontainer';

      //active by default
      $this->commentslist  = new \ZMT\Theme\DefaultConfig\configCommentsList('default',0,'commentscontainer',false);
      $this->commentspagination  = new \ZMT\Theme\DefaultConfig\configCommentsPagination('default',0,'commentscontainer',false);
      $this->commentsform  = new \ZMT\Theme\DefaultConfig\configCommentsForm('default',0,'commentscontainer',false);

      /*$this->separator = new \ZMT\Theme\DefaultConfig\configSeparator('default',0,'commentscontainer',false );
      $this->separator->com_status = 0;*/

      $this->custom_container  = new \ZMT\Theme\DefaultConfig\configContainerSortableCustomContainer( 'default', 0,'commentscontainer',false );
      $this->custom_container->com_status = 0;
      $this->custom_html  = new \ZMT\Theme\DefaultConfig\configContainerCustomHTML( 'default', 0,'commentscontainer',false );
      $this->custom_html->com_status = 0;


    $this->extendModules('comments');

  }

}
