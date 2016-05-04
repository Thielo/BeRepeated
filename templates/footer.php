<footer class="content-info">
  <div class="wrap">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <ul>
    	<li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
    	<li><a href="#" target="_blank"><i class="fa fa-vimeo"></i></a></li>
    	<li><a href="#" target="_blank"><i class="fa fa-soundcloud"></i></a></li>
    	<li><a href="#" target="_blank"><i class="fa fa-envelope"></i></a></li>
    </ul>
  </div>
</footer>
<div id="search" data-overlay="search" class="overlay">
	<div class="overlay--content wrap">
		<?php get_search_form(); ?>
		<div class="cols">
			<div class="col -half">
				<select placeholder="Tags" name="tag" id="tag">
					<?php
						$tagArgs = array();
						$tagTaxes = array(
							'post_tag',
						);
						$tags = get_terms($tagTaxes, $tagArgs);
						foreach ($tags as $tag){
							$tag_link = get_tag_link($tag->term_id);
							echo '<option value="'.$tag_link.'">'.$tag->name.'</option>';
						}
					?>
				</select>
			</div>
			<div class="col -half">
				<select placeholder="Kategorien" name="categories" id="categories">
					<?php
						$categoryArgs = array();
						$categories = get_categories();
						foreach ($categories as $category){
							$tag_link = get_tag_link($category->term_id);
							echo '<option value="'.$category_link.'">'.$category->name.'</option>';
						}
					?>
				</select>
			</div>
		</div>
	</div>
	<div class="overlay--backdrop"></div>
</div>
