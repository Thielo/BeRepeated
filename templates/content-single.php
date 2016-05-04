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
      <div class="title">
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
          <a target="_blank" class="social-facebook" href="http://www.facebook.com/sharer.php?u=<?php echo rawurlencode(get_permalink()); ?>">
            <i class="fa fa-facebook"></i>
          </a>
        </li>
        <li>
          <a target="_blank" class="social-twitter" href="http://twitter.com/share?url=<?php echo rawurlencode(get_permalink()); ?>&amp;text=<?php echo rawurlencode(get_the_title()); ?>">
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
      </ul>
    </footer>
    <div class="disqus">
      <img src="<?php echo get_template_directory_uri(); ?>/dist/images/disqus.jpg" />
    </div>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
