<?php

namespace ZMT\Theme\Modules;

class modCommentsForm extends \ZMT\Theme\Modules\Module {

  public function getContent() {

    $title_element = $this->getArg('title_element');
    $form_class = $this->getArg('form_class');
    $button_class = $this->getArg('button_class');
    $input_class = $this->getArg('input_class');
    $textarea_class = $this->getArg('textarea_class');
    $checkbox_class = $this->getArg('checkbox_class');
    $label_class = $this->getArg('label_class');

    $comment_form = NULL;
    $args = array(
      'class_form'         => $form_class,
      'title_reply_before' => '<'.esc_html( $title_element ).' id="reply-title" class="comment-reply-title uk-margin-top">',
      'title_reply_after'  => '</'.esc_html( $title_element ).'>',
    );

    ob_start();
    comment_form( $args	);
    $comment_form = ob_get_contents();
    ob_end_clean();

    $privacy_checkbox = NULL;
    $privacy_url = get_privacy_policy_url();
    if($privacy_url){

      $comment_privacy_policy = \ZMT\Theme\Helpers::getTrStr('comment_privacy_policy');
      $comment_privacy_policy_url_title = \ZMT\Theme\Helpers::getTrStr('comment_privacy_policy_url_title');

      $comment_privacy_policy_url = '<a href="'.esc_url( $privacy_url ).'" target="_blank">'.esc_html( $comment_privacy_policy_url_title ).'</a>';
  
      $privacy_checkbox = '<p class="comment-form-privacy-policy"><input id="wp-comment-privacy-policy" class="uk-checkbox" name="wp-comment-privacy-policy" type="checkbox" value="yes" required> <label class="" for="wp-comment-privacy-policy">'.sprintf( esc_html( $comment_privacy_policy ),  $comment_privacy_policy_url ).'</label></p>';

    }

    $comment_form = str_replace(' novalidate>', '>',$comment_form);
    $comment_form = str_replace('<label for="', '<label class="'.esc_attr( $label_class ).'" for="',$comment_form);
    $comment_form = str_replace('<textarea id="comment"', '<textarea id="comment" class="'.esc_attr( $textarea_class ).'"',$comment_form);
    $comment_form = str_replace('<input id="author"', '<input id="author" class="'.esc_attr( $input_class ).'"',$comment_form);
    $comment_form = str_replace('<input id="email"', '<input id="email" class="'.esc_attr( $input_class ).'"',$comment_form);
    $comment_form = str_replace('<input id="url"', '<input id="url" class="'.esc_attr( $input_class ).'"',$comment_form);
    $comment_form = str_replace('<input id="wp-comment-cookies-consent"', $privacy_checkbox.'<input id="wp-comment-cookies-consent" class="'.esc_attr( $checkbox_class ).'"',$comment_form);
    $comment_form = str_replace('<input name="submit" type="submit" id="submit" class="submit"', '<input name="submit" type="submit" id="submit" class="'.esc_attr( $button_class ).'"',$comment_form);

    //new: no settings yet..
    $comment_form = str_replace('class="comment-notes"', 'class="comment-notes uk-text-small"',$comment_form);
    $comment_form = str_replace('class="logged-in-as"', 'class="logged-in-as uk-text-small"',$comment_form);
    $comment_form = str_replace('class="must-log-in"', 'class="must-log-in uk-text-small"',$comment_form);
    $comment_form = str_replace('class="uk-form-label" for="wp-comment-cookies-consent"', 'class="" for="wp-comment-cookies-consent"',$comment_form);

    return $comment_form;

  }

}
