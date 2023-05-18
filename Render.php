<?php

namespace ZMT\Theme;

use WP_Query;

class Render {

  static function setContent($com_id){

    global $zmtheme;

    //$component_type first part before _
    //$component_type = strtok($com_id, '__');
    $component_type = substr($com_id, 0, strpos($com_id, '__'));

    //$component_name second part after _
    $component_name = substr($com_id, strpos($com_id, '__') + 2);

    if( property_exists( $zmtheme['default_components'], $component_type ) ){

      $com_types_object = $zmtheme['default_components']->$component_type;

      /**
      * to handle active_callbacks in customizer
      */
      if(is_customize_preview()){
        $zmtheme['zmpaneactivecomobject'][$component_type] = $component_type;
      }

      if( property_exists( $com_types_object, $component_name ) ){

        $component = $com_types_object->$component_name;

        if( property_exists( $component, 'section_content' ) ){

          $com_status = '1';
          if( method_exists( $zmtheme[ $com_id ], 'getComStatus' ) ){
            $com_status = $zmtheme[ $com_id ]->getComStatus();
          }
          if($com_status == '1'){

            //add default sidebar content
            if($component->section_content == 'default'){

              $zmtheme[ $com_id ]->addContent( $zmtheme[ $com_id.'_defsidebar' ]->getModule() );

            } elseif($component->section_content == 'custom'){

              $section_content = \ZMT\Theme\Render::getSectionContent( $com_id );

              $zmtheme[ $com_id ]->addContent( $section_content );

            } elseif( $component->section_content == 'get_archive_or_singular' ){

              $def_coms_key = \ZMT\Theme\Render::getSingularorArchiveKeybyCondition();

              $zmtheme[ $com_id ]->addContent( $zmtheme[ $def_coms_key ]->getModule() );

            } elseif( $component->section_content == 'get_the_post' ){

              $the_post_content = \ZMT\Theme\Render::getThePostsLoop( $com_id );

              $zmtheme[ $com_id ]->addContent( $the_post_content );

            } elseif( $component->section_content == 'get_query_loop' ){

              $query_loop_content = \ZMT\Theme\Render::getQueryLoop( $com_id );

              $zmtheme[ $com_id ]->addContent( $query_loop_content );

            } elseif( $component->section_content == 'block_template' ){

              $block_template_content = \ZMT\Theme\Render::getTemplateBlock( $com_id );

              $zmtheme[ $com_id ]->addContent( $block_template_content );

            } elseif( $component->section_content == 'get_static_html' ){

              $static_html = \ZMT\Theme\Render::getStaticHTML( $com_id );

              $zmtheme[ $com_id ]->addContent( $static_html );

            } elseif( $component->section_content == 'get_the_comments' ){

              $comments_content = \ZMT\Theme\Render::getCommentsTemplate();

              $zmtheme[ $com_id ]->addContent( $comments_content );

            } else {

              $zmtheme[ $com_id ]->addContent( $zmtheme[ $component->section_content ]->getModule() );

            }

          } //com_status check

          return;//stop function here if has 'section_content', else, check for children

        }

        foreach($com_types_object as $key2 => $single_com_object){

          if( is_object( $single_com_object ) ){

          /**
            * parent_container
            * if has children with this parent
            * --> only processes items with parent_container !!!
            * Loop will be restarted in modContainer & Sortable & modSection
            */
            if( $zmtheme[ $component_type.'__'.$key2 ]->getArg('parent_container') == $component_name ){

              $com_status = '1';
              if( method_exists( $zmtheme[ $component_type.'__'.$key2 ], 'getComStatus' ) ){
                $com_status = $zmtheme[ $component_type.'__'.$key2 ]->getComStatus();
              }
              if($com_status == '1'){

                if( method_exists( $zmtheme[ $com_id ], 'addItemtoSortableContentArray' ) ){

                  $zmtheme[ $com_id ]->addItemtoSortableContentArray($zmtheme[ $component_type.'__'.$key2 ]);

                } else {

                  $zmtheme[ $com_id ]->addContent( $zmtheme[ $component_type.'__'.$key2 ]->getModule() );

                }

              }

            }

          }

        }


      }

    }

  }

  static function getStaticHTML( $com_id ){

    global $zmtheme;

    $static_html_json = $zmtheme[ $com_id ]->getArg('static_content');

    $static_html = NULL;
    if($static_html_json){

      $static_html = \ZMT\Theme\Element::processHTMLElements(json_decode($static_html_json,true));

    }

    return $static_html;

  }
  static function getSectionContent( $com_id ){

    global $zmtheme;

    $custom_section_content = $zmtheme[ $com_id ]->getArg('custom_section_content');

    if($custom_section_content){

      $component_type = substr($custom_section_content, 0, strpos($custom_section_content, '__'));

      $component_type = \ZMT\Theme\Helpers::checkDefComsObjExists($component_type, NULL);

      if($component_type && array_key_exists( $custom_section_content, $zmtheme )){

        return $zmtheme[ $custom_section_content ]->getModule();

      }

    } else {

      return NULL;

    }

  }

