<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\Helpers as Helpers;

class modMenu extends \ZMT\Theme\Modules\Module {

  /**
    * Menu DisplayName
    * @var string
    * @access private
    */
  private $displayname = NULL;

  /**
  * DisplayName Getters n Setters
  */
  public function setDisplayName($displayname) {

    $this->displayname = $displayname;

  }
  public function DisplayName() {

    return $this->displayname;

  }
  public function getDisplayName() {

    if($this->DisplayName()){

      return $this->DisplayName();

    }

    return 'Menu: '.$this->getId();

  }

  public function getMenuIdbyLocation( ) {

    $menu_id = NULL;

    $theme_locations = get_nav_menu_locations();

    if( array_key_exists( $this->getId(), $theme_locations ) ){

      $menu_obj = get_term( $theme_locations[ $this->getId() ], 'nav_menu' );

      if($menu_obj && property_exists($menu_obj,'term_id')){

        $menu_id = $menu_obj->term_id;

      }

    }

    return $menu_id;

  }

  public function getContainerClasses() {

    $result = NULL;

    if( $this->getArg('menu_container_element') ) {

      $result = $this->getArg('menu_container_class');

    }

    return $result;

  }

  public function getMenuTitle() {

    $result = NULL;

    $id = $this->getMenuIdbyLocation();

    if( $id ){

      $obj = wp_get_nav_menu_object( $id );

      if( is_object($obj) ){

        $result =  $obj->name ;

      }

    }



    return $result;

  }

  public function getMenuTitleHTML() {

    $headingelement = $this->getArg('menutitle_element');
    $headingclass = $this->getArg('menutitle_class');

    $title = $this->getMenuTitle();

    $html = NULL;

    if( $title && $headingelement ){

      $html = '<'.esc_attr( $headingelement ).\ZMT\Theme\Helpers::getAttribute($headingclass,NULL,' class="%s" ').'>'.esc_html( $title ).'</'.esc_attr( $headingelement ).'>';

    } elseif( $title ) {

      $html = '<span class="screen-reader-text">'.esc_html( $title ).'</span>';

    }

    return $html;

  }

  public function getNavWrapper($html){

    $arialabel = NULL;

    $arialabel = \ZMT\Theme\Helpers::getTrStr('Menu_default_label');

    $menutitle = $this->getMenuTitle();

    if($menutitle){
      $arialabel = $menutitle;
    }

    $html = '<nav aria-label="'.esc_html($arialabel).'">'.$html.'</nav>';

    return $html;

  }

  public function RegisterMenu(){

      register_nav_menu( $this->getId(), $this->getDisplayName() );

  }

  public function addMenu(){

    add_action( 'after_setup_theme', array($this, 'RegisterMenu') );

  }

  public function defaultMenu(){

    //is loaded when no menu for nav__menu is set
    $args = array(
      'echo' => false,
      'show_home' => true,
      'depth' => 1,//only show first level if default menu not set
      'container' => $this->getArg('menu_container_element'),
      'menu_class' => $this->getContainerClasses(),
      'before' => '<ul class="'.esc_attr($this->getArg('menu_ul_class')).'">'
    );

    return wp_page_menu($args);

  }

  public function getMenu(){

    //activate this to not set default menu to all menus
    //if ( has_nav_menu( $this->getId() ) || $this->getId()  == 'nav__menu' ) {

      $args = array();

      /**
        * Static func_get_args
        */
        $args['theme_location'] = $this->getId();
        $args['echo'] = false;

        //fallback if nav__menu and no menu is defined at all
        if(has_nav_menu( $this->getId() )){
          $args['fallback_cb'] = false;
        } else {
          $args['fallback_cb'] = array($this, 'defaultMenu');
        }


      /**
        * Container Elements
        */
        $args['container'] = $this->getArg('menu_container_element');

      /**
        * Container Class
        */
        $args['container_class'] = $this->getContainerClasses();

      /**
        * Container Ul Class
        */
        $args['menu_class'] = $this->getArg('menu_ul_class');

      /**
        * Itemswrap
        * default: '<ul id="%1$s" class="%2$s">%3$s</ul>'
        * do not set 'items_wrap' if no value
        */
        $menuitemswrap = $this->getArg('menu_items_wrap');
        if( $menuitemswrap ){
          $args['items_wrap'] = \ZMT\Theme\Element::processHTMLElements(json_decode($menuitemswrap,true));//json
        }

      /**
        * Add MenuWalker --> new ZMThemeMenuWalker()
        */
        if( $this->getArg('menu_walker') ){

          $menu_walker = new \ZMT\Theme\MenuWalker;

          $menu_walker->setWrapFirst( $this->getArg('menu_walker_wrap_first') );
          $menu_walker->setWrapSecond( $this->getArg('menu_walker_wrap_second') );
          $menu_walker->setWrapThird( $this->getArg('menu_walker_wrap_third') );

          $args['walker'] = $menu_walker;

        }

      $result = NULL;

      $menutitle = $this->getMenuTitleHTML();

      if( $menutitle ){

        $result = $menutitle.wp_nav_menu($args);

      } else {

        $result = wp_nav_menu($args);

      }

      //nav wrapper
      $result = $this->getNavWrapper($result);//add nav and aria label from menu name!

      return $result;

    //}

  }

/**
  * Customizations base, component, module
  */
  public function setArgs($args){

    parent::setArgs($args);

    if( $this->getComLabel() ){
      $this->setDisplayName( $this->getComLabel() );
    } else {
      //$this->setDisplayName( $this->getId() );
      $this->setDisplayName( Helpers::transformObjectKeystoLabel( $this->getId() ) );
    }

    $this->addMenu();

  }

  public function getContent() {

    return $this->getMenu();

  }

  public function getModule() {

    $result = parent::getModule();

    if($result){

      $label = \ZMT\Theme\Helpers::getTrStr('NavToggle_label');//Open Menu

      $result = str_replace(
        array( '__label_menu_toggle__' ),
        array(  esc_html( $label ) ),
        $result
      );

    }

    return $result;

  }

}
