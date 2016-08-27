<?php
/*
Plugin Name: HK demo
Plugin URI: http://www.hongkiat.com/
Description: This is just a simple plugin to update post excerpts.
Author: Hongkiat
Version: 1.0
Author URI: http://twitter.com/jakerocheleau
*/

function hk_trim_content( $limit ) {
  $content = explode( ' ', get_the_content(), $limit );
  
  if ( count( $content ) >= $limit ) {
    array_pop( $content );
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 

  return $content;
}

?>