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
include "../tom/verify_user.php";
$_SESSION['helptext'] = "'To close a deposit account <br><br> <strong>Step 1: </strong> Choose the deposit account. <br><br> <strong>Step 2: </strong> Confirm the account details are correct. <br><br> <strong>Step 3 </strong> Press the Close button.<br><br> <strong>NOTE: </strong> A Deposit Account cannot be closed if the account has a balance'";
include 'head.php';
?>
<form name="close_deposit_ac" id="close_deposit_ac" method="post"  action="close_deposit_ac.php" >             
<h2>Close Deposit Account <img src="../common/images/help-01.png" alt="Help" id="helpbtn" onmousedown="frameToggleHelp() " > </h2>          

	<fieldset class="fullwidth"> 
	<legend> Select Customer </legend>
	
	<!-- Select by customer ID -->
	<label>Customer Number</label>
	<?php include 'view_number.php';	?>	
	
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
    <div id="customerIdDiv"><br></div>
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
	<input type = "hidden" id = "accountID" name = "accountID"  value = "<?php if(ISSET($_SESSION['accountID'])) echo $_SESSION['accountID'] ?>"> 
	<!-- <div><input type = "text" id = "accountID" name = "accountID"></div> -->
	
	<label>Balance </label>
	<div id = "balanceDIV"> &nbsp;</div>
	<input type = "hidden" id = "balance" name = "balance">
	<!--<div><input type = "text" id = "balance" name = "balance"></div>-->
	
	
	<br><br>
	</fieldset>		

	<input type="reset" value="Clear" onclick = "clearClosure()" > 
	
	<input type="submit" name="close" value="Close" onclick = "checkClosure()" > 




 </form>

	<?php
	
	// display confirmation message to user
	if (ISSET ($_SESSION['accountID']))
	{
		echo "<script>alert('Deposit Account: ". $_SESSION['accountID'] . " has been clsed ');</script>";
	}
	unset( $_SESSION['accountID']);
	
	?>

</body>	
		
</html>
	
<script>
	

	
	function clearClosure()
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