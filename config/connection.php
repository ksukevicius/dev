<?php
// Connects to the XE service (i.e. database) on the "localhost" machine
// IMPORTANT to have charset 'AL32UTF8'
$conn = oci_connect('system', 'rastam80', 'localhost/orcl','AL32UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
	
?>