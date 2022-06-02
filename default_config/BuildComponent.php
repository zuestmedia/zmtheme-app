<?php

namespace ZMT\Theme\DefaultConfig;

class BuildComponent {

/**
  * Component / Module / Container Type id
  */
  public $type = NULL;

  public $args = array();

/**
  * Available Options
  * Object Values (property exists check!) do not set NULL, only set if value
  * public $parent_container;
  * public $args;
  * public $com_label;
  * public $com_status;
  * public $view_status;
  * public $view_conditions;
  * public $isstartobj;
  * public $section_content;
  * public $is_static_clone;
  * Arg Values (only sample)
  * $this->args['custom_section_content'] = 'default';
  * $this->args['presets'] = 'default';
  */

  function __construct(

    $key = 'default',
    $item_position = 0,
    $parent_container = NULL,
    $is_static_clone = true

  ){

  /**
    * loads only the specific arguments in child config files
    */
    if($key){
      if(method_exists($this, $key)){
        $this->$key();
      }
    }

  /**
    * item position is always 0 if not set to false
    */
    if($item_position !== false){
      $this->args['item_position'] = $item_position;//always added if not false!
    }

  /**
    * Sets Container Parent if available
    */
    if($parent_container){//only added if needed
      $this->args['parent_container'] = $parent_container;//to dynamically set parents in template editor,
      //has also setParentContainerStatic method to check for com_status=0 coms/mods --> used in themesettings
    }

  /**
    * to be able to create not deletable and not clonable clones from static object
    * use double-underline and the number of clone eg section__1 oder section__2
    */
    if($is_static_clone){
      $this->is_static_clone = $is_static_clone;//remove if clonable module
    }

  }

}
