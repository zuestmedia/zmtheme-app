<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\Helpers as Helpers;

class modSidebar extends \ZMT\Theme\Modules\Module {

  /**
    * Sidebar DisplayName
    * @var string
    * @access private
    */
  private $displayname = NULL;

  /**
    * Sidebar Description
    * @var string
    * @access private
    */
  private $description = NULL;

  /**
    * Sidebar Admin View Class
    * Has no Effect in Frontend!
    * @var string
    * @access private
    */
  private $class = NULL;

  /**
  * DisplayName Getters n Setters
  */
  public function setDisplayName($displayname) {

    $this->displayname = $displayname;

  }
  public function getDisplayName() {

    return $this->displayname;

  }

  /**
  * Description Getters n Setters
  */
  public function setDescription($description) {

    $this->description = $description;

  }
  public function getDescription() {

    return $this->description;

  }

  /**
  * Class Getters n Setters (only effects Admin-View)
  */
  public function setClass($class) {

    $this->class = $class;

  }
  public function getClass() {

    return $this->class;

  }

  public function newWidgetDynamicSidebar( $params ) {

    $params[0]['before_widget'] = $this->getSidebarStart().$params[0]['before_widget'];
    $params[0]['after_widget' ] = $params[0]['after_widget'].$this->getSidebarEnd();

    $params[0]['before_title'] = $this->getSidebarTitleStart();
    $params[0]['after_title' ] = $this->getSidebarTitleEnd();

    return $params;

  }

  public function addSidebarFilters(){

    //need to load settings via filter to work also in customizer...
    add_filter( 'dynamic_sidebar_params', array( $this, 'newWidgetDynamicSidebar' ), 11 );

  }
  public function removeSidebarFilters(){

    remove_filter( 'dynamic_sidebar_params', array( $this, 'newWidgetDynamicSidebar' ), 11 );


  }

  public function getSidebarTitleStart(){

    $result = NULL;

    $widgettitle_wrap = $this->getArg('widgettitle_wrap');
    if($widgettitle_wrap) {

      $result .= \ZMT\Theme\Element::processHTMLElementsStart( json_decode( $widgettitle_wrap, true ) );//json

    }

    return $result;

  }
  public function getSidebarTitleEnd(){

    $result = NULL;

    $widgettitle_wrap = $this->getArg('widgettitle_wrap');
    if($widgettitle_wrap) {

      $result .= \ZMT\Theme\Element::processHTMLElementsEnd( json_decode( $widgettitle_wrap, true ) );//json

    }

    return $result;

  }

  public function getSidebarStart(){

    $result = NULL;

    $widget_element = esc_html($this->getArg('widget_element'));
    if($widget_element) {

      $result .= '<'.$widget_element.Helpers::getAttribute($this->getElementAttributesByPraefix('widget'),NULL,' class="%s"').'>';

    }

      $widgetinner_element = esc_html($this->getArg('widgetinner_element'));
      if($widgetinner_element) {

        $result .= '<'.$widgetinner_element.Helpers::getAttribute($this->getElementAttributesByPraefix('widgetinner'),NULL,' class="%s"').'>';

      }

    return $result;

  }

  public function getSidebarEnd(){

    $result = NULL;

      $widgetinner_element = esc_html($this->getArg('widgetinner_element'));
      if($widgetinner_element) {

        $result .= '</'.$widgetinner_element.'>';

      }

    $widget_element = esc_html($this->getArg('widget_element'));
    if($widget_element) {

      $result .= '</'.$widget_element.'>';

    }

    return $result;

  }

  public function newgetRegisterSidebarArray(){

    $result = NULL;

    if($this->getId()) {

      $result['id'] = $this->getId();

      if($this->getDisplayName()) {
        $result['name'] = $this->getDisplayName();
      }

      if($this->getDescription()) {
        $result['description'] = $this->getDescription();
      }

      if($this->getClass()) {
        $result['class'] = $this->getClass();
      }

      $result['before_widget'] = '<div id="%1$s" class="widget %2$s">';
      $result['after_widget' ] = '</div>';

      $result['before_title'] = $this->getSidebarTitleStart();
      $result['after_title' ] = $this->getSidebarTitleEnd();

    }

    register_sidebar( $result );

  }

  public function registerSidebar(){

    add_action( 'widgets_init', array($this, 'newgetRegisterSidebarArray'));

  }

  /**
  * This Function is used in View-Template-Files to get sidebar as a html string
  */
  public function getSidebar(){

    if ( is_active_sidebar( $this->getId() ) ) {

      $this->addSidebarFilters();

      ob_start();
      dynamic_sidebar( $this->getId() );
      $sidebar = ob_get_contents();
      ob_end_clean();

      $this->removeSidebarFilters();

    return $sidebar;

    }

  }

  public function setArgs($args){

    parent::setArgs($args);

    if( $this->getComLabel() ){
      $this->setDisplayName( $this->getComLabel() );
    } else {
      $com_id = $this->getId();
      if( strpos( $com_id, '_defsidebar' ) ){
        $com_id = str_replace('_defsidebar', '', $com_id );
      }

      $com_type_obj = new \ZMT\Theme\ComponentTypeLabel();

      //$this->setDisplayName( Helpers::transformObjectKeystoLabel( $com_id ) );
      $this->setDisplayName( $com_type_obj->getComLabelOrKey($com_id) );
    }

    $this->registerSidebar();

  }

  public function getContent() {

    return $this->getSidebar();

  }

}
