<?php
require 'functions.php';
require 'config/connection.php';
?>

<?php
// There we will check if form was submited
if (isset($_POST["submit"])) {
	
	$title = test_input($_POST["title"]);
	$note = test_input($_POST["note"]);
	
	$sql = "CALL C##Kestas.NOTES_NEW(:title,:note)";
	
	$stid = oci_parse($conn, $sql);
	
	oci_bind_by_name($stid, ':title', $title);
	oci_bind_by_name($stid, ':note', $note);

	$res = oci_execute($stid);
	
	oci_free_statement($stid); // need to check when this has to be executed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
	include 'includes/menu.php';
	?>
	
	<div class="container">

		<form action="notes_new.php" method="post">
			<div class="form-group">
				<label for="title">Title:</label>
				<input type="text" class="form-control" id="title" name="title" placeholder="Enter note title" >
			</div>
			<div class="form-group">
				<label for="note">Note:</label>
				<textarea class="form-control" rows="5" id="note" name="note"></textarea>
			</div>
			<button type="submit" name="submit" class="btn btn-primary">Submit</button>
		</form>

	</div>	
	
</body>
</html>

<?php
oci_close($conn);
?>