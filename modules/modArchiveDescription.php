<?php

namespace ZMT\Theme\Modules;

class modArchiveDescription extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $description =  get_the_archive_description();
    if ( is_author() && $description ) {
        $description = '<p>'.esc_html($description).'</p>';//author has no auto p tags! the others have
    } elseif( is_home() && !is_front_page()){

      $page_for_posts = get_option( 'page_for_posts' );//gets id of blog page
      if($page_for_posts){

        $content = get_the_content( NULL, NULL, $page_for_posts );

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

        if($content){

          $description = $content;

        }

      }

    }

    return $description;

  }

}
