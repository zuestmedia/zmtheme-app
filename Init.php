<?php

namespace ZMT\Theme;

class Init {

    function __construct( ){      

      $this->selectiveInit();

    }

    /**
     * Check if ZMPlugin is installed!
     * -> theme needs different action to initialise, because zmplugin actions are not available if no zmplugin!
     * -> version check, because actions are different before v2.0.0
     */
    public function selectiveInit(){

      /**
       * add theme support directly at 'after_setup_theme'!
       * is a static function inside Theme.php!
       */
      \ZMT\Theme\Theme::addThemeSupport();

      //check if zmplugin is installed and activated
      if(class_exists('ZMPluginPsr4AutoloaderClass')){

        global $zmplugin;      

        $zmplugin_data = get_file_data(WP_PLUGIN_DIR.'/'.$zmplugin['plugin_basename'], array('Version' => 'Version'), false);        

        //check version of zmplugin
        if($zmplugin_data['Version'] < 2){

          $this->initTheme();
          $this->displayErrorMessage();

        } else {

          add_action('zmplugin_last_action', array($this, 'initTheme'));
          add_action('zmplugin_last_action', array($this, 'initThemeSettings'));
          add_action('zmplugin_last_action', array($this, 'initThemeCustomizer'));

        }

      } else {

        //only initTheme if ZMPlugin is not activated or not installed
        $this->initTheme();
        $this->displayErrorMessage();

      }

    }

    public function displayErrorMessage(){

      if( is_admin() ){

        global $zmtheme;

        /**
         * This is a standard error menu to show zm toolbox core is missing
         * Required setters: Display Name & Slug
         */
        $errormenu = new \ZMT\Theme\ErrorMenu( $zmtheme['theme']->getDisplayName() );

        $errormenu->setMenuPage('<div class="wrap">');

          $errormenu->setMenuPage('<h1>');

            $errormenu->setMenuPage( esc_html( $zmtheme['theme']->getDisplayName() ) );

          $errormenu->setMenuPage('</h1>');

          $errormenu->setMenuPage('<div class="notice notice-info"><p>');

            $errormenu->setMenuPage( esc_html( \ZMT\Theme\Helpers::getTrStr('Toenablethemesettings') ) );

            $errormenu->setMenuPage('</p><p><a target="_blank" rel="nofollow" href="https://zuestmedia.com/zmplugin/">');

            $errormenu->setMenuPage( esc_html( \ZMT\Theme\Helpers::getTrStr('DownloadZMPlugin') ) );

          $errormenu->setMenuPage('</a></p></div>');

        $errormenu->setMenuPage('</div>');

        $errormenu->getErrorMenu();

        //stop execution of plugin
        return;

      }

    }

