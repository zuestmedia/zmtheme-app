<?php

namespace ZMT\Theme\Modules;

class modLastNextArticleLink extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $formatlast = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('last_wrap'),true));//json
    $formatnext = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('next_wrap'),true));//json
    $in_same_term = $this->getArg('in_same_term'); //true / false
    $excluded_terms = $this->getArg('excluded_terms'); //commaseplist
    $taxonomy = $this->getArg('taxonomy'); //taxslug if in same term is true

    $last = get_previous_post_link(
      '%link',
      '%title',
      $in_same_term,
      $excluded_terms,
      $taxonomy
    );
    $next = get_next_post_link(
      '%link',
      '%title',
      $in_same_term,
      $excluded_terms,
      $taxonomy
    );

    $html = NULL;
    if($last) {

      $html .= sprintf($formatlast,$last);

    }
    if($next) {

      $html .= sprintf($formatnext,$next);

    }
    return $html;

  }

  public function getModule() {

    $result = parent::getModule();

    if($result){

      $label = \ZMT\Theme\Helpers::getTrStr('LastNextArticleLink_label');//Posts navigation:

      $result = str_replace(
        array( '__label__' ),
        array(  esc_html( $label ) ),
        $result
      );

    }

    return $result;

  }

}
