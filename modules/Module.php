<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\View as View;

class Module extends \ZMT\Theme\Component {

  //can be empty or hidden module!
  public function getEmptyModulTemplate($type){

    $result = NULL;
    if(is_customize_preview() && $this->getComLockStatus() == false){
      if (class_exists('\ZMP\Plugin\ThemeCustomizer\CustomizerHelpers') && $this->getSettingsStatus() >= 2) {

        $result = \ZMP\Plugin\ThemeCustomizer\CustomizerHelpers::getEmptyModuleTemplate($this->getId(),$this->getClasses('module'),$type,get_class( $this ));

      }
    }
    return $result;

  }


  /**
  * if a "hide" is set in a _element of module, no element will be shown!
  */
  public function getMostInnerElement(){

    $mostinnerelement = NULL;
    $hideit = NULL;

    $moduleinner_element = $this->getArg( 'moduleinner_element' );
    $module_element = $this->getArg( 'module_element' );
    $moduleouter_element = $this->getArg( 'moduleouter_element' );

    if( $moduleinner_element ){

      $mostinnerelement = 'moduleinner';

      if($moduleinner_element == 'hide'){
        $hideit = 1;
      }

    } elseif( $module_element ){

      $mostinnerelement = 'module';

      if($module_element == 'hide'){
        $hideit = 1;
      }

    } elseif( $moduleouter_element ){

      $mostinnerelement = 'moduleouter';

      if($moduleouter_element == 'hide'){
        $hideit = 1;
      }

    }

    if($hideit){
      $mostinnerelement = 'hide';
    }

    return $mostinnerelement;

  }

  /**
   * [getSectionElementsStart description]
   * @return string [description]
   */
  public function getModuleElementsStart($mostinner_el) {

    $result = NULL;

    if($mostinner_el != NULL){

      $result .= $this->getElementStart( 'moduleouter', $mostinner_el );

        $result .= $this->getElementStart( 'module', $mostinner_el );

          $result .= $this->getElementStart( 'moduleinner', $mostinner_el );

          $content_wrap = $this->getArg( 'content_wrap' );//faster than calling 2x arg!!
          if( $content_wrap ) {
            $result .= \ZMT\Theme\Element::processHTMLElementsStart( json_decode( $content_wrap, true ) );
          }

    } else {

      if( is_customize_preview() ){//Null means, no element is active!

        $zmquery_result = $this->getCustomizerPostQueryInnerContainerClass(1,1);

        $result = '<div'.$this->getAttrs('module').$this->getClasses('module',$zmquery_result).'>';
      }

    }


    return $result;

  }
  /**
   * [getSectionElementsEnd description]
   * @return string [description]
   */
  public function getModuleElementsEnd($mostinner_el) {

    $result = NULL;

    if($mostinner_el != NULL){

          $content_wrap = $this->getArg( 'content_wrap' );//faster than calling 2x arg!!
          if( $content_wrap ) {
            $result .= \ZMT\Theme\Element::processHTMLElementsEnd( json_decode( $content_wrap, true ) );
          }

          $result .= $this->getElementEnd('moduleinner');

        $result .= $this->getElementEnd('module');

      $result .= $this->getElementEnd('moduleouter');

    } else {//Null means, no element is active!

      if( is_customize_preview() ){
        $result = '</div>';
      }

    }

    if( is_customize_preview() ){
      $this->setMostOuterAttribute(1);
      $this->setMostOuterClass(1);
    }

    return $result;

  }

  public function getModule() {

    $result = NULL;

    if( View::checkStatus( $this->getViewStatus() ) == 1 ) {

      $content = $this->getContent();

      if( $content ) {

            //hide --> means no element for module containers should be shown!
            //if its NULL, default one div will be shown for com_ids etc.
            $mostinner_el = $this->getMostInnerElement();
            if( $mostinner_el == 'hide'){

              $result .= $content;

            } else {

              $result .= $this->getModuleElementsStart($mostinner_el);

                $result .= $content;

              $result .= $this->getModuleElementsEnd($mostinner_el);

            }

      } else {

        $result = $this->getEmptyModulTemplate('empty');//empty value in modules in customizer

      }

    } else {

      $result = $this->getEmptyModulTemplate('hidden');//module hidden customizer

    }

    return $result;

  }
  public function getModuleStart() {

    //to execute functions and optionss
    $this->getContent();

    $result = NULL;

    if( View::checkStatus( $this->getViewStatus() ) == 1) {

      $mostinner_el = $this->getMostInnerElement();
      if( $mostinner_el !== 'hide'){

        $result .= $this->getModuleElementsStart($mostinner_el);

      }

    }

    return $result;

  }

  public function getModuleEnd() {

    //to execute functions and options
    $this->getContent();

    $result = NULL;

    if( View::checkStatus( $this->getViewStatus() ) == 1) {

      $mostinner_el = $this->getMostInnerElement();
      if( $mostinner_el !== 'hide'){

        $result .= $this->getModuleElementsEnd($mostinner_el);

      }

    }

    return $result;

  }


}
