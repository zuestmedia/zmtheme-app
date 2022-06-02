<?php

namespace ZMT\Theme\DefaultConfig;

class configErrorPage extends BuildModule {

  public $type = 'ErrorPage';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['title'] = __( '404 - Page Not Found'  , 'zmtheme' );
    $this->args['text'] = __( 'The page you were looking for could not be found. It might have been removed, renamed, or does not exist anymore. Start again from home or use the searchform to find what you are looking for.'  , 'zmtheme' );//TODO add home link variable in text
    $this->args['title_element'] = 'h1';
    $this->args['title_class'] = array('uk-heading-medium');

    parent::module();
    parent::module_layout_helper();

  }


}
