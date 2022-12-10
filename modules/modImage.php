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

    $size = $this->getArg('image_size');//thumbnail,medium,large,full
    $class = $this->getArg('image_class');
    $captionstatus = $this->getArg('caption');//0=off 1=on
    $captionformat = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('caption_wrap'),true));//json
    $linked = $this->getArg('image_link');

    $args = array('class' => $class);

    if($linked == 1){
      $args['alt'] = get_the_title( get_the_ID() );
    }

    $img = get_the_post_thumbnail( get_the_ID(), $size, $args );
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

        $caption = sprintf( $captionformat, esc_attr( $captiontext ));

      }

    }

    $html = NULL;

    if( $img ) {

      $html .= $img;

    } elseif( $url ) {

      $html .= '<img src="'.esc_url($url).'">';

    }

    if( $html && $linked ) { $html = '<a style="display:block" href="'. esc_url($redirurl) .'" data-caption="'.esc_attr( $captiontext ).'">'. $html .'</a>'; }

    if( $html && $caption ) { $html .= $caption; }

    return $html;

  }

}
