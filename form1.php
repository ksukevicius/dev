<?php
// Connects to the XE service (i.e. database) on the "localhost" machine
$conn = oci_connect('system', 'rastam80', 'localhost/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php
// There we will check if form was submited
if (isset($_POST["submit"])) {
	echo "Form was submitted";
	echo "<hr />";
	var_dump($_POST);
	echo "<hr />";
	
	$cname = test_input($_POST["cname"]);
	$stid = oci_parse($conn, "insert into C##Kestas.companies (cname) values(:cname)");
	//$stid = oci_parse($conn, "insert into C##Kestas.companies (cname) values({$cname})");
	
	oci_bind_by_name($stid, ':cname', $cname);
	// for the second case don't need oci_bind_by_name
	// need to find out better way
	oci_execute($stid);
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

<div class="container">
	The purpose of this page is to remember Bootstrap and to learn connection to oracle database.
	Submit the form and save some data there.
</div>

<div class="container">
  <h2>Stacked form</h2>
  <form action="form1.php" method="post">
    <div class="form-group">
      <label for="email">Company name:</label>
      <input type="text" class="form-control" id="cname" placeholder="Enter company name" name="cname">
    </div>
    <div class="form-group form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<div class="container">
	<h4>There is list of companies</h4>
	<?php
	$stid = oci_parse($conn, 'select * from C##Kestas.companies');
	
	oci_execute($stid);

	echo "<table border='1'>\n";
	while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
		echo "<tr>\n";
		echo "<td>" . $row['ID'] ."</td>";
		echo "<td>" . $row['CNAME'] ."</td>";
		echo "<td>" . $row['INSERT_DATE'] ."</td>";
		/*
		foreach ($row as $item) {
			echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
		}
		*/
		echo "</tr>\n";
	}
	echo "</table>\n";

	?>
</div>


</body>
</html>
<?php
oci_free_statement($stid); // need to check when this has to be executed
oci_close($conn);
?>
