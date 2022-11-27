<?php

namespace ZMT\Theme\DefaultConfig;

class configTaxonomyTerms extends BuildModule {

  public $type = 'TaxonomyTerms';

  protected function default() {


    $this->args['presets'] = 'default';

    $this->args['taxonomy'] = 'category';

    parent::module();
    parent::module_layout_helper_article();

    $this->args['module_class_margin_vertical'] = array('uk-margin-remove-adjacent', 'uk-margin-bottom');

    $this->args['content_wrap'] = '{"tag":"span","content":{"tag":"span","attributes":{"class":"screen-reader-text"},"content":"__label__: ","close":true},"content_end":""}';

    $this->args['linked'] = 1;
    $this->args['link_class'] = array();
    $this->args['list_item'] = 'span';
    $this->args['text_separator'] = ',&nbsp;';

  }
  protected function category() {
    $this->default();
  }
  protected function post_tag() {
    $this->default();
    $this->args['taxonomy'] = 'post_tag';
  }

  protected function inline(){

    $this->default();

    $this->args['module_class_text_helpers_string'] = array('uk-display-inline', 'uk-text-small', 'uk-margin-right');
    $this->args['module_class_margin_vertical'] = array();

    $this->args['link_class'] = array('uk-link-text');

    $this->args['content_wrap'] = '{"tag":"span","content":[{"tag":"i","attributes":{"uk-icon":"icon:tag","class":"uk-margin-small-right","aria-hidden":"true"},"close":true},{"tag":"span","attributes":{"class":"screen-reader-text"},"content":"__label__: ","close":true}],"content_end":""}';

  }
  protected function inline_category() {
    $this->inline();
  }
  protected function inline_post_tag() {
    $this->inline();
    $this->args['taxonomy'] = 'post_tag';
  }

}
