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
		$locationsList[] = [
			'id' => $location->ID,
			'title' => $location->post_title,
			'location' => get_field('location',$location->ID),
		];
	}
?>
<script>
	var locations = <?php echo json_encode($locationsList); ?>;
</script>
<div id="map"></div>