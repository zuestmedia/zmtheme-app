<?php

namespace ZMT\Theme;

class Component extends Base {

  /**
    * OptionsGroupName
    * @var string
    * @access private
    */
    private $optgroup;

  /**
    * isstartobj
    * @var string
    * @access private
    */
    private $isstartobj = NULL;

  /**
    * has_parent
    * @var string
    * @access private
    */
    private $parent_container_static = NULL;

  /**
    * add Section-ID to most outer Element
    */
    private $mostouterclass = 1;

  /**
    * add custmoizer data
    */
    private $mostouterattribute = 1;

  /**
    * Com Label = Display Name of Components in Settings and Customizer
    * @var integer
    * @access private
    */
    private $com_label = NULL;

  /**
    * Com Status
    * @var integer
    * @access private
    */
    private $com_status = '1';
    private $com_lock_status = false;

  /**
    * View Status
    * @var string
    * @access private
    */
    private $view_status = 0;
    private $option_name_view_status = '_viewstatus';

  /**
    * View Condition
    * @var string
    * @access private
    */
    private $view_conditions = array();
    private $option_name_view_condition = '_viewconditions';

  /**
    * Content
    * if no content, empty response
    * @var string
    * @access private
    */
    private $content = NULL;

  /**
    * OptGroup Präfix Getters n Setters
    *
    * only necessary if has options / option_mod
    */
    public function setOptGroup($optgroup) {

      $this->optgroup = $optgroup;

    }
    protected function getOptGroup() {

      return $this->optgroup;

    }

    public function setIsStartObj($isstartobj) {

      $this->isstartobj = $isstartobj;

    }
    public function getIsStartObj() {

      return $this->isstartobj;

    }

    public function setParentContainerStatic($parent_container_static) {

      $this->parent_container_static = $parent_container_static;

    }
    public function getParentContainerStatic() {

      return $this->parent_container_static;

    }

  /**
    * Component Status active or deactivated
    */
    public function setComStatus($com_status) {

      $this->com_status = $com_status;

    }
    public function getComStatusFieldName() {

      return $this->getId();

    }
    public function getComStatusOptionsModName() {

      return $this->getOptGroup().'_com_status';

    }
    static function getComStatusOptionsModNamewithoutOptGroup() {

      return '_com_status';

    }
    public function getComStatusDefaultValue() {

      return $this->com_status;

    }
    public function getComStatus() {

      return Helpers::getOptionNew(
        $this->getComStatusFieldName(),
        $this->getComStatusDefaultValue(),
        $this->getSettingsStatus(),
        'option_mod',
        $this->getComStatusOptionsModName()
      );

    }



  /**
    * ComLockStatus
    */
    public function setComLockStatus($com_lock_status) {

      $this->com_lock_status = $com_lock_status;

    }
    public function getComLockStatusFieldName() {

      return $this->getId();

    }
    public function getComLockStatusOptionsModName() {

      return $this->getOptGroup().'_com_lock_status';

    }
    static function getComLockStatusOptionsModNamewithoutOptGroup() {

      return '_com_lock_status';

    }
    public function getComLockStatusDefaultValue() {

      return $this->com_lock_status;

    }
    public function getComLockStatus() {

      return Helpers::getOptionNew(
        $this->getComLockStatusFieldName(),
        $this->getComLockStatusDefaultValue(),
        $this->getSettingsStatus(),
        'option_mod',
        $this->getComLockStatusOptionsModName()
      );

    }
    public function getComLockStatusesArray() {

      return Helpers::getOptionNew(
        $this->getComLockStatusOptionsModName(),
        NULL,
        $this->getSettingsStatus(),
        'option'
      );

    }

  /**
    * Component Status active or deactivated
    */
    public function setComLabel($com_label) {

      $this->com_label = $com_label;

    }
    public function getComLabelFieldName() {

      return $this->getId();

    }
    public function getComLabelOptionsModName() {

      return $this->getOptGroup().'_com_label';

    }
    static function getComLabelOptionsModNamewithoutOptGroup() {

      return '_com_label';

    }
    public function getComLabelDefaultValue() {

      return $this->com_label;

    }
    public function getComLabel() {

      return Helpers::getOptionNew(
        $this->getComLabelFieldName(),
        $this->getComLabelDefaultValue(),
        $this->getSettingsStatus(),
        'option_mod',
        $this->getComLabelOptionsModName()
      );

    }

  /**
    * View Status (all,hidden(,custom))
    */
    public function setViewStatus($view_status) {

        $this->view_status = $view_status;

    }
    public function getViewStatusFieldName() {

      return $this->getOptPra().$this->option_name_view_status;

    }
    public function getViewStatusDefaultValue() {

      return $this->view_status;

    }
    public function getViewStatus() {

      return Helpers::getOptionNew(
        $this->getViewStatusFieldName(),
        $this->getViewStatusDefaultValue(),
        $this->getSettingsStatus()
      );

    }

