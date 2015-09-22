<!--
Group:					BANK
Student Number:			C00186095
Student Name:			CIARA MCMAHON						
Spec Description:		This form should list all the transactions that took place with this account.  
						It should give the date, type and amount of each transaction.  
						It should also state the current balance.  In essence it should read like a normal bank statement.  
						The user should be given the option to print out this screen.

-->

<?php
include "../tom/verify_user.html.php";
include '../common/db.inc.php';

		/*
				$sql = "SELECT * FROM transaction INNER JOIN depositAccount";
			$sql. = "ON depositAccount.accountNumber = transaction.accuntNumber
			WHERE depositAccount.accountNumber = '$_POST[accountIdDIV]'
			";
		*/

		// sql query to find the transaction history of the selected deposit account from deposit_ac_history.html.php
		 $sql = "SELECT date, amount, type, balanceAfter, depositAccount.accountNumber
				FROM transaction, depositAccount
				WHERE depositAccount.accountNumber = '$_POST[accountIdDIV]'
				" ;
				produceReport($sql);		// call to function which display records in table form
				
		// error check query and database connection
		if(!$result = mysql_query($sql,$con)) 		// check if query is correct
		{
			die('Error in querying the database' . mysql_error());
		}
	
	
		function produceReport($sql)
		{
			
			$record = mysql_query($sql);
			
			echo "<div align = 'center'>
			<table border = '1' cellpadding = '5' width = '90%' bgcolor = 'lightblue'>
			<tr><th>Date</th><th>Amount</th><th>Type</th><th>Balance After</th></tr>";
			
			while ($row = mysql_fetch_array($record))
			{
				echo "<tr align = 'center'>
				<td>".$row['date']. "</td>
				 <td>".$row['amount']. "</td>
				 <td>".$row['type'] . "</td>
				 <td>".$row['balanceAfter']."</td></tr>";
			}
			
			echo " </table></div>";
			
		}
	
	mysql_close($con);		// close connection to bank database
header ("location: deposit_ac_history.html.php") ;

?>
