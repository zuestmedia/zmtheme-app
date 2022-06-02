<?php

namespace ZMT\Theme\Modules;

class modWooCommerce extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    ob_start();
    woocommerce_content();
    $woocommerce_content = ob_get_contents();
    ob_end_clean();

    return $woocommerce_content;  

  }

}
