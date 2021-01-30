<?php 
require_once('db.php');
header('Content-Type: application/json');

$database = new Database();

$episodes = $database->allEpisodes();
$group = array_slice($episodes, 0, 15);

echo json_encode($group);

?>
