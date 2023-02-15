<?php

namespace ZMT\Theme;

class ComponentTypeLabel {

  /**
  * use like this:
  * $com_type_obj = new \ZMT\Theme\ComponentTypeLabel();
  * $com_type_obj->getComLabel($key) // get value  or NULL
  * $com_type_obj->getComLabelOrKey($key) // get directly key or value
  */

    public $settings_status;
    public $opt_group;

    function __construct(){

      global $zmtheme;

      $this->settings_status = $zmtheme['theme']->getSettingsStatus();
      $this->opt_group = $zmtheme['theme']->getOptGroup();

    }

    public function getComLabel($component_type) {

      return \ZMT\Theme\Helpers::getOptionNew(
        $component_type,
        NULL,
        $this->settings_status,
        'option_mod',
        $this->opt_group.'_com_label'
      );

    }

    public function getComLabelOrKey($component_type){

      $label = $this->getComLabel($component_type);

      if($label == NULL){

        $label = \ZMT\Theme\Helpers::transformObjectKeystoLabel($component_type);

      }

      return $label;

    }

}
