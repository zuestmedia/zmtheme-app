<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\Helpers as Helpers;

class modCommentsCounter extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    if(comments_open()){

      $no_com = esc_html($this->getArg('no_comments'));//sprintf()
      $one_com = esc_html($this->getArg('one_comment'));//sprintf()
      $more_com = esc_html($this->getArg('more_than_one_comment'));//sprintf()
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

        $html .= $com_text;

      }

      if($html && $url && $linked) {

        $html = '<a href="'. esc_url($url) .'#comments"'.Helpers::getAttribute($class,NULL,' class="%s"').'>'.$html.'</a>';

      }

      return $html;

    }

    return NULL;

  }

}
