<!--
			
Group:					BANK
Student Number:			C00186095
Student Name:			CIARA MCMAHON
Spec Description:			Calculate the interest for the selected deposit account(s)
								
This option is available to all the manager to either manually or automatically proceed through all the current accounts. 
For each account in this category interest is to be calculated at the current rate (from the rate table) 
and the amount is to be credited to the account . 
That is, the current balance is to be updated. 
Charging interest is to be shown as a transaction for that account. 
The date and the amount of the charge is to be recorded for that account along with the transaction type (interest earned).  

			 NEED TO AUTOMATICALLY UPDATE ACCOUNTS ALSO

-->

<?php
include "../tom/verify_manager.html.php";
include '../common/db.inc.php';					// database connection

date_default_timezone_set('Europe/London');		
		$today = date("Y-m-d");  
		// GET THE DEPOSIT RATE FROM RATE TABLE
		$sql = "SELECT rate FROM rate				
				WHERE rateTypeID = 2";			// string
				
		// ERROR CHECK  QUERY
		$row = mysql_query($sql,$con);		// result
		if(!$row)	
		{
			die('Error: Query 1 - Calculate Individual account ' . mysql_error());
		}
	
		$array = mysql_fetch_array($row);	 
		$rate = $array['rate']; 	// Convert row to associative array
		
		$newInterest = ( $rate * '$_POST[balance]') + '$_POST[balance]';			// calculate the new interest
		
		$calcInterest = "UPDATE depositAccount
						SET balance = $newInterest
						WHERE accountNumber = '$_POST[accountID]'
						";
		
		
		// ERROR CHECK $calcInterest QUERY
		if(!mysql_query($calcInterest,$con))	
		{
			die('Error: Query 2 - Calculate Individual account' . mysql_error());
		}
		
		// 	Charging interest is to be shown as a transaction for that account. 
		//	The date and the amount of the charge is to be recorded for that account along with the transaction type (interest earned).
		
		//create a new transaction id
		$tID = mysql_query( "SELECT MAX(transactionID) AS maxTrans FROM transaction"); 	//	return the row containing the highest id in accountHolder table
		
		$array2 = mysql_fetch_array($tID);	 // Convert row to associative array
		$currentT = $array2['maxTrans']; 		// Set the currentId to maxId in associative array
		$transId = $currentT + 1; 		// Increment to create a new id in accountHolder table

		/*
		$sql = "INSERT INTO transaction(transactionID,accountNumber,amount,date,balanceAfter,type)
				VALUES ('$transId','$_POST[accountIdDIV]','$_POST[balance]','$today','$newInterest',interest')";		
				";
	
		
		if(!mysql_query($sql,$con))
						{
							die ("Error: insert into transaction table ".mysql_error());
						}
		
		*/
		
		
		/*
		// calculate interest for all deposit accounts
		function calcAllDeposits()
		{	
			// GET THE DEPOSIT RATE FROM RATE TABLE
			$sql = "SELECT rate FROM rate				
				WHERE rateTypeID = 2";
				
			// Error check query
			if (!$result = mysql_query($sql, $con))
			{
				die ('Error in querying the database' . mysql_error());
			}	
			
			$array = mysql_fetch_array($row);	 
			$rate = $array['rate']; 			
		
			$newInterest = ( $rate * '$_POST[balance]');			// calculate the new interest
		
			$sql = "SELECT accountNumber, Balance  from depositaccount
					WHERE closed = 0 AND balance > 0";
				
			// Loop throught all deposit accounts
			while ($row = mysql_fetch_array($sql))
			{
				// update the balance for every open deposit account
				$calcInterest = "UPDATE depositAccount
				SET balance = $newInterest
				WHERE accountNumber = '$_POST[accountID]'";
				
				// error check query
				if(!mysql_query($sql,$con))
						{
							die ("Error: All Deposits Accounts - update of balance  ".mysql_error());
						}
						
				$sql = "INSERT INTO transaction(transactionID,accountNumber,amount,date,balanceAfter,type)
				VALUES ('$transId','$_POST[accountIdDIV]','$_POST[balance]','$today','$newInterest',interest')";		
				";
						
			}
			
		
		}
		
		*/
header ("location: calcint_deposit_ac.html.php") ;

?>
