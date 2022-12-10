<?php

namespace ZMT\Theme\Modules;

class modLogo extends \ZMT\Theme\Modules\Module {

  public function getContent() {


    $textwrap = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('logo_wrap'),true));//json
    $linked = $this->getArg('linked');
    $link_class = $this->getArg('link_class');

    $blogname = get_bloginfo( 'name' );
    $blogdesc = get_bloginfo( 'description' );

    $html = NULL;
    $logotext_html = NULL;
    if ( has_custom_logo() ) {
      $html .= get_custom_logo();
    }
    if( get_theme_mod( 'header_text', true ) ){

      if( $blogname || $blogdesc ){

          $logotext_html = sprintf($textwrap, esc_html( $blogname ), esc_html( $blogdesc ) );

          if( $linked ) {

            $html .= '<a href="'.esc_url( get_home_url() ).'/"'.\ZMT\Theme\Helpers::getAttribute($link_class,NULL,' class="%s" ').' rel="home">'.$logotext_html.'</a>';

          } else {

            $html .= $logotext_html;

          }

      }

    }

    return $html;

  }

}
