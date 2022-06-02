<?php

namespace ZMT\Theme\DefaultConfig;

class configImage extends BuildModule {

  public $type = 'Image';

  protected function default() {

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_image_helper();

    $this->args['image_size'] = 'full';
    $this->args['image_link'] = 0;
    $this->args['image_class'] = array();
    $this->args['caption'] = 1;
    $this->args['caption_wrap'] = '{"tag":"p","attributes":{"class":"uk-article-meta"},"content":"%s","close":true}';

  }


  protected function singular() {

    $this->default();

    $this->args['module_attrs'] = '{"uk-lightbox":""}';

    $this->args['module_class_margin_vertical'] = array('uk-margin');

    $this->args['image_link'] = 2;

  }

  protected function posts() {

    $this->default();

    $this->args['image_size'] = 'large';
    $this->args['image_link'] = 1;

  }

}
