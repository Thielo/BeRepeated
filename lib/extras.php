<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return '';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');



/**
 * Renaming of Post Formats
 */
function rename_post_formats( $safe_text ) {
    if($safe_text == 'Kurzmitteilung' ){
        return 'Plattencheck';
    }else if($safe_text == 'Chatprotokoll'){
      return 'Interview';
    }
    return $safe_text;
}
add_filter( 'esc_html', __NAMESPACE__ . '\\rename_post_formats' );

//rename Aside in posts list table
function live_rename_formats() {
  global $current_screen;
  if($current_screen->id == 'edit-post'){
?>
    <script type="text/javascript">
      jQuery('document').ready(function() {
        jQuery("span.post-state-format").each(function() {
          if(jQuery(this).text() == "Kurzmitteilung" ){
            jQuery(this).text("Plattencheck");
          }else if(jQuery(this).text() == "Chatprotokoll" ){
            jQuery(this).text("Interview");
          }
        });
      });
    </script>
<?php
  }
}
add_action('admin_head', __NAMESPACE__ . '\\live_rename_formats');


/**
 * Custom Excerpt Length
 */
function customExcerptLength( $length ) {
  return 20;
}
add_filter( 'excerpt_length', __NAMESPACE__ . '\\customExcerptLength', 999 );


function removeExcerptMore($output) {
  return $output;
}
add_filter( 'get_the_excerpt', __NAMESPACE__ . '\\removeExcerptMore' );