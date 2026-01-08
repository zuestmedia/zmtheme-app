<?php

namespace ZMT\Theme;

class ThemeImport {

    static function importJsonData($json_data,$partial = false){

      $count_imports = 0;

      //json_decode with true is array output and not std obj!
      $array_content = json_decode($json_data,true);

      //update option theme_mod (different for parent or child theme)
      $theme_mod_slug = get_option( 'stylesheet' );
      if(array_key_exists( 'theme_mods', $array_content )){
        update_option( "theme_mods_$theme_mod_slug", $array_content['theme_mods'] );
        $count_imports++;
      }

      global $zmtheme;
      //theme-slug (same for parent or child theme)
      $optgroup = $zmtheme['theme']->getOptGroup();

      $css_type_key = $zmtheme['theme']->getCSSTypeFieldNamewithoutOptGroup();
      if(array_key_exists( $css_type_key, $array_content )){
        update_option( $optgroup.$css_type_key, $array_content[$css_type_key] );
        $count_imports++;
      }

      $template_config_key = \ZMT\Theme\Prepare::getTemplateConfigOptionsModNamewithoutOptGroup();
      if(array_key_exists( $template_config_key, $array_content )){
        update_option( $optgroup.$template_config_key, $array_content[$template_config_key] );
        $count_imports++;
      }
      $virtual_com_key = \ZMT\Theme\Prepare::getVirtualComOptionsModNamewithoutOptGroup();
      if(array_key_exists( $virtual_com_key, $array_content )){
        update_option( $optgroup.$virtual_com_key, $array_content[$virtual_com_key] );
        $count_imports++;
      }
      $com_status_key = \ZMT\Theme\Component::getComStatusOptionsModNamewithoutOptGroup();
      if(array_key_exists( $com_status_key, $array_content )){
        update_option( $optgroup.$com_status_key, $array_content[$com_status_key] );
        $count_imports++;
      }
      $com_lock_status_key = \ZMT\Theme\Component::getComLockStatusOptionsModNamewithoutOptGroup();
      if(array_key_exists( $com_lock_status_key, $array_content )){
        update_option( $optgroup.$com_lock_status_key, $array_content[$com_lock_status_key] );
        $count_imports++;
      }
      $com_label_key = \ZMT\Theme\Component::getComLabelOptionsModNamewithoutOptGroup();
      if(array_key_exists( $com_label_key, $array_content )){
        update_option( $optgroup.$com_label_key, $array_content[$com_label_key] );
        $count_imports++;
      }

      //if partial install is true, do not import widget blocks and sidebar widgets
      if($partial == false){

        //overwrites widget_block & positions reset on import
        if(array_key_exists( 'widget_block', $array_content )){
          update_option( 'widget_block', $array_content['widget_block'] );
          $count_imports++;
        }
        if(array_key_exists( 'sidebars_widgets', $array_content )){
          update_option( 'sidebars_widgets', $array_content['sidebars_widgets'] );
          $count_imports++;
        }
        if(array_key_exists( 'zm_blocks', $array_content )){
          ThemeImport::importZMBlocks($array_content['zm_blocks']);
          $count_imports++;
        }
        if(array_key_exists( 'show_on_front', $array_content )){
          ThemeImport::setShowOnFront($array_content['show_on_front']);
          $count_imports++;
        }

      }

      //recreate zmtheme global vars again with new imported theme_mods! so menus can be created from new data in first run not in second!   
      //same like in theme init...   
      new \ZMT\Theme\Prepare( $zmtheme['theme']->getOptGroup(), $zmtheme['theme']->getSettingsStatus());
      new \ZMT\Theme\Config();

      //always asign nav_menu_locations by slugs or remove array if no matching menus...
      ThemeImport::updateNavMenuLocations();

      return $count_imports;

    }    

    static function getZMBlocksArray(){

      $args = array(
        'post_type'   => 'zm_blocks',
        'posts_per_page'   => -1,
      );

      $posts_array = get_posts($args);

      $new_array = array();

      if ( $posts_array ) {

          foreach ( $posts_array  as $post ) {
              $new_array[ $post->post_name ] = array(
                'post_content' => $post->post_content,
                'post_title' => $post->post_title,
              );
          }

      }

      return $new_array;

    }

    static function importZMBlocks($new_zm_blocks_array){

      //existing blocks (use same functions as for export to get array)
      $existing_zm_blocks_array = ThemeImport::getZMBlocksArray();

      foreach($new_zm_blocks_array as $new_zm_block_key => $new_zm_block_array){

        //does not import or overwrite existing slugs! of zm_blocks (post id does not matter)
        if(array_key_exists($new_zm_block_key, $existing_zm_blocks_array) == false){

          //wp_insert_post
          wp_insert_post(
            array(
              'post_name'     => $new_zm_block_key,
              'post_title'    => wp_strip_all_tags($new_zm_block_array['post_title']),
              'post_content'  => $new_zm_block_array['post_content'],
              'post_status'   => 'publish',
              'post_type'     => 'zm_blocks',
            )
          );

        }

      }

    }


  /**
    * theme_mod: 'nav_menu_locations'
    * recreate nav_menu_locations array in theme_mods to assign menu locations correctly
    * uses name of menu in appearance/menu settings and com_label of Menu modules in template editor
    * if slugs are same, assigns menu!
    */
    static function updateNavMenuLocations(){

      global $zmtheme;

      $new_nav_menu_locations = array();

      foreach($zmtheme as $com_id => $object){

        if( strpos($com_id, '__menu') !== false ) {

          //check if is really modMenu class! (safety check)
          if( strpos(get_class($zmtheme[ $com_id ]), 'modMenu') !== false ){

            $label = $zmtheme[ $com_id ]->getComLabel();

            if($label){

              $slug = sanitize_title($label);

              $term_obj = get_term_by( 'slug', $slug, 'nav_menu' );

              if($term_obj){

                $nav_menu_location_id = $term_obj->term_taxonomy_id;

                $new_nav_menu_locations[ $com_id ] = $nav_menu_location_id;

              }

            }

          }

        }

      }

      //result: set new theme mod for nav_menu_locations
      set_theme_mod( 'nav_menu_locations', $new_nav_menu_locations );

    }

    static function setShowOnFront($value){

      if($value == 'posts'){

        update_option( 'show_on_front', 'posts' );

      } elseif($value == 'page'){

        //uze get_page_by_path to get id on import: if show_on_front (posts or page) is page
        if( get_option( 'page_for_posts' ) == 0 ){
          $blog_page_obj = get_page_by_path( 'blog' );
          if(is_object($blog_page_obj)){
            update_option( 'page_for_posts', $blog_page_obj->ID );
          }
        }

        if( get_option( 'page_on_front' ) == 0 ){
          $front_page_obj = get_page_by_path( 'home' );
          if(is_object($front_page_obj)){
            update_option( 'page_on_front', $front_page_obj->ID );
          }
        }

        if( get_option( 'page_for_posts' ) != 0 && get_option( 'page_on_front' ) != 0 ){

          update_option( 'show_on_front', 'page' );

        }

      }

    }

}
