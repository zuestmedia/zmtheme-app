<?php

namespace ZMT\Theme;

class Theme {

  /**
    * Alternative Displayname (Optional)
    */
    private $displayname = NULL;

  /**
    * Predefined Form_OptionsGroupName
    * used in ZMForms, ZMThemeSection, ZMThemeSidebar, ZMThemeMenu combined with formname as optpra
    * if not set, optionsgroupname is theme slug (foldername)
    */
    private $optionsgroupname = NULL;

  /**
    * Settings Status
    * 1=off
    * 2=on
    * if on, option tables theme,section,sidebar,menu usw. settings will be queried and default options saved to options_table (add_option)
    * if off, just programmatically set options will be used directly from ZM Theme Object
    */
    private $settings_status = '1';
    private $option_name_settings_status = '_set_status';

    private $framework = 'zm';

    private $css_type = 'default';
    private $option_name_css_type = '_css_type';

    private $css = NULL;
    private $css_rtl = NULL;

    private $js = NULL;
    private $icons = NULL;

    private $headscript = NULL;
    private $footerscript = NULL;

    private $option_name_css = '_css';

    private $js_array = NULL;
    private $js_array_child_theme = NULL;

    private $menu_active_class = 'uk-active';

    private $menu_parent_class = 'uk-parent';

    private $starter_content = NULL;

    private $head_modules = NULL;

    private $version;

  /**
    * Version-Status
    */
    public function setVersion($version) {

      $this->version = $version;

    }
    public function getVersion() {

      return $this->version;

    }

    public function versionErrorNotice() {

      echo '<div class="notice-warning notice"><p>'.esc_html( \ZMT\Theme\Helpers::getTrStr('WarningVersionsare') ).'</p></div>';

    }

    public function checkVersion(){

      if(is_admin()){

        $versionofstylecss = NULL;

        //if is a child theme, get version of parent theme to check against!!
        if(is_child_theme()){

          $parent = wp_get_theme()->parent();

          if (!empty($parent)) {

            $versionofstylecss = $parent->Version;

          }

        } else {

          $versionofstylecss = Helpers::getThemeDetails('Version');

        }

        if( $this->getVersion() != $versionofstylecss ){
          add_action( 'admin_notices', array($this,'versionErrorNotice') );
        }

      }

    }



  /**
    * Optional Display Name if not this from Style.css
    */
    public function setDisplayName($displayname) {

      $this->displayname = $displayname;

    }

    public function getDisplayName() {

      if($this->displayname) {
        return $this->displayname;
      }

      return Helpers::getThemeDetails('Name');

    }

  /**
    * get OptGroup!
    */
    public function setOptionsGroupName($optionsgroupname) {

      $this->optionsgroupname = $optionsgroupname;

    }
    private function getOptionsGroupName() {

      return $this->optionsgroupname;

    }
    public function getOptGroup(){

      $result = Helpers::getSlug();

      if ($this->getOptionsGroupName()){

        $result = $this->getOptionsGroupName();

      }

      return $result;

    }

  /**
    * Settings Status Get n Set
    * not self dependent from settings status! --> always '2'!
    */
    public function setSettingsStatus($settings_status) {

      $this->settings_status = $settings_status;

    }
    public function getSettingsStatusFieldName() {

      return $this->getOptGroup().$this->option_name_settings_status;

    }
    public function getSettingsStatusDefaultValue() {

      return $this->settings_status;

    }
    public function getSettingsStatus() {

      /*return Helpers::getOptionNew(
        $this->getSettingsStatusFieldName(),
        $this->getSettingsStatusDefaultValue(),
        '2', // always check settings for default theme values!!
        'option'
      );*/
      return Helpers::getOptionNew(
        $this->getSettingsStatusFieldName(),
        $this->getSettingsStatusDefaultValue(),
        '2', // always check settings for default theme values!!
        'option'
        //$this->getOptGroup()
      );

    }

