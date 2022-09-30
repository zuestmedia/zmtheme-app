<?php

namespace ZMT\Theme\DefaultConfig;

class configDate extends BuildModule {

  public $type = 'Date';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['module_element'] = 'div';
    $this->args['content_wrap'] = '{"tag":"span"}';
    $this->args['linked'] = 0;
    $this->args['link_class'] = array();
    $this->args['date_format'] = '';//eg 'Y-m-d'

  }

  protected function articlemeta() {

    $this->args['presets'] = 'default';

    $this->args['module_element'] = 'span';
    $this->args['content_wrap'] = '[{"tag":"span","content":"'.__('Published on', 'zmtheme').' "},{"tag":"span"}]';
    $this->args['linked'] = 0;
    $this->args['link_class'] = array();
    $this->args['date_format'] = '';//eg 'Y-m-d'

  }

  protected function inline() {

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_layout_helper_article();
    $this->args['module_class_text_helpers_string'] = array('uk-display-inline', 'uk-text-small');

    $this->args['content_wrap'] = '[{"tag":"span","content":"'.__('Published on', 'zmtheme').' "},{"tag":"span"}]';
    $this->args['linked'] = 0;
    $this->args['link_class'] = array();
    $this->args['date_format'] = '';//eg 'Y-m-d'

  }

}
