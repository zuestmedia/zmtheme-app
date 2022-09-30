<?php

namespace ZMT\Theme\Templates;

class _singular extends \ZMT\Theme\ExtendModules {

  function __construct(){

    //no setting; must have file for post types to be able to choose static templates
    $this->template = new \ZMT\Theme\DefaultConfig\configTemplate();

    //articlecontainer
    $this->articlecontainer = new \ZMT\Theme\DefaultConfig\configArticleContainer('default', false); //must be named articlecontainer!!!
    $this->articlecontainer->isstartobj = 'articlecontainer';

      //active by default
      $this->title  = new \ZMT\Theme\DefaultConfig\configTitle('singular', 0,'articlecontainer',false);
      $this->date  = new \ZMT\Theme\DefaultConfig\configDate('inline',0,'articlecontainer',false);//pages are not listed in date-archives!!! so no link!
      $this->taxonomy  = new \ZMT\Theme\DefaultConfig\configTaxonomyTerms('inline_category',0,'articlecontainer',false);
        $this->taxonomy__1  = new \ZMT\Theme\DefaultConfig\configTaxonomyTerms('inline_post_tag',0,'articlecontainer');//not clonable! --> is_static_clone
      $this->authorlink  = new \ZMT\Theme\DefaultConfig\configAuthorLink('inline',0,'articlecontainer',false);
      $this->commentscounter  = new \ZMT\Theme\DefaultConfig\configCommentsCounter('inline',0,'articlecontainer',false);
      $this->editlink  = new \ZMT\Theme\DefaultConfig\configEditlink('inline',0,'articlecontainer', false);
      $this->image  = new \ZMT\Theme\DefaultConfig\configImage( 'singular', 0,'articlecontainer',false);
      $this->the_content  = new \ZMT\Theme\DefaultConfig\configTheContent( 'singular', 0,'articlecontainer',false);
      $this->linkpages  = new \ZMT\Theme\DefaultConfig\configLinkPages( 'default', 0,'articlecontainer', false );
      $this->authorbox  = new \ZMT\Theme\DefaultConfig\configAuthorBox( 'default', 0,'articlecontainer', false );
      $this->comments  = new \ZMT\Theme\DefaultConfig\configContainerComments( 'default', 0, 'articlecontainer', false );
      $this->articlelinks  = new \ZMT\Theme\DefaultConfig\configLastNextArticleLink( 'default', 0,'articlecontainer', false );

      //inactive by default
      /*$this->separator = new \ZMT\Theme\DefaultConfig\configSeparator('default',0,'articlecontainer', false );
      $this->separator->com_status = 0;*/

      $this->postmeta  = new \ZMT\Theme\DefaultConfig\configPostMeta( 'default', 0,'articlecontainer', false );
      $this->postmeta->com_status = 0;

      $this->custom_container  = new \ZMT\Theme\DefaultConfig\configContainerSortableCustomContainer( 'default', 0,'articlecontainer',false );
      $this->custom_container->com_status = 0;
      $this->custom_widget  = new \ZMT\Theme\DefaultConfig\configContainerCustomWidget( 'default', 0,'articlecontainer',false );
      $this->custom_widget->com_status = 0;
      $this->custom_block_template  = new \ZMT\Theme\DefaultConfig\configContainerCustomTemplateBlock( 'default', 0,'articlecontainer',false );
      $this->custom_block_template->com_status = 0;
      $this->custom_html  = new \ZMT\Theme\DefaultConfig\configContainerCustomHTML( 'default', 0,'articlecontainer',false );
      $this->custom_html->com_status = 0;
      $this->custom_nav  = new \ZMT\Theme\DefaultConfig\configContainerCustomNav( 'default', 0,'articlecontainer',false );
      $this->custom_nav->com_status = 0;
      $this->custom_queryloop  = new \ZMT\Theme\DefaultConfig\configContainerCustomQueryloop( 'default', 0,'articlecontainer',false );
      $this->custom_queryloop->com_status = 0;


    $this->extendModules('singular');

  }

}
