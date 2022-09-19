<?php

namespace ZMT\Theme\DefaultConfig;

class configContainerCustomTemplateBlock extends configContainer {


    protected function default() {

      $this->args['presets'] = 'default';
      $this->section_content = 'block_template';
      $this->args['block_template'] = '0';

      parent::module();
      parent::module_layout_helper();

      parent::moduleinner();
      $this->args['moduleinner_element'] = '';
      parent::moduleinner_grid();

    }


}
