<?php

namespace ZMT\Theme\DefaultConfig;

class configSeparator extends BuildModule {

  public $type = 'Separator';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['separator'] = '{"tag":"hr","attributes":{"class":"uk-divider-small uk-margin-large-top"},"close":false}';

  }

}
