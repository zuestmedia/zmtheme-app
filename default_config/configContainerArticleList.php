<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerArticleList extends configContainer {

  protected function default() {

    $this->section_content = 'get_the_post';

    $this->args['presets'] = 'default';

    $this->args['posts_templates_object'] = 'posts';

    /*$this->args['module_element'] = 'div';
    $this->args['module_class'] = 'uk-margin-large-top';*/

    parent::module();
    parent::module_body();

    //add this class 'zm-no-full-align' if it is a grid or portfolio list --> if width not 100% add this class!!!
    //$this->args['module_class_disabled'] = 'zm-no-full-align';//activates jquery add class to body function
    $this->args['module_class_disabled'] = '';

    parent::moduleinner();
    parent::moduleinner_grid_article_list();

    $this->args['moduleinner_wrap'] = '{"tag":"hr","attributes":{"class":"uk-margin-medium-bottom"},"close":false}';



  }

}