  /**
    * View Single Condition Checkbox
    * via Theme_Mod
    */
    public function setViewConditions($view_conditions){

      $this->view_conditions = $view_conditions;

    }
    public function getViewConditionsFieldName() {

      return $this->getOptPra().$this->option_name_view_condition;

    }
    public function getViewConditionsDefaultValue() {

      return $this->view_conditions;

    }
    public function getViewConditions(){

      return Helpers::getOptionNew(
        $this->getViewConditionsFieldName(),
        $this->getViewConditionsDefaultValue(),
        $this->getSettingsStatus()
      );

    }

  /**
    * Join any kind of Element Attributes to a string filtered by praefix
    * eg. 'widget_class' / 'module_class' / 'section_class'
    * 'module_attrs' / 'section_attrs'
    */
    public function getElementAttributesByPraefix( $praefix, $attributetype = '_class' ) {

      $args = $this->getArgs();//returns array w or wo values

      $result = NULL;

      if( $args !== NULL && is_array( $args ) ) {

        $classes = array();
        foreach($args as $key => $arg) {

          if( strpos( $key, $praefix.$attributetype ) !== false ) {

            $getargval = $this->getArg( $key );//faster than calling 2x arg!!
            if( $getargval ) {

              if($attributetype == '_attrs'){

                $getargval = Helpers::renderAttrs( json_decode( $getargval, true ) );

              }

              $classes[] = $getargval;

            }

          }

        }

        $result .= join( ' ', $classes );

      }

      return $result;

    }

  /**
    * Set, Get Most Outer Class
    */
    public function setMostOuterClass($mostouterclass) {

      $this->mostouterclass = $mostouterclass;

    }
    public function getMostOuterClass() {

      return $this->mostouterclass;

    }

    public function getCustomizerClasses() {

      $result = NULL;

      if($this->getMostOuterClass() === 1 && $this->getSettingsStatus() >= 2) {

        if(is_customize_preview()){

          //selective Refresh class by single Module!!!
          $result = 'com_id_'.$this->getId().' zm-customizer-component';

          if( $this->getComLockStatus() == false ){

            //jquery nav classes
            if($this->getIsStartObj()){

              $result .= ' zmdata-custonav module';

            } elseif( get_class($this) == 'ZMT\Theme\Modules\modContainerSortable' && strpos( $this->getId(), '__main' ) !== false ){

              $result .= ' zmdata-custonav module main';

            } elseif( get_class($this) == 'ZMT\Theme\Modules\modSection' ){

              $result .= ' zmdata-custonav section';

            } elseif(
              ( get_class($this) == 'ZMT\Theme\Modules\modContainer' || get_class($this) == 'ZMT\Theme\Modules\modContainerSortable' ) &&
              (
                strpos( $this->getId(), '__custom_blocks' ) !== false ||
                strpos( $this->getId(), '__custom_container' ) !== false ||
                strpos( $this->getId(), '__custom_html' ) !== false ||
                strpos( $this->getId(), '__custom_nav' ) !== false ||
                strpos( $this->getId(), '__custom_queryloop' ) !== false
              )
            ){

              //$result .= ' zmdata-custonav module custom-module';

              //different icon for custom_container
              if(strpos( $this->getId(), '__custom_container' ) !== false){
                $result .= ' zmdata-custonav module';
              } else {
                $result .= ' zmdata-custonav module custom-module';
              }

            }

          }

        }

        $this->setMostOuterClass(NULL);

      }

      return $result;

    }

    public function getPostQueryClass($result) {

      if($result){

        //'_zmquery_id' after (suffix) so its no danger to exchange zmquery_id_posts and zmquery_id_posts_theme --> posts_zmquery_id / posts_theme_zmquery_id
        return $this->getArg('posts_templates_object').'_zmquery_id';

      }

      return NULL;

    }

    public function getClasses($element_name,$zmquery_class = 0) {

      $result = NULL;

      $classes = $this->getElementAttributesByPraefix( $element_name );
      if($classes){
        $result .= $classes;//add space before!
      }

      $post_query_class = $this->getPostQueryClass($zmquery_class);
      if($post_query_class){
        $result .= ' '.$post_query_class;//add space before!
      }

      $customizer_class = $this->getCustomizerClasses();
      if($customizer_class){
        $result .= ' '.$customizer_class;//add space before!
      }

      $result = Helpers::getAttribute( $result, NULL, ' class="%s"' );

      return $result;

    }

