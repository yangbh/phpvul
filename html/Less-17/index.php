<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Less-17 Update Query- Error based - String</title>
</head>

<body bgcolor="#000000">

<div style=" margin-top:20px;color:#FFF; font-size:24px; text-align:center"><font color="#FFFF00"> [PASSWORD RESET] </br></font>&nbsp;&nbsp;<font color="#FF0000"> Dhakkan </font><br></div>

<div  align="center" style="margin:20px 0px 0px 520px;border:20px; background-color:#0CF; text-align:center; width:400px; height:150px;">

<div style="padding-top:10px; font-size:15px;">
 

<!--Form to post the contents -->
<form action="" name="form1" method="post">

  <div style="margin-top:15px; height:30px;">User Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text"  name="uname" value=""/>  </div>
  
  <div> New Password : &nbsp; &nbsp;
    <input type="text" name="passwd" value=""/></div></br>
    <div style=" margin-top:9px;margin-left:90px;"><input type="submit" name="submit" value="Submit" /></div>
</form>
</div>
</div>
<div style=" margin-top:10px;color:#FFF; font-size:23px; text-align:center">
<font size="6" color="#FFFF00">



<?php
//including the Mysql connect parameters.
//include("../sql-connections/sql-connect.php");
$dir = __DIR__ . "/../sql-connections/sqli-connect.php";
include($dir);
//var_dump($con1);
error_reporting(0);
//var_dump($path);
function check_input($value)
	{
		global $con1;
		
	if(!empty($value))
		{
			
		// truncation (see comments)
		$value = substr($value,0,20);
		}

		// Stripslashes if magic quotes enabled
	/*	if (get_magic_quotes_gpc())
			{
			$value = stripslashes($value);
			}
*/
//$value = stripslashes($value);
		// Quote if not a number
		//$check = mysqli_real_escape_string($con1, $value);
		//$test = "UPDATE users SET password = '$check'";
		if (!ctype_digit($value))
			{
				
				//var_dump($con1);
			$value = "'" . mysqli_real_escape_string($con1, $value) . "'";
			}
		
	else
		{
			
		$value = intval($value);
		}
		
	return $value;
	}

// take the variables
if(isset($_POST['uname']) && isset($_POST['passwd']))

{
	//var_dump($_POST['uname']);
	
//making sure uname is not injectable
$uname=check_input($_POST['uname']); 
//$uname=$_POST['uname'];
echo "uname is" . $uname;
$passwd=$_POST['passwd'];

//$passwd="3242";
//var_dump($uname);

//logging the connection parameters to a file for analysis.
$fp=fopen('result.txt','a');
fwrite($fp,'User Name:'.$uname."\n");
fwrite($fp,'New Password:'.$passwd."\n");
fclose($fp);


// connectivity 
$sql="SELECT username, password FROM users WHERE username= $uname LIMIT 0,1";
//echo $sql;
$result=mysqli_query($con1, $sql);
var_dump("after mysqli_query");
$row = mysqli_fetch_array($result);
var_dump("after mysqli_fetch_array");
	if($row)
	{
  		//echo '<font color= "#0000ff">';	
		$row1 = $row['username'];
		//$row1 = "admin";  
		echo 'Your Login name:'. $row1;
		$update="UPDATE users SET password = '$passwd' WHERE username='$row1'";
		echo $update;
		$result=mysqli_query($con1, $update);
		echo $result;
  		echo "<br>";
	
	
	
		if (mysqli_error($con1))
		{
			echo '<font color= "#FFFF00" font size = 3 >';
			print_r(mysqli_error());
			echo "</br></br>";
			echo "</font>";
		}
		else
		{
			echo '<font color= "#FFFF00" font size = 3 >';
			//echo " You password has been successfully updated " ;		
			echo "<br>";
			echo "</font>";
		}
	
		echo '<img src="../images/flag1.jpg"   />';	
		//echo 'Your Password:' .$row['password'];
  		echo "</font>";
	


  	}
	else  
	{
		echo '<font size="4.5" color="#FFFF00">';
		//echo "Bug off you Silly Dumb hacker";
		echo "</br>";
		echo '<img src="../images/slap1.jpg"   />';
	
		echo "</font>";  
	}

}
?>


</font>
</div>
</body>
</html>
