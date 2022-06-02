<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerCustomHTML extends configContainer {


    protected function default() {

      $this->args['presets'] = 'default';
      $this->section_content = 'get_static_html';
      $this->args['static_content'] = '{"tag":"div","content":"Custom HTML content","close":true}';

      parent::module();
      parent::module_layout_helper();

    }


}
