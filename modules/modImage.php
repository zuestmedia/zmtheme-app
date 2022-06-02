<?php

namespace ZMT\Theme\Modules;

class modImage extends \ZMT\Theme\Modules\Module {

  /**
   * get the featured Image in Wordpress View Templates
   *
   * should be updated with data-src="" uk-img
   * --> see uikit doku: https://getuikit.com/docs/image
   * for lazyloading and optimiziation
   *
   * @return string html of featured image
   */
   public function getContent() {

    $size = esc_html($this->getArg('image_size'));//thumbnail,medium,large,full
    $class = esc_attr($this->getArg('image_class'));
    $captionstatus = $this->getArg('caption');//0=off 1=on
    $captionformat = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('caption_wrap'),true));//json
    $linked = $this->getArg('image_link');

    $img = get_the_post_thumbnail( get_the_ID(), $size, array('class' => $class) );
    $url = wp_get_attachment_url(get_post_thumbnail_id());

    $redirurl = NULL;
    if($linked == 1) {

      $redirurl = get_permalink( get_the_ID() );

    } elseif($linked == 2) {

      $redirurl = $url;

    }

    $caption = NULL;
    $captiontext = NULL;
    if($captionstatus){

      $captiontext = esc_html(wp_get_attachment_caption(get_post_thumbnail_id()));

      if($captiontext) {

        $caption = sprintf( $captionformat, $captiontext);

      }

    }

    $html = NULL;

    if( $img ) {

      $html .= $img;

    } elseif( $url ) {

      $html .= '<img src="'.esc_url($url).'">';

    }

    if( $html && $linked ) { $html = '<a href="'. esc_url($redirurl) .'" data-caption="'. $captiontext .'">'. $html .'</a>'; }

    if( $html && $caption ) { $html .= $caption; }

    return $html;

  }

}
