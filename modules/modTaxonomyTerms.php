<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\Helpers as Helpers;

class modTaxonomyTerms extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $element = $this->getArg('list_item');
    $class = $this->getArg('link_class');
    $separator = $this->getArg('text_separator');
    $linked = $this->getArg('linked');// 0 = no link, 1 = all linked
    $taxonomy = $this->getArg('taxonomy');

    $terms = get_the_terms( get_the_ID(), $taxonomy );

    $html = NULL;

    if($terms){

      $count = 0;
      foreach( $terms as $term ) {

        if($count > 0){

          $html .= esc_html($separator);

        }

        if($element) { $html .= '<'.esc_attr( $element ).'>'; }

          if($linked) {  

            $termlink = get_term_link( $term->term_id );

            if(!is_string($termlink)){

              $termlink = '#errorintaxonomyterms';

            }
            
            $html .= '<a rel="tag" href="'. esc_attr( $termlink ) .'"'.Helpers::getAttribute($class,NULL,' class="%s"').'>'; 
          
          }

            $html .= esc_html( $term->name );

          if($linked) {  $html .= '</a>'; }

        if($element) { $html .= '</'.esc_attr( $element ).'>'; }

        $count++;

      }

    }

    return $html;

  }

  public function getModule() {

    $result = parent::getModule();

    $taxonomy_details = get_taxonomy( $this->getArg('taxonomy') );
    $label = NULL;
    if($taxonomy_details !== false){
      $label = $taxonomy_details->labels->name;
    }

    if($result){

      $result = str_replace(
        array( '__label__' ),
        array(  esc_html( $label ) ),
        $result
      );
      
    }

    return $result;

  }

}
