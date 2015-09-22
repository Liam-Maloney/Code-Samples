<?php
/*
AUTHOR:     Liam Maloney
PURPOSE:    Returns the details of a loan
DATE:       23 March 2015
*/
    include 'db.inc.php';
	$query =   "SELECT accountNumber, balance, 
                    loanAmount, term, monthlyRepayment 
                FROM loanAccount 
                WHERE accountNumber=" . $_POST['account'];
	$reply = mysql_query($query, $con);
	$details = mysql_fetch_array($reply);                   
	$rows = mysql_affected_rows();
	if($rows == 1) {
		echo json_encode($details);
	}	
	mysql_close($con);	
?>