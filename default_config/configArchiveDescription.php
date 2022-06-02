<?php

namespace ZMT\Theme\DefaultConfig;

class configArchiveDescription extends BuildModule {

  public $type = 'ArchiveDescription';

  protected function default() {

    //nothing here
    $this->args['presets'] = 'default'; //has no specific presets! just preset-arg to get default and reset to default options!

    parent::module();
    parent::module_text_helper();

  }

}
