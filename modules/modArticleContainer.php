<?php

namespace ZMT\Theme\Modules;

class modArticleContainer extends modContainerSortable {

  public function getAttrs($section_element_type) {

    $result = parent::getAttrs($section_element_type);

    /*if($section_element_type == 'module'){

      $result .= ' id="'.esc_attr(get_the_ID()).'"';

    }*/
    if($section_element_type == 'moduleouter'){

      $result .= ' id="'.esc_attr(get_the_ID()).'"';

    }

    return $result;

  }

  public function getClasses($section_element_type,$zmquery_class = 0) {

    $result = parent::getClasses($section_element_type,$zmquery_class);

    $classes = NULL;

    if($section_element_type == 'moduleouter'){

      $classes = join( ' ', get_post_class('',get_the_ID()) );

    }

    if($section_element_type == 'module'){

      if(is_customize_preview()){
        $classes = 'zm-nohide-articles';//to jquery not hide if has zm-prev-hidden eg in article container children
      }

      $stickyclass = $this->getArg('sticky_class'); //only escape in getContent! --> this is a modContainer class...

      if( strpos( $classes, 'sticky') ){
        $classes .= ' '.$stickyclass;
      }

    }

    if($classes){

      if($result){

        $result = str_replace(' class="', ' class="'.esc_attr($classes).' ', $result);

      } else {//if arg classes == NULL!!

        $result = ' class="'.esc_attr($classes).'"';

      }

    }

    return $result;

  }

}