  /**
   * This works for singular posts and archives
   * used in def com sections -> contentarea
   */
  static function getSingularorArchiveKeybyCondition(
    $section_content_is_archive = '%%var%%__archivecontainer',
    $section_content_is_singular = '%%var%%__template'
  ){

    $result = NULL;

    if ( class_exists( 'woocommerce' ) ) {
      if(is_woocommerce()){
        return 'extensions__woocommerce';
      }
    }

    if ( class_exists( 'bbPress' ) ) {
      /*
      * is_bbpress() not working properly!
      * when a bbpress shortcode is used, is_bbpress() returns also true!!!
      * not only when loaded as main content.
      * so use global $template here and bbpress.php template file to check
      * if bbpress template is loaded and use then only bbpress module.
      */
      global $template;
      if( basename( $template ) == 'bbpress.php' ){
        return 'extensions__bbpress';
      }
    }

    if ( is_singular() ){

      //single, single-custom-post-type, page or custom-templates (single & pages)
      $key = NULL;
      if( is_page_template( ) ) {
        $obj_key = get_page_template_slug();
        $obj_key = str_replace(".php", "", $obj_key);
        $key = \ZMT\Theme\Helpers::checkDefComsObjExists($obj_key, NULL);
      }

      if($key == NULL){

        if( is_single() ){

          //if single = 'single'
          $key = \ZMT\Theme\Helpers::checkDefComsObjExists('single', 'posts');

          if(get_post_type() !== 'post' ) {
            $obj_key = 'single_'.get_post_type(); //returns page-customposttypeslug!
            $obj_key = \ZMT\Theme\Helpers::modifyTaxandPostTypeSlugtoObject($obj_key);
            $key = \ZMT\Theme\Helpers::checkDefComsObjExists($obj_key, $key);
          }

        } elseif( is_page() ){

          $key = \ZMT\Theme\Helpers::checkDefComsObjExists('page', 'posts');

          if( is_front_page( ) ) {
            $key = \ZMT\Theme\Helpers::checkDefComsObjExists('frontpage', $key);
          }

        }

      }

      //returns the key of posttype object in def coms
      $result = str_replace( '%%var%%', $key, $section_content_is_singular );

    } else {

      //archive, home or search
      $key = NULL;
      if ( is_home() ) {
        $key = \ZMT\Theme\Helpers::checkDefComsObjExists('home', 'archive');
      } elseif ( is_search() ) {
        $key = \ZMT\Theme\Helpers::checkDefComsObjExists('search', 'archive');
      } elseif( is_archive() ) {
        if( is_category() ){
          $key = \ZMT\Theme\Helpers::checkDefComsObjExists('category', 'archive');
        } elseif( is_tag() ){
          $key = \ZMT\Theme\Helpers::checkDefComsObjExists('tag', 'archive');
        } elseif( is_author() ){
          $key = \ZMT\Theme\Helpers::checkDefComsObjExists('author', 'archive');
        } elseif( is_date() ){
          $key = \ZMT\Theme\Helpers::checkDefComsObjExists('date', 'archive');
        } elseif( is_tax() ){
          $obj_key = 'taxonomy_'.get_query_var('taxonomy');
          $obj_key = \ZMT\Theme\Helpers::modifyTaxandPostTypeSlugtoObject($obj_key);
          $key = \ZMT\Theme\Helpers::checkDefComsObjExists( $obj_key, 'archive');
        } elseif( is_post_type_archive() ){
          $obj_key = 'archive_'.get_post_type();
          $obj_key = \ZMT\Theme\Helpers::modifyTaxandPostTypeSlugtoObject($obj_key);
          $key = \ZMT\Theme\Helpers::checkDefComsObjExists( $obj_key, 'archive');
        }
      }

      //returns the key of posttype object in def coms
      $result = str_replace( '%%var%%', $key, $section_content_is_archive );

    }

    return $result;

  }

  static function getTemplateBlock($init_obj){

    global $zmtheme;

    /**
    * get posts by slug! so import export is better to handle with post-types
    */
    $zm_block_post_slug = $zmtheme[ $init_obj ]->getArg('block_template');

    $content = NULL;

    if($zm_block_post_slug){

      $post_obj = get_page_by_path( $zm_block_post_slug, OBJECT, 'zm_blocks' );

      if($post_obj && $post_obj->post_status == 'publish'){

        $content = $post_obj->post_content;

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

      }

    }

    return $content;

  }

