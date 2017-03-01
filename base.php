<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=1378142265741611";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <div class="page wrap">
      <?php
        do_action('get_header');
        get_template_part('templates/header');
      ?>
      <?php if(is_page_template('page-locations.php')){ ?>
        <?php include Wrapper\template_path(); ?>
      <?php }else{ ?>
        <main class="main wrap">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
      <?php } ?>
    </div>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
