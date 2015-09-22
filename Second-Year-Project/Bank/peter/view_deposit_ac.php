<!--
Group:					BANK
Student Number:			C00186095
Student Name:			CIARA MCMAHON						
Spec Description:		This option is chosen from the Deposit Account menu if a customer wishes to view a Deposit Account.
						The user should either be able to type in the customer number, account number or select the appropriate customer 
						by name from a list of customers. 
						Further details of the customer are then displayed for confirmation purposes.

						The last few transactions should be displayed.

-->

<?php
session_start();
include "../tom/verify_user.html.php";
include '../common/db.inc.php';

	// SQL query to find the records for the selected deposit account
	$sql = "SELECT * FROM transaction
				WHERE transaction.accountNumber = $_SESSION[record]";
				produceReport($sql);
	
	// ERROR CHECK 
	if(!$result = mysql_query($sql,$con)) 
	{
		die('ERROR: records query' . mysql_error());
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
	mysql_close($con);
header ("location: view_deposit_ac.html.php") ;

?>
