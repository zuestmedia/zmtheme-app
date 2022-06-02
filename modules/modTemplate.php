<?php

namespace ZMT\Theme\Modules;

class modTemplate extends \ZMT\Theme\Base {

  public function getModule() {

    return \ZMT\Theme\Render::getThePostsLoop( $this->getId() );

  }

}
