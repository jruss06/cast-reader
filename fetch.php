<?php
require_once('db.php');
include('header.php');

$database = new Database();
$podcasts = $database->allPodcasts();

foreach($podcasts as $pod) {
	$url = $pod['url'];
	$page = file_get_contents($url);
	$parsed = simplexml_load_string($page);
	$items = $parsed->channel->item;

	$latest =  $database->latestEp($pod['id']);
	$latest_date = $latest['pub_date'];

	foreach($items as $item) {
        $item_date = strtotime($item->pubDate);
		$real_date = date('Y-m-d', $item_date);

		if ($real_date > $latest_date) {
			$ep = array(
				'title' => (string) $item->title,
				'podcast_id' => $pod['id'],
			    'summary' => (string) $item->description,
				'pub_date' => $real_date,
				'url' => (string) $item->link,
				'audio_url' => (string) $item->enclosure['url']
			);

			$database->addEpisode($ep);
		}
	}
}

include('footer.php');
?>
