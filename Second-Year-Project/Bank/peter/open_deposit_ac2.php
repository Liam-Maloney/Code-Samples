<?php
session_start();
include '../common/db.inc.php';


		// assign a unique account number to new deposit account number store number in account holder table in bank database
				
		$type = "deposit";
		date_default_timezone_set('Europe/London');		
		$today = date("Y-m-d");  
		
			
		$sql = "SELECT max(accountNumber) as maxId FROM accountHolder";
	
		if (!$result = mysql_query($sql, $con))
		{
			die ('Error Query 1: selecting max id from accountHolder table ' . mysql_error());
		}
		
		$rowcount = mysql_affected_rows();
	
		if ($rowcount == 1) 
		{
			$row= mysql_fetch_array($result);
			$_SESSION['accountNumber'] = $row['maxId'] + 1;			// create a new account number
			$_SESSION['balance'] = $_POST['balance'];
			$_SESSION['firstname'] = $row['firstname'];
			$_SESSION['surname'] = $row['surname'];
		}
       else 
		{
			$_SESSION['accountNumber'] = 1;			// if account number hasn't been set
		}
	
	
	
	  // insert new record into depositaccount table
	  $insert1="INSERT INTO depositAccount (accountNumber,balance,openDate) 
			VALUES ('$_SESSION[accountNumber]','$_POST[balance]','$today')";
		
		//error check - if query doesn't work notify user
						if(!mysql_query($insert1,$con))
						{
							die ('Error Query 2: Inserting new record into depositaccount table' . mysql_error());
						}
						
	

	$insert2 = "INSERT INTO accountHolder(customerNumber,accountNumber,accountType)
				VALUES ('$_POST[customerId]','$_SESSION[accountNumber]','deposit')";
		
		//error check - if query doesn't work notify user		
		if(!mysql_query($insert2,$con))
						{
							die ("Error Query 3: Inserting new record into accountHolder table ".mysql_error());
						}
						
						
		
// Select the maximum id in transaction table
		$tID = mysql_query( "SELECT MAX(transactionID) AS maxTrans FROM transaction"); 	//	return the row containing the highest id in accountHolder table
		
	
		$array2 = mysql_fetch_array($tID);	 // Convert row to associative array
		$currentT = $array2['maxTrans']; 		// Set the currentId to maxId in associative array
		$transId = $currentT + 1; 		// Increment to create a new id in accountHolder table
		
		
		
		$balanceAfter = $_POST['balance'];
		
		
		// insert new transaction record into transaction table
		$sql3 = "INSERT INTO transaction(transactionID,accountNumber,amount,date,balanceAfter,type)
				VALUES ('$transId','$_SESSION[accountNumber]','$_POST[balance]','$today',".$balanceAfter.",'deposit')";			
				
		if(!mysql_query($sql3,$con))
						{
							die ("Error Query 4: Inserting new record into transaction table  ".mysql_error() . $sql3);
						}		
		
		
mysql_close($con);		// close connection to bank database
		
header ("location: open_deposit_ac.html.php") ;

?>				