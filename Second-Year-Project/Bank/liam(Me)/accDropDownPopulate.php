<?php
/*
AUTHOR:     Liam Maloney
PURPOSE:    returns all non closed loan accounts
DATE:       23 March 2015
*/
	include 'db.inc.php';   //connect to the DB
	//set up query string
	$query = "SELECT accountHolder.accountNumber FROM 
        accountHolder INNER JOIN loanAccount ON 
        accountHolder.accountNumber=loanAccount.accountNumber 
        WHERE accountType='loan' AND closed=0";   
	if(!($reply = mysql_query($query, $con))) {
        die("Error in populating account numbers");
    }
	while($numbers = mysql_fetch_array($reply)){
	echo "<option value='" . $numbers['accountNumber'] . "'>";
	}
	mysql_close($con);	
?>