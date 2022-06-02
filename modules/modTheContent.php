<?php

namespace ZMT\Theme\Modules;

class modTheContent extends \ZMT\Theme\Modules\Module {

  public function customExcerptLength( $length ) {
    return $this->getArg('excerpt_length');
  }

  public function getContent() {

    $excerpt = $this->getArg('excerpt');// 0 = content, 1 = excerpt, 2 = auto

    if( $excerpt == 3 ){

      if( has_excerpt() ){

        //no filter for custom excerpt!

        return get_the_excerpt( get_the_ID() );

      }

      return;

    }

    if( $excerpt == 2 ){

      if(is_singular()){

        $excerpt = 0;

      }

    }

    if( $excerpt ) {

      $theexcerpt = get_the_excerpt( get_the_ID() );

      if( $theexcerpt ){

        add_filter( 'excerpt_length', array( $this, 'customExcerptLength' ) , 999 );

        return $theexcerpt;

      } else {

        return;

      }


    } else {

      $content = get_the_content( NULL, NULL, get_the_ID() );

    /**
      * Filters the post content.
      *
      * @since 0.71
      *
      * @param string $content Content of the current post.
      * --> https://developer.wordpress.org/reference/functions/the_content/
      */
      $content = apply_filters( 'the_content', $content );
      $content = str_replace( ']]>', ']]&gt;', $content );

      return $content;

    }

  }

}
