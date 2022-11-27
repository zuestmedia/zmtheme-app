<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\Helpers as Helpers;

class modAuthorLink extends \ZMT\Theme\Modules\Module {

  public function getContent() {

  /**
    * on customizer pagereload, user object is not set in global context, have to build it self
    * see: https://wordpress.stackexchange.com/questions/292367/author-functions-don-t-work-in-customizer-s-selective-refresh
    */
    $user = false; //default value for get_the_author_meta!
    if(is_customize_preview()){
      $current_post = get_post();
      if ( ! empty( $current_post ) ) {
          $user = $current_post->post_author;
      }
    }

    $linked = $this->getArg('linked');// 0 = no link, 1 = all linked
    $class = $this->getArg('link_class');//link class

    $url = get_author_posts_url( get_the_author_meta( 'ID' , $user) );
    $author = get_the_author_meta( 'display_name' , $user);

    $html = NULL;

    if( $author ) { $html .= esc_html($author); }

    if( $html && $linked && $url ) {

      $html = '<a rel="author" href="'. esc_url($url) .'"'.Helpers::getAttribute($class,NULL,' class="%s"').'>'.$html.'</a>';

    }

    return $html;

  }

  public function getModule() {

    $result = parent::getModule();

    $label = esc_html( \ZMT\Theme\Helpers::getTrStr('AuthorLink_label') );//Author:

    $result = str_replace(
      array( '__label__' ),
      array(  $label, ),
      $result
    );

    return $result;

  }

}
