<?php
	require 'carbon.php';
	use Carbon\Carbon;

	$title = 'Locations';
	$postPerPage = 5;
	$locationsArgs = [
		'post_type' => 'location',
		'posts_per_page' => -1,
	];

	$locations = new WP_Query($locationsArgs);

	$locationsList = [];
	foreach($locations->posts as $location){
		$thisLoc = get_field('location',$location->ID);

		$content = $location->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);

		$locationsList[] = [
			'icon' => get_template_directory_uri().'/dist/images/map-icon.png',
			'lat' => $thisLoc['lat'],
			'lng' => $thisLoc['lng'],
			'title' => $location->post_title,
			'infoWindow' => [
				'content' => '<div class="infoBox"><h4>'.$location->post_title.'</h4><div>'.$content.'</div></div>',
			],
			'details' => [
				'database_id' => $location->ID,
				'address' => $thisLoc['address'],
			],
		];

	}
	//die();
?>
<script>
	var locations = <?php echo json_encode($locationsList); ?>;
</script>
<div id="map"></div>