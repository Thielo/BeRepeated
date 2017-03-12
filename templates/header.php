<div id="bar" class="sticky">
  <div class="wrap">
    <span class="brand">
      <a href="<?= esc_url(home_url('/')); ?>">
        <?php get_template_part('templates/partials/logo'); ?>
      </a>
    </span>
    <a class="navToggle" href="#"><span><i>Menu</i></span></a>
    <nav class="nav-primary">
      <?php
        if (has_nav_menu('primary_navigation')){
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
        }
      ?>
    </nav>
    <a href="#" data-task="open" data-overlay="search" class="fa fa-search"><span>Suche</span></a>
  </div>
</div>
<?php if(!is_single() && !is_front_page()){ ?>
<header class="banner">
  <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php get_template_part('templates/partials/logo'); ?></a>
</header>
<?php } ?>
