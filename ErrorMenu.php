<?php

namespace ZMT\Theme;

class ErrorMenu {

  /**
    * Error Menu Display Name
    * @var string
    * @access private
    */
  private $display_name = 'ZM';

  /**
    * Page Slug
    * @var string
    * @access private
    */
  private $page_slug = 'zmtheme';

  /**
    * Set parent page https://developer.wordpress.org/reference/functions/add_submenu_page/
    * @var string
    * @access private
    */
/*  private $menu_parent = 'themes.php';*/

  /**
    * Menu Page Content HTML
    * @var string
    * @access private
    */
  private $menu_page = NULL;

  /**
  * Location is minimal value to setup a plugin without menu page.
  */
  function __construct( $display_name ) {

		$this->display_name = $display_name;

	}

  public function setDisplayName($display_name) {

    $this->display_name = $display_name;

  }

  public function getDisplayName() {

    return $this->display_name;

  }

  public function setPageSlug($page_slug) {

    $this->page_slug = $page_slug;

  }

  public function getPageSlug() {

    return $this->page_slug;

  }

  /*public function setMenuParent($menu_parent) {

    $this->menu_parent = $menu_parent;

  }

  public function getMenuParent() {

    return $this->menu_parent;

  }*/

  public function setMenuPage($menu_page) {

    $this->menu_page .= $menu_page;

  }

  public function getMenuPage() {

    return $this->menu_page;

  }

  //menupage function
  public function getErrorMenuPage() {

    add_theme_page( $this->getDisplayName(), $this->getDisplayName(), 'manage_options', $this->getPageSlug(), array($this,'ErrorMenuPage') );

  }

  //menupage content
  public function ErrorMenuPage() {

    echo $this->getMenuPage();

  }

  public function getErrorMenu(){

      add_action('admin_menu', array($this,'getErrorMenuPage'));

  }

}
