<?php

namespace ZMT\Theme\Modules;

class modBBPress extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $bbpress_content = NULL;

    if ( have_posts() ) {

    	while ( have_posts() ) {

    		the_post();

        //$bbpress_content .= get_the_content();

        ob_start();
        the_content();
        $bbpress_content .= ob_get_contents();
        ob_end_clean();

    	}

    }

    return $bbpress_content;

  }

}
