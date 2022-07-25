<?php

namespace ZMT\Theme;

use Walker_Nav_Menu;

class MenuWalker extends Walker_Nav_Menu {

  /**
    * Suffix Depth = 0
    * @var string
    * @access private
    */
  private $wrap_first = NULL;
  /**
    * Suffix Depth = 1
    * @var string
    * @access private
    */
  private $wrap_second = NULL;
  /**
    * Suffix Depth = 2
    * @var string
    * @access private
    */
  private $wrap_third = NULL;

  /**
  * Suffix Depth = 0 Getters n Setters
  */
  public function setWrapFirst($wrap_first) {

    $this->wrap_first = $wrap_first;

  }
  private function getWrapFirst() {

    return $this->wrap_first;

  }

  /**
  * Suffix Depth = 0 Getters n Setters
  */
  public function setWrapSecond($wrap_second) {

    $this->wrap_second = $wrap_second;

  }
  private function getWrapSecond() {

    return $this->wrap_second;

  }

  /**
  * Suffix Depth = 0 Getters n Setters
  */
  public function setWrapThird($wrap_third) {

    $this->wrap_third = $wrap_third;

  }
  private function getWrapThird() {

    return $this->wrap_third;

  }

  /**
  * UIKIT uk-navbar Menu mit Javascript Dropdown!
  * 1.1 neues div um submenu ul einfügen
  * 1.2. ul class definieren von submenu
  * 2. check ob menu oberster ebene children items hat
  * 3. wenn item oberster ebene children items hat wird data-uk-dropdown in parent li eingefügt
	* damit es funktioniert muss im template an stelle wo ZMThemeMenu definiert wird setMenuWalker  new ZM_Sublevel_Walker gesetzt werden
  *
  * Note: to add custom parent or active classes to li use filter functions (-> see ZMTheme addMenuParentClass)
  */
  function start_lvl( &$output, $depth = 0, $args = array() ) {

    /**
    * Every Depth can have different values! so all kind of wp uk-navbar menus customized till 4 levels deep are possible
    */
    if($depth == 0){

      $output .= \ZMT\Theme\Element::processHTMLElementsStart(json_decode($this->getWrapFirst(),true));

    }
    if($depth == 1){

      $output .= \ZMT\Theme\Element::processHTMLElementsStart(json_decode($this->getWrapSecond(),true));

    }
    if($depth > 1){

      $output .= \ZMT\Theme\Element::processHTMLElementsStart(json_decode($this->getWrapThird(),true));

    }

  }

  function end_lvl( &$output, $depth = 0, $args = array() ) {

    /**
    * Every Depth can have different values! so all kind of wp uk-navbar menus customized till 4 levels deep are possible
    */
    if($depth == 0){

      $output .= \ZMT\Theme\Element::processHTMLElementsEnd(json_decode($this->getWrapFirst(),true));

    }
    if($depth == 1){

      $output .= \ZMT\Theme\Element::processHTMLElementsEnd(json_decode($this->getWrapSecond(),true));

    }
    if($depth > 1){

      $output .= \ZMT\Theme\Element::processHTMLElementsEnd(json_decode($this->getWrapThird(),true));

    }

  }

  public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {

    //TODO: maybe create options in customizer... now only via class in wp/menu/ add class to items...

    $args->link_after = '';

    //parent icon can be set via menu classes in wp dashboard
    if(in_array('zm-has-nav-parent-icon', $data_object->classes)){

      $args->link_after = ' <span uk-nav-parent-icon></span>';

    }

    //parent icon will be set via class in presets menu_ul_class! (used in nav-accordion and navbar)
    if( strpos( $args->menu_class, 'zm-has-nav-parent-icon') !== false && ( $depth == 0 ) && in_array('menu-item-has-children', $data_object->classes)){

      $args->link_after = ' <span uk-nav-parent-icon></span>';

    }

    parent::start_el( $output, $data_object, $depth, $args, $current_object_id );

  }

}
