<?php

//including the Mysql connect parameters.
$path = __DIR__ . "/../sql-connections/db-creds.inc";
include($path);
error_reporting(0);

//mysql connections for stacked query examples.
$con1 = mysqli_connect($host,$dbuser,$dbpass,$dbname,3306);
//var_dump($host,$dbuser,$dbpass,$dbname);
//var_dump($con1);
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
    @mysqli_select_db($con1, $dbname) or die ( "Unable to connect to the database: $dbname");
}


?>




 
