<?php

namespace ZMT\Theme\DefaultConfig;

class configTaxonomyTerms extends BuildModule {

  public $type = 'TaxonomyTerms';

  protected function default() {

    $this->args['presets'] = 'default';

    $this->args['taxonomy'] = 'category';

    $this->args['module_element'] = 'div';
    $this->args['content_wrap'] = '[{"tag":"div","attributes":{"class":"uk-article-meta","uk-grid":""}},{"tag":"div","attributes":{"class":"uk-width-auto"},"content":{"tag":"b","content":"'.__('Taxonomy', 'zmtheme').': ","close":true},"close":true}]';

    $this->args['linked'] = 1;
    $this->args['link_class'] = array();
    $this->args['list_item'] = 'div';
    $this->args['text_separator'] = '';

  }
  protected function category() {
    $this->default();
    $this->args['content_wrap'] = '[{"tag":"div","attributes":{"class":"uk-grid-small uk-article-meta","uk-grid":""}},{"tag":"div","attributes":{"class":"uk-width-auto"},"content":{"tag":"b","content":"'.__('Category', 'zmtheme').': ","close":true},"close":true}]';
  }

  protected function post_tag() {
    $this->default();
    $this->args['taxonomy'] = 'post_tag';
    $this->args['content_wrap'] = '[{"tag":"div","attributes":{"class":"uk-grid-small uk-article-meta","uk-grid":""}},{"tag":"div","attributes":{"class":"uk-width-auto"},"content":{"tag":"b","content":"'.__('Tag', 'zmtheme').': ","close":true},"close":true}]';
  }


  protected function articlemeta(){

    $this->args['presets'] = 'default';

    $this->args['taxonomy'] = 'category';

    $this->args['module_element'] = 'span';

    $this->args['linked'] = 1;
    $this->args['link_class'] = array();
    $this->args['list_item'] = 'span';
    $this->args['text_separator'] = ',&nbsp;';


  }
  protected function articlemeta_category() {
    $this->articlemeta();

    $this->args['content_wrap'] = '{"tag":"span","content":" '.__('in', 'zmtheme').' ","close":true}';

  }
  protected function articlemeta_post_tag() {

    $this->articlemeta();

    $this->args['taxonomy'] = 'post_tag';

    $this->args['content_wrap'] = '{"tag":"span","content":" '.__('tagged with', 'zmtheme').' ","close":true}';

  }

  protected function inline(){

    $this->args['presets'] = 'default';

    $this->args['taxonomy'] = 'category';

    parent::module();
    parent::module_layout_helper_article();
    $this->args['module_class_text_helpers_string'] = array('uk-display-inline', 'uk-text-small');

    $this->args['linked'] = 1;
    $this->args['link_class'] = array();
    $this->args['list_item'] = 'span';
    $this->args['text_separator'] = ',&nbsp;';


  }
  protected function inline_category() {
    $this->inline();

    $this->args['content_wrap'] = '{"tag":"span","content":" '.__('in', 'zmtheme').' ","close":true}';

  }
  protected function inline_post_tag() {

    $this->inline();

    $this->args['taxonomy'] = 'post_tag';

    $this->args['content_wrap'] = '{"tag":"span","content":" '.__('tagged with', 'zmtheme').' ","close":true}';

  }

}