  /**
    * Framework
    */
    public function getFramework() {

        return $this->framework;

    }
    public function setFramework($framework) {

        $this->framework = $framework;

    }


    public function setCSSType($css_type) {

      $this->css_type = $css_type;

    }
    public function getCSSTypeFieldName() {

      return $this->getOptGroup().$this->option_name_css_type;

    }
    public function getCSSTypeFieldNamewithoutOptGroup() {

      return $this->option_name_css_type;

    }
    public function getCSSTypeDefaultValue() {

      return $this->css_type;

    }
    public function getCSSType() {
      return Helpers::getOptionNew(
        $this->getCSSTypeFieldName(),
        $this->getCSSTypeDefaultValue(),
        $this->getSettingsStatus(),
        'option'
      );
    }

    public function getCSSFileByType($css_file_string){

      $result = $css_file_string;

      $rtl_string = '';
      if(is_rtl()){
        $rtl_string = '-rtl';
      }

      $string_to_replace = $rtl_string.'.min.css';

      $type = $this->getCSSType();
      if( $type == 'dark' ){
        $new_string_to_add = '-dark'.$rtl_string.'.min.css';
        $result = str_replace($string_to_replace, $new_string_to_add, $css_file_string);
      }

      if( $type == 'light'){
        $new_string_to_add = '-light'.$rtl_string.'.min.css';
        $result = str_replace($string_to_replace, $new_string_to_add, $css_file_string);
      }

      return $result;

    }

  /**
    * CSS Get n Set
    */
    public function setCss($css) {

      $this->css = $css;

    }
    public function getCssDefaultValue() {

      return $this->css;

    }
    public function setCssRtl($css_rtl) {

      $this->css_rtl = $css_rtl;

    }
    public function getCssRtlDefaultValue() {

      return $this->css_rtl;

    }
    public function getCss() {

      if ( is_rtl() ) {

        return $this->getCSSFileByType( $this->getCssRtlDefaultValue() );

      } else {

        return $this->getCSSFileByType( $this->getCssDefaultValue() );

      }

    }

    public function setJs($js) {

      $this->js = $js;

    }
    public function getJs() {

      return Helpers::getThemeUrl().$this->js;

    }

    public function setIcons($icons) {

      $this->icons = $icons;

    }
    public function getIcons() {

      return Helpers::getThemeUrl().$this->icons;

    }

    public function setHeadScript($headscript) {

      $this->headscript .= $headscript;

    }
    public function getHeadScript() {

      echo $this->headscript;

    }
    public function addHeadScript(){

      add_action('wp_head', array( $this, 'getHeadScript' ));

      if(is_customize_preview()){
        add_action('customize_controls_print_scripts', array( $this, 'getHeadScript' ));
      }

    }

    public function BodySkipLinks(){

      echo '<a href="#content" class="screen-reader-text">'.esc_html( \ZMT\Theme\Helpers::getTrStr('Skiptocontent') ).'</a>';

    }

    public function addBodySkipLinks(){
      add_action('wp_body_open', array( $this, 'BodySkipLinks' ));
    }


    public function setFooterScript($footerscript) {

      $this->footerscript .= $footerscript;

    }
    public function getFooterScript() {

      return $this->footerscript;

    }
    public function addFooterScript(){
      add_action('wp_footer', array( $this, 'getFooterScript' ));
    }

  /**
    * Get JS array
    */
    public function getJsArray() {

        return $this->js_array;

    }
  /**
    * Set JS array
    */
    public function setJsArray($js_array) {

        $this->js_array = $js_array;

    }

    public function getJsArrayChildTheme() {

        return $this->js_array_child_theme;

    }
    public function setJsArrayChildTheme($js_array_child_theme) {

        $this->js_array_child_theme = $js_array_child_theme;

    }


