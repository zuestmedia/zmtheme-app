<?php

namespace ZMT\Theme\Modules;

class modLinkPages extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $prae = $this->getArg('before');
    $next_or_number = $this->getArg('next_or_number');
    $separator = esc_html($this->getArg('text_separator'));
    $prev_text = esc_html($this->getArg('prev_text'));
    $next_text = esc_html($this->getArg('next_text'));

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

}
