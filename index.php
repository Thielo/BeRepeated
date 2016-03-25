<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>
<div class="grid">
	<div class="grid-sizer"></div>
	<?php
		while(have_posts()){
			the_post();
			get_template_part('templates/listing/content', get_post_type() != 'post' ? get_post_type() : get_post_format());
		}
	?>
</div>
<?php echo pagination(); ?>