  static function getAjaxReloadQueryLoop($init_obj,$query_args){

    global $zmtheme;

    //post_modules_object check
    $post_modules_object = $zmtheme[ $init_obj ]->getArg('posts_templates_object');
    $posts_key = \ZMT\Theme\Helpers::checkDefComsObjExists( $post_modules_object, 'posts');

    //template_part check --> if 'default' (oop) else by file in folder template_part!
    $template = 'default';
    if( array_key_exists( $posts_key.'__template', $zmtheme ) ){

      $template_part = $zmtheme[ $posts_key.'__template' ]->getArg('template_part');

      if($template_part){
        $template = $template_part;
      }

    }

    //var_dump($query_args);

    if(!array_key_exists('posts_per_page', $query_args)){
      $count = get_option('posts_per_page', 10);//get count from default posts_per_page from options
      $query_args['posts_per_page'] = $count;//set posts_per_page if is missing
    } else {
      $count = $query_args['posts_per_page'];//get count from posts_per_page
    }

    $paged = 1;
    if(array_key_exists('paged',$query_args) && $query_args['paged']){
      $paged = $query_args['paged'];//get count from posts_per_page
    }

    if($paged && $count > 0){
      $query_args['paged'] = $paged + 1;
      $offset = $paged * $count;
      $query_args['offset'] = $offset;
    }

    //in ajax calls other stati are added by default if not set (And if the query is run in an admin context (administration area or AJAX call), protected statuses are added too. By default protected statuses are ‘future‘, ‘draft‘ and ‘pending‘. --> https://developer.wordpress.org/reference/classes/wp_query/#status-parameters)
    $query_args['post_status'] = 'publish';
    if( is_user_logged_in() && current_user_can( 'manage_options' ) ){
      $query_args['post_status'] = array( 'publish', 'private' );
    }

    $content = NULL;
    $next_post_id = NULL;

    $zm_query = new WP_Query( $query_args );
    if ( $zm_query->have_posts() ) {

      $counter = 0;   
      while ( $zm_query->have_posts() ) {

        $zm_query->the_post();

        if($counter == 0){

          $next_post_id = get_the_ID();

        }

        if($template == 'default'){

          $content .= $zmtheme[ $posts_key.'__articlecontainer' ]->getModule();//(is output buffered!)

        } else {

          $content .= \ZMT\Theme\Render::getThePostsLoopItems( $template, $posts_key );//(is output buffered!)

        }

        ++$counter;

      }

      //ajax post loading
      $content .= \ZMT\Theme\Render::AjaxPostLoadingButton($init_obj,$zm_query,false);//no fallback, only archives have nav pages

    } 

    //Restore original Post Data
    wp_reset_postdata();

    $resulting_array = array(
      'html' => $content,
      'next_post_id' => $next_post_id// to scroll to...
    );

    return $resulting_array;

  }

  static function getQueryLoop($init_obj){

    global $zmtheme;

    //post_modules_object check
    $post_modules_object = $zmtheme[ $init_obj ]->getArg('posts_templates_object');
    $posts_key = \ZMT\Theme\Helpers::checkDefComsObjExists( $post_modules_object, 'posts');

    /**
    * belongs to reloadPostsList in CustomizerRenderCallback
    * to handle render_callbacks in customizer
    * because posts in queryloops and archives need a list reload to get correct data!
    */
    if(is_customize_preview()){
      $zmtheme['zmrendercallbackloopobj'][$init_obj] = $posts_key;
    }

    //template_part check --> if 'default' (oop) else by file in folder template_part!
    $template = 'default';
    if( array_key_exists( $posts_key.'__template', $zmtheme ) ){

      $template_part = $zmtheme[ $posts_key.'__template' ]->getArg('template_part');

      if($template_part){
        $template = $template_part;
      }

    }

    $query_args_json = $zmtheme[ $init_obj ]->getArg('query_args_json');

    if($query_args_json){

      $query_args = json_decode($query_args_json,true);//with second variable true; output is array, not object

    } else {

      $query_args = array('post_type' => 'post',);

    }

    if(!array_key_exists('posts_per_page', $query_args)){
      $count = get_option('posts_per_page', 10);//get count from default posts_per_page from options
      $query_args['posts_per_page'] = $count;//set posts_per_page if is missing
    } else {
      $count = $query_args['posts_per_page'];//get count from posts_per_page
    }

    $paged = get_query_var('paged');
    if($paged && $count > 0){
      $query_args['paged'] = $paged;
      $offset = ($paged - 1) * $count;
      $query_args['offset'] = $offset;
    }

    $content = NULL;

    $zm_query = new WP_Query( $query_args );
    if ( $zm_query->have_posts() ) {

      while ( $zm_query->have_posts() ) {

          $zm_query->the_post();

          if($template == 'default'){

            $content .= $zmtheme[ $posts_key.'__articlecontainer' ]->getModule();//(is output buffered!)

          } else {

            $content .= \ZMT\Theme\Render::getThePostsLoopItems( $template, $posts_key );//(is output buffered!)

          }

      }

      //ajax post loading
      $content .= \ZMT\Theme\Render::AjaxPostLoadingButton($init_obj,$zm_query,false);//no fallback, only archives have nav pages

    } 

    //Restore original Post Data
    wp_reset_postdata();

    return $content;

  }

