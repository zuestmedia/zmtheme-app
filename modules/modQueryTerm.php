<?php

namespace ZMT\Theme\Modules;

use ZMT\Theme\Helpers as Helpers;
use WP_Term_Query;

class modQueryTerm extends \ZMT\Theme\Modules\Module {

  /*
  object(WP_Term)#1389 (10) {
    ["term_id"]=> int(1)
    ["name"]=> string(13) "Uncategorized"
    ["slug"]=> string(13) "uncategorized"
    ["term_group"]=> int(0)
    ["term_taxonomy_id"]=> int(1)
    ["taxonomy"]=> string(8) "category"
    ["description"]=> string(0) ""
    ["parent"]=> int(0)
    ["count"]=> int(4)
    ["filter"]=> string(3) "raw"
  }
*/

  public function get_tax_term_class($term){

    if($term->taxonomy == 'post_tag'){
      $tax_str = 'tag';
    } else {
      $tax_str = $term->taxonomy;
    }

    $result = ' uk-filter-control="filter: .'.$tax_str.'-'.$term->slug.'; group: data-'.$tax_str.'"';

    return $result;

  }

  public function getContent() {

    $taxonomy = $this->getArg('taxonomy');
    $list_wrap = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('list_wrap'),true));//json
    $list_item = esc_html($this->getArg('list_item'));
    $link_class = $this->getArg('link_class');// linkclass

    $query_args_json = $this->getArg('query_args_json');

    if($query_args_json){

      $query_args = json_decode($query_args_json);

    } else {

      $query_args = array( 'taxonomy' => array( $taxonomy ) );

    }

    $html = NULL;

    $term_query = new WP_Term_Query( $query_args );

    if ( ! empty( $term_query ) && ! is_wp_error( $term_query ) ) {

      if(is_array($term_query->terms)){

        foreach ( $term_query->terms as $term ) {

          if($list_item) { $html .= '<'.$list_item.$this->get_tax_term_class($term).'>'; }
            $html .= '<a href="'. get_term_link($term) .'"'. Helpers::getAttribute($link_class,NULL,' class="%s"') .'>' .$term->name. '</a>';
          if($list_item) { $html .= '</'.$list_item.'>'; }

        }

        $html = sprintf( $list_wrap, $html );

      }

    } else {
    	// no terms found
    }

    return $html;

  }

}
