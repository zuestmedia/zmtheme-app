<?php

namespace ZMT\Theme;

class BlockPatterns {

  /**
    * Block Patterns (not used by default)
    * load this class in your functions.php to load your
    * own blockpatterns from a folder called "block_patterns"
    */

    function __construct( $dir ){

      $this->dir = $dir;

      //add theme support for block-patterns
      $this->addBlockPatterns();

    }

    public function addBlockPatterns() {

      add_action('init', array( $this, 'BlockPatterns' ));

    }

    public function BlockPatterns() {

      register_block_pattern_category(
        'zmp-my-patterns',
        array( 'label' => __( 'My Patterns', 'zmtheme' ) )
      );

      if(file_exists($this->dir.'/block_patterns')){

        $file_name_array = scandir( $this->dir.'/block_patterns' );

        foreach($file_name_array as $file_name){

          if (strpos($file_name, '.html') !== false) {

            $slug = str_replace(".html", "", $file_name);
            $name = ucwords( str_replace("_", " ", $slug) );

            register_block_pattern(
              'zmp-my-patterns/'.$slug,
              array(
                  'title'       => $name,
                  'content' => file_get_contents( $this->dir.'/block_patterns/'.$file_name ),
                  'categories' => array( 'zmp-my-patterns' ),
              )
            );

          }

        }

      }

    }

}
