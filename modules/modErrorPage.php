<?php

namespace ZMT\Theme\Modules;

class modErrorPage extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $title = \ZMT\Theme\Helpers::getTrStr('PageNotFound');
    $text = \ZMT\Theme\Helpers::getTrStr('PageNotFound_long');

    $home = \ZMT\Theme\Helpers::getTrStr('Home');

    $home_url_html = '<a href="'.esc_url( get_home_url() ).'/">'.esc_html( $home ).'</a>';

    $element = $this->getArg('title_element');
    $class = $this->getArg('title_class');

    $html = NULL;
    if($title) {
      $html .= '<'.esc_attr( $element ).\ZMT\Theme\Helpers::getAttribute($class,NULL,' class="%s" ').'>'.esc_html( $title ).'</'.esc_attr( $element ).'>';
    }
    if($text) {

      $text = sprintf($text, $home_url_html );

      $html .= '<p>'.esc_html( $text ).'</p>';
    }
    if($html == NULL){
      $html .= '<h1 class="uk-heading-medium">404 - Page Not Found</h1>';
    }

    return $html;

  }

}
