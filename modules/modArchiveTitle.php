<?php

namespace ZMT\Theme\Modules;

class modArchiveTitle extends \ZMT\Theme\Modules\Module {

  public function setArchiveTitle( $title ) {

    if ( is_home() ) {
        //$title = post_type_archive_title( '', false );
        $title = NULL;
        $page_for_posts = get_option( 'page_for_posts' );//gets id of blog page
        if($page_for_posts){
          $title = get_the_title($page_for_posts);
        }
    } elseif ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } elseif ( is_author() ) {
        $title = get_the_author();
    } elseif ( is_search() ) {
        $title = get_search_query();
    }

    return $title;
  }

  public function getContent() {

    $element = esc_attr( $this->getArg('title_element') );
    $class = esc_attr( $this->getArg('title_class') );
    $sprintf = esc_html( $this->getArg('title_sprintf') );

    $title = NULL;

    if($sprintf){

      add_filter( 'get_the_archive_title', array( $this, 'setArchiveTitle' ) );

      $title = sprintf( $sprintf , get_the_archive_title() );

      remove_filter( 'get_the_archive_title', array( $this, 'setArchiveTitle' ) );

    } else {

      //no filter!
      //default titles when empty field = default for all archives
      if ( is_home() ) {
          $title = esc_html( \ZMT\Theme\Helpers::getTrStr('Blog') );
          $page_for_posts = get_option( 'page_for_posts' );//gets id of blog page
          if($page_for_posts && !is_front_page()){
            $title = get_the_title($page_for_posts);
          }
      } elseif ( is_search() ) {
          $title = get_search_query();
          $title = sprintf( \ZMT\Theme\Helpers::getTrStr('SearchResultsfor_n'), $title );
      } else {
        //most default archive_title
        $title = get_the_archive_title();
      }

    }

    //title can not be escaped because has span around value eg, 'Category: <span>uncategorized</span>'
    if($title && $element){
      $title = '<'.$element.\ZMT\Theme\Helpers::getAttribute( $class, NULL, ' class="%s"' ).'>'.$title.'</'.$element.'>';
    }

    return $title;

  }

}
