<?php

namespace ZMT\Theme\DefaultConfig;

class configReadMore extends BuildModule {

  public $type = 'ReadMore';

  protected function default() {

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_layout_helper_article();

    $this->args['module_class_text_helpers_string'] = array('uk-text-small');

    $this->args['link_class'] = array('uk-link-text');
    $this->args['read_more_wrap'] = '{"tag":"span","content":"__readmoretext__","content_end":{"tag":"i","attributes":{"uk-icon":"icon:arrow-right","class":"","aria-hidden":"true"},"close":true}}';

  }

}
