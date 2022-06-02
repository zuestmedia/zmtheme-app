<?php

namespace ZMT\Theme\Modules;

class modCssVars extends \ZMT\Theme\Base {

  /**
   * Info: IE11 Support for CSS Variables is added via Theme::setHeadScript in Config.php
   */

  public function addVars() {

    $result = NULL;
    $style = NULL;

    if($this->getSettingsStatus() > '1'){

      foreach( $this->getArgs() as $key => $value ){

        if( $this->getArgDefaultValue( $key ) != $this->getArg( $key ) ){

          if($key == 'color_text_inverse'){

            $style .= '--'.esc_attr($key).':'.esc_attr($this->convertHEXtoRGBA( $this->getArg( $key ) )).';';

          } else {

            $style .= '--'.esc_attr($key).':'.esc_attr($this->getArg( $key )).';';

          }

        }

      }

      if($style){

        $result = '<style> :root {'.$style.'} </style>';

      }

    }

    return $result;

  }

  public function convertHEXtoRGBA( $hex, $opacity = 1 ) {

  /**
    *
    * color_text_inverse is saved as hex color but needed in cssvar in form of a part of rgba style!
    *
    * https://mekshq.com/how-to-convert-hexadecimal-color-code-to-rgb-or-rgba-using-php/
    *
    * background / color: #ffffff !important;     --> ": #ffffff"            --> rgba(var, 1)
    * rgba(255, 255, 255, 0.5)                    --> "255, 255, 255"        --> rgba(var, 0.5)
    *
    * ==> rgba( var(--color_text_inverse, 255, 255, 255), 1 );
    *
    */
    $hex = str_replace( '#', '', $hex );

    // if in 3 digit format
    if( strlen( $hex ) == 3) {

      $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
      $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
      $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );

    } else {

      $r = hexdec( substr( $hex, 0, 2 ) );
      $g = hexdec( substr( $hex, 2, 2 ) );
      $b = hexdec( substr( $hex, 4, 2 ) );

    }

    //return 'rgba( '.$r.', '.$g.', '.$b.', '.$opacity.' )';
    return $r.', '.$g.', '.$b;

  }

  public function getModule() {

    return $this->addVars();

  }

}
