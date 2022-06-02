<?php

namespace ZMT\Theme\Modules;

class modErrorPage extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $title = esc_html($this->getArg('title'));
    $text = esc_html($this->getArg('text'));
    $element = esc_html($this->getArg('title_element'));
    $class = $this->getArg('title_class');

    $html = NULL;
    if($title) {
      $html .= '<'.$element.\ZMT\Theme\Helpers::getAttribute($class,NULL,' class="%s" ').'>'.$title.'</'.$element.'>';
    }
    if($text) {

      $text = sprintf($text, home_url() );

      $html .= '<p>'.$text.'</p>';
    }
    if($html == NULL){
      $html .= '<h1 class="uk-heading-medium">404 - Page Not Found</h1>';
    }

    return $html;

  }

}
