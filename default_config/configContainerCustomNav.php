<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerCustomNav extends configContainer {


    protected function default() {

      $this->args['presets'] = 'default';
      $this->section_content = 'custom';//if custom, needs custom_section_content!
      $this->args['custom_section_content'] = 'nav__navcontainer';//is the default nav

    }


}
