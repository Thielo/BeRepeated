<?php
	get_template_part('templates/page', 'header');
	if(!have_posts()){
?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
<?php
	get_search_form();
	}
	while(have_posts()){
		the_post();
		if(is_category('photography')){
			get_template_part('templates/listing/content-photography');
		}else{
			get_template_part('templates/listing/content', get_post_type() != 'post' ? get_post_type() : get_post_format());
		}
	}
	echo pagination();
?>
