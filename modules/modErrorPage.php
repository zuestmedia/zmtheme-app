<?php

namespace ZMT\Theme\Modules;

class modErrorPage extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $title = esc_html( \ZMT\Theme\Helpers::getTrStr('PageNotFound') );
    $text = esc_html( \ZMT\Theme\Helpers::getTrStr('PageNotFound_long') );

    $home = esc_html( \ZMT\Theme\Helpers::getTrStr('Home') );

    $home_url = '<a href="'.esc_url( get_home_url() ).'/">'.$home.'</a>';

    $element = esc_html($this->getArg('title_element'));
    $class = $this->getArg('title_class');

    $html = NULL;
    if($title) {
      $html .= '<'.$element.\ZMT\Theme\Helpers::getAttribute($class,NULL,' class="%s" ').'>'.$title.'</'.$element.'>';
    }
    if($text) {

      $text = sprintf($text, $home_url );

      $html .= '<p>'.$text.'</p>';
    }
    if($html == NULL){
      $html .= '<h1 class="uk-heading-medium">404 - Page Not Found</h1>';
    }

    return $html;

  }

}
