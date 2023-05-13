<?php

namespace ZMT\Theme;

class Element {

  /**
  * This class is used to create output validated html elements from json or php arrays
  */
  static function processHTMLElements($module_array){

    $html = NULL;

    $html .= Element::processHTMLElementsStart( $module_array );
    $html .= Element::processHTMLElementsEnd( $module_array );

		return $html;

  }

	static function processHTMLElementsStart($module_array){

		$html = NULL;

    if(is_array($module_array)){

      if(!array_key_exists('tag',$module_array)){

    		foreach( $module_array as $element ){

          $html .= Element::processHTMLElementStart($element);

    		}

      } else {

        $html .= Element::processHTMLElementStart( $module_array );

      }

    }

		return $html;

	}

	static function processHTMLElementsEnd($module_array){

		$html = NULL;

    if(is_array($module_array)){

  		$module_array = array_reverse($module_array);

      if(!array_key_exists('tag',$module_array)){

    		foreach( $module_array as $element ){

          $html .= Element::processHTMLElementEnd($element);

    		}

      } else {

        $html .= Element::processHTMLElementEnd( $module_array );

      }

    }

		return $html;

	}

	static function processHTMLElementStart($element){

		$html = NULL;

		$html .= '<'.esc_attr( $element['tag'] );

		if(array_key_exists('attributes',$element)){

			$attributes = $element['attributes'];

			if(is_array($attributes)){

				foreach( $attributes as $key => $attribute ){

					$html .= ' '.esc_attr( $key ).'="'.esc_attr( $attribute ).'"';

				}

			}

    }

		$html .= '>';

		if(array_key_exists('content',$element)){

			$content = $element['content'];

			if(is_array($content)){

        $html .= Element::processHTMLElementsStart( $content );
        $html .= Element::processHTMLElementsEnd( $content );

			} else {

				$html .= esc_html( $content );

			}

    }

    if(array_key_exists('close',$element) && $element['close'] == true){

			$html .= '</'.esc_attr( $element['tag'] ).'>';

    }

		return $html;

	}

	static function processHTMLElementEnd($element){

		$html = NULL;

    if(array_key_exists('content_end',$element)){

			$content_end = $element['content_end'];

			if(is_array($content_end)){

        $html .= Element::processHTMLElementsStart( $content_end );
        $html .= Element::processHTMLElementsEnd( $content_end );

			} else {

				$html .= esc_html( $content_end );

			}

    }

    if(!array_key_exists('close',$element)){

			$html .= '</'.esc_attr( $element['tag'] ).'>';

    }

		return $html;

	}

