<?php

namespace ZMT\Theme\Modules;

class modCommentsPagination extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $list_wrap = \ZMT\Theme\Element::processHTMLElements(json_decode($this->getArg('list_wrap'),true));//json
    $label = \ZMT\Theme\Helpers::getTrStr('CommentsPagination_label');//Comments navigation
    $list_wrap = str_replace('__label__', esc_attr( $label ), $list_wrap );
    $show_all = $this->getArg('show_all');
    $prev_next = $this->getArg('prev_next');
    $prev_text = \ZMT\Theme\Helpers::getTrStr('Previous');
    $next_text = \ZMT\Theme\Helpers::getTrStr('Next');

    $html = NULL;

    $args = array(
        //'base'               => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below).
        //'format'             => $format, // ?page=%#% : %#% is replaced by the page number.
        //'total'              => $total,
        //'current'            => $current,
        //'aria_current'       => 'page',
        'show_all'           => $show_all,
        'prev_next'          => $prev_next,
        'prev_text'          => $prev_text,
        'next_text'          => $next_text,
        //'end_size'           => 1,
        //'mid_size'           => 2,
        'type'               => 'array',
        //'add_args'           => array(), // Array of query args to add.
        //'add_fragment'       => '',
        //'before_page_number' => 'bef',
        //'after_page_number'  => 'aft',
    );

    $arrayay = paginate_comments_links( $args );

    if($arrayay){

      foreach($arrayay as $pagelink) {

        $pagelink = str_replace('<span aria-current="page" class="page-numbers current">', '<span aria-current="page" class="page-numbers current uk-active">',$pagelink);

        $html .= '<li>'.$pagelink.'</li>';

      }

    }


    if( $html && $list_wrap ){

    //  $html = sprintf( '<ul class="uk-pagination">%s</ul>', $html );
      $html = sprintf( $list_wrap, $html );

    //  $html = '<ul'.Helpers::getAttribute($listclass,NULL,' class="%s"').'>'.$html.'</ul>';

    }


    return $html;

  }

}
