<?php

namespace ZMT\Theme\Modules;

class modEditLink extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    //$text = esc_html($this->getArg('link_text'));
    $text = esc_html( \ZMT\Theme\Helpers::getTrStr('Edit') );
    $class = esc_attr($this->getArg('link_class'));

    if(is_customize_preview()){
      return '<a class="'.$class.'">'.$text.'</a>';
    }

    ob_start();
    edit_post_link( $text, '', '', get_the_ID(), $class );
    $edit_post_link = ob_get_contents();
    ob_end_clean();

    return $edit_post_link;

  }

}
