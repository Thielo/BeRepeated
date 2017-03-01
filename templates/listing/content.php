<article <?php post_class('listing-article'); ?>>
  <a href="<?php the_permalink(); ?>">
    <figure>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 57 254">
        <polygon points="0 0 0 254 57 82.775 0 0"/>
      </svg>
      <img src="<?php echo get_template_directory_uri(); ?>/dist/images/transparent_article.png" alt="" />
      <?php
        if(get_field('wn_article_image') != ''){
          $image = get_field('wn_article_image');
          echo '<img class="preview" src="'.$image['url'].'" alt="'.get_the_title().'" />';
        }else{
          if(has_post_thumbnail()){
            the_post_thumbnail('large',['class' => 'preview']);
          }else{
            echo '<img class="preview" src="'.get_template_directory_uri().'/dist/images/placeholder.png" alt="">';
          }
        }
      ?>
    </figure>
    <div>
      <h2><span><?php the_title(); ?>&nbsp;</span></h2>
      <?php the_excerpt(); ?>
    </div>
  </a>
</article>