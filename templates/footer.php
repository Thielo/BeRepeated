<footer class="content-info">
	<div class="wrap">
		<figure id="founder">
			<img src="<?php bloginfo('template_directory') ?>/dist/images/footer_claus.jpg" alt="Claus Richter - Head of berepeated" />
			<figcaption>Mastermind<br/><span>of berepeated</span></figcaption>
		</figure>
	</div>
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>
</footer>
<div id="search" data-overlay="search" class="overlay">
	<div class="overlay-content wrap">
		<?php get_search_form(); ?>
		<div class="cols">
			<div class="col -third">
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
			<div class="col -third">
				<select placeholder="Genres" name="genres" id="genres">
					<?php
						$genreArgs = [
							'hide_empty' => false
						];
						$genreTaxes = [
							'genre',
						];
						$genres = get_terms($genreTaxes, $genreArgs);
						foreach ($genres as $genre){
							$genre_link = get_tag_link($genre->term_id);
							echo '<option value="'.$genre_link.'">'.$genre->name.'</option>';
						}
					?>
				</select>
			</div>
			<div class="col -third">
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
</div>
