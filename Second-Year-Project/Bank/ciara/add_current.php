<?php
date_default_timezone_set('Europe/London');
include 'db.inc.php';

	$sql = "SELECT max(accountNumber) as Max 
			FROM accountHolder";
	//max get the highest vaule in the field of the table
	if (!$result = mysql_query($sql, $con))
	{
		die ('Error in querying the database ' . mysql_error());
	}
	
	$Rowcounter = mysql_affected_rows();
	
	if ($Rowcounter == 1) 
	{
		$Row= mysql_fetch_array($result);
		$_SESSION['accountNumber'] = $Row['Max'] +1;
	}
       else 
	{
		$_SESSION['accountNumber'] = 1;
	}
	
	$Opendate = date('Y-m-d');
	
	$sql = "INSERT INTO currentAccount(accountNumber, balance, overdraftLimit, openDate)
			VALUES('$_SESSION[accountNumber]', '$_POST[Balance]', '$_POST[Limit]', '$Opendate')";
	  
	if (!$result = mysql_query($sql, $con))
	{
		die ('Error unable to create current account ' . mysql_error());
	}		
		
	$sql = "INSERT INTO accountHolder(customerNumber, accountNumber, accountType)
			VALUES('$_POST[UserID]', '$_SESSION[accountNumber]', 'Current')";	
		
	if (!$result = mysql_query($sql, $con))
	{
		die ('Error could not inset account holder ' . mysql_error());
	}	
	
mysql_close($con);
header ("location:  open_current_ac.html.php") ;
?>