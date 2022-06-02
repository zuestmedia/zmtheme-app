<?php

namespace ZMT\Theme\DefaultConfig;

class configWooCommerce extends BuildModule {

  public $type = 'WooCommerce';

  protected function default() {

    $this->args['presets'] = 'default';

  }

}
