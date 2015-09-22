<?php
/*
AUTHOR:     Liam Maloney
PURPOSE:    This populates drop down lists
            containing account numbers on current
            account related pages
DATE:       23 March 2015
*/

	include 'db.inc.php';
	$query =    "SELECT accountHolder.accountNumber 
                FROM accountHolder 
                INNER JOIN currentAccount
 ON accountHolder.accountNumber=currentAccount.accountNumber
                WHERE accountType='Current' AND closed=0"; 
	$reply = mysql_query($query, $con);                
	while($numbers = mysql_fetch_array($reply)) {
	echo "<option value='" . $numbers['accountNumber'] . "'>";
	}
	mysql_close($con);	
?>