  static function processHTMLElementTestArray(){

    //expected result:
  /*
    <div class="uk-card uk-card-body uk-card-primary">
      <a class="uk-button uk-button-small uk-button-primary" href="https://aktione.ch">
        <span class="uk-icon-xy">the link</span>
      </a>
      a string before end tag
    </div>
  */

    return array(

              //starting <div class="uk-card uk-card-body uk-card-primary">
              array(
                'tag' => 'div',//required!
                'attributes' => array(
                  'class' => 'uk-card uk-card-body uk-card-primary',
                  /*'src' => '',*/
                  /*'href' => '',*/
                ),

              ),

                  //will be enclosed from element before
                  array(
                    'tag' => 'a',//required!
                    'attributes' => array(
                      'class' => 'uk-button uk-button-small uk-button-primary',
                      /*'src' => '',*/
                      'href' => 'https://aktione.ch',
                    ),
                    //---> here content has single array as content: array( tag => ..., xy => ... )
                    'content' => array(

                        //child content starts own loop
                        'tag' => 'span',//required!
                        'attributes' => array(
                          'class' => 'uk-icon-xy',
                        ),
                        'content' => 'the link',//or another array!!!
                        'close' => true,//closes the html tag after its content, remove close key if not closing

                    ),
                    'content_end' => 'a string before end tag',//a content string or array before end tag
                    'close' => true,//closes the html tag after its content, remove close key if not closing

                  ),

      );

  }
  static function processHTMLElementTestArrayMenuWalkerWrapper(){

    //result: '<div class="uk-navbar-dropdown" uk-drop="boundary: .uk-navbar-nav; boundary-align: true; pos: bottom-justify;offset:0;"><ul class="uk-nav uk-navbar-dropdown-nav">';
    return array(

      array(

        'tag' => 'div',
        'attributes' => array(
          'class' => 'uk-navbar-dropdown',
          'uk-drop' => 'boundary: .uk-navbar-nav; boundary-align: true; pos: bottom-justify;offset:0;',
        ),

      ),

      array(

        'tag' => 'ul',
        'attributes' => array(
          'class' => 'uk-nav uk-navbar-dropdown-nav',
        ),

      ),

    );

  }
  static function processHTMLElementTestArrayMenuItemsWrap(){

    //result: <ul uk-nav="multiple:true" id="%1$s" class="%2$s">%3$s</ul>
    return array(

        'tag' => 'ul',//required!
        'attributes' => array(
          'id' => '%1$s',
          'class' => '%2$s',
          'uk-nav' => 'multiple:true',
        ),
        'content' => '%3$s',//or another array!!!
        'close' => true,//closes the html tag after its content, remove close key if not closing

      );

  }
  static function processHTMLElementTestArraynext(){

    //result: '<span class="uk-float-left"><i uk-icon="icon: chevron-left"></i> %s</span>';
    return array(

        'tag' => 'span',//required!
        'attributes' => array(
          'class' => 'uk-margin-large-top',
        ),
        'content' => array(

          'tag' => 'i',//required!
          'attributes' => array(
            'uk-icon' => 'icon: chevron-left',
          ),
          'close' => true,//closes the html tag after its content, remove close key if not closing

        ),
        'content_end' => ' %s',


      );

  }
  static function processHTMLElementTestArrayListWrap(){

    //result: '<hr class="uk-margin-large-top"><ul class="uk-pagination">%s</ul>';
    return array(

      array(

        'tag' => 'hr',//required!
        'attributes' => array(
          'class' => 'uk-margin-large-top',
        ),
        'close' => false,//closes the html tag after its content, remove close key if not closing

      ),
      array(

        'tag' => 'ul',//required!
        'attributes' => array(
          'class' => 'uk-pagination',
        ),
        'content' => '%s',//or another array!!!
        'close' => true,//closes the html tag after its content, remove close key if not closing

      )

      );

  }
  static function processHTMLElementTestArrayLogoWrap(){

    //result: <div class="uk-logo">%1$s<div class="uk-navbar-subtitle">%2$s</div></div>
    return array(

      array(

        'tag' => 'div',//required!
        'attributes' => array(
          'class' => 'uk-logo',
        ),
        'content' => '%1$s',

      ),
        array(

          'tag' => 'div',//required!
          'attributes' => array(
            'class' => 'uk-navbar-subtitle',
          ),
          'content' => '%2$s',//or another array!!!
          'close' => true,//closes the html tag after its content, remove close key if not closing

        )

      );

  }
  static function processHTMLElementTestArrayMetaWrap(){

    //result: '<span><strong>%1$s:</strong> %2$s</span>'
    return array(

        'tag' => 'span',//required!
        'content' => array(

            'tag' => 'strong',//required!
            'content' => '%1$s: ',//or another array!!!
            'close' => true,//closes the html tag after its content, remove close key if not closing

          ),
        'content_end' => '%2$s',
        'close' => true,//closes the html tag after its content, remove close key if not closing

      );

  }
  static function processHTMLElementTestArrayCAptionWrap(){

    //result: '<p class="uk-article-meta">%s</p>'
    return array(

        'tag' => 'p',//required!
        'attributes' => array(
          'class' => 'uk-article-meta',
        ),
        'content' => '%s',//or another array!!!
        'close' => true,//closes the html tag after its content, remove close key if not closing

      );

  }
  static function processHTMLElementTestArrayiconwrap(){

    //result: <a class="uk-navbar-toggle" zmtargetid="#__offcanvasid__" uk-toggle="target:#__offcanvasid__;animation:">
    //          <i style="min-width:calc(20px * __iconratio__)" uk-icon="icon:__icontype__;ratio:__iconratio__;"></i>
    //        </a>
    return array(

        'tag' => 'a',//required!
        'attributes' => array(
          'class' => 'uk-navbar-toggle',
          'zmtargetid' => '#__offcanvasid__',
          'uk-toggle' => 'target:#__offcanvasid__;animation:',
        ),
        'content' => array(

            'tag' => 'i',//required!
            'attributes' => array(
              'style' => 'min-width:calc(20px * __iconratio__)',
              'uk-icon' => 'icon:__icontype__;ratio:__iconratio__;',
            ),
            'close' => true,

          ),

      );

  }
  static function processHTMLElementTestArraySeparator(){

    //result: <hr class="uk-divider-small uk-margin-large-top">
    return array(

        'tag' => 'hr',//required!
        'attributes' => array(
          'class' => 'uk-divider-small uk-margin-large-top',
        ),
        //'content' => '',//or another array!!!
        'close' => false,//closes the html tag after its content, remove close key if not closing

      );

  }
  static function processHTMLElementTestArraySimple(){

    //result: <div class="uk-card uk-card-body uk-card-secondary">a card content</div>
    return array(

        'tag' => 'div',//required!
        'attributes' => array(
          'class' => 'uk-card uk-card-body uk-card-secondary',
        ),
        'content' => 'a card content',//or another array!!!
        'close' => true,//closes the html tag after its content, remove close key if not closing

      );

  }
  static function processHTMLElementTestArrayoffcanvas(){

    //result: <div class="uk-card uk-card-body uk-card-secondary">a card content</div>
    return array(

      'tag' => 'div',
      'attributes' => array(
        'class' => 'uk-offcanvas-bar',
      ),
      'content_end' => array(

        'tag' => 'button',
        'attributes' => array(
          'type' => 'button',
          'class' => 'uk-offcanvas-close',
          'uk-close' => '',
        ),
        'close' => true,

      ),


    );

  }
  static function processHTMLElementTestArraysearchclosebuttondroppp(){
/*
    <a class="uk-navbar-toggle" uk-search-icon uk-toggle="target: .test-overlay; animation: uk-animation-fade" href="#"></a>

    <div class="uk-navbar-left uk-flex-1 test-overlay" hidden>

        <div class="uk-navbar-item uk-width-expand">
            <form class="uk-search uk-search-navbar uk-width-1-1">
                <input class="uk-search-input" type="search" placeholder="Search" autofocus>
            </form>
        </div>

        <a class="uk-navbar-toggle" uk-close uk-toggle="target: .test-overlay; animation: uk-animation-fade" href="#"></a>

    </div>

    <a class="uk-navbar-toggle" uk-close uk-toggle="target: .test-overlay; animation: uk-animation-fade" href="#"></a>

    <div class="uk-navbar-item uk-padding-remove-horizontal">

      <a class="uk-navbar-toggle" uk-close uk-toggle="target: .test-overlay; animation: uk-animation-fade" href="#"></a>
    </div>


*/

      return array(
        'tag' => 'div',
        'attributes' => array(
          'class' => 'uk-navbar-item',
        ),
        'content_end' => array(

              'tag' => 'a',
              'attributes' => array(
                'class' => 'uk-navbar-toggle',
                'uk-close' => '',
                'uk-toggle' => 'target: .zmnavitems; animation: uk-animation-fade',
                'href' => '#',
              ),

              'close' => true,

        ),

      );

      /*return array(

        'tag' => 'a',
        'attributes' => array(
          'class' => 'uk-navbar-toggle uk-navbar-item',
          'href' => '#',
          'uk-search-icon' => '',
          'uk-toggle' => 'target: .uk-navbar-item; animation: uk-animation-fade',
        ),
        'close' => true,

      );*/

  }
  static function processHTMLElementTestArraysearchclosebutton(){

    /*
    <a class="uk-navbar-toggle" href="#" uk-search-icon></a>
        <div class="uk-navbar-dropdown" uk-drop="mode: click; cls-drop: uk-navbar-dropdown; boundary: !nav">

            <div class="uk-grid-small uk-flex-middle" uk-grid>
                <div class="uk-width-expand">
                    <form class="uk-search uk-search-navbar uk-width-1-1">
                        <input class="uk-search-input" type="search" placeholder="Search" autofocus>
                    </form>
                </div>
                <div class="uk-width-auto">
                    <a class="uk-drop-close" href="#" uk-close></a>
                </div>
            </div>

        </div>*/

    return array(

              array(
                  'tag' => 'a',
                  'attributes' => array(
                    'href' => '#',
                    'class' => 'uk-navbar-toggle',
                    'uk-search-icon' => '',
                  ),
                  'close' => true,
              ),

              array(
                  'tag' => 'div',
                  'attributes' => array(
                    'class' => 'uk-navbar-dropdown',
                    'uk-drop' => 'mode: click; cls-drop: uk-navbar-dropdown; boundary: .uk-navbar',
                  ),
              ),

              array(
                'tag' => 'div',
                'attributes' => array(
                  'class' => 'uk-grid-small uk-flex-middle',
                  'uk-grid' => '',
                ),
                'content_end' => array(

                      'tag' => 'div',
                      'attributes' => array(
                        'class' => 'uk-width-auto',
                      ),

                      'content' => array(

                        'tag' => 'a',
                        'attributes' => array(
                          'href' => '#',
                          'uk-close' => '',
                          'class' => 'uk-drop-close',
                        ),
                        'close' => true,
                      ),

                      'close' => true,

                ),

              ),

                  array(

                      'tag' => 'div',
                      'attributes' => array(
                        'class' => 'uk-width-expand',
                      ),

                  ),

      );



  }
  static function processHTMLElementTestArraysearch(){

    //result:'<a class="uk-navbar-toggle" uk-search-icon href="#"></a><div class="uk-drop" uk-drop="mode: click; pos: left-center; offset: 0">';
    return array(

      array(

        'tag' => 'a',
        'attributes' => array(
          'class' => 'uk-navbar-toggle',
          'uk-search-icon' => '',
          'href' => '#',
        ),
        'close' => true,


      ),

      array(

        'tag' => 'div',
        'attributes' => array(
          'uk-drop' => 'mode:click;pos:left-center;offset:0;',
          //'class' => 'uk-drop',
        ),

      ),

    );

  }
  static function processHTMLElementTestArraytaxonomy(){

    //result:'<div uk-grid class="uk-grid-small uk-article-meta"><div class="uk-width-auto"><b>cat: </b></div>';
    //[{"tag":"div","attributes":{"class":"uk-grid-small uk-article-meta","uk-grid":""}},{"tag":"div","attributes":{"class":"uk-width-auto"},"content":{"tag":"b","content":"__cat__","close":true},"close":true}]
    return array(

      array(

        'tag' => 'div',
        'attributes' => array(
          'class' => 'uk-grid-small uk-article-meta',
          'uk-grid' => '',
        ),

      ),

      array(

        'tag' => 'div',
        'attributes' => array(
          'class' => 'uk-width-auto',
        ),
        'content' =>array(

          'tag' => 'b',
          'content' =>'__cat__',
          'close' => true,

        ),
        'close' => true,

      ),

    );

  }
  static function processHTMLElementTestArraydouble(){

    //result: <div class="uk-card uk-card-body uk-card-secondary">a card content</div>
    return array(

      array(

          'tag' => 'span',//required!
          'content' => '__thetext__',

        ),

        array(

            'tag' => 'em',

          )

      );

  }
  static function processHTMLElementTestArrayGrid(){

    //result: <div class="uk-card uk-card-body uk-card-secondary">a card content</div>
    return array(

        'tag' => 'div',//required!
        'attributes' => array(
          'uk-grid' => '',
          'class' => 'uk-child-width-expand',
        ),

      );

  }
  static function processHTMLElementTestContentPra(){

    //result: <div class="uk-card uk-card-body uk-card-secondary">a card content</div>
    return array(

        'tag' => 'b',//required!
        'content' => '__author__',//or another array!!!
        'close' => true,//closes the html tag after its content, remove close key if not closing

      );

  }
  static function processHTMLElementTesticon(){

    //{"tag":"span","attributes":{"uk-search-icon":""},"close":true}
    return array(

        'tag' => 'span',
        'attributes' => array(
          'uk-search-icon' => '',
        ),
        'close' => true,

      );

  }
  static function processHTMLElementPowered(){

    /*
    <div class="uk-text-small uk-text-center">
      <a href="https://zuestmedia.com" class="uk-link-reset" target="_blank" rel="nofollow">
        ThisThemeName
      </a>
       | Built with ZMTheme
    </div>
    */

    /*
    [{"tag":"div","attributes":{"class":"uk-text-small uk-text-center"}},{"tag":"a","attributes":{"class":"uk-link-reset","href":"https://zuestmedia.com","target":"_blank","rel":"nofollow"},"content":"Modular","close":true,"content_end":" | Built with ZMTheme"}]
    */

      return array(

                array(
                  'tag' => 'div',
                  'attributes' => array(
                    'class' => 'uk-text-small uk-text-center',
                  ),

                ),
                    array(
                      'tag' => 'a',
                      'attributes' => array(
                        'class' => 'uk-link-reset',
                        'href' => 'https://zuestmedia.com',
                        'target' => '_blank',
                        'rel' => 'nofollow',
                      ),
                      'content' => 'Modular',
                      'close' => true,
                      'content_end' => ' | Built with ZMTheme',  //string to the end after closing?!
                    ),

        );



  }

