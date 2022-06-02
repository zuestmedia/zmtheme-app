<?php

namespace ZMT\Theme\Modules;

class modLogo extends \ZMT\Theme\Modules\Module {

  public function getContent() {


    $textwrap = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('logo_wrap'),true));//json
    $linked = $this->getArg('linked');
    $link_class = $this->getArg('link_class');

    $blogname = esc_html(get_bloginfo( 'name' ));
    $blogdesc = esc_html(get_bloginfo( 'description' ));

    $html = NULL;
    $logotext = NULL;
    if ( has_custom_logo() ) {
      $html .= get_custom_logo();
    }
    if( get_theme_mod( 'header_text', true ) ){

      if( $blogname || $blogdesc ){

          $logotext = sprintf($textwrap,$blogname,$blogdesc);

          if( $linked ) {

            $html .= '<a href="'.esc_url( get_home_url() ).'/"'.\ZMT\Theme\Helpers::getAttribute($link_class,NULL,' class="%s" ').'>'.$logotext.'</a>';

          } else {

            $html .= $logotext;

          }

      }

    }

    return $html;

  }

}
