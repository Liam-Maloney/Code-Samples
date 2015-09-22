<!--

Group:						BANK
Student Number:				C00186095
Student Name:				CIARA MCMAHON						
Description:				Drop down list to only include deposit accounts for selection.		
							List used by deposit_ac_history.html.php
										 view_deposit_ac.html.php
-->
 <?php

include '../common/db.inc.php';			// database connection

date_default_timezone_set('Europe/London');			// set time to database format

	//
	/*
	$sql  ="SELECT distinct depositAccount.accountNumber,balance,accountHolder.customerNumber,firstName,surname,firstName, surname,address1,address2,address_town,address_county,birthDate
			FROM depositAccount, accountHolder, customer
			WHERE depositAccount.accountNumber = accountHolder.accountNumber
			ORDER BY depositAccount.accountNumber desc;";
*/


	$sql = "SELECT distinct depositAccount.accountNumber,balance,accountHolder.customerNumber,firstName,surname,firstName, surname,address1,address2,address_town,address_county,birthDate
			FROM depositAccount, accountHolder, customer
			WHERE 
			depositAccount.accountNumber = accountHolder.accountNumber 
			AND accountHolder.customerNumber = customer.customerNumber
			AND deleted !=1
			ORDER BY depositAccount.accountNumber desc;"
			
			
	// Error check the sql query and database connection
	if(!$result = mysql_query($sql,$con)) 		
	{
		die('Error in querying the database' . mysql_error());
	}
	
	
	echo "<select name = 'listbox_account' id = 'listbox_account' onclick = 'fillViewAccount()'>";
	
	
	while($row = mysql_fetch_array($result))
	{
		$account = $row['accountNumber'];
		$balance = $row['balance'];
		$id = $row['customerNumber'];
		$name = $row['firstName'] . " " .  $row['surname'];
		$dob = $row['birthDate'];
		$dob = date("Y-m-d", strtotime($dob));
		$address = $row['address1'] . "<br>" . $row['address2'] . "<br>" . $row['address_town'] . "<br>" . $row['address_county'];
		
		
		//$display = "$account,$balance";
		$display = "$account#$balance#$id#$name#$dob#$address";				
		
		//echo "<option value = '$display'>$account</option>";
		echo "<option value = '$display'>$account</option>";				
		
	}
	
	echo "</select>";
		
	mysql_close($con);

?>

	<script>
		// function to populate deposit details from selecting account number via listbox_account
		function fillViewAccount()
		{
			
			// -------------- populate the deposit account details ----------------------------------
			var details = document.getElementById("listbox_account");
			var result = details.options[details.selectedIndex].value;
			var accountDetails = result.split('#');
	
			document.getElementById("accountIdDIV").innerHTML = accountDetails[0];
			document.getElementById("accountID").value = accountDetails[0];
		
			document.getElementById("balanceDIV").innerHTML = accountDetails[1];
			document.getElementById("balance").value = accountDetails[1];

			// -------------- populate the customer details ----------------------------------
			var details2 = document.getElementById("nameListbox");
			var result = details.options[details.selectedIndex].value;
			var customerDetails = result.split('#');
	
			document.getElementById("customerIdDiv").innerHTML = customerDetails[2];
			document.getElementById("customerId").value = customerDetails[2];
	
	
			document.getElementById("customerNameDiv").innerHTML = customerDetails[3];
			document.getElementById("customerName").value = customerDetails[3];
	
	
			document.getElementById("customerAddressDiv").innerHTML = customerDetails[4];
			document.getElementById("customerAddress").value = customerDetails[4];
			document.getElementById("customerDOBDiv").innerHTML = customerDetails[5];
			document.getElementById("customerDOB").value = customerDetails[5];
	
		}
		
	</script>