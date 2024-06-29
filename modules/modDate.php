<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\Helpers as Helpers;

class modDate extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $linked = $this->getArg('linked');// 0 = no link, 1 = all linked
    $format = $this->getArg('date_format');//date-format like php date function
    $class = $this->getArg('link_class');//link class

    $html = NULL;

    $html .= '<time datetime="'.esc_attr( get_the_date( 'c', get_the_ID() ) ).'">'.esc_html( get_the_date( $format, get_the_ID() ) ).'</time>';

    if($html && $linked) {

      /*$link = get_day_link(
        get_post_time( 'Y', false, get_the_ID() ),
        get_post_time( 'm', false, get_the_ID() ),
        get_post_time( 'd', false, get_the_ID() )
      );*/
      $link = get_month_link(
        get_post_time( 'Y', false, get_the_ID() ),
        get_post_time( 'm', false, get_the_ID() )
      );

      $html = '<a href="'. esc_url($link) .'"'.Helpers::getAttribute($class,NULL,' class="%s"').'>'.$html.'</a>';

    }

    return $html;

  }

  public function getModule() {

    $result = parent::getModule();

    if($result){

      $label = \ZMT\Theme\Helpers::getTrStr('Date_label');//Post Date:

      $result = str_replace(
        array( '__label__' ),
        array(  esc_html( $label ) ),
        $result
      );

    }

    return $result;

  }

}
