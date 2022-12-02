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
    $title = \ZMT\Theme\Helpers::getTrStr('Comments');

    $article_class = $this->getArg('comment_container_class');
    $body_class = $this->getArg('comment_body_class');
    $header_class = $this->getArg('header_class');
    $header_grid = $this->getArg('header_grid');//json
    $image_class = $this->getArg('avatar_container_class');
    $meta_class = $this->getArg('meta_class');
    $meta_subnav_attrs = $this->getArg('meta_subnav_attrs');//json
    $meta_subnav_class = $this->getArg('meta_subnav_class');
    $author_link_wrap = $this->getArg('author_link_wrap');//json

    $author_link_wrap = str_replace('__says__',esc_html(\ZMT\Theme\Helpers::getTrStr('says')),$author_link_wrap);//replace variable

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
      $comment_list_title = sprintf( $title_wrap, esc_html( $title ) );
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
      'avatar_size'       => $this->getArg('avatar_size'),
      //'reverse_top_level' => null,
      //'reverse_children'  => '',
      'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
      //'short_ping'        => false,   // @since 3.6
      'echo'              => false,     // boolean, default is true

    //custom arguments for Walker_Comment
      'zm_avatar_class' => $this->getArg('avatar_class'),
      'zm_comment_datentime_sprintf' => \ZMT\Theme\Helpers::getTrStr('s_at_s'),
      'zm_comment_date_format' => $this->getArg('comment_date_format'),
      'zm_comment_time_format' => $this->getArg('comment_time_format'),
      'zm_moderation_note_1' => \ZMT\Theme\Helpers::getTrStr('Yourcommentisawaitin'),
      'zm_moderation_note_2' => \ZMT\Theme\Helpers::getTrStr('Yourcommentisawaitin_long'),
      'zm_edit' => \ZMT\Theme\Helpers::getTrStr('Edit')

  );

    $result = wp_list_comments( $args, $comments_obj );
    if($result){
      $result = sprintf( $list_wrap, $result );
      $result = $comment_list_title.$result;
    }

    return $result;

  }

}
