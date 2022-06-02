<?php

namespace ZMT\Theme\DefaultConfig;

class configAuthorLink extends BuildModule {

  public $type = 'AuthorLink';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['module_element'] = 'div';
    $this->args['content_wrap'] = '{"tag":"b","content":" '.__('Author:', 'zmtheme').' ","close":true}';

    $this->args['linked'] = 1;
    $this->args['link_class'] = array();

  }

  protected function articlemeta() {

    $this->args['presets'] = 'default';

    $this->args['module_element'] = 'span';
    $this->args['content_wrap'] = '{"tag":"span","content":" '.__('written by', 'zmtheme').' ","close":true}';

    $this->args['linked'] = 1;
    $this->args['link_class'] = array();

  }

  protected function inline() {

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_layout_helper_article();
    $this->args['module_class_text_helpers_string'] = array('uk-display-inline', 'uk-text-small');
    
    $this->args['content_wrap'] = '{"tag":"span","content":" '.__('written by', 'zmtheme').' ","close":true}';

    $this->args['linked'] = 1;
    $this->args['link_class'] = array();

  }

}
