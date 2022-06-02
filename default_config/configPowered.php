<?php

namespace ZMT\Theme\DefaultConfig;

class configPowered extends BuildModule {

  public $type = 'Powered';

  protected function default() {

    //$this->args['presets'] = 'default';

    $this->args['link_text'] = __( 'ThisThemeName' , 'zmtheme' );
    $this->args['link_class'] = array('uk-link-reset');
    $this->args['link_url'] = 'https://zmtheme.com';
    $this->args['powered_text'] = __( 'Built with ZMTheme' , 'zmtheme' );

    $this->args['module_element'] = 'div';
    $this->args['module_class'] = 'uk-text-small uk-text-center';

  }


}
