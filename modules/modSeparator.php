<?php

namespace ZMT\Theme\Modules;

class modSeparator extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    return \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('separator'),true));//json

  }

}
