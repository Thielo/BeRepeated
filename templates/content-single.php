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
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
