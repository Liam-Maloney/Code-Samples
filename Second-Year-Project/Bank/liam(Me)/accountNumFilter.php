<?php

/*
AUTHOR:     Liam Maloney
PURPOSE:    This file returns from the Database all of the unclosed 
            accounts belonging to a particular customer number
DATE:       23 March 2015
*/
	include 'db.inc.php';
	$query =   "SELECT accountHolder.accountNumber 
                FROM accountHolder 
                INNER JOIN loanAccount 
                ON accountHolder.accountNumber=loanAccount.accountNumber 
                WHERE customerNumber=" . $_POST['customerNum'] . 
                " AND accountType='loan' AND closed=0"; 
	$result = mysql_query($query, $con);
	while($values = mysql_fetch_array($result)) {
		echo "<option value='" . $values['accountNumber'] . "'>";
	}
	mysql_close($con);	
?>