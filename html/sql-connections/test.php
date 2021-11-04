<?php
 exit("song");
	include 'db-creds.inc';
	include 'sqli-connect.php';
	include 'functions.php';

$tab = table_name();
$col = column_name(2);
$data = data($tab,$col);

echo $data;

?>
