<?php

namespace ZMT\Theme\Modules;

class modCommentsForm extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $title_element = esc_html($this->getArg('title_element'));
    $form_class = esc_attr($this->getArg('form_class'));
    $button_class = esc_attr($this->getArg('button_class'));
    $input_class = esc_attr($this->getArg('input_class'));
    $textarea_class = esc_attr($this->getArg('textarea_class'));
    $checkbox_class = esc_attr($this->getArg('checkbox_class'));
    $label_class = esc_attr($this->getArg('label_class'));
    $comments_closed_message = esc_html($this->getArg('comments_closed_message'));

    $comment_form = NULL;
    $args = array(
      'class_form'         => $form_class,
      'title_reply_before' => '<'.$title_element.' id="reply-title" class="comment-reply-title uk-h2">',
      'title_reply_after'  => '</'.$title_element.'>',
    );

    ob_start();
    comment_form( $args	);
    $comment_form = ob_get_contents();
    ob_end_clean();

    $comment_form = str_replace(' novalidate>', '>',$comment_form);
    $comment_form = str_replace('<label for="', '<label class="'.$label_class.'" for="',$comment_form);
    $comment_form = str_replace('<textarea id="comment"', '<textarea id="comment" class="'.$textarea_class.'"',$comment_form);
    $comment_form = str_replace('<input id="author"', '<input id="author" class="'.$input_class.'"',$comment_form);
    $comment_form = str_replace('<input id="email"', '<input id="email" class="'.$input_class.'"',$comment_form);
    $comment_form = str_replace('<input id="url"', '<input id="url" class="'.$input_class.'"',$comment_form);
    $comment_form = str_replace('<input id="wp-comment-cookies-consent"', '<input id="wp-comment-cookies-consent" class="'.$checkbox_class.'"',$comment_form);
    $comment_form = str_replace('<input name="submit" type="submit" id="submit" class="submit"', '<input name="submit" type="submit" id="submit" class="'.$button_class.'"',$comment_form);

  /*  if ( !comments_open() ) {

      $comment_form = '<p>'.$comments_closed_message.'</p>';

    }*/

    return $comment_form;

  }

}
