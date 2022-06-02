<?php

namespace ZMT\Theme\Modules;

class modContainerSortable extends modContainer {

/**
  * Sortable Content Array
  * @var array
  * @access private
  */
  private $sortable_content_array = array();

/**
  * set array of default args
  */
  public function setSortableContentArray($sortable_content_array) {
   $this->sortable_content_array = $sortable_content_array;
  }

/**
  * get array of default args
  */
  public function getSortableContentArray() {
   return $this->sortable_content_array;
  }

/**
  * set single arg of default args
  */
  public function addItemtoSortableContentArray( $item_obj ) {

    $sortable_content_array = $this->getSortableContentArray();//returns array w or wo values

    if( $sortable_content_array  !== NULL && is_array( $sortable_content_array ) ) {

      $sortable_content_array[ $item_obj->getId() ] = array();
      $sortable_content_array[ $item_obj->getId() ]['item_obj'] = $item_obj;
      $sortable_content_array[ $item_obj->getId() ]['item_position'] = $item_obj->getArg('item_position');

    }

    $this->sortable_content_array = $sortable_content_array;

  }

/**
  * getSortedContentArray
  * https://stackoverflow.com/questions/1597736/how-to-sort-an-array-of-associative-arrays-by-value-of-a-given-key-in-php
  * with foreach and array_multisort is the most php version backward compatible type
  */
  public function getSortedContentArray(){

    $sortable_content_array = $this->getSortableContentArray();

    //create an sorted array column by item_position
    $sorted_positions = array();
    $i = 0;
    foreach ($sortable_content_array as $key => $row)
    {
        //if item_position = 0 add zero, if item_position = 0 twice or more, start adding positions $i++
        if( $row['item_position'] == 0 ){
          $row['item_position'] = $i;
          $i++;
        }

        $sorted_positions[$key] = $row['item_position'];
    }
    //use ordered array column to sort item_objects
    array_multisort($sorted_positions, SORT_ASC, $sortable_content_array);

    //var_dump($sortable_content_array);
    //
    return $sortable_content_array;

  }

  public function getContent() {

    $result = NULL;

    foreach($this->getSortedContentArray() as $module){

      $result .= $module['item_obj']->getModule();

    }

    return $result;

  }

}
