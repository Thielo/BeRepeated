<?php
	require 'carbon.php';
	use Carbon\Carbon;

	$title = 'Kommende Events';
	$postPerPage = 5;
	$eventsArgs = [
		'post_type' => 'event',
		'posts_per_page' => 5,
		'status' => 'published',
		'meta_key'	=> 'event_date',
		'orderby' => 'meta_value_num',
		'order'	=> 'ASC',
	];

	if(isset($_GET['month']) && $_GET['month'] != ''){
		$date = explode('-',$_GET['month']);
		$endOfMonth = Carbon::createFromDate($date[1], $date[0], 1)->endOfMonth();

		$dateFields = [
			'start' => $date[1].$date[0].'01',
			'end' => $date[1].$date[0].$endOfMonth->format('d'),
		];

		$months = [
			'01' => 'Januar',
			'02' => 'Februar',
			'03' => 'März',
			'04' => 'April',
			'05' => 'Mai',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'August',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'Noveber',
			'12' => 'Dezember',
		];
		$title = 'Veranstaltungen im '.$months[$date[0]].' '.$date[1];
		$postPerPage = 1;
		$eventsArgs = [
			'post_type' => 'event',
			'posts_per_page' => 5,
			'status' => 'published',
			'meta_key'	=> 'event_date',
			'orderby' => 'meta_value_num',
			'order'	=> 'ASC',
			'meta_query' => [
				'relation' => 'OR',
				[
					'key' => 'event_date',
					'value' => array($dateFields['start'],$dateFields['end']),
					'type' => 'numeric',
					'compare' => 'BETWEEN'
				],
				[
					'key' => 'event_date_end',
					'value' => array($dateFields['start'],$dateFields['end']),
					'type' => 'numeric',
					'compare' => 'BETWEEN'
				]
			]
		];
	}

	$events = new WP_Query($eventsArgs);

	//var_dump($events);
?>
<div class="page-header">
	<h1><?php echo $title; ?></h1>
</div>
<div class="events">
	<form class="filter">
		<strong>Filter</strong>
		<select id="dateMonth">
			<option value="01">Januar</option>
			<option value="02">Februar</option>
			<option value="03">März</option>
			<option value="04">April</option>
			<option value="05">Mai</option>
			<option value="06">Juni</option>
			<option value="07">Juli</option>
			<option value="08">August</option>
			<option value="09">September</option>
			<option value="10">Oktober</option>
			<option value="11">Noveber</option>
			<option value="12">Dezember</option>
		</select>

		<select id="dateYear">
			<option value="2016">2016</option>
			<option value="2017">2017</option>
		</select>

		<span class="btn btn--ghost">Jetzt filtern</span>
	</form>
	<div class="eventList">
		<?php
			if($events->have_posts()){
				while($events->have_posts()){
					$events->the_post();
		?>
			<a class="event" target="_blank" href="<?php echo get_field('event_fb_url'); ?>">
				<h3><?php echo get_the_title() ?></h3>
				<p class="date">
					<?php
						if(is_null(get_field('event_date_end'))){
							echo get_field('event_date');
						}else{
							echo get_field('event_date').' bis '.get_field('event_date_end');
						}
					?>
				</p>
				<div><?php echo get_field('event_description'); ?></div>
			</a>
		<?php
				}
				wp_reset_postdata();
			}else{
				echo '<p class="no-events">Keine Veranstaltungen im gewünschten Zeitraum</p>';
			}
		?>
	</div>
</div>