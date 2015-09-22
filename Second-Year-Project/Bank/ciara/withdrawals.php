<?php
date_default_timezone_set('Europe/London');
include '../common/db.inc.php';
$TrainsAct = date('Y-m-d');

	$sql = "SELECT max(transactionID) as Max 
			FROM transaction";

	if (!$result = mysql_query($sql, $con))
	{
	die ('Error unable to create transaction for account ' . mysql_error());
	}

	$Rowcounter = mysql_affected_rows();

	if($Rowcounter == 1) 
	{
		$Row= mysql_fetch_array($result);
		$_SESSION['transactionID'] = $Row['Max'] +1;
	}
	else 
	{
		$_SESSION['transactionID'] = 1;
	}
	
	$Bal = $_POST['Balance'];
	$withdrawn = $_POST['Amount'];
	$AfterTrainsAct = $Bal - $withdrawn;
	
	$sql = "INSERT INTO transaction(transactionID, accountNumber, amount, date, balanceAfter, type)
			VALUES('$_SESSION[transactionID]', '$_POST[AccID]', '$_POST[Amount]', '$TrainsAct', '$AfterTrainsAct', 'Withdrawal')";
	
	if (!$result = mysql_query($sql, $con))
	{
		die ('Error unable to process transaction ' . mysql_error());
	}	
	
	$Type = $_POST['AccType'] . 'Account';
	
	$sql = "UPDATE $Type
			SET balance = '$AfterTrainsAct'
			Where $Type.accountNumber = '$_POST[AccID]'";
	
	if (!$result = mysql_query($sql, $con))
	{
		die ('Error unable to update account ' . mysql_error());
	}

mysql_close($con);
header("location:  withdrawals.html.php");
?>