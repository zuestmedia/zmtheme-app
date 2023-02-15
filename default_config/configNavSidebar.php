<?php

namespace ZMT\Theme\DefaultConfig;

class configNavSidebar extends configNav {

  public $type = 'Sidebar';

  public $sidebar;

  protected function default() {

    parent::default();

    $this->args['module_class_text_align'] = '';

    $this->args['presets'] = 'default';

    $this->args['content_wrap'] = '';

    $this->args['widget_element'] = 'div';
    $this->args['widget_class'] = '';
    //old widget title
    $this->sidebar['widgettitle_wrap'] = '{"tag":"div","attributes":{"class":"uk-hidden"}}';

  }

  protected function nav() {

    parent::nav();

  }
  protected function navbar() {

    parent::navbar();
    $this->args['moduleinner_wrap'] = '';

  }


}
