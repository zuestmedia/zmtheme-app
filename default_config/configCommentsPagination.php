<?php

namespace ZMT\Theme\DefaultConfig;

class configCommentsPagination extends BuildModule {

  public $type = 'CommentsPagination';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['show_all']  = 0;
    $this->args['prev_next'] = 0;
    $this->args['prev_text'] = __( 'Previous'  , 'zmtheme' );
    $this->args['next_text'] = __( 'Next'  , 'zmtheme' );
    $this->args['list_wrap'] = '{"tag":"ul","attributes":{"class":"uk-pagination"},"content":"%s","close":true}';

    parent::module();
    parent::module_layout_helper();

  }

}