  static function processHTMLElementTestGrid(){

    //expected result:
  /*
    <div class="uk-child-width-1-2 uk-grid" uk-grid="">
      <div class="uk-card uk-card-body uk-card-primary uk-first-column">
        <h2>heading 2</h2>
        <p>paragraph text text. ...</p>
      </div>
      <div class="uk-card uk-card-body uk-card-primary">
        <h2>heading 2</h2>
        <p>paragraph text text. ...</p>
      </div>
      a string before end taga string before end tag
    </div>
  */

    return array(

              array(
                'tag' => 'div',
                'attributes' => array(
                  'class' => 'uk-child-width-1-2',
                  'uk-grid' => '',
                ),

              ),
                  array(
                    'tag' => 'div',
                    'attributes' => array(
                      'class' => 'uk-card uk-card-body uk-card-primary',
                    ),
                    'content' => array(
                      array(
                          'tag' => 'h2',
                          'content' => 'heading 2',
                          'close' => true,
                      ),
                      array(
                          'tag' => 'p',
                          'content' => 'paragraph text text. ...',
                          'close' => true,
                      ),
                    ),
                    'content_end' => 'a string before end tag',
                    'close' => true,

                  ),

                  array(
                    'tag' => 'div',
                    'attributes' => array(
                      'class' => 'uk-card uk-card-body uk-card-primary',
                    ),
                    'content' => array(
                      array(
                          'tag' => 'h2',
                          'content' => 'heading 2',
                          'close' => true,

                      ),
                      array(
                          'tag' => 'p',
                          'content' => 'paragraph text text. ...',
                          'close' => true,
                      ),

                    ),
                    'content_end' => 'a string before end tag',
                    'close' => true,

                  ),

      );

  }

