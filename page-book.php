<?php
/**
 * Template Name: Buch-Seite
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'book'); ?>
<?php endwhile; ?>
