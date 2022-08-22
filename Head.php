<?php

namespace ZMT\Theme;

class Head {

  /**
    * Construct Function
    */
    function __construct(){

      //start function
      $this->addHead();
      $this->addJSVarsHeadScript();

    }

  /**
    *
    */
    public function HeadModules() {

      global $zmtheme;

      $head_modules = NULL;

      $head_modules = $zmtheme['theme']->getHeadModules();

      if( is_array($head_modules) ){

        foreach( $head_modules as $com_id ){

          echo $zmtheme[ $com_id ]->getModule();

        }

      }

    }

    public function addHead(){

      add_action('wp_head', array( $this, 'HeadModules' ));//to add in frontend
      add_action('admin_head', array( $this, 'HeadModules' ));//to add in gutenberg

    }


    public function JSVarsHeadScript(){

      ?>

      <script>

        // recalculate on resize
        window.addEventListener('resize', zmListenonResizeingWindow, false);
        // recalculate on dom load
        document.addEventListener('DOMContentLoaded', zmListenonResizeingWindow, false);
        // recalculate on load (assets loaded as well)
        window.addEventListener('load', zmListenonResizeingWindow);

        function zmListenonResizeingWindow(){

          zmCalculateScrollbarWidth();

          zmGetArticleContainerWidth();

        }

        function zmGetArticleContainerWidth() {

          var x = document.getElementsByClassName('zm-wp-block-width');

          if (x.length > 0) {

            document.documentElement.style.setProperty('--zm-wp-block-width', x[0].clientWidth + "px");

          }

        }

        //scrollbar width for alignfull calculation
        function zmCalculateScrollbarWidth() {

          document.documentElement.style.setProperty('--scrollbar-width', (window.innerWidth - document.documentElement.clientWidth) + "px");

        }

      </script>

      <?php

    }

    public function addJSVarsHeadScript() {

      add_action( 'wp_head', array( $this, 'JSVarsHeadScript') );

    }


}
