<?php

namespace ZMT\Theme\DefaultConfig;

class configLastNextArticleLink extends BuildModule {

  public $type = 'LastNextArticleLink';

  protected function default() {

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_layout_helper();

    $this->args['module_class'] = 'uk-clearfix uk-link-text';

    $this->args['content_wrap'] = '[{"tag":"nav","attributes":{"aria-label":"__label__"},"content":{"tag":"span","attributes":{"class":"screen-reader-text"},"content":"__label__","close":true},"content_end":""},{"tag":"hr","attributes":{"class":""},"close":false}]';

    $this->args['last_wrap'] = '{"tag":"span","attributes":{"class":"uk-float-left"},"content":{"tag":"i","attributes":{"uk-icon":"icon: chevron-left","aria-hidden":"true"},"close":true},"content_end":" %s"}';
    $this->args['next_wrap'] = '{"tag":"span","attributes":{"class":"uk-float-right"},"content":"%s ","content_end":{"tag":"i","attributes":{"uk-icon":"icon: chevron-right","aria-hidden":"true"},"close":true}}';
    $this->args['in_same_term'] = 0; //0 / 1
    $this->args['taxonomy'] = 'category';//taxslug if in same term is true
    $this->args['excluded_terms'] = '';//commaseplist

  }

}
