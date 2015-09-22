<?php
date_default_timezone_set('Europe/London');
include '../common/db.inc.php';

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
	
	$TrainsAct = date('Y-m-d');
	$Bal = $_POST['Balance'];
	$Rates = $_POST['IntRates'];
	$Amount = $Bal * $Rates;
	$NewBal = $Bal - $Amount;
	
	$sql = "INSERT INTO transaction(transactionID, accountNumber, amount, date, balanceAfter, type)
			VALUES('$_SESSION[transactionID]', '$_POST[AccountID]', '$Amount', '$TrainsAct', '$NewBal', 'Interest')";
	
	if (!$result = mysql_query($sql, $con))
	{
		die ('Error unable to process transaction ' . mysql_error());
	}	
		
	$sql = "UPDATE currentAccount
			SET balance = '$NewBal'
			WHERE currentAccount.accountNumber = '$_POST[AccountID]'";
	
	if (!$result = mysql_query($sql, $con))
	{
		die ('Error unable to update customer account ' . mysql_error());
	}

mysql_close($con);
header("location:  chargeint_current_ac.html.php");
?>