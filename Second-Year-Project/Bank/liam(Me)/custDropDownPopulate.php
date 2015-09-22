<?php
/*
AUTHOR:     Liam Maloney
PURPOSE:    Returns all customer names where the account is not deleted    
DATE:       23 March 2015
*/
	include 'db.inc.php';   //connect to the DB
	$query = "SELECT firstName, surname FROM customer WHERE deleted=0";
	$reply = mysql_query($query, $con);  
	$names = mysql_fetch_array($reply);             
	while($names = mysql_fetch_array($reply)) {			
	echo "<option value='" . $names['surname'] . ", " . $names['firstName'] . "'>";
	}
	mysql_close($con);	
?>