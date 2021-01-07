<?php 
include('header.php');
require_once('db.php');

$database = new Database();
if ($_GET['id'])
{
	$id = $_GET['id'];

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
</form>

<?php
} else {

  echo "poop";

}

include('footer.php');
?>
