<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\Helpers as Helpers;

class modCommentsCounter extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    if(comments_open()){

      $no_com = \ZMT\Theme\Helpers::getTrStr('nocomments');//sprintf()
      $one_com = \ZMT\Theme\Helpers::getTrStr('n_comment');//sprintf()
      $more_com = \ZMT\Theme\Helpers::getTrStr('n_comments');//sprintf()

      $linked = $this->getArg('linked');// 0 = no link, 1 = all linked
      $class = $this->getArg('link_class');// linkclass

      $com_numb = get_comments_number( get_the_ID() );
      $url = get_permalink( get_the_ID() );

      $com_text = NULL;
      if($com_numb == 0){ $com_text = sprintf( $no_com, $com_numb ); }
      if($com_numb == 1){ $com_text = sprintf( $one_com, $com_numb ); }
      if($com_numb >= 2){ $com_text = sprintf( $more_com, $com_numb ); }

      $html = NULL;

      if($com_text) {

        $html .= esc_html( $com_text );

      }

      if($html && $url && $linked) {

        $html = '<a href="'. esc_url($url) .'#comments"'.Helpers::getAttribute($class,NULL,' class="%s"').'>'.esc_html( $html ).'</a>';

      }

      return $html;

    }

    return NULL;

  }

  public function getModule() {

    $result = parent::getModule();

    $label = esc_html( \ZMT\Theme\Helpers::getTrStr('CommentsCounter_label') );//Author:

    $result = str_replace(
      array( '__label__' ),
      array(  $label, ),
      $result
    );

    return $result;

  }

}
