<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\Helpers as Helpers;

class modReadMore extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $readmoretext = \ZMT\Theme\Helpers::getTrStr('ReadMore');//Read More...
    $readmorehtml = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('read_more_wrap'),true));//json

    if($readmorehtml){
      $readmoretext = str_replace(
        array(
          '__readmoretext__'
        ),
        array(
          esc_html( $readmoretext )
        ),
        $readmorehtml
      );
    }
    $class = $this->getArg('link_class');//link class

    $html = NULL;
    $html .= '<a href="'. esc_url( get_permalink( get_the_ID() ) ) .'"'.Helpers::getAttribute($class,NULL,' class="%s"').'>'.$readmoretext.'<span class="screen-reader-text">: '.esc_html( get_the_title( get_the_ID() ) ).'</span></a>';
    return $html;

  }

}
