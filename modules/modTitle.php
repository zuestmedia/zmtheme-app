<?php

namespace ZMT\Theme\Modules;

class modTitle extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $title_element = esc_html($this->getArg('title_element'));
    $title_class = $this->getArg('title_class');
    $link_class = $this->getArg('link_class');
    $linked = $this->getArg('linked');

    $html = NULL;

    $html .= esc_html( get_the_title( get_the_ID() ) );

    if( $html && $linked ) {

      $html = '<a href="'. get_permalink( get_the_ID() ) .'"'.\ZMT\Theme\Helpers::getAttribute($link_class,NULL,' class="%s" ').'>'.$html.'</a>';

    }

    if( $html && $title_element ){
      $html = '<'.$title_element.\ZMT\Theme\Helpers::getAttribute($title_class,NULL,' class="%s" ').'>'.$html.'</'.$title_element.'>';
    }

    return $html;

  }

}
