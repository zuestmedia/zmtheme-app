<?php

namespace ZMT\Theme\Templates;

class _posts extends \ZMT\Theme\ExtendModules {

  function __construct(){

    //no setting; must have file for post types to be able to choose static templates
    $this->template = new \ZMT\Theme\DefaultConfig\configTemplate();

    //articlecontainer
    $this->articlecontainer = new \ZMT\Theme\DefaultConfig\configArticleContainer('default', false); //must be named articlecontainer!!!
    $this->articlecontainer->isstartobj = 'articlecontainer';

      $this->taxonomy  = new \ZMT\Theme\DefaultConfig\configTaxonomyTerms('category',0,'articlecontainer',false);
      $this->title  = new \ZMT\Theme\DefaultConfig\configTitle('posts', 0,'articlecontainer',false);
      $this->image  = new \ZMT\Theme\DefaultConfig\configImage( 'posts', 0,'articlecontainer',false);
      $this->date  = new \ZMT\Theme\DefaultConfig\configDate('inline',0,'articlecontainer',false);
      $this->authorlink  = new \ZMT\Theme\DefaultConfig\configAuthorLink('inline',0,'articlecontainer',false);
        $this->taxonomy__1  = new \ZMT\Theme\DefaultConfig\configTaxonomyTerms('inline_post_tag',0,'articlecontainer');//not clonable! --> is_static_clone
      $this->commentscounter  = new \ZMT\Theme\DefaultConfig\configCommentsCounter('inline',0,'articlecontainer',false);
      $this->editlink  = new \ZMT\Theme\DefaultConfig\configEditlink('inline',0,'articlecontainer', false);
      $this->the_content  = new \ZMT\Theme\DefaultConfig\configTheContent( 'posts', 0,'articlecontainer',false);
      $this->readmore  = new \ZMT\Theme\DefaultConfig\configReadMore( 'default', 0,'articlecontainer',false);

      $this->postmeta  = new \ZMT\Theme\DefaultConfig\configPostMeta( 'default', 0,'articlecontainer', false );
      $this->postmeta->com_status = 0;

      $this->custom_container  = new \ZMT\Theme\DefaultConfig\configContainerSortableCustomContainer( 'default', 0,'articlecontainer',false );
      $this->custom_container->com_status = 0;
      $this->custom_widget  = new \ZMT\Theme\DefaultConfig\configContainerCustomWidget( 'default', 0,'articlecontainer',false );
      $this->custom_widget->com_status = 0;
      $this->custom_html  = new \ZMT\Theme\DefaultConfig\configContainerCustomHTML( 'default', 0,'articlecontainer',false );
      $this->custom_html->com_status = 0;


    $this->extendModules('posts');

  }

}
