
<?php
	// must be at the top
	// before html output
	// unless output buffering is on
	$name = "test";
	$value = 45;
	$expire = time() + (60*60*24*7); //add seconds
	setcookie($name, $value, $expire);
?>

 <!DOCTYPE html>
<html>
<body>

<h1>Learning cookies</h1>


</body>
</html> 