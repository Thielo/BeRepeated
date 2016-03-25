<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <div class="page wrap">
      <?php
        do_action('get_header');
        get_template_part('templates/header');
      ?>
      <main class="main wrap">
        <?php include Wrapper\template_path(); ?>
      </main><!-- /.main -->
      <?php /* if(Setup\display_sidebar()){ ?>
        <aside class="sidebar">
          <?php include Wrapper\sidebar_path(); ?>
        </aside><!-- /.sidebar -->
      <?php } */ ?>
    </div>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
