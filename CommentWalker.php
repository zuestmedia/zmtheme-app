<?php

namespace ZMT\Theme;

use Walker_Comment;

class CommentWalker extends Walker_Comment  {


  /**
    * Class
    * @var string
    * @access private
    */
  private $article_class = NULL;
  private $header_class = NULL;
  private $header_grid = NULL;
  private $image_class = NULL;
  private $meta_class = NULL;
  private $meta_subnav_class = NULL;
  private $author_link_wrap = NULL;
  private $body_class = NULL;

/**
  * Set Class
  * @param string $article_class
  */
  public function setArticleClass($article_class) {

      $this->article_class = $article_class;

  }

        /**
   * Get Class
   * @return string
   */
  public function getArticleClass() {

      return $this->article_class;

  }

        /**
   * Set Header Class
   * @param mixed $header_class
   */
  public function setHeaderClass($header_class) {

      $this->header_class = $header_class;

  }

        /**
   * Get Header Class
   * @return mixed
   */
  public function getHeaderClass() {

      return $this->header_class;

  }

        /**
   * Set Header Grid
   * @param mixed $header_grid
   */
  public function setHeaderGrid($header_grid) {

      $this->header_grid = $header_grid;

  }

        /**
   * Get Header Grid
   * @return mixed
   */
  public function getHeaderGrid() {

      return $this->header_grid;

  }

        /**
   * Set Image Class
   * @param mixed $image_class
   */
  public function setImageClass($image_class) {

      $this->image_class = $image_class;

  }

        /**
   * Get Image Class
   * @return mixed
   */
  public function getImageClass() {

      return $this->image_class;

  }

        /**
   * Set Meta Class
   * @param mixed $meta_class
   */
  public function setMetaClass($meta_class) {

      $this->meta_class = $meta_class;

  }

        /**
   * Get Meta Class
   * @return mixed
   */
  public function getMetaClass() {

      return $this->meta_class;

  }

        /**
   * Set Meta Subnav Class
   * @param mixed $meta_subnav_class
   */
  public function setMetaSubnavClass($meta_subnav_class) {

      $this->meta_subnav_class = $meta_subnav_class;

  }

        /**
   * Get Meta Subnav Class
   * @return mixed
   */
  public function getMetaSubnavClass() {

      return $this->meta_subnav_class;

  }

        /**
   * Set Author Link Wrap
   * @param mixed $author_link_wrap
   */
  public function setAuthorLinkWrap($author_link_wrap) {

      $this->author_link_wrap = $author_link_wrap;

  }

        /**
   * Get Author Link Wrap
   * @return mixed
   */
  public function getAuthorLinkWrap() {

      return $this->author_link_wrap;

  }

        /**
   * Set Body Class
   * @param mixed $body_class
   */
  public function setBodyClass($body_class) {

      $this->body_class = $body_class;

  }

/**
  * Get Body Class
  * @return mixed
  */
  public function getBodyClass() {

      return $this->body_class;

  }

  /**
     * Outputs a comment in the HTML5 format.
     *
     * @since 3.6.0
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment Comment to display.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function html5_comment( $comment, $depth, $args ) {
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

        $commenter = wp_get_current_commenter();
        if ( $commenter['comment_author_email'] ) {
            //$moderation_note = 'Your comment is awaiting moderation.';
            $moderation_note = $args['zm_moderation_note_1'];
        } else {
            //$moderation_note ='Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.';
            $moderation_note = $args['zm_moderation_note_2'];
        }

        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="<?php echo esc_attr($this->getArticleClass()); ?>">

                <header class="<?php echo esc_attr($this->getHeaderClass()); ?>">

                  <div <?php echo $this->getHeaderGrid(); ?>>

                      <div class="<?php echo esc_attr($this->getImageClass()); ?>">
                          <?php
                          if ( 0 != $args['avatar_size'] ) {
                              echo get_avatar( $comment, $args['avatar_size'] );
                          }
                          ?>

                      </div><!-- .comment-author -->

                      <div class="<?php echo esc_attr($this->getMetaClass()); ?>">

                        <?php printf( $this->getAuthorLinkWrap(), get_comment_author_link( $comment ) ); ?>

                        <ul class="<?php echo esc_attr($this->getMetaSubnavClass()); ?>">

                          <li>
                            <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                                <time datetime="<?php comment_time( 'c' ); ?>">
                                    <?php
                                        /* translators: 1: Comment date, 2: Comment time. */
                                        //printf( '%1$s at %2$s', get_comment_date( '', $comment ), get_comment_time() );
                                        printf( $args['zm_comment_datentime_sprintf'], get_comment_date( $args['zm_comment_date_format'], $comment ), get_comment_time($args['zm_comment_time_format']) );
                                    ?>
                                </time>
                            </a>
                          </li>
                          <?php
                          comment_reply_link(
                              array_merge(
                                  $args,
                                  array(
                                      'add_below' => 'div-comment',
                                      'depth'     => $depth,
                                      'max_depth' => $args['max_depth'],
                                      'before'    => '<li class="reply">',
                                      'after'     => '</li>',
                                  )
                              )
                          );
                          ?>
                          <?php //edit_comment_link( 'Edit', '<li class="edit-link">', '</li>' ); ?>
                          <?php edit_comment_link( $args['zm_edit'], '<li class="edit-link">', '</li>' ); ?>
                          <?php if ( '0' == $comment->comment_approved ) : ?>
                            <li>
                              <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
                            </li>
                          <?php endif; ?>
                        </ul>

                      </div><!-- .comment-metadata -->

                    </div>

                </header><!-- .comment-meta -->

                <div class="<?php echo esc_attr($this->getBodyClass()); ?>">
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->

            </article><!-- .comment-body -->
        <?php
    }


}