  /**
    * Customizer Attributes
    */
    public function setMostOuterAttribute($mostouterattribute) {

      $this->mostouterattribute = $mostouterattribute;

    }
    public function getMostOuterAttribute() {

      return $this->mostouterattribute;

    }
    public function getCustomizerAttributes() {

      $result = NULL;

      if($this->getMostOuterAttribute() === 1 && $this->getSettingsStatus() >= 2) {

        if(is_customize_preview()){

          if( $this->getComLockStatus() == false ){

            if( $this->getIsStartObj() ){

              $result .= 'zmcustonav-comid="'.esc_attr($this->getId()).'"';

            } elseif( get_class($this) == 'ZMT\Theme\Modules\modContainerSortable' && strpos( $this->getId(), '__main' ) !== false ){

              $result .= 'zmcustonav-comid="'.esc_attr($this->getId()).'"';

            } elseif( get_class($this) == 'ZMT\Theme\Modules\modContainerSortable' && strpos( $this->getId(), '__content' ) !== false ){

              $result .= 'zmcustonav-comid="'.esc_attr($this->getId()).'"';

            } elseif( get_class($this) == 'ZMT\Theme\Modules\modSection'){

              $result .= 'zmcustonav-comid="'.esc_attr($this->getId()).'"';

            } elseif(
              ( get_class($this) == 'ZMT\Theme\Modules\modContainer' || get_class($this) == 'ZMT\Theme\Modules\modContainerSortable' ) &&
              (
                strpos( $this->getId(), '__custom_blocks' ) !== false ||
                strpos( $this->getId(), '__custom_container' ) !== false ||
                strpos( $this->getId(), '__custom_html' ) !== false ||
                strpos( $this->getId(), '__custom_nav' ) !== false ||
                strpos( $this->getId(), '__custom_queryloop' ) !== false
              )
            ){

              $result .= 'zmcustonav-comid="'.esc_attr($this->getId()).'"';

            }

          }

        }

        $this->setMostOuterAttribute(NULL);

      }

      return $result;

    }

    public function getAttrs($element_name) {

      $result = NULL;

      $allattrs = $this->getElementAttributesByPraefix( $element_name, '_attrs' );
      if($allattrs){
        $result .= ' '.$allattrs;//add space before!
      }

      $customizer_attrs = $this->getCustomizerAttributes();
      if($customizer_attrs){
        $result .= ' '.$customizer_attrs;//add space before!
      }

      $background_image = $this->getArg( $element_name.'_background_image' );
      if( $background_image ) {

        $result .= Helpers::getBackgroundImage( $background_image, $this->getArg( $element_name.'_background_image_size' ) );

      }

      return $result;

    }

    public function getCustomizerPostQueryInnerContainerClass($element_name, $mostinner_el) {

      $result = 0;

      if(is_customize_preview()){

        if($element_name == $mostinner_el){

          if( get_class($this) == 'ZMT\Theme\Modules\modSection' && ( $this->getSectionContentType() == 'get_the_post' || $this->getSectionContentType() == 'get_query_loop' ) ){

            $result = 1;

          } elseif( strpos( $this->getId(), '__articlelistcontainer' ) !== false ){

            $result = 1;

          } elseif( $this->getArg('custom_section_content') == 'queryloop' ){

            $result = 1;

          } elseif( get_class($this) == 'ZMT\Theme\Modules\modQueryLoop' ){

            $result = 1;

          }

        }

      }

      return $result;

    }

  /**
   * [getElementStart description]
   * @return string [description]
   */
    public function getElementStart( $element_name, $mostinner_el ) {

      $result = NULL;

      $zmquery_result = $this->getCustomizerPostQueryInnerContainerClass($element_name, $mostinner_el);

      $element = $this->getArg( $element_name.'_element' );
      if( $element ) {

        $wrap = $this->getArg( $element_name.'_wrap' );
        if( $wrap ) {

          $result .= Element::processHTMLElementsStart( json_decode( $wrap, true ) );

        }

        $result .= '<'.esc_html($element).$this->getAttrs($element_name).$this->getClasses($element_name,$zmquery_result).'>';

      }

      return $result;

    }

    /**
     * [getElementEnd description]
     * @return string [description]
     */
    public function getElementEnd( $element_name ) {

      $result = NULL;

      $element = $this->getArg( $element_name.'_element' );
      if( $element ) {

        $result .= '</'.esc_html($element).'>';

        $wrap = $this->getArg( $element_name.'_wrap' );
        if( $wrap ) {

          $result .= Element::processHTMLElementsEnd( json_decode( $wrap, true ) );

        }

      }

      return $result;

    }

  /**
    * Set, Add, and Get Content!
    */
    public function setContent($content) {

      $this->content = $content;

    }
    public function addContent($content) {

      $this->content .= $content;

    }
    public function getContent() {

      return $this->content;

    }
    public function getInnerContent() {

      return $this->getContent();

    }


}
