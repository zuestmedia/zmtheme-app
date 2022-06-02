<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\Helpers as Helpers;

class modReadMore extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $readmoretext = esc_html( $this->getArg('read_more') );//Read More...
    $class = $this->getArg('link_class');//link class

    $html = NULL;
    $html .= '<a href="'. esc_url( get_permalink( get_the_ID() ) ) .'"'.Helpers::getAttribute($class,NULL,' class="%s"').'>'.$readmoretext.'</a>';
    return $html;

  }

}
