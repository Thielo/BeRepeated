<article <?php post_class('listing-photography'); ?>>
  <figure>
    <?php
      if(has_post_thumbnail()){
        the_post_thumbnail('large',['class' => 'preview']);
      }else{
        echo '<img class="preview" src="'.get_template_directory_uri().'/dist/images/placeholder.png" alt="">';
      }
    ?>
    <figcaption>
      <span><?php the_title(); ?></span>
    </figcaption>
  </figure>
</article>
