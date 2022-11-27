<?php

namespace ZMT\Theme\DefaultConfig;

class configDate extends BuildModule {

  public $type = 'Date';

  protected function default() {

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_layout_helper_article();

    $this->args['content_wrap'] = '{"tag":"span","content":[{"tag":"i","attributes":{"uk-icon":"icon:calendar","class":"uk-margin-small-right","aria-hidden":"true"},"close":true},{"tag":"span","attributes":{"class":"screen-reader-text"},"content":"__label__","close":true}],"content_end":""}';


    $this->args['linked'] = 0;
    $this->args['link_class'] = array();
    $this->args['date_format'] = '';//eg 'Y-m-d'

  }

  protected function inline() {

    $this->default();

    $this->args['module_class_text_helpers_string'] = array('uk-display-inline', 'uk-text-small', 'uk-margin-right');

    $this->args['link_class'] = array('uk-link-text');

  }

}
