<?php
  if(is_single()){
    $format = get_post_format();
    if($format == 'aside'){
      $postFormat = 'Plattencheck';
    }else if($format == 'gallery'){
      $postFormat = 'Galerie';
    }else if($format == 'link'){
      $postFormat = 'Link (extern)';
    }else if($format == 'chat'){
      $postFormat = 'Interview';
    }else{
      $postFormat = 'Artikel';
    }
    echo '<p class="subline">'.__('By', 'sage').' <a href="'.get_author_posts_url(get_the_author_meta('ID')).'" rel="author">'.get_the_author().'</a></p>';
  }
?>
<p><strong><?php echo $postFormat; ?></strong> geschrieben am <strong><time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date(); ?></time></strong></p>
