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
include "../tom/verify_user.php";
$_SESSION['helptext'] = "'To View a Deposit Account<br> <br> <strong>Step 1: </strong> Select the Deposit Account. <br><br>Deposit Accounts can be chosen by their Customer ID, Customer Name or Account ID<br><br> <strong>Step 2: </strong> Confirm the account details are correct. <br><br> <strong>Step 3 </strong> Click the View button. <br><br> <strong>Step 4 </strong> The last few transactions of the selected account will be displayed.'";
include 'head.php';
?>

<form name="amend_deposit_ac" id="amend_deposit_ac"" method="post" onsubmit = "checkView()" action="view_deposit_ac.php" >             
<h2>View Deposit Account <img src="../common/images/help-01.png" alt="Help" id="helpbtn" onmousedown="frameToggleHelp() " > </h2>          

<!-- User selection of customer-->

	<fieldset class="fullwidth"> 
	<legend> Select Customer </legend>
	
	<!-- Select by customer ID -->
	<label>Customer Number</label>
	<?php include 'view_number.php';	?> 	<!-- listbox -->            
					
	<!-- Select by customer Name -->
	<label>Customer Name</label>
	<?php include 'view_name.php';?>  
  
	<!-- Select by account ID -->
	<label>Deposit Account Number</label>
	<?php include 'interest_listbox.php';?>   
	
	</fieldset>

	<!-- DISPLAY USER SELECTION-->
	<fieldset class="halfwidth"> 
	<legend> Customer Details </legend>
	

	<label> Customer Number</label>
    <div id="customerIdDiv"><br><?php if(ISSET($_SESSION['record']) ) echo $_SESSION['record']?> </div>
	<input type = "hidden" id = "customerId" name = "customerId">
	
	<label> Customer Name</label>
    <div id="customerNameDiv"><br></div> 
	<input type = "hidden" id = "customerName" name = "customerName">
	
	<label> Customer Address</label>
    <div id="customerAddressDiv"><br><br><br><br></div>
	<input type = "hidden" id = "customerAddress" name = "customerAddress">
	
	<label> Date of Birth</label>
    <div id="customerDOBDiv"><br></div> 
	<input type = "hidden" id = "customerDOB" name = "customerDOB">
	
	<input type = "hidden" id = "guarantor" name = "guarantor">
	
	</fieldset>
	<!-- DESPOSIT ACCOUNT DETAILS -->

	<fieldset class="halfwidth"> 
	<legend>Account/Deposit Details </legend>
	<label >Account Number </label>
	<div id="accountIdDIV"> &nbsp;</div>	
	<input type = "hidden" id = "accountID" name = "accountID">

	
	<label>Balance </label>
	<div id = "balanceDIV"> &nbsp;</div>
	<input type = "hidden" id = "balance" name = "balance">

	
	<br><br>
	
	
	</fieldset>		
		
	<input type = "reset" value = "Clear" onclick = "clearView()">
	
	<input type = "submit" value = "View">
	
</form>
	
	
	
	
	
<!-- display the last few transactions for the selected deposit account-->
	<fieldset class = "fullwidth">
	<legend> Deposit Account Transaction History </legend>

	<table>
		<tr>
			<th rowspan= "10">Transaction Number</th>
			<th rowspan= "10">Account Number </th>
			<th rowspan= "10">Date</th>
			<th rowspan= "10">Amount Deposited</th>
			<th rowspan= "10">Balance</th>
		</tr>
		
		<tr>
		
		</tr>

		
	</table>
	
	
	</fieldset>
	

</body>	
		
</html>

<script>
	

	
	function clearView()
	{
		//ensures user wants to clear the account details on screen
		confirm("are you sure you want to clear these account details from the screen ?");
		if(confirm)
		{
			document.getElementById("customerIdDiv").innerHTML = " ";
			document.getElementById("customerNameDiv").innerHTML = " ";
			document.getElementById("customerAddressDiv").innerHTML = " ";
			document.getElementById("customerDOBDiv").innerHTML = " ";
			document.getElementById("accountIdDIV").innerHTML = " ";
			document.getElementById("accountIdDIV").innerHTML = " ";
			document.getElementById("balanceDIV").innerHTML = " ";
		}
		else
		{
			return false
		}
	}
</script>	
			
