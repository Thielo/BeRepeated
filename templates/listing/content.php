<article <?php post_class('listing-article'); ?>>
  <a href="<?php the_permalink(); ?>">
    <figure>
      <img src="<?php echo get_template_directory_uri(); ?>/dist/images/transparent_article.png" alt="" />
      <?php
        if(has_post_thumbnail()){
          the_post_thumbnail('large',['class' => 'preview']);
        }else{
          echo '<img class="preview" src="'.get_template_directory_uri().'/dist/images/placeholder.png" alt="">';
        }
      ?>
    </figure>
    <div>
      <h2><span><?php the_title(); ?></span></h2>
      <?php the_excerpt(); ?>
    </div>
  </a>
</article>
