<?php

namespace ZMT\Theme\DefaultConfig;

class configArchiveTitle extends BuildModule {

  public $type = 'ArchiveTitle';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['title_element'] = 'h1';
    $this->args['title_class'] = array('uk-heading-small');
    $this->args['title_sprintf'] = '';//use %s to get the archivetitle

  }

}
