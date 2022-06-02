<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\Helpers as Helpers;

class modPostMeta extends \ZMT\Theme\Modules\Module {

/**
  *same as modTermMeta except the value function!!!
  */
  public function getContent() {

    $meta_key = esc_html($this->getArg('meta_key'));
    $meta_wrap = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('meta_wrap'),true));//json
    $list_wrap = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('list_wrap'),true));//json
    $list_item = esc_html($this->getArg('list_item'));
    $text_separator = esc_html($this->getArg('text_separator'));

    $html = NULL;

    $value = get_post_meta( get_the_ID(), $meta_key, false );

    if($value){

      if($meta_key){

        if(is_array($value[0])){

          foreach($value[0] as $single_value){

            if($list_item) { $html .= '<'.$list_item.'>'; }

              $html .= sprintf( $meta_wrap, $meta_key, $single_value );

            if($list_item) { $html .= '</'.$list_item.'>'; }

          }

          if($html){

            $html = sprintf( $list_wrap, $html );

          }

        } else {

          $html .= sprintf( $meta_wrap, $meta_key, $value[0] );

        }

      } else {

        foreach($value as $meta_name => $meta_value_arr){

          if( !Helpers::stringStartsWith($meta_name,'_') ){

            if($list_item) { $html .= '<'.$list_item.'>'; }

              $html .= sprintf( $meta_wrap, $meta_name, Helpers::implodeIfArray( $meta_value_arr[0], $text_separator ) );

            if($list_item) { $html .= '</'.$list_item.'>'; }

          }

        }

        if($html){

          $html = sprintf( $list_wrap, $html );

        }

      }

    }

    return $html;

  }

}
