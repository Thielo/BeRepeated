<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <div class="bg-img">
        <?php
        if(has_post_thumbnail()){
          the_post_thumbnail();
        }else{
          echo '<img src="'.get_bloginfo('template_directory').'/dist/images/placeholder_posts_big.jpg" alt="">';
        }
        ?>
      </div>
      <?php
        $titleClass = 'title';
        if(get_field('background_header') == true){
          $titleClass = 'title dark';
        }
      ?>
      <div class="<?php echo $titleClass; ?>">
        <h1 class="entry-title">
          <?php the_title(); ?>
          <span class="brand">
            <span>
              <?php get_template_part('templates/partials/logo'); ?>
            </span>
          </span>
        </h1>
        <?php get_template_part('templates/entry-meta'); ?>
      </div>
    </header>
    <section class="content">
      <div>
        <?php the_content(); ?>
      </div>
    </section>
    <footer class="share">
      <h3>Liked this? Share it!</h3>
      <ul>
        <li>
          <a target="_blank" class="social-facebook" href="https://www.facebook.com/sharer.php?u=<?php echo rawurlencode(get_permalink()); ?>">
            <i class="fa fa-facebook"></i>
          </a>
        </li>
        <li>
          <a target="_blank" class="social-twitter" href="https://twitter.com/share?url=<?php echo rawurlencode(get_permalink()); ?>&amp;text=<?php echo rawurlencode(get_the_title()); ?>">
            <i class="fa fa-twitter"></i>
          </a>
        </li>
        <li>
          <a target="_blank" class="social-google-plus" href="https://plus.google.com/share?url=<?php echo rawurlencode(get_permalink()); ?>">
          <i class="fa fa-google-plus"></i>
          </a>
        </li>
        <li>
          <a class="social-mail" href="mailto:?Subject=<?php echo rawurlencode(get_the_title()); ?>&amp;Body=<?php echo rawurlencode(get_permalink()); ?>">
            <i class="fa fa-envelope"></i>
          </a>
        </li>
        <li>
          <a class="social-recommend" href="<?php echo get_permalink(); ?>">
            <i class="fa fa-heart"></i>
            <span>0</span>
          </a>
        </li>
      </ul>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
