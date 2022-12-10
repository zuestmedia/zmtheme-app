<?php

namespace ZMT\Theme\Modules;

class modLinkPages extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $prae = \ZMT\Theme\Helpers::getTrStr('ContinueReading');
    $next_or_number = $this->getArg('next_or_number');
    $separator = $this->getArg('text_separator');
    $prev_text = \ZMT\Theme\Helpers::getTrStr('Previouspage');
    $next_text = \ZMT\Theme\Helpers::getTrStr('Nextpage');

    $html = NULL;

    $args = array(
        'before'           => $prae,
        'after'            => '',
        'link_before'      => '',
        'link_after'       => '',
        'aria_current'     => 'page',
        'next_or_number'   => $next_or_number,
        'separator'        => $separator,
        'nextpagelink'     => $next_text,
        'previouspagelink' => $prev_text,
        'pagelink'         => '%',
        'echo'             => 0,
    );

    $html = wp_link_pages( $args );

    if($html){

        $html = str_replace('<span class="post-page-numbers current" aria-current="page">', '<span aria-current="page" class="post-page-numbers current uk-active">',$html);

    }

    return $html;

  }

  public function getModule() {

    $result = parent::getModule();

    $label = \ZMT\Theme\Helpers::getTrStr('LinkPages_label');//Author:

    $result = str_replace(
      array( '__label__' ),
      array(  esc_html( $label ) ),
      $result
    );

    return $result;

  }

}
