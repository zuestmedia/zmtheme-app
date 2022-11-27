<?php

namespace ZMT\Theme\Modules;

class modSearch extends \ZMT\Theme\Modules\Module {

  public function searchformFilter($form, $args){

    $formclass = $this->getArg('form_class');
    $searchicon = $this->getArg('search_icon');
    $inputclass = $this->getArg('input_class');
    $autofocus = $this->getArg('autofocus');

    if($formclass){
      $form = str_replace("search-form", esc_attr($formclass), $form);
    }

    if($searchicon){
      $form = str_replace("<label>", "<label>".\ZMT\Theme\Element::processHTMLElements(json_decode($searchicon,true)), $form);//$searchicon is escaped in Elements!
    }

    if($inputclass){
      $form = str_replace("search-field", esc_attr($inputclass), $form);
    }

    //add required and opt. autofocus to input type="search"
    if($autofocus == 1){
      $form = str_replace('type="search"', 'type="search" required autofocus', $form);
    } else {
      $form = str_replace('type="search"', 'type="search" required', $form);
    }

    //hide button//style="right: 0;left: auto;"
    $form = str_replace('class="search-submit"', 'class="screen-reader-text" style="right: 0;left: auto;padding: 6px 23px 6px;"', $form);

    return $form;

  }

  public function getContent() {

    $html = NULL;

    $args = array(
      'echo' => false
    );

    add_filter( 'get_search_form', array($this,'searchformFilter'), 10, 2 );

    $html .= get_search_form($args);

    remove_filter( 'get_search_form', array($this,'searchformFilter') );

    return $html;


  }

  public function getModule() {

    $result = parent::getModule();

    $label = esc_html( \ZMT\Theme\Helpers::getTrStr('Search_label') );//Search
    $label_close = esc_html( \ZMT\Theme\Helpers::getTrStr('Search_label_close') );//Search

    $result = str_replace(
      array( '__label__', '__label_close__' ),
      array(  $label, $label_close ),
      $result
    );

    return $result;

  }

}
