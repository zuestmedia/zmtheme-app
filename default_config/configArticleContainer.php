<?php

namespace ZMT\Theme\DefaultConfig;

class configArticleContainer extends configContainer {

  public $type = 'ArticleContainer';

  protected function default() {

    $this->args['sortable'] = '1';

    $this->args['presets'] = 'default';

    $this->args['sticky_class'] = 'uk-sticky';//in customizer not possible getting sticky class

    $this->args['moduleouter_element'] = 'div';//as gridchild - no style!


    parent::module();
    //!!!!!!!!
        //define classname where container width selector is defined,
        //only use once per page, so the wp block editor gets the correct width and alignwide as well
        $this->args['module_class_disabled'] = 'zm-wp-block-width';
    //!!!!!!!!

    $this->args['module_element'] = 'article';//if not set, no article classes are added
    $this->args['module_class'] = 'uk-article';
    parent::module_background();
    parent::module_body();



  }

}