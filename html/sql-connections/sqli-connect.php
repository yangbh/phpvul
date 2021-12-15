<?php

//including the Mysql connect parameters.
include("../sql-connections/db-creds.inc");

//mysql connections for stacked query examples.
$con1 = mysqli_connect($host,$dbuser,$dbpass,$dbname, 3306);

var_dump($host);
var_dump($dbuser);
var_dump($dbpass);
var_dump($dbname);

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




 
