<?php

namespace ZMT\Theme\DefaultConfig;

class configNavToggle extends configNav {

  public $type = 'NavToggle';

  protected function default() {

    parent::default();

    $this->args['presets'] = 'default';

    $this->args['offcanvas_module'] = 'offcanvas__offcanvascontainer';

    $this->args['icon_type'] = 'navbar-toggle-icon';
    $this->args['icon_ratio'] = 1;
    $this->args['toggle_wrap'] = '{"tag":"a","attributes":{"class":"uk-navbar-toggle uk-navbar-toggle-animate","zmtargetid":"#__offcanvasid__","uk-toggle":"target:#__offcanvasid__;animation:"},"content":{"tag":"i","attributes":{"style":"min-width:calc(20px * __iconratio__)","uk-icon":"icon:__icontype__;ratio:__iconratio__;"},"close":true}}';//dont forget zmtargetid!!!

  }

  protected function nav() {

    parent::nav();
    $this->args['toggle_wrap'] = '{"tag":"a","attributes":{"class":"uk-link-text","zmtargetid":"#__offcanvasid__","uk-toggle":"target:#__offcanvasid__;animation:"},"content":{"tag":"i","attributes":{"style":"min-width:calc(20px * __iconratio__)","uk-icon":"icon:__icontype__;ratio:__iconratio__;"},"close":true}}';//dont forget zmtargetid!!!

  }
  protected function navbar() {

    parent::navbar();

  }


}
