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
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
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



// Register Custom Taxonomy
function wn_genre_taxonomy() {

  $labels = array(
    'name'                       => 'Genres',
    'singular_name'              => 'Genre',
    'menu_name'                  => 'Genre',
    'all_items'                  => 'Alle Genres',
    'parent_item'                => 'Eltern Genre',
    'parent_item_colon'          => 'Eltern Genre:',
    'new_item_name'              => 'Neues Genre',
    'add_new_item'               => 'Neues Genre hinzufügen',
    'edit_item'                  => 'Genre bearbeiten',
    'update_item'                => 'Genre updaten',
    'view_item'                  => 'Eintrag anschauen',
    'separate_items_with_commas' => 'Separate genres with commas',
    'add_or_remove_items'        => 'Add or remove genres',
    'choose_from_most_used'      => 'Choose from the most used genres',
    'popular_items'              => 'Popular Items',
    'search_items'               => 'Search genres',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No items',
    'items_list'                 => 'Items list',
    'items_list_navigation'      => 'Items list navigation',
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'genre', array( 'post' ), $args );

}
add_action( 'init', __NAMESPACE__ . '\\wn_genre_taxonomy', 0 );