<?php
include '../common/db.inc.php';

$sql = "UPDATE currentAccount 
		SET closed = '1'
		Where accountNumber = '$_POST[AccountID]' ";
  
if (!$result = mysql_query($sql, $con))
{
	die ('Error unable to create current account ' . mysql_error());
}		

mysql_close($con);
header ("location: close_current_ac.html.php");
?>
