<div id="master-categories">
	<a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php get_template_part('templates/partials/logo'); ?></a>
	<?php
		if(have_rows('frontpage_categories')){
 			// loop through the rows of data
 			echo '<ul class="count--'.count(get_field('frontpage_categories')).'">';
    		while(have_rows('frontpage_categories')){
    			the_row();
    			$category = get_sub_field('category');
        		$image = get_sub_field('image');
    ?>
    <li>
		<a href="<?php echo get_category_link($category->term_taxonomy_id); ?>">
			<img src="<?php echo $image['sizes']['large']; ?>" alt="">
			<span><?php echo $category->name; ?></span>
		</a>
	</li>
    <?php
        	}
        }else{
        	// nope
        }
	?>
</div>

<div class="frontpageIntro">
<?php while (have_posts()) : the_post(); ?>
  <?php //get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
</div>