<?php
  $format = get_post_format();
  if($format == 'aside'){
    $postInfos = [
      'Plattencheck',
      'aside',
      'music'
    ];
  }else if($format == 'gallery'){
    $postInfos = [
      'Galerie',
      'gallery',
      'picture-o'
    ];
  }else if($format == 'link'){
    $postInfos = [
      'Link (extern)',
      'link',
      'external-link'
    ];
  }else if($format == 'chat'){
    $postInfos = [
      'Interview',
      'chat',
      'comments-o'
    ];
  }else{
    $postInfos = [
      'Artikel',
      'default',
      'file-o'
    ];
  }
?>
<article <?php post_class('grid-item format-'.$postInfos[1]); ?>>
  <div>
    <a href="<?php the_permalink(); ?>">
      <figure>
      <?php
        if(has_post_thumbnail()){
          the_post_thumbnail();
        }else{
          echo '<img src="https://placekitten.com/g/390/300" alt="">';
        }
      ?>
      </figure>
      <h2><span><?php the_title(); ?></span></h2>
    </a>
  </div>
</article>
