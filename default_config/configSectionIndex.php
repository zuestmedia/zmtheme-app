<?php

namespace ZMT\Theme\DefaultConfig;

class configSectionIndex extends BuildComponent {

  public $type = 'Section';

    protected function default() {

      $this->section_content = 'get_archive_or_singular';

    }

}
