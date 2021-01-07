<?php 
include('header.php');
require_once('db.php');

$database = new Database();
if ($_GET['id'])
{
	$id = $_GET['id'];
	if ($_GET['action'] == "delete") {	
		$database->deletePodcast($id);
		echo "<div>Deleted</div><br>";	
	} 
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$database->updatePodcast($id, $_POST['title'], $_POST['summary'], $_POST['url']);
		echo "<div>Saved</div><br>";	
	}

	$podcast = $database->getPodcast($id);
	
?>

<form action="" method="post">
	<label for='title'>Title</label><br>
	<input type="text" id="title" name="title" value="<?php echo $podcast['title']; ?>"> <br>
	<label for='summary'>Summary</label><br>
	<textarea id="summary" name="summary" rows="5" cols="80"><?php echo $podcast['summary']; ?></textarea><br>
	<label for='url'>URL</label><br>
	<input style="width:50%;" type="text" id="url" name="url" value="<?php echo $podcast['url']; ?>"> <br><br>
	<input type="submit" value="Submit">
	<a class="delete" href="show?action=delete&id=<?php echo $id; ?>">Delete</a>
</form>


<?php
} elseif ($_GET['action'] == "new") {
 
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$database->addPodcast($_POST['title'], $_POST['summary'], $_POST['url']);
		echo "<div>Added</div><br>";	
	}
?>

<h2>Add Podcast</h2>
<form action="" method="post">
	<label for='title'>Title</label><br>
	<input type="text" id="title" name="title" value=""> <br>
	<label for='summary'>Summary</label><br>
	<textarea id="summary" name="summary" rows="5" cols="80"></textarea><br>
	<label for='url'>URL</label><br>
	<input style="width:50%;" type="text" id="url" name="url" value=""> <br><br>
	 <input type="submit" value="Submit">
</form>

<?php

}

include('footer.php');
?>