    public function initTheme(){

      /**
        * This is the global theme var!
        * all frontend settings and more are this way always accessible and
        * setters and getters can be used in later states in eg. functions.php to alter settings
        * or even finaly in view templates...
        * Contains: array of Objects from Theme classes
        * @var array
        * @access public
        */
        global $zmtheme;

      /**
        * Load Textdomain before Config!
        */
        \ZMT\Theme\Helpers::LoadTextDomainbeforeConfigFiles();

      /**
        * Default Config with Namespace and Alt-Namespace(s)
        */
        $ns_def_conf = new \ZMT\Theme\Namespaces( '\ZMT\Theme\Config\Theme\\', '\ZMT\Theme\Child\Config\Theme\\' );

        $full_classname_conf = $ns_def_conf->getClass('BuildObject');

        $zmtheme['default_config'] = new $full_classname_conf();

      /**
        * Default Components with Namespace and Alt-Namespace(s)
        */
        $ns_def_coms = new \ZMT\Theme\Namespaces( '\ZMT\Theme\Config\\', '\ZMT\Theme\Child\Config\\' );

        $full_classname_coms = $ns_def_coms->getClass('BuildObject');

        $zmtheme['default_components'] = new $full_classname_coms();


      /**
        * Class: ZMTheme as $zmtheme['theme']
        * Define at first Main Theme Object and set most default settings for theme
        * eg. displayname, settings-form&options-name-definition, css, js..
        * lastly init actions and filters
        */
        $zmtheme['theme'] = new \ZMT\Theme\Theme();


      /**
        * Update to 2.1.0 - if is child theme copy existing option settings to child-option-settings (only once!)
        */
        \ZMT\Theme\Helpers::updateTo210();


        $theme_config_object = $zmtheme['default_config'];

      /**
        * Theme Config
        */
        $zmtheme['theme']->setVersion( $theme_config_object->theme->version );
        $zmtheme['theme']->setFramework( $theme_config_object->theme->framework );
        $zmtheme['theme']->setCSSType( $theme_config_object->theme->css_type );
        $zmtheme['theme']->setCss( $theme_config_object->theme->css );
        $zmtheme['theme']->setCssRtl( $theme_config_object->theme->css_rtl );
        $zmtheme['theme']->setJs( $theme_config_object->theme->js );
        $zmtheme['theme']->setIcons( $theme_config_object->theme->icons );
        $zmtheme['theme']->setJsArray( $theme_config_object->theme->js_array );
        $zmtheme['theme']->setMenuActiveClass( $theme_config_object->theme->menu_active_class );
        $zmtheme['theme']->setMenuParentClass( $theme_config_object->theme->menu_parent_class );

        $zmtheme['theme']->setHeadModules( $theme_config_object->theme->head_modules );

        $zmtheme['theme']->setStarterContent( $theme_config_object->startercontent->content );

        if( is_child_theme() ){          

          //set settings = 2 in child themes to use pre-imported designs
          $zmtheme['theme']->setSettingsStatus( '2' );

          //child theme css 
          if( isset( $theme_config_object->theme->css_child_theme ) ){
            $zmtheme['theme']->setCssChildTheme( $theme_config_object->theme->css_child_theme );
          }
          //child theme css-rtl
          if( isset( $theme_config_object->theme->css_rtl_child_theme ) ){
            $zmtheme['theme']->setCssRtlChildTheme( $theme_config_object->theme->css_rtl_child_theme );
          }
          //child theme uikit js
          if( isset( $theme_config_object->theme->js_child_theme ) ){
            $zmtheme['theme']->setJsChildTheme( $theme_config_object->theme->js_child_theme );
          }
          //child theme uikit icons
          if( isset( $theme_config_object->theme->icons_child_theme ) ){
            $zmtheme['theme']->setIconsChildTheme( $theme_config_object->theme->icons_child_theme );
          }
          //child theme js array
          if( isset( $theme_config_object->theme->js_array_child_theme ) ){
            $zmtheme['theme']->setJsArrayChildTheme( $theme_config_object->theme->js_array_child_theme );
          }

        }


      /**
        * Init Actions and Filters
        */
        $zmtheme['theme']->initTheme(); //am Schluss, wenn Theme settings gemacht sind! können alle actions und filters usw (vor)geladen werden

        //add color palette and gradients to theme.json and needed css to head (gradients)
        new \ZMT\Theme\ThemeJSON();

        //prepares global default_components objects
        new \ZMT\Theme\Prepare( $zmtheme['theme']->getOptGroup(), $zmtheme['theme']->getSettingsStatus());

        //create configurated com & module objects
        new \ZMT\Theme\Config();

        /**
        * Load Theme Design if has zmt-config.json and not theme_mods yet (fresh install / preview or reset to default)
        * Important: load after prepare and config, to recreate objects again
        */
        \ZMT\Theme\Helpers::loadThemeDesignConfig();

        //add modules to head
        new \ZMT\Theme\Head();

        //add ajax posts loader
        new \ZMT\Theme\AjaxPostsLoader();
        
        //add action to delet wp_options on theme deletion
        \ZMT\Theme\Helpers::addDeleteThemeOptions();

        do_action( 'after_setup_ZMTheme' );

    }

    public function initThemeSettings(){

      if (class_exists('\ZMP\Plugin\ThemeSettings\ThemeSettingsInit')) {

        new \ZMP\Plugin\ThemeSettings\Init();

      }

    }

    public function initThemeCustomizer(){

      if(is_customize_preview()){

        global $zmtheme;

        /**
        * Theme Customizer
        */
        if ( class_exists('\ZMP\Plugin\ThemeCustomizer\ThemeCustomizerInit') && $zmtheme['theme']->getSettingsStatus() >= 2 ) {

          new \ZMP\Plugin\ThemeCustomizer\ThemeCustomizerInit();

        }

      }

    }

}
