<?php
include 'db.inc.php';
//update the current acount overdraft limit where acount number selected customer acount
$sql = "UPDATE currentAccount 
		SET overdraftLimit = '$_POST[NewLimit]'
		Where accountNumber = '$_POST[AccountID]' AND closed = 0";
	
if (!$result = mysql_query($sql, $con))
{
	die ('Error unable to update current account ' . mysql_error());
}		

mysql_close($con);
header("location:  amend_current_ac.html.php") ;
?>