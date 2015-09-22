<!--

Group:				BANK
Student Number:		C00186095
Student Name:		CIARA MCMAHON
Spec Description:	This option is chosen from the Deposit Account menu if a customer wishes to close a Deposit Account.
				
The user should either be able to type in the customer number, account number or select the appropriate customer by name 
from a list of customers. Further details of the customer are then displayed for confirmation purposes.

Note: that a customer may not close an account unless the balance is zero. 
Hence, if the account does contain funds, they must first be withdrawn. 
The user then returns to this form to close the deposit account..

Once the account has a balance of zero, the user causes it to be closed (flagged for closure). 
User should include some kind of a double check to ensure that the wrong account isn't inadvertently closed. 
Once the user responds positively, a message is displayed confirming that the closure has taken place.


-->

<?php
include "../tom/verify_user.html.php";
include '../common/db.inc.php';				// connection to bank database


/*
	$sql = "SELECT customer.customerNumber, depositAccount.accountNumber, balance 
		FROM customer, accountHolder, depositAccount
		WHERE customer.customerNumber = accountHolder.customerNumber AND accountHolder.accountNumber = depositAccount.accountNumber 
		AND depositAccount.closed = '0' 
		AND customer.deleted = 0
		ORDER BY depositAccount.accountNumber desc";

	if (!$result = mysql_query($sql, $con))
	{
		die ('Error in querying the database, query 1' . mysql_error());
	}	
		
	if ( mysql_affected_rows() != 0)
	{
		$_SESSION['returnMessage'] = '"Cannot delete account with a balance\\n';
		
		while ($row = mysql_fetch_array($result))
		{	
			$_SESSION['returnMessage'] = $_SESSION['returnMessage']."$row[type] acccount Number : $row[number]\\n";
		}	
		$_SESSION['returnMessage'] = $_SESSION['returnMessage'].'"';
	} 
	else 
	{	

		// SQL query to close a selected deposit account		
		$sql = " UPDATE depositAccount
				SET  closed = '1'
				WHERE  accountNumber = '$_POST[accountID]'
				AND  balance = '0'
				";
		// error check query - notify user if it is not working
		if (!$result = mysql_query($sql, $con))
		{
			die ('Error: Query to find selected deposit account for closure' . mysql_error());
		}
	//}	

		$_SESSION["accountId"] = $accountId;	
		
		// display message to user confirming closing of deposit account
		echo "<br>The following account has been flagged for closure " .$_SESSION["accountId"] .  "<br><br>";
		
	
	*/
	
	
	
	


		// SQL query to close a selected deposit account		
		$sql = " UPDATE depositAccount
				SET  closed = '1'
				WHERE  accountNumber = '$_POST[accountID]'
				";
		// error check query - notify user if it is not working
		if (!$result = mysql_query($sql, $con))
		{
			die ('Error: Query to find selected deposit account for closure' . mysql_error());
		}	

		$_SESSION["accountId"] = $accountId;	
		
		// display message to user confirming closing of deposit account
		echo "<br>The following account has been flagged for closure " .$_SESSION["accountId"] ."<br>With the balance:  ".  "<br><br>";
		
	
		
	
	mysql_close($con);
header ("location: close_deposit_ac.html.php") ;

?>	
	
	mysql_close($con);
header ("location: close_deposit_ac.html.php") ;

?>
