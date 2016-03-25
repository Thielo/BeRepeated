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
          echo '<img src="'.get_bloginfo('template_directory').'/dist/images/placeholder_posts.jpg" alt="">';
        }
      ?>
        <figcaption><?php echo $postInfos[0]; ?></figcaption>
      </figure>
      <div class="infos">
        <i class="fa fa-<?php echo $postInfos[2]; ?>"></i>
        <img src="<?php echo get_bloginfo('template_directory'); ?>/dist/images/profile_claus.jpg" class="author" />
        <h2 class="entry-title"><?php the_title(); ?></h2>
      </div>
    </a>
  </div>
</article>
