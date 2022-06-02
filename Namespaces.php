<?php

namespace ZMT\Theme;

class Namespaces {

  /**
    * default_namespace
    * eg: '\ZMT\Theme\Config\\'
    * @var string
    * @access private
    */
    private $default_namespace = NULL;

  /**
    * alt_namespacees
    * singlevalue: '\ZMT\Theme\Child\Config\\'
    * or
    * multiplevalue: array( '\ZMT\Theme\Child\Config\\', '\ZMT\Theme\Child\Config2\\' )
    * @var string or array
    * @access private
    */
    private $alt_namespacees = NULL;

  /**
    * Construct Function
    * Slug is required
    */
    function __construct( $default_namespace = NULL, $alt_namespacees = NULL ){

      $this->default_namespace = $default_namespace;
      $this->alt_namespacees = $alt_namespacees;

    }

  /**
    * DefaultNamespace Getters n Setters
    */
    protected function setDefaultNamespace($default_namespace) {

      $this->default_namespace = $default_namespace;

    }
    protected function getDefaultNamespace() {

      return $this->default_namespace;

    }

  /**
    * AltNamespaces Getters n Setters
    */
    protected function setAltNamespaces($alt_namespacees) {

      $this->alt_namespacees = $alt_namespacees;

    }
    protected function getAltNamespaces() {

      return $this->alt_namespacees;

    }

    protected function AltNamespace($class_name){

      $fullclassname = NULL;

      if( $this->getAltNamespaces() ){

        if( is_array( $this->getAltNamespaces() ) ){

          foreach( $this->getAltNamespaces() as $key => $namespace){

            if( class_exists( $namespace.$class_name ) ) {

              return $namespace.$class_name;//directly return first namespace that exists if multiple namespaces for overwrites

            }

          }

        } else {

          if( class_exists( $this->getAltNamespaces().$class_name ) ) {

            $fullclassname =  $this->getAltNamespaces().$class_name;

          }

        }

      }

      return $fullclassname;

    }

    public function getClass($class_name){

      $altnamespace = $this->AltNamespace($class_name);

      if( $altnamespace ){

        return $altnamespace;

      } else {

        return $this->getDefaultNamespace().$class_name;

      }

    }


}
