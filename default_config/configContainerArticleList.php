<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerArticleList extends configContainer {

  public $section_content;

  protected function default() {

    $this->section_content = 'get_the_post';

    $this->args['presets'] = 'default';

    $this->args['posts_templates_object'] = 'posts';

    $this->args['ajax_posts_loading'] = 1;
    $this->args['ajax_posts_loading_container_class'] = 'uk-width-1-1 uk-text-center';
    $this->args['ajax_posts_loading_button_class'] = 'uk-button uk-button-default uk-width-medium';

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

    // TODO add this class to most inner element of query container: zmt-ajax-post-reload-container --> id adds button to load more posts to end of container
    //$this->args['moduleinner_class_ajaxreload'] = '';//must be at most inner element!!! --> uses get inner content loop with args


  }

}
