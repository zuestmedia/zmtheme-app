<?php

namespace ZMT\Theme\Modules;

class modCommentsList extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    /**
      * on customizer pagereload, comments object is not set in global context, have to build it self
      * see: https://developer.wordpress.org/reference/functions/get_comments/
      */
      $comments_obj = NULL; //default value for get_the_author_meta!
      if(is_customize_preview()){
        $comments_obj = get_comments( array( 'post_id' => get_the_ID() ) );
      }

    $list_wrap = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('list_wrap'),true));//json
    $title_wrap = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('title_wrap'),true));//json
    $article_class = esc_attr($this->getArg('comment_container_class'));
    $body_class = esc_attr($this->getArg('comment_body_class'));
    $avatar_size = esc_attr($this->getArg('avatar_size'));
    $title = esc_html($this->getArg('title'));
    $header_class = esc_attr($this->getArg('header_class'));
    $header_grid = \ZMT\Theme\Helpers::renderAttrs(json_decode($this->getArg('header_grid'),true));//json
    $image_class = esc_attr($this->getArg('avatar_container_class'));
    $meta_class = esc_attr($this->getArg('meta_class'));
    $meta_subnav_attrs = \ZMT\Theme\Helpers::renderAttrs(json_decode($this->getArg('meta_subnav_attrs'),true));//json
    $meta_subnav_class = esc_attr($this->getArg('meta_subnav_class'));
    $author_link_wrap = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('author_link_wrap'),true));//json

    $walker = new \ZMT\Theme\CommentWalker();
    $walker->setArticleClass($article_class);
    $walker->setHeaderClass($header_class);
    $walker->setHeaderGrid($header_grid);
    $walker->setImageClass($image_class);
    $walker->setMetaClass($meta_class);
    $walker->setMetaSubnavAttrs($meta_subnav_attrs);
    $walker->setMetaSubnavClass($meta_subnav_class);
    $walker->setAuthorLinkWrap($author_link_wrap);
    $walker->setBodyClass($body_class);

    $comment_list_title = NULL;
    if($title_wrap){
      $comment_list_title = sprintf( $title_wrap, $title );
    }

    $args = array(
      'walker'            => $walker,
      //'max_depth'         => '',
      'style'             => 'ul',
      //'callback'          => null,
      //'end-callback'      => null,
      //'type'              => 'all',
      //'page'              => '',
      //'per_page'          => '',
      'avatar_size'       => $avatar_size,
      //'reverse_top_level' => null,
      //'reverse_children'  => '',
      'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
      //'short_ping'        => false,   // @since 3.6
      'echo'              => false,     // boolean, default is true

    //custom arguments for Walker_Comment
      'zm_avatar_class' => esc_attr($this->getArg('avatar_class')),
      'zm_comment_datentime_sprintf' => esc_html($this->getArg('datentime_sprintf')),
      'zm_comment_date_format' => esc_html($this->getArg('comment_date_format')),
      'zm_comment_time_format' => esc_html($this->getArg('comment_time_format')),
      'zm_moderation_note_1' => esc_html($this->getArg('moderation_note_1')),
      'zm_moderation_note_2' => esc_html($this->getArg('moderation_note_2')),
      'zm_edit' => esc_html($this->getArg('link_text'))

  );

    $result = wp_list_comments( $args, $comments_obj );
    if($result){
      $result = sprintf( $list_wrap, $result );
      $result = $comment_list_title.$result;
    }

    return $result;

  }

}
