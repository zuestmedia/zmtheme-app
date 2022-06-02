<?php

namespace ZMT\Theme;

use ZMT\Theme\Namespaces;

class Build {

  static function newClass($str){

    return new $str();

  }

}
