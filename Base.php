<?php

namespace ZMT\Theme;

class Base {

  /**
    * Base Object for Menu, Section, Sidebar
    * --> for HTML Objects with Settings
    */

  /**
    * Element ID
    * @var string
    * @access private
    */
    private $id;

  /**
    * Settings Status
    * @var int
    * @access private
    */
    private $settings_status;

  /**
    * args
    * @var array
    * @access private
    */
    private $args = array();
    private $options_name = '_args_';

  /**
    * Construct Function
    * Slug is required
    */
    function __construct( $id, $settings_status = '1' ){

      $this->id = $id;
      $this->settings_status = $settings_status;

    }

  /**
    * ID Getters n Setters
    */
    public function setId($id) {

      $this->id = $id;

    }
    public function getId() {

      return $this->id;

    }

    //für elemente mit id brauchts PRO element SEPARATES optionspräfix!
    //optgroup nicht in mehr nötig in optpra mit theme_mods
    //aber notwendig für option_mod und form name etc..
    public function getOptPra() {

      return $this->getId();

    }

  /**
    * Settings-Status
    */
    public function setSettingsStatus($settings_status) {

      $this->settings_status = $settings_status;

    }
    public function getSettingsStatus() {

      return $this->settings_status;

    }

  /**
    * set array of default args
    */
    public function setArgs($args) {
     $this->args = $args;
    }

  /**
    * get array of default args
    */
    public function getArgs() {
     return $this->args;
    }

  /**
    * set single arg of default args
    */
    public function setArg($value, $arg_name) {

      $args = $this->getArgs();//returns array w or wo values

      if( $args  !== NULL && is_array( $args ) ) {

        $args[ $arg_name ] = $value;

      }

      $this->args = $args;

    }

    public function getArgFieldName($arg_name) {

      return $this->getOptPra().$this->options_name.$arg_name;

    }

  /**
    * get default arg
    */
    public function getArgDefaultValue($arg_name) {

      $args = $this->getArgs();

      if( $args ){

        if( array_key_exists( $arg_name, $args ) !== false ){

          return $args[ $arg_name ];

        }

      }

    }

  /**
    * get single arg of args
    */
    public function getArg( $arg_name, $array_handling = array() ) {

      return Helpers::getOptionNew(
        $this->getArgFieldName($arg_name),
        $this->getArgDefaultValue($arg_name),
        $this->getSettingsStatus(),
        'theme_mod',
        NULL,
        '2',
        $array_handling//means array handling is active when not NULL!!!
      );

    }


}
