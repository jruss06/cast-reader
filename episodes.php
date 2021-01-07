<?php 
include('header.php');
require_once('db.php');

$database = new Database();

if ($_GET['podcast']) {
	$id = $_GET['podcast'];
	$episodes = $database->episodesByPodcast($id);
}

foreach($episodes as $ep) {
	echo '<div class="ep-item">';	
	echo '<h3>' . $ep['title'] . '</h3>';
	echo '<h5>' . $ep['podcast'] . '</h5>';
	echo '<div>' . $ep['summary'] . '</div>';
	echo '<div class="date">' . $ep['date'] . '</div> <br>';
	echo '<a href="' . $ep['audio'] . '" target="_blank"><span class="btn">play</span></a>';
	echo '</div>';
}

include('footer.php');

?>
