<?php

namespace ZMT\Theme\DefaultConfig;

class configNavSidebar extends configNav {

  public $type = 'Sidebar';

  public $sidebar;

  protected function default() {

    parent::default();

    $this->args['module_class_text_align'] = '';

    $this->args['presets'] = 'default';

    $this->args['widget_element'] = 'div';
    $this->args['widget_class'] = '';
    //old widget title
    $this->sidebar['widgettitle_wrap'] = '{"tag":"div","attributes":{"class":"uk-hidden"}}';
    
    $this->args['moduleinner_element'] = '';
    $this->args['moduleinner_class'] = '';
    $this->args['moduleinner_wrap'] = '';

    $this->args['content_wrap'] = '';

  }

  protected function nav() {

    parent::nav();

  }
  protected function navbar() {

    parent::navbar();    

  }


}
