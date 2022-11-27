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

            $style .= '--'.esc_attr($key).':'.esc_attr(\ZMT\Theme\Helpers::convertHEXtoRGBA( $this->getArg( $key ) )).';';

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

  public function getModule() {

    return $this->addVars();

  }

}