  static function processHTMLElementTestSlider(){

    //<div uk-slider>
      //<div class="uk-position-relative uk-visible-toggle">
        //----> the content
        //<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
        //<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>
      //</div>
      //<ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-top"></ul>
    //</div>

    //result
    //[{"tag":"div","attributes":{"uk-slider":""},"content_end":{"tag":"ul","attributes":{"class":"uk-slider-nav uk-dotnav uk-flex-center uk-margin-top"},"close":true}},{"tag":"div","attributes":{"class":"uk-position-relative uk-visible-toggle","tabindex":"-1"},"content_end":[{"tag":"a","attributes":{"class":"uk-position-center-left uk-position-small uk-hidden-hover","uk-slidenav-previous":"","uk-slider-item":"previous","href":"#"},"close":true},{"tag":"a","attributes":{"class":"uk-position-center-right uk-position-small uk-hidden-hover","uk-slidenav-next":"","uk-slider-item":"next","href":"#"},"close":true}]}]
    return array(

            //<div uk-slider>
            array(
              'tag' => 'div',
              'attributes' => array(
                'uk-slider' => '',
              ),
              'content_end' => array(

                  'tag' => 'ul',
                  'attributes' => array(
                    'class' => 'uk-slider-nav uk-dotnav uk-flex-center uk-margin-top',
                  ),
                  'close' => true,

              ),
            ),

              //<div class="uk-position-relative uk-visible-toggle">
              array(
                  'tag' => 'div',
                  'attributes' => array(
                    'class' => 'uk-position-relative uk-visible-toggle',
                    'tabindex' => '-1',
                  ),

                  //----> the content / the Middle of Start/End

                  'content_end' => array(
                    array(
                        'tag' => 'a',
                        'attributes' => array(
                          'class' => 'uk-position-center-left uk-position-small uk-hidden-hover',
                          'uk-slidenav-previous' => '',
                          'uk-slider-item' => 'previous',
                          'href' => '#',
                        ),
                        'close' => true,
                    ),
                    array(
                        'tag' => 'a',
                        'attributes' => array(
                          'class' => 'uk-position-center-right uk-position-small uk-hidden-hover',
                          'uk-slidenav-next' => '',
                          'uk-slider-item' => 'next',
                          'href' => '#',
                        ),
                        'close' => true,
                    ),
                  ),

              ),
              //content_end: <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
              //content_end: <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>
              //</div>



          );
          //content_end: <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-top"></ul>
          //</div>

  }
  static function processHTMLElementTestSlideshow(){

    //<div uk-slideshow"animation:push;">
      //<div class="uk-position-relative uk-visible-toggle">
        //----> the content
        //<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
        //<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
      //</div>
      //<ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin-top"></ul>
    //</div>

    //result
    //[{"tag":"div","attributes":{"uk-slideshow":"animation:push;"},"content_end":{"tag":"ul","attributes":{"class":"uk-slideshow-nav uk-dotnav uk-flex-center uk-margin-top"},"close":true}},{"tag":"div","attributes":{"class":"uk-position-relative uk-visible-toggle","tabindex":"-1"},"content_end":[{"tag":"a","attributes":{"class":"uk-position-center-left uk-position-small uk-hidden-hover","uk-slidenav-previous":"","uk-slideshow-item":"previous","href":"#"},"close":true},{"tag":"a","attributes":{"class":"uk-position-center-right uk-position-small uk-hidden-hover","uk-slidenav-next":"","uk-slideshow-item":"next","href":"#"},"close":true}]}]

    return array(

            //<div uk-slideshow>
            array(
              'tag' => 'div',
              'attributes' => array(
                'uk-slideshow' => 'animation:push;',
              ),
              'content_end' => array(

                  'tag' => 'ul',
                  'attributes' => array(
                    'class' => 'uk-slideshow-nav uk-dotnav uk-flex-center uk-margin-top',
                  ),
                  'close' => true,

              ),
            ),

              //<div class="uk-position-relative uk-visible-toggle">
              array(
                  'tag' => 'div',
                  'attributes' => array(
                    'class' => 'uk-position-relative uk-visible-toggle',
                    'tabindex' => '-1',
                  ),

                  //----> the content / the Middle of Start/End

                  'content_end' => array(
                    array(
                        'tag' => 'a',
                        'attributes' => array(
                          'class' => 'uk-position-center-left uk-position-small uk-hidden-hover',
                          'uk-slidenav-previous' => '',
                          'uk-slideshow-item' => 'previous',
                          'href' => '#',
                        ),
                        'close' => true,
                    ),
                    array(
                        'tag' => 'a',
                        'attributes' => array(
                          'class' => 'uk-position-center-right uk-position-small uk-hidden-hover',
                          'uk-slidenav-next' => '',
                          'uk-slideshow-item' => 'next',
                          'href' => '#',
                        ),
                        'close' => true,
                    ),
                  ),

              ),
              //content_end: <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
              //content_end: <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
              //</div>



          );
          //content_end: <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin-top"></ul>
          //</div>

  }


}
