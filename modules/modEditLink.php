<?php

namespace ZMT\Theme\Modules;

class modEditLink extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    //$text = esc_html($this->getArg('link_text'));
    $text = \ZMT\Theme\Helpers::getTrStr('Edit');
    $class = $this->getArg('link_class');

    if(is_customize_preview()){
      return '<a class="'.esc_attr( $class ).'">'.esc_html( $text ).'</a>';
    }

    ob_start();
    edit_post_link( $text, '', '', get_the_ID(), $class );
    $edit_post_link = ob_get_contents();
    ob_end_clean();

    return $edit_post_link;

  }

}
