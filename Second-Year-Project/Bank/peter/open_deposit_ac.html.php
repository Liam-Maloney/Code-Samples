<!--
Group:					BANK
Student Number:			C00186095
Student Name:			CIARA MCMAHON						
Spec Description:		This form should open a deposit account for a customer.  
						The details will be stored in a separate table (for deposit accounts) in the database.

						For simplicity, you should assume that the customer wishing to open a deposit account is already on file. 
						If a completely new customer (i.e. not already on file) wants to open an account, the user must first go to the 
						Customer Menu and choose the Add a New Customer option. 
						The user then returns to this form to open the deposit account.
						If the customer does exist, the user should either be able to type in the customer number or 
						select the appropriate customer by name from a list of customers. 
						Further details of the customer are then displayed for confirmation purposes. 

						When the user confirms that the details are correct, a unique account number is allocated and displayed on form.
						The user should also request the first transaction i.e. a deposit of an opening balance. 
						When all details are confirmed a new record is added to the Deposit Accounts Table.

-->

<?php 
include "../tom/verify_user.php";

$_SESSION['helptext'] = "'To create a new deposit account for a current customer <br><br> <strong>Step 1: </strong> Choose the customer who is requesting a new deposit account. <br><br> <strong>Step 2: </strong> Confirm the customer details are correct. <br><br> <strong>Step 3 </strong> Enter the amount the account holder wishes to deposit.'";
include 'head.php';

?>
																						<!-- "confirmDetails()"-->
	<form name="open_deposit_ac" id="open_deposit_ac" method="post"  action="open_deposit_ac2.php"  onsubmit = "check()">             
     <h2>Open Deposit Account <img src="../common/images/help-01.png" alt="Help" id="helpbtn" onmousedown="frameToggleHelp() " > </h2>          
	
	<!-- USER SELECTION -->
	<fieldset class="fullwidth"> 
	<legend> Select Customer </legend>
	
	<!-- listbox to choose customer by ID -->  
	<label>Customer Number</label>
	<?php include 'number_listbox.php';	?> 	          
					
				
	
	<!-- listbox  choose customer by NAME-->  
	<label>Customer Name</label>
	<?php include 'name_listbox.php';?>      
	
	</fieldset>
	
	<!-- DISPLAY CUSTOMER DETAILS -->
	<fieldset class="halfwidth">
	<legend> Customer Details </legend>
	
	<label> Customer Number</label>
    <div id="customerIdDiv"><br></div>
	<input type = "hidden" id = "customerId" name = "customerId" pattern = "[0-9]*">
	
	<label> Customer Name</label>
    <div id="customerNameDiv"><br></div> 
	<input type = "hidden" id = "customerName" name = "customerName"  pattern="[a-zA-Z]+, [a-zA-Z]+" value = "<?php if(ISSET($_SESSION['firstname'])) echo $_SESSION['firstname'] ?>">
	
	<label> Customer Address</label>
    <div id="customerAddressDiv"><br><br><br><br></div>
	<input type = "hidden" id = "customerAddress" name = "customerAddress" pattern="[a-zA-Z]+, [a-zA-Z]+">
	
	<label> Date of Birth</label>
    <div id="customerDOBDiv"><br></div> 
	<input type = "hidden" id = "customerDOB" name = "customerDOB">
	
	</fieldset>
	
	
	<!-- DESPOSIT ACCOUNT DETAILS -->
	<fieldset class="halfwidth">
	<legend> Deposit Account Details </legend>
	</br>
	
	<label >Account Number </label>
	<div><input disabled type = "text" id="accountId" name= "accountId" value = "<?php if(ISSET($_SESSION['accountNumber'])) echo $_SESSION['accountNumber'] ?>"/> &nbsp;</div>
	
	
	<label>Balance </label>
	<input disabled type = "text" id = "balance" name = "balance" placeholder = "Enter deposit amount" pattern = "[0-9]*"  title = "Accepted: Numbers only" value = "<?php if(ISSET($_SESSION['balance'])) echo $_SESSION['balance'] ?>">
	
	
	<br><br>
	</fieldset>	
	
	<input type="reset" value="Clear" onclick= "checkClear()">
	
	 <input type="button" value="Confirm" id="confirm" onclick = "confirmDetails()">

	</form>

	
<!--  Display confirmation message of opening deposit account -->
	<?php
	
	// display confirmation message to user
	if (ISSET ($_SESSION['accountNumber']))
	{
		echo "<script>alert('Created account No ". $_SESSION['accountNumber'] . " for deposit customer ');</script>";
	}
	unset( $_SESSION['accountNumber']);
	
	?>
	
	</body>	
	

	
	</html>
			