  /**
    * Load Textdomain (only works with strings in template files, not in config files)
    * to load translations for config files, use helpers load_theme_textdomain function and set before config.php is loaded
    * -> LoadTextDomainbeforeConfigFiles()
    */
    ////not in use --> see helper and init.php!
    public function TextDomain(){

      load_theme_textdomain( Helpers::getTextDomain(), get_template_directory().'/languages' );

    }
    public function addTextDomain() {

      add_action( 'after_setup_theme', array( $this, 'TextDomain' ) );

    }

  /**
    * Add uk-active as menu active class! with add_filter
    * default = uk-active!
    */
    public function setMenuActiveClass($menu_active_class){

      $this->menu_active_class = $menu_active_class;

    }
    public function getMenuActiveClass(){

      return $this->menu_active_class;

    }
    public function MenuActiveClass($classes,$items){

      if (in_array('current-menu-item', $classes) ){

          $classes[] = $this->getMenuActiveClass();

      }

      return $classes;

    }
    public function addMenuActiveClass() {

      add_filter('nav_menu_css_class' , array( $this, 'MenuActiveClass' ) , 10 , 2);

    }

  /**
    * Add uk-parent as menu parent class! with add_filter
    * default = uk-parent!
    * --> https://wordpress.stackexchange.com/questions/37179/wp-nav-menu-check-if-the-list-item-has-children-and-add-a-class-to-anchor-link
    */
    public function setMenuParentClass($menu_parent_class){

      $this->menu_parent_class = $menu_parent_class;

    }
    public function getMenuParentClass(){

      return $this->menu_parent_class;

    }
    public function MenuParentClass($classes,$items){

      if (in_array('menu-item-has-children', $classes) ){

          $classes[] = $this->getMenuParentClass();

      }

      return $classes;

    }
    public function addMenuParentClass() {

      add_filter('nav_menu_css_class' , array( $this, 'MenuParentClass' ) , 10 , 2);

    }

    public function getStarterContent(){

      return $this->starter_content;

    }
    public function setStarterContent($starter_content){

      $this->starter_content = $starter_content;

    }

    public function getHeadModules(){

      return $this->head_modules;

    }
    public function setHeadModules($head_modules){

      $this->head_modules = $head_modules;

    }

  /**
    * Theme Support for different features default activated
    */
    public function ThemeSupport(){

      // Set content-width.
    	global $content_width;
    	if ( ! isset( $content_width ) ) {
    		$content_width = 4096;
    	}

      //add_theme_support( 'post-formats' , array( 'aside', 'link', 'image', 'gallery', 'video', 'audio', 'quote', 'status' ) );
      add_theme_support( 'post-thumbnails' );
      add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
      add_theme_support( 'title-tag' );

      add_post_type_support( 'page', 'excerpt' );

      //to add edit buttons in customizer
      add_theme_support( 'customize-selective-refresh-widgets' );

      //feeds
      add_theme_support( 'automatic-feed-links' );

      //editor styles
      add_theme_support( 'editor-styles' );

      //blocks tests
      add_editor_style( 'style-editor.css' ); //to add gutenberg editor wp-block width etc

      /**
        * these settings are new loaded with theme.json,
        * loaded here again as fallback, eg when no theme.json in child themes!
        */
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'align-wide' );
        add_theme_support( 'custom-spacing' );
        add_theme_support( 'custom-line-height' );
        add_theme_support( 'custom-units', 'rem', 'px', '%', 'em', 'vh', 'vw' );

        //new
        add_theme_support( 'responsive-embeds' );


        //new
        add_theme_support( 'appearance-tools' );

      /**
        *
        * Add a setting to activate / deactivate (full) site editing with block templates??
        *
        */
        //remove_theme_support( 'block-templates' );

      //block templates added via zmplugin

      //block-patterns added via zmplugin!


      $defaults = array(
       'height'      => 'thumbnail',
       'width'       => 'thumbnail',
       'flex-height' => true,
       'flex-width'  => true,
       'header-text' => array( 'site-title', 'site-description' ),
       );
       add_theme_support( 'custom-logo', $defaults );

