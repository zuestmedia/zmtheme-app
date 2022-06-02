<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerComments extends configContainer {

  protected function default() {

    $this->section_content = 'get_the_comments';

    $this->args['presets'] = 'default';

  }

}
