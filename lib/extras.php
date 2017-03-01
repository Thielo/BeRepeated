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



function postThumbnailCol($image) {
    if(!has_post_thumbnail()){
      return trailingslashit(get_stylesheet_directory_uri()).'images/no-featured-image';
   }
}
add_filter( 'featured_image_column_default_image', __NAMESPACE__ . '\\postThumbnailCol' );


function my_embed_oembed_html($html, $url, $attr, $post_id) {
  return '<div class="embedContainer">' . $html . '</div>';
}
add_filter('embed_oembed_html', __NAMESPACE__ . '\\my_embed_oembed_html', 99, 4);


// Add Shortcode
function embedFb( $atts ) {

  // Attributes
  $atts = shortcode_atts(
    array(
      'url' => '',
    ),
    $atts
  );

  if($atts['url'] != ''){
    return '<div class="responsiveEmbed"><div class="fb-post" data-href="'.$atts['url'].'"></div></div>';
  }

}
add_shortcode( 'fb', __NAMESPACE__ . '\\embedFb' );






// Register Custom Post Type
function createEventsPostType() {

  $labels = [
    'name'                  => 'Events',
    'singular_name'         => 'Event',
    'menu_name'             => 'Events',
    'name_admin_bar'        => 'Events',
    'archives'              => 'Event Archiv',
    'parent_item_colon'     => 'Eltern Event',
    'all_items'             => 'Alle Events',
    'add_new_item'          => 'Neues Event hinzufügen',
    'add_new'               => 'Neu hinzufügen',
    'new_item'              => 'Neues Event',
    'edit_item'             => 'Event bearbeiten',
    'update_item'           => 'Event updaten',
    'view_item'             => 'Event anschauen',
    'search_items'          => 'Event suchen',
    'not_found'             => 'Nichts gefunden',
    'not_found_in_trash'    => 'Nichts im Papierkorb gefunden',
    'featured_image'        => '',
    'set_featured_image'    => '',
    'remove_featured_image' => '',
    'use_featured_image'    => '',
    'insert_into_item'      => '',
    'uploaded_to_this_item' => '',
    'items_list'            => '',
    'items_list_navigation' => '',
    'filter_items_list'     => '',
  ];
  $rewrite = [
    'slug'                  => 'event',
    'with_front'            => true,
    'pages'                 => true,
    'feeds'                 => true,
  ];
  $args = [
    'label'                 => 'Event',
    'description'           => 'Events',
    'labels'                => $labels,
    'supports'              => array('title'),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => true,
    'publicly_queryable'    => true,
    'rewrite'               => $rewrite,
    'capability_type'       => 'page',
  ];
  register_post_type( 'event', $args );

}
add_action( 'init', __NAMESPACE__ . '\\createEventsPostType', 0 );


function createLocationsPostType() {

  $labels = [
      'name'                  => 'Locations',
      'singular_name'         => 'Location',
      'menu_name'             => 'Locations',
      'name_admin_bar'        => 'Locations',
      'archives'              => 'Location Archiv',
      'parent_item_colon'     => 'Eltern Location',
      'all_items'             => 'Alle Locations',
      'add_new_item'          => 'Neue Location hinzufügen',
      'add_new'               => 'Neu hinzufügen',
      'new_item'              => 'Neue Location',
      'edit_item'             => 'Location bearbeiten',
      'update_item'           => 'Location updaten',
      'view_item'             => 'Location anschauen',
      'search_items'          => 'Location suchen',
      'not_found'             => 'Nichts gefunden',
      'not_found_in_trash'    => 'Nichts im Papierkorb gefunden',
      'featured_image'        => '',
      'set_featured_image'    => '',
      'remove_featured_image' => '',
      'use_featured_image'    => '',
      'insert_into_item'      => '',
      'uploaded_to_this_item' => '',
      'items_list'            => '',
      'items_list_navigation' => '',
      'filter_items_list'     => '',
  ];
  $rewrite = [
      'slug'                  => 'location',
      'with_front'            => true,
      'pages'                 => true,
      'feeds'                 => true,
    ];
  $args = [
    'label'                 => 'Location',
    'description'           => 'Locations',
    'labels'                => $labels,
    'supports'              => ['title','editor'],
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => true,
    'publicly_queryable'    => true,
    'rewrite'               => $rewrite,
    'capability_type'       => 'page',
  ];
  register_post_type( 'location', $args );

}
add_action( 'init', __NAMESPACE__ . '\\createLocationsPostType', 0 );


if( function_exists('acf_add_options_page') ) {

  acf_add_options_page([
    'page_title'  => 'Locations',
    'menu_title'  => 'Locations',
    'menu_slug'   => 'wn-locations',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ]);
}



function my_acf_init() {
  acf_update_setting('google_api_key', 'AIzaSyA6tYAPlVItyqXHU69nWd9CwWWO8WBNgnI');
}
add_action('acf/init', __NAMESPACE__ . '\\my_acf_init');


function create_location_taxonomy() {
  $labels = [
    'name'                       => 'Ortsarten',
    'singular_name'              => 'Ortsart',
    'search_items'               => 'Ortsart suchen',
    'popular_items'              => 'oft genutzte Ortsarten',
    'all_items'                  => 'Alle Ortsarten',
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => 'Ortsart bearbeiten',
    'update_item'                => 'Ortsart updaten',
    'add_new_item'               => 'Neue Ortsart hinzfügen',
    'new_item_name'              => 'Neue Ortsart',
    'separate_items_with_commas' => 'Ortsarten mit komma getrennt',
    'add_or_remove_items'        => 'Add or remove writers',
    'choose_from_most_used'      => 'Choose from the most used writers',
    'not_found'                  => 'No writers found.',
    'menu_name'                  => 'Ortsarten',
  ];

  $args = array(
    'hierarchical'          => false,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'location-type' ),
  );

  register_taxonomy( 'location-type', 'location', $args );
}

add_action( 'init', __NAMESPACE__ . '\\create_location_taxonomy', 0 );