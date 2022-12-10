<?php

namespace ZMT\Theme\Modules;

class modTitle extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $title_element = $this->getArg('title_element');
    $title_class = $this->getArg('title_class');
    $link_class = $this->getArg('link_class');
    $linked = $this->getArg('linked');

    $html = NULL;

    $html .= esc_html( get_the_title( get_the_ID() ) );

    if( $html && $linked ) {

      $html = '<a href="'.esc_attr( get_permalink( get_the_ID() ) ).'"'.\ZMT\Theme\Helpers::getAttribute($link_class,NULL,' class="%s" ').'>'.$html.'</a>';

    }

    if( $html && $title_element ){
      $html = '<'.esc_attr( $title_element ).\ZMT\Theme\Helpers::getAttribute($title_class,NULL,' class="%s" ').'>'.$html.'</'.esc_attr( $title_element ).'>';
    }

    return $html;

  }

}