       //removed, because of own settings and confusion when duplicated...
       //add_theme_support( 'custom-background' );
/*
       //add starter content
       $startercontentarray = $this->getStarterContent(); //muss so geholt werden!
       add_theme_support( 'starter-content', $startercontentarray );
       //add_theme_support( 'starter-content', array( $this, 'getStarterContent') );//ufnktionert so nicht! falscher wert wird ausgegeben????
*/
       //woocommerce
       add_theme_support( 'woocommerce' );


    }

    public function addThemeSupport(){

      add_action( 'after_setup_theme', array( $this, 'ThemeSupport') );

    }

  /**
    * add assets - styles, scripts and icons
    */
    static function EnqueueStyle($css_slug, $css_url = '', $css_deps = array(), $css_ver = false, $css_media = 'all') {

      if(!wp_style_is($css_slug)) {
        //add style
        wp_enqueue_style( $css_slug, $css_url,  $css_deps, $css_ver, $css_media);

      }

    }
    static function EnqueueScript($js_slug, $js_url = '', $js_deps = array(), $js_ver = false, $js_in_footer = false) {

      if(!wp_script_is($js_slug)) {
        //add style
        wp_enqueue_script( $js_slug, $js_url, $js_deps, $js_ver, $js_in_footer);

      }

    }
    static function LocalizeScript($js_slug,$localize_array){

      if(is_array($localize_array) && array_key_exists('var_name',$localize_array)){

        $data = array();
        if(array_key_exists('translations',$localize_array) && is_array($localize_array['translations'])){
          $data = $localize_array['translations'];
        }

        global $wp_query; 

        //auto add admin-php and nonce security!
        $data['homeurl'] = get_home_url();
        $data['ajaxurl'] = admin_url( 'admin-ajax.php' );
        $data['ajaxnonce'] = wp_create_nonce( 'zmt_global_ajax_validation' );
  
        wp_localize_script( 
          $js_slug,
          $localize_array['var_name'],
          $data
        );

      }      

    }


    /**
     * Enqueue Js Array
     */
    public function EnqueueJsArray() {

      foreach($this->getJsArray() as $innerarray) {

        if( array_key_exists ('js_slug',$innerarray) ) {

          if(array_key_exists ('js_url',$innerarray)) { $js_url = Helpers::getThemeUrl().$innerarray['js_url']; } else { $js_url = NULL; }
          if(array_key_exists ('js_deps',$innerarray)) { $js_deps = $innerarray['js_deps']; } else { $js_deps = NULL; }
          if(array_key_exists ('js_ver',$innerarray)) { $js_ver = $innerarray['js_ver']; } else { $js_ver = $this->getVersion(); }
          if(array_key_exists ('js_in_footer',$innerarray)) { $js_in_footer = $innerarray['js_in_footer']; } else { $js_in_footer = NULL; }

          //Call to static function... (wäre auch mit this möglich, aber so korrekter)
          self::EnqueueScript($innerarray['js_slug'],$js_url,$js_deps,$js_ver,$js_in_footer);

          if(array_key_exists('js_localize',$innerarray)){

            self::LocalizeScript($innerarray['js_slug'],$innerarray['js_localize']);

          }

        }

      }

    }

    public function EnqueueJsArrayChildTheme() {

      foreach($this->getJsArrayChildTheme() as $innerarray) {

        if( array_key_exists ('js_slug',$innerarray) ) {

          if(array_key_exists ('js_url',$innerarray)) { $js_url = Helpers::getChildThemeUrl().$innerarray['js_url']; } else { $js_url = NULL; }
          if(array_key_exists ('js_deps',$innerarray)) { $js_deps = $innerarray['js_deps']; } else { $js_deps = NULL; }
          if(array_key_exists ('js_ver',$innerarray)) { $js_ver = $innerarray['js_ver']; } else { $js_ver = $this->getVersion(); }
          if(array_key_exists ('js_in_footer',$innerarray)) { $js_in_footer = $innerarray['js_in_footer']; } else { $js_in_footer = NULL; }

          //Call to static function... (wäre auch mit this möglich, aber so korrekter)
          self::EnqueueScript($innerarray['js_slug'],$js_url,$js_deps,$js_ver,$js_in_footer);

          if(array_key_exists('js_localize',$innerarray)){

            self::LocalizeScript($innerarray['js_slug'],$innerarray['js_localize']);

          }

        }

      }

    }

  /**
    * add css to editor (Tinymc not gutenberg)
    */
    public function EditorStyle() {

      add_editor_style( $this->getCss() );//relative path to theme root!!

    }
    public function addEditorStyle() {

      add_action( 'after_setup_theme', array( $this, 'EditorStyle') );

    }

  /**
    * collect all assets and check if set or not
    */
    public function Assets() {

      //if set to NULL, css or script will not be loaded, all set by default!
      if($this->getCss()) {
        self::EnqueueStyle($this->getFramework().'-css',Helpers::getThemeUrl().$this->getCss(),NULL,$this->getVersion());
      }
      if($this->getJs()) {
        self::EnqueueScript($this->getFramework().'-js',$this->getJs(),array('jquery'),$this->getVersion());
      }
      if($this->getIcons()) {
        self::EnqueueScript($this->getFramework().'-icons',$this->getIcons(),array($this->getFramework().'-js'),$this->getVersion());
      }

      //js_array
      if($this->getJsArray()) {
        $this->EnqueueJsArray();
      }

      if($this->getJsArrayChildTheme()) {
        $this->EnqueueJsArrayChildTheme();
      }

      //load comments form script
      if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    		self::EnqueueScript( 'comment-reply' );
    	}

      //always load style.css
      self::EnqueueStyle(Helpers::getSlug().'-style-css',Helpers::getThemeUrl().'/style.css',NULL,$this->getVersion());

      //if is child theme
      if(is_child_theme()){
        self::EnqueueStyle(Helpers::getSlug().'-child-style-css',Helpers::getChildThemeUrl().'/style.css',NULL,$this->getVersion());
      }


    }
    public function addAssets() {

      add_action( 'wp_enqueue_scripts', array( $this, 'Assets') );

      if(!is_customize_preview()){

        add_action( 'enqueue_block_editor_assets', array( $this, 'Assets') );

      }

    }

  /**
    * Init Theme after settings are made
    * instead of loading single functions in settings page like addAssets, addThemeSupport, usw.
    */
    public function initTheme(){


        //do a version check
        $this->checkVersion();

      /**
        * Theme Support: post-formats, post-thumbnails, html5, title-tag
        * action: after_setup_theme
        */
        $this->addThemeSupport();

      /**
        * Theme Support: post-formats, post-thumbnails, html5, title-tag
        * action: after_setup_theme
        */
        $this->addThemeSupport();

      /**
        * Add CSS n Scripts
        * action: wp_enqueue_scripts
        */
        $this->addAssets();

      /**
        * Add HeadScript (& customizer control script)
        * action: wp_head
        */
        $this->addHeadScript();

      /**
        * Accesibility body skip link
        */
        $this->addBodySkipLinks();


      /**
        * Add FooterScript
        * action: wp_footer
        */
        $this->addFooterScript();

      /**
        * Add CSS to Editor and Gutenberg
        * action: add_editor_style
        */
        $this->addEditorStyle();

      /**
        * Add Language File Support if defined in style.css
        * action: after_setup_theme
        * --> too late for config files!
        * no in config.php
        */
        //$this->addTextDomain();

      /**
        * Add Custom Menu Active Class --> uk-active = default
        * filter: nav_menu_css_class
        */
        $this->addMenuActiveClass();

      /**
        * Add Custom Menu Parent Class --> uk-parent = default
        * filter: nav_menu_css_class
        */
        $this->addMenuParentClass();


    }

}
