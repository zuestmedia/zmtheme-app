<?php

namespace ZMT\Theme\DefaultConfig;

class configCommentsList extends BuildModule {

  public $type = 'CommentsList';

  protected function default() {

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_layout_helper();

    $this->args['list_wrap'] = '{"tag":"ul","attributes":{"class":"uk-comment-list"},"content":"%s","close":true}';
    $this->args['title_wrap'] = '{"tag":"h3","attributes":{"class":"uk-h2 uk-margin-large-top"},"content":"%s"}';
    $this->args['comment_container_class'] = 'uk-comment';
    $this->args['comment_body_class'] = 'uk-comment-body uk-margin';
    $this->args['avatar_size'] = 50;
    $this->args['avatar_class'] = 'uk-border-circle';
    $this->args['header_class'] = 'uk-section-transparent';//no setting
    $this->args['header_grid'] = '{"uk-grid":"","class":"uk-grid-small uk-flex-middle"}';
    $this->args['avatar_container_class'] = 'uk-width-auto';
    $this->args['meta_class'] = 'uk-width-expand';//no setting
    $this->args['meta_subnav_attrs'] = '{"uk-grid":""}';//json
    $this->args['meta_subnav_class'] = 'uk-comment-meta uk-link-text uk-grid-small uk-grid-divider uk-margin-remove-top';//no setting
    $this->args['author_link_wrap'] = '{"tag":"h4","attributes":{"class":"uk-comment-title uk-margin-remove uk-link-heading"},"content":"%s","content_end":{"tag":"span","attributes":{"class":"screen-reader-text"},"content":"__says__:","close":true},"close":true}';

    //walker via wp_list_comments $args
    $this->args['comment_date_format'] = '';
    $this->args['comment_time_format'] = '';

  }


}
