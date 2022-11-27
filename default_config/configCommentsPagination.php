<?php

namespace ZMT\Theme\DefaultConfig;

class configCommentsPagination extends BuildModule {

  public $type = 'CommentsPagination';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['show_all']  = 0;
    $this->args['prev_next'] = 0;
    $this->args['list_wrap'] = '[{"tag":"hr","close":true},{"tag":"nav","attributes":{"aria-label":"__label__"},"content":[{"tag":"span","attributes":{"class":"screen-reader-text"},"content":"__label__","close":true},{"tag":"ul","attributes":{"class":"uk-pagination"},"content":"%s","close":true}],"close":true}]';

    parent::module();
    parent::module_layout_helper();

  }

}
