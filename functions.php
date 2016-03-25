<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


function pagination($range = 3, $show_one_pager = true, $show_page_hint = false){
  global $wp_query;
  $num_of_pages = (int)$wp_query->max_num_pages;

  if(!is_single() && $num_of_pages > 1){
    $current_page = get_query_var('paged') === 0 ? 1 : get_query_var('paged');
    $num_of_display_pages = ($range * 2) + 1;
    $output = '<ul id="pagination">';
    if($show_page_hint){
      $output .= '<li><span>Seite ' . $current_page . ' von ' . $num_of_pages . '</span></li>';
    }

    if($current_page > 2 && $current_page > $range + 1 && $num_of_display_pages < $num_of_pages){
      $output .= '<li><a href="' . get_pagenum_link(1) . '" title="Seite 1 - Neueste Artikel">«</a></li>';
    }

    if($show_one_pager && $current_page > 1){
      $output .= '<li><a href="' . get_pagenum_link($current_page - 1) . '" title="Seite ' . ($current_page - 1) . ' - Neuere Artikel">‹</a></li>';
    }

    for($i = 1; $i <= $num_of_pages; $i++){
      if($i < $current_page + $range + 1 && $i > $current_page - $range - 1){
        if($current_page === $i){
          $output .= '<li class="current"><span>' . $i . '</span></li>';
        }else{
          $output .= '<li><a href="' . get_pagenum_link($i) . '" title="Seite ' . $i . '" >' . $i . '</a></li>';
        }
      }
    }

    if($show_one_pager && $current_page < $num_of_pages){
      $output .= '<li><a href="' . get_pagenum_link($current_page + 1) . '" title="Seite ' . ($current_page + 1) . ' - Ältere Artikel">›</a></li>';
    }
    if($current_page < $num_of_pages - 1 && $current_page + $range < $num_of_pages && $num_of_display_pages < $num_of_pages){
      $output .= '<li><a href="' . get_pagenum_link($num_of_pages) . '" title="Seite ' . $num_of_pages . ' - Älteste Artikel">»</a></li>';
    }
    $output .= '</ul>';
    return $output;
  }
}