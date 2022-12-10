<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\Helpers as Helpers;

class modPostMeta extends \ZMT\Theme\Modules\Module {

/**
  *same as modTermMeta except the value function!!!
  */
  public function getContent() {

    $meta_key = $this->getArg('meta_key');
    $meta_wrap = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('meta_wrap'),true));//json
    $list_wrap = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('list_wrap'),true));//json
    $list_item = $this->getArg('list_item');
    $text_separator = $this->getArg('text_separator');

    $html = NULL;

    $value = get_post_meta( get_the_ID(), $meta_key, false );

    if($value){

      if($meta_key){

        if(is_array($value[0])){

          //todo: array wird nie als array hier ausgegeben, muss von serialized oder was auch immer umgewandelt werden...
          //--> anpassen wenn case da.
          //funktioniert perfekt mit single values pro custom field.

          //filter array for existing values!
          /*$values_array =  array_filter($value[0],
            function ($a) {
              //return $a !== null;
              if($a){
                return $a;
              }
            }
          );*/

          foreach($value[0] as $single_value){

            if($list_item) { $html .= '<'.esc_attr( $list_item ).'>'; }

              $html .= sprintf( $meta_wrap, esc_html( $meta_key ), esc_html( $single_value ) );

            if($list_item) { $html .= '</'.esc_attr( $list_item ).'>'; }

          }

          if($html){

            $html = sprintf( $list_wrap, $html );

          }

        } else {

          if($value[0]){
            $html = sprintf( $meta_wrap, esc_html( $meta_key ), esc_html( $value[0] ) );
          }

        }

      } else {

        foreach($value as $meta_name => $meta_value_arr){

          if( !Helpers::stringStartsWith($meta_name,'_') ){

            //same here, no array is processed because none yet is coming in
            if( (is_array($meta_value_arr[0]) && !empty($meta_value_arr[0]) ) || ( !is_array($meta_value_arr[0]) && $meta_value_arr[0] ) ){

              if($list_item) { $html .= '<'.esc_attr( $list_item ).'>'; }

                $html .= sprintf( $meta_wrap, esc_html( $meta_name ), esc_html( Helpers::implodeIfArray( $meta_value_arr[0], esc_html( $text_separator ) ) ) );

              if($list_item) { $html .= '</'.esc_attr( $list_item ).'>'; }

            }

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
