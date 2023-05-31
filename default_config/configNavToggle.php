<?php

namespace ZMT\Theme\DefaultConfig;

class configNavToggle extends configNav {

  public $type = 'NavToggle';

  protected function default() {

    parent::default();

    $this->args['presets'] = 'default';

    $this->args['offcanvas_module'] = 'offcanvas__offcanvascontainer';

    //activate to use _custom_icon & _rotating_icon --> see in pro presets
    //$this->args['icon_type'] = 'navbar-toggle-icon';

    $this->args['icon_ratio'] = 1;
    $this->args['toggle_wrap'] = '{"tag":"button","attributes":{"class":"uk-button uk-button-link uk-navbar-toggle uk-navbar-toggle-animate","zmtargetid":"#__offcanvasid__","uk-toggle":"target:#__offcanvasid__;"},"content":[{"tag":"i","attributes":{"style":"min-width:calc(20px * __iconratio__)","uk-navbar-toggle-icon":"ratio:__iconratio__;","aria-hidden":"true"},"close":true},{"tag":"span","attributes":{"class":"screen-reader-text"},"content":"__label__","close":true}]}';//dont forget zmtargetid!!!
  }

  protected function nav() {

    parent::nav();

  }
  protected function navbar() {

    parent::navbar();

  }


}
