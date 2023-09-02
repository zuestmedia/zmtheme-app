<?php

namespace ZMT\Theme\DefaultConfig;

class configNavMenu extends configNav {

  public $type = 'Menu';

  protected function default() {

    parent::default();

    $this->args['module_class_text_align'] = '';    

    $this->args['presets'] = 'default';

    //not used yet...
    /*$this->args['menu_container_element'] = 'div';
    $this->args['menu_container_class'] = 'zm-navbar-boundary';*/
    //not used yet...

    //cannot be set as default value --> error in customizer!!!!
    //but can be used in presets!!! &&& if empty uses default value!
    //default = '<ul id="%1$s" class="%2$s">%3$s</ul>'
    $this->args['menu_items_wrap'] = '';//more than 2 (two) sprintf vars are not possible to set...
    //$this->args['menu_items_wrap'] = '{"tag":"ul","attributes":{"id":"%1$s","class":"%2$s"},"content":"%3$s","close":true}';//same as default value!

    $this->args['menu_walker'] = 1;
    $this->args['menu_walker_wrap_second'] = '{"tag":"ul","attributes":{"class":"uk-nav-sub"}}';//'<ul class="uk-nav-sub">'
    $this->args['menu_walker_wrap_third'] = '{"tag":"ul","attributes":{"class":"uk-nav-sub"}}';

    $this->args['menutitle_element'] = '';
    $this->args['menutitle_class'] = '';


  }

  protected function nav() {

    parent::nav();

    $this->args['module_element'] = 'div';

    $this->args['menu_ul_class'] = 'uk-nav uk-nav-default';

    $this->args['menu_walker_wrap_first'] = '{"tag":"ul","attributes":{"class":"uk-nav-sub"}}';

  }


  protected function navbar() {

    parent::navbar();

    $this->args['moduleinner_element'] = 'div';

    $this->args['moduleinner_class'] = 'uk-padding-remove-horizontal'; //without uk-navbar-item!!!!

    $this->args['moduleinner_wrap'] = '';

    $this->args['menu_ul_class'] = 'uk-navbar-nav zm-has-navbar-parent-icon';

    /*$this->args['menu_walker_wrap_first'] = '[{"tag":"div","attributes":{"class":"uk-navbar-dropdown","uk-drop":"boundary: .uk-navbar-nav; boundary-align: true; pos: bottom-justify;offset:0;"}},{"tag":"ul","attributes":{"class":"uk-nav uk-navbar-dropdown-nav"}}]';*/
    /*$this->args['menu_walker_wrap_first'] = '[{"tag":"div","attributes":{"class":"uk-navbar-dropdown","uk-drop":"boundary-align: true; pos: bottom-justify;offset:0;"}},{"tag":"ul","attributes":{"class":"uk-nav uk-navbar-dropdown-nav"}}]';*/
    //uk-drop is not necessary on default dropdown...
    $this->args['menu_walker_wrap_first'] = '[{"tag":"div","attributes":{"class":"uk-navbar-dropdown"}},{"tag":"ul","attributes":{"class":"uk-nav uk-navbar-dropdown-nav"}}]';

  }

  protected function navbar_dropdown_nav() {

    parent::navbar();

    $this->args['moduleinner_wrap'] = '[{"tag":"button","attributes":{"class":"uk-button uk-button-link uk-navbar-toggle uk-navbar-toggle-animate"},"content":[{"tag":"i","attributes":{"uk-navbar-toggle-icon":"{\"i18n\": {\"label\": \"__label_menu_toggle__\"}}","aria-hidden":"true"},"close":true},{"tag":"span","attributes":{"class":"screen-reader-text"},"content":"__label_menu_toggle__","close":true}],"close":true},{"tag":"div","attributes":{"class":"uk-navbar-dropdown","uk-drop":"mode: click; cls-drop: uk-navbar-dropdown; boundary: !.uk-navbar; stretch: x; flip: false"}}]'; 

    $this->args['menu_ul_class'] = 'uk-nav uk-navbar-dropdown-nav';

    $this->args['menu_walker_wrap_first'] = '{"tag":"ul","attributes":{"class":"uk-nav-sub"}}'; // simple nav

    
  }



}
