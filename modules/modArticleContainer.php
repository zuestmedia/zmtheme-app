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

  public function getContent() {

    $result = parent::getContent();

    $imageoverlay_wrap = $this->getArg('imageoverlay_wrap');

    if($imageoverlay_wrap){

      $size = $this->getArg('imageoverlay_size');

      $html = \ZMT\Theme\Element::processHTMLElements( json_decode( $imageoverlay_wrap, true ) );

      $img = get_the_post_thumbnail( get_the_ID(), $size );

      if(!$img){

        $width = '300';
        $height = '200';

        $width = get_option( $size.'_size_w' );
        $height = get_option( $size.'_size_h' );

        //get placeholder image
        $placeholder_img_url = \ZMT\Theme\Helpers::getThemeUrl().'/assets/img/placeholder.png';

        $img = '<img width="'.esc_attr($width).'" height="'.esc_attr($height).'" src="'.esc_attr($placeholder_img_url).'" class="placeholder-image" alt="placeholder image">';

      }

      $result = str_replace(
        array(
          '__image__',
          '__articlecontent__'
        ),
        array(
          $img,
          $result
        ),
        $html
      );

    }

    return $result;

  }

}
