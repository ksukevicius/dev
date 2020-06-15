<?php
require 'functions.php';
require 'config/connection.php';
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

	<div class='container'>there I want to implement kind of BLOG</div>
	
	<div class="container">
		<h4>There is list of notes</h4>
		<?php
		$stid = oci_parse($conn, 'SELECT * FROM C##Kestas.NOTES ORDER BY ID');
		oci_execute($stid);
		?>
		<table class='table table-striped'>
		<thead>
			<th>ID</th>
			<th>Title</th>
			<th>Note</th>
			<th>Inserted</th>
		</thead>
		<tbody>
		<?php
		while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
			echo "<tr>\n";
			echo "<td>" . $row['ID'] ."</td>";
			echo "<td>" . $row['TITLE'] ."</td>";
			echo "<td>" . $row['NOTE'] ."</td>";
			echo "<td>" . $row['INSERT_DATE'] ."</td>";
			echo "</tr>\n";
		}
		?>
		</tbody>
		</table>
	</div>	
	
</body>
</html>

<?php
oci_free_statement($stid); // need to check when this has to be executed
oci_close($conn);
?>