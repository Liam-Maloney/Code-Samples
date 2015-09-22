<?php
/*
* File Produced By: Tom Anderson - C00174844 - 2015
* Purpose: 			
*/
session_start();
include '../common/db.inc.php';
if (! ISSET($_SESSION["passattempts"]))
{	
$_SESSION["passattempts"] = 3;
}

$_SESSION["passattempts"]--;

$sql = "SELECT password
		FROM password
		WHERE userName = '$_SESSION[username]'";
		
	if (!$result = mysql_query($sql, $con))
{
	die ('Error in querying the database, query 1' . mysql_error());
}	

	$result = mysql_fetch_array($result);
	if ($result['password'] == $_POST['oldpass'])
	{
		unset ($_SESSION["passattempts"]);
	$sql = "UPDATE password SET password = '$_POST[newpass]'
				WHERE userName = '$_SESSION[username]'";
		
		if (!$result = mysql_query($sql, $con))
		{	
			die ('Error in querying the database, query 2' . mysql_error());
		}	
		$_SESSION['returnMessage'] = "'You have changed your password'";
		header("Location: default.html.php");
		exit;
	} 
				
	if ($_SESSION["passattempts"] <= 0) 
	{
		UNSET($_SESSION['passattempts']);
		$_SESSION['returnMessage'] = "'Login failed, no attempts remaining!!.'";
		header("Location: logout.html.php");
		exit();
	}

	$_SESSION['returnMessage'] = "'Incorrect Password, $_SESSION[passattempts] attempt(s) remaining.'";
	header("Location: password.htmlphp");

?>