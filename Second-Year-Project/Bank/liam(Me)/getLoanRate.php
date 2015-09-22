<?php
/*
AUTHOR:     Liam Maloney
PURPOSE:    Returns the interest rate of loans
            from the rates table
DATE:       23 March 2015
*/
    include 'db.inc.php'; 
	$sql = "SELECT rate FROM rate WHERE rateTypeID=1";
	$reply = mysql_query($sql, $con);
	$loanRate = mysql_fetch_object($reply);
	echo $loanRate->rate;
?>