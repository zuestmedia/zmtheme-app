<?php

namespace ZMT\Theme\DefaultConfig;

class configBBPress extends BuildModule {

  public $type = 'BBPress';

  protected function default() {

    $this->args['presets'] = 'default';

  }

}
