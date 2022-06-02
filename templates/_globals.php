<?php

namespace ZMT\Theme\Templates;

class _globals extends \ZMT\Theme\ExtendModules {

  function __construct(){

    $this->colors = new \ZMT\Theme\DefaultConfig\configCssVars('colors');
    $this->body = new \ZMT\Theme\DefaultConfig\configCssVars('body');
    $this->heading = new \ZMT\Theme\DefaultConfig\configCssVars('heading');
    $this->logo = new \ZMT\Theme\DefaultConfig\configCssVars('logo');
    $this->navbar = new \ZMT\Theme\DefaultConfig\configCssVars('navbar');

    $this->extendModules('globals');

  }

}
