<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\Helpers as Helpers;

class modTermMeta extends \ZMT\Theme\Modules\Module {

/**
  *same as modPostMeta except the value function!!!
  */
  public function getContent() {

    $meta_key  = $this->getArg('meta_key');
    $meta_wrap = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('meta_wrap'),true));//json
    $list_wrap = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('list_wrap'),true));//json
    $list_item = $this->getArg('list_item');
    $text_separator = $this->getArg('text_separator');

    $html = NULL;

    $value = get_term_meta( get_queried_object_id(), $meta_key, false );

    if($value){

      if($meta_key){

        if(is_array($value[0])){

          foreach($value[0] as $single_value){

            if($list_item) { $html .= '<'.esc_attr( $list_item ).'>'; }

              $html .= sprintf( $meta_wrap, esc_html( $meta_key ), esc_html( $single_value ) );

            if($list_item) { $html .= '</'.esc_attr( $list_item ).'>'; }

          }

          if($html){

            $html = sprintf( $list_wrap, $html );

          }

        } else {

          $html .= sprintf( $meta_wrap, esc_html( $meta_key ), esc_html( $value[0] ) );

        }

      } else {

        foreach($value as $meta_name => $meta_value_arr){

          if( !Helpers::stringStartsWith($meta_name,'_') ){

            if($list_item) { $html .= '<'.esc_attr( $list_item ).'>'; }

              $html .= sprintf( $meta_wrap, esc_html( $meta_name ), esc_html( Helpers::implodeIfArray( $meta_value_arr[0], $text_separator ) ) );

            if($list_item) { $html .= '</'.esc_attr( $list_item ).'>'; }

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
