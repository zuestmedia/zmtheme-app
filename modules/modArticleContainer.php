<?php

namespace ZMT\Theme\Modules;

class modArticleContainer extends modContainerSortable {

  public function getAttrs($section_element_type) {

    $result = parent::getAttrs($section_element_type);

    if($section_element_type == 'module'){

      $result .= ' id="'.esc_attr(get_the_ID()).'"';

    }

    return $result;

  }

  public function getClasses($section_element_type,$zmquery_class = 0) {

    $result = parent::getClasses($section_element_type,$zmquery_class);

    if($section_element_type == 'module'){

      $classes = NULL;

      if(is_customize_preview()){
        $classes .= 'zm-nohide-articles ';//to jquery not hide if has zm-prev-hidden eg in article container children
      }

      $classes .= join( ' ', get_post_class('',get_the_ID()) );

      $stickyclass = $this->getArg('sticky_class'); //only escape in getContent! --> this is a modContainer class...

      if( strpos( $classes, 'sticky') ){
        $classes .= ' '.$stickyclass;
      }

      $result = str_replace(' class="', ' class="'.esc_attr($classes).' ', $result);

    }

    return $result;

  }

}
