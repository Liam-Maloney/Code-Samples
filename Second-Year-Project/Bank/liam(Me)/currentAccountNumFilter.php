<?php
/*
AUTHOR:     Liam Maloney
PURPOSE:    This acts as a filter for the current account
            number.  It only returns account belonging to a 
            specific customer number
DATE:       23 March 2015
*/
	include 'db.inc.php';	
	$query =    "SELECT accountNumber 
                FROM accountHolder 
                WHERE customerNumber=" . $_POST['customerNum'] . 
                " AND accountType='Current'"; 
	$result = mysql_query($query, $con);
	while($values = mysql_fetch_array($result)) {
		echo "<option value='" . $values['accountNumber'] . "'>";
	}
	mysql_close($con);	
?>