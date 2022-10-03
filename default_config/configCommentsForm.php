<?php

namespace ZMT\Theme\DefaultConfig;

class configCommentsForm extends BuildModule {

  public $type = 'CommentsForm';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['title_element'] = 'h4';
    $this->args['form_class'] = 'uk-form-stacked';
    $this->args['button_class'] = 'uk-button uk-button-default';
    $this->args['input_class'] = 'uk-input';
    $this->args['textarea_class'] = 'uk-textarea';
    $this->args['checkbox_class'] = 'uk-checkbox';
    $this->args['label_class'] = 'uk-form-label';
    $this->args['comments_closed_message'] = __( 'Comments are closed.', 'zmtheme'  );

    parent::module();
    parent::module_layout_helper();

  }


}
