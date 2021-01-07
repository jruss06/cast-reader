<?php 
include('header.php');
require_once('db.php');

$database = new Database();
$podcasts = $database->allPodcasts();
?>

<div><a href="show?action=new"><span class="btn">Add</span></a></div><br>

<?php

foreach ($podcasts as $pod) {
	echo '<a href="show?id='. $pod['id'] .'">';	
	echo '<div class="podcast-item">';
	echo '<h3>' . $pod['title'] . '</h3>';
	echo '<div>' . $pod['summary'] . '</div>';
	echo '</div>';
	echo '</a>';
}

include('footer.php');
?>
