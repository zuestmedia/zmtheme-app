<?php

namespace ZMT\Theme\DefaultConfig;

class configCommentsForm extends BuildModule {

  public $type = 'CommentsForm';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['title_element'] = 'h3';
    $this->args['form_class'] = 'uk-form-stacked';
    $this->args['button_class'] = 'uk-button uk-button-default uk-button-small';
    $this->args['input_class'] = 'uk-input';
    $this->args['textarea_class'] = 'uk-textarea';
    $this->args['checkbox_class'] = 'uk-checkbox';
    $this->args['label_class'] = 'uk-form-label';

    parent::module();
    parent::module_layout_helper();

    $this->args['module_class_margin_vertical'] = array('uk-margin-large-top');

  }


}
