<?php

namespace ZMT\Theme\DefaultConfig;

class configAuthorBox extends BuildModule {

  public $type = 'AuthorBox';

  protected function default() {

    $this->args['presets'] = 'default';

    parent::module();
    parent::module_layout_helper();
    $this->args['avatar_size'] = 96;
    $this->args['avatar_class'] = 'uk-border-circle';
    $this->args['content_wrap'] = '[{"tag":"hr","attributes":{"class":"uk-margin-top"},"close":false}]';
    $this->args['author_box_json'] = '[{"tag":"div","attributes":{"class":"uk-grid-medium uk-flex-middle","uk-grid":""}},{"tag":"div","attributes":{"class":"uk-width-auto"},"content":"__image__","close":true},{"tag":"div","attributes":{"class":"uk-width-expand"},"content":[{"tag":"h2","attributes":{"class":"uk-comment-title uk-margin-remove uk-link-heading"},"content":{"tag":"a","attributes":{"href":"__link__","rel":"author"},"content":"__title__","close":true},"close":true},{"tag":"p","attributes":{"class":"uk-margin-remove uk-text-small"},"content":"__text__","close":true}],"close":true}]';

    /*json_encode(array(

      array(
        'tag' => 'div',
        'attributes' => array(
          'class' => 'uk-grid-medium uk-flex-middle',
          'uk-grid' => '',
        ),
      ),

        array(
          'tag' => 'div',
          'attributes' => array(
            'class' => 'uk-width-auto',
          ),
          'content' => '__image__',
          'close' => true,
        ),

        array(
          'tag' => 'div',
          'attributes' => array(
            'class' => 'uk-width-expand',
          ),
          'content' => array(

            array(
                'tag' => 'div',
                'attributes' => array(
                    'class' => 'uk-comment-title uk-margin-remove uk-link-reset',
                ),
                'content' => array(

                    'tag' => 'a',
                    'attributes' => array(
                        'href' => '__link__',
                    ),
                    'content' => '__title__',
                    'close' => true,

                ),
                'close' => true,
            ),
            array(
                'tag' => 'p',
                'attributes' => array(
                    'class' => 'uk-margin-remove uk-text-small',
                ),
                'content' => '__text__',
                'close' => true,
            ),

          ),
          'close' => true,
        ),

    ));*/

  }

}
