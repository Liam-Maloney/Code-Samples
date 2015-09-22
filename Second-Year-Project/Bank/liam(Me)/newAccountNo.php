<?php
/*
AUTHOR:     Liam Maloney
PURPOSE:    This returns a new account number
            by looking at the previous highest in the
            account holder table and adding one to it
DATE:       23 March 2015
*/
	include 'db.inc.php'; 
	
	$query = "SELECT MAX(accountNumber) as previousMax FROM accountHolder";
	$reply = mysql_query($query, $con);
	$newAccountNum = mysql_fetch_object($reply);
	echo $newAccountNum->previousMax + 1;
?>