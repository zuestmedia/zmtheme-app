<?php

namespace ZMT\Theme\DefaultConfig;

class configCommentsList extends BuildModule {

  public $type = 'CommentsList';

  protected function default() {

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_layout_helper();

    $this->args['list_wrap'] = '{"tag":"ul","attributes":{"class":"uk-list uk-list-divider"},"content":"%s","close":true}';
    $this->args['title_wrap'] = '{"tag":"h3","attributes":{"class":"uk-h2"},"content":"%s"}';
    $this->args['comment_container_class'] = 'uk-comment uk-comment-primary uk-margin-top';
    $this->args['comment_body_class'] = 'uk-comment-body uk-margin';
    $this->args['avatar_size'] = 100;
    $this->args['title'] = __( 'Comments', 'zmtheme' );
    $this->args['header_class'] = 'uk-section-transparent';//no setting
    $this->args['header_grid'] = '{"uk-grid":"","class":"uk-grid-medium uk-flex-middle"}';
    $this->args['avatar_container_class'] = 'uk-width-auto';
    $this->args['meta_class'] = 'uk-width-expand';//no setting
    $this->args['meta_subnav_class'] = 'uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top';//no setting
    $this->args['author_link_wrap'] = '{"tag":"h4","attributes":{"class":"uk-comment-title uk-margin-remove uk-link-reset"},"content":"%s","close":true}';

    //walker via wp_list_comments $args
    $this->args['datentime_sprintf'] = __( '%1$s at %2$s', 'zmtheme'  );
    $this->args['comment_date_format'] = '';
    $this->args['comment_time_format'] = '';
    $this->args['moderation_note_1'] = __( 'Your comment is awaiting moderation.', 'zmtheme'  );
    $this->args['moderation_note_2'] = __( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.', 'zmtheme'  );
    $this->args['link_text'] = __( 'Edit', 'zmtheme'  );

  }


}
