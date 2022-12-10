<?php

namespace ZMT\Theme\Modules;

class modAuthorBox extends \ZMT\Theme\Modules\Module {

  public function getContent() {

  /**
    * on customizer pagereload, user object is not set in global context, have to build it self
    * see: https://wordpress.stackexchange.com/questions/292367/author-functions-don-t-work-in-customizer-s-selective-refresh
    */
    $user = false; //default value for get_the_author_meta!
    if(is_customize_preview()){
      $current_post = get_post();
      if ( ! empty( $current_post ) ) {
          $user = $current_post->post_author;
      }
    }

    $avatar_size = $this->getArg('avatar_size');
    $avatar_class = $this->getArg('avatar_class');

    //$img = get_avatar( get_the_author_meta( 'ID', $user ) );
    $img = get_avatar( get_the_author_meta( 'ID' ), $avatar_size, '', '', array( 'class' => $avatar_class ) ); 
    //$web_link = get_the_author_meta('user_url');
    $author_url = get_author_posts_url( get_the_author_meta( 'ID', $user ) );
    $name = get_the_author_meta( 'display_name', $user );
    $desc = get_the_author_meta( 'description', $user );

    $author_box_json = $this->getArg('author_box_json');

    $author_box_rendered = NULL;
    if($author_box_json){

      $author_box_rendered = \ZMT\Theme\Element::processHTMLElements(json_decode($author_box_json,true));

      //sprintf and vsprintf not working with more than two (2) variables
      //leads to errors in customizer ... ???!!!
      $author_box_rendered = str_replace(
        array(
          '__image__',
          '__title__',
          '__link__',
          '__text__'
        ),
        array(
          $img,
          esc_html( $name ),
          esc_url( $author_url ),
          esc_html( $desc )
        ),
        $author_box_rendered
      );

    }

    return $author_box_rendered;

  }

}
