<?php
session_start();
if (!isset($_SESSION['k_username']))
{
	header('Location: ../login.php');
}
else 
{
 	$handle = fopen("/tmp/myfile", 'w');
 	fwrite($handle, "doreboot");
	fclose($handle);
 
	$output =shell_exec('/innovared/app/restart');
}

?>