  static function getThePostsLoop( $init_obj ){

    global $zmtheme;

    //post_modules_object check
    $posts_key = NULL;
    if( strpos( $init_obj, '__template' ) !== false ){

      $posts_key = substr($init_obj, 0, strpos($init_obj, '__template'));

    } else {

      $posts_key = $zmtheme[ $init_obj ]->getArg('posts_templates_object');
      $posts_key = \ZMT\Theme\Helpers::checkDefComsObjExists( $posts_key, 'posts');

      /**
      * belongs to reloadPostsList in CustomizerRenderCallback
      * to handle render_callbacks in customizer
      * because posts in queryloops and archives need a list reload to get correct data!
      */
      if(is_customize_preview()){
        $zmtheme['zmrendercallbackloopobj'][$init_obj] = $posts_key;
      }

    }

    //template_part check --> if 'default' (oop) else by file in folder template_part!
    $template = 'default';
    if( array_key_exists( $posts_key.'__template', $zmtheme ) ){

      $template_part = $zmtheme[ $posts_key.'__template' ]->getArg('template_part');

      if($template_part){
        $template = $template_part;
      }

    }

    $content = NULL;

    if ( have_posts() ) {
      
  		while ( have_posts() ) {

  			the_post();

        if($template == 'default'){

          $content .= $zmtheme[ $posts_key.'__articlecontainer' ]->getModule();//(is output buffered!)

        } else {

          $content .= \ZMT\Theme\Render::getThePostsLoopItems( $template, $posts_key );//(is output buffered!)

        }

  		}
      
      //ajax post loading
      global $wp_query;
      $content .= \ZMT\Theme\Render::AjaxPostLoadingButton($init_obj,$wp_query);

  	}

    return $content;

  }

  static function getThePostsLoopItems( $template, $posts_key ){

    $slug = str_replace(".php", "", $template);

    ob_start();
    get_template_part( 'template-parts/'.$slug, $slug, array('posts_key' => $posts_key) );
    $template_part = ob_get_contents();
    ob_end_clean();

    return $template_part;

  }

  static function getCommentsTemplate() {

    ob_start();
    comments_template();
    $comments = ob_get_contents();
    ob_end_clean();

    return $comments;

  }

  static function AjaxPostLoadingButton($init_obj,$wp_query, $fallback = true){

    $content = '';

    global $zmtheme;
    $ajax_posts_loading = $zmtheme[ $init_obj ]->getArg('ajax_posts_loading');

    if($ajax_posts_loading == 1){

      $container_class = $zmtheme[ $init_obj ]->getArg('ajax_posts_loading_container_class');
      $button_class = $zmtheme[ $init_obj ]->getArg('ajax_posts_loading_button_class');

      //ajax post loading
      if($wp_query->max_num_pages > 1) {
        if($wp_query->query_vars["paged"] == 0) {
          $current_page = 1;
        } else {
          $current_page = $wp_query->query_vars["paged"];
        }

        if($current_page < $wp_query->max_num_pages){

          $content .=  '<div class="zmt-ajax-posts-load-container '.esc_attr($init_obj).'-ajax-button-container '.esc_attr($container_class).'" data-zmt-comid="'.esc_attr($init_obj).'" data-zmt-query="'.esc_attr(htmlspecialchars(wp_json_encode($wp_query->query_vars))).'" data-zmt-maxpages="'.esc_attr($wp_query->max_num_pages).'" data-zmt-current="'.esc_attr($current_page).'" style="display:none;">';

            $content .= '<button class="zmt-ajax-posts-load-button uk-animation-scale-up '.esc_attr($button_class).'"><i class="uk-margin-small-right" uk-icon="icon:refresh;ratio:0.8;"></i>'.esc_html( \ZMT\Theme\Helpers::getTrStr('Loadmoreposts') ).'</button>';
            $content .= '<button class="zmt-ajax-posts-loading-button '.esc_attr($button_class).'" style="display:none;"><i class="uk-margin-small-right" uk-spinner="ratio:0.5;"></i>'.esc_html( \ZMT\Theme\Helpers::getTrStr('Loading') ).'</button>';
                        
          $content .= '</div>';

        }      

        //add fallback not on ajax call, because is set already on normal pageload via getThePostsLoop or getQueryLoop
        if($fallback == true){
          $content .= '<noscript>'.paginate_links(array('total' => $wp_query->max_num_pages)).'</noscript>';
        }      

      }

    }

    
    return $content;

  }


}
