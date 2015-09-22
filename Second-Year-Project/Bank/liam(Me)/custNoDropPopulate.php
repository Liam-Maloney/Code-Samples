<?php
/*
AUTHOR:     Liam Maloney
PURPOSE:    This returns customer numbers form the database 
            belonging to the customers who are not flagged for 
            deletion
DATE:       23 March 2015
*/
	include 'db.inc.php';  
	$query = "SELECT customerNumber FROM customer WHERE deleted=0";
	$reply = mysql_query($query, $con);                   
	$numbers = mysql_fetch_array($reply);             
	while($numbers = mysql_fetch_array($reply)) {			
	echo "<option value='" . $numbers['customerNumber'] . "'>";
	}
	mysql_close($con);	
?>