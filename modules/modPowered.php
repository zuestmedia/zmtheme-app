<?php

namespace ZMT\Theme\Modules;

class modPowered extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $link_text = esc_html($this->getArg('link_text'));
    $link_url = esc_url($this->getArg('link_url'));
    $link_class = $this->getArg('link_class');
    $text = esc_html($this->getArg('powered_text'));

    $html = NULL;
      $html .= '<a href="'.$link_url.'"'.\ZMT\Theme\Helpers::getAttribute($link_class,NULL,' class="%s" ').'target="_blank" rel="nofollow">';
        $html .= $link_text;
      $html .= '</a> | ';
      $html .= $text;
    return $html;

  }

}
