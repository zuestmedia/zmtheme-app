<?php

namespace ZMT\Theme\DefaultConfig;

class configCommentsCounter extends BuildModule {

  public $type = 'CommentsCounter';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['module_element'] = 'div';

    $this->args['linked'] = 1;
    $this->args['link_class'] = array();
    $this->args['no_comments'] = __( 'No Comments' , 'zmtheme' );
    $this->args['one_comment'] = __( '%s Comment'  , 'zmtheme' );
    $this->args['more_than_one_comment'] = __( '%s Comments' , 'zmtheme' );

  }

  protected function articlemeta() {

    $this->args['presets'] = 'default';

    $this->args['module_element'] = 'span';
    $this->args['content_wrap'] = '{"tag":"span","content":" '.__('having', 'zmtheme').' ","close":true}';

    $this->args['linked'] = 1;
    $this->args['link_class'] = array();
    $this->args['no_comments'] = __( 'no Comments' , 'zmtheme' );
    $this->args['one_comment'] = __( '%s Comment'  , 'zmtheme' );
    $this->args['more_than_one_comment'] = __( '%s Comments' , 'zmtheme' );

  }
  protected function inline() {

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_layout_helper_article();
    $this->args['module_class_text_helpers_string'] = array('uk-display-inline', 'uk-text-small');

    $this->args['content_wrap'] = '{"tag":"span","content":" '.__('having', 'zmtheme').' ","close":true}';

    $this->args['linked'] = 1;
    $this->args['link_class'] = array();
    $this->args['no_comments'] = __( 'no Comments' , 'zmtheme' );
    $this->args['one_comment'] = __( '%s Comment'  , 'zmtheme' );
    $this->args['more_than_one_comment'] = __( '%s Comments' , 'zmtheme' );

  }

}
