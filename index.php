<?php 
include('header.php');
require_once('db.php');

$database = new Database();

$episodes = $database->allEpisodes();
$group = array_slice($episodes, 0, 15);

foreach ($group as $ep) {
	echo '<div class="ep-item">';	
	echo '<h3>' . $ep['title'] . '</h3>';
	echo '<div>' . $ep['summary'] . '</div>';
	echo '<div class="date">' . $ep['date'] . '</div> <br>';
	echo '<a href="' . $ep['audio'] . '" target="_blank"><span class="btn">play</span></a>';
	echo '</div>';
}

include('footer.php');
?>
