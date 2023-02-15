<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerComments extends configContainer {

  public $section_content;

  protected function default() {

    $this->section_content = 'get_the_comments';

    $this->args['presets'] = 'default';

  }

}
