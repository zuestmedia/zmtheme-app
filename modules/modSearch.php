<?php

namespace ZMT\Theme\Modules;

class modSearch extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $formclass = $this->getArg('form_class');
    $searchicon = $this->getArg('search_icon');//json
    $inputclass = $this->getArg('input_class');
    $placeholder = $this->getArg('placeholder');
    $autofocus = $this->getArg('autofocus');

    $autofocus_attr = NULL;
    if($autofocus == 1){
      $autofocus_attr = ' autofocus';
    }

    $html = NULL;
    $html .= '<form class="'.esc_attr($formclass).'" method="get" action="'.esc_url( home_url( '/' ) ).'">';
      $html .= \ZMT\Theme\Element::processHTMLElements(json_decode($searchicon,true));//json
      $html .= '<input class="'.esc_attr($inputclass).'"'.$autofocus_attr.' type="search" placeholder="'.esc_attr($placeholder).'" value="'.esc_attr( get_search_query() ).'" name="s">';
    $html .= '</form>';
    return $html;

  }

}
