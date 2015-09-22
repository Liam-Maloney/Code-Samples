<!--
			Group:					BANK
			Student Number:			C00186095
			Student Name:			CIARA MCMAHON
			Description:			Calculate the interest for the selected deposit account(s)
								
			This option is available to all the manager to either manually or automatically proceed through all the current accounts. 
			For each account in this category interest is to be calculated at the current rate (from the rate table) 
			and the amount is to be credited to the account . 
			That is, the current balance is to be updated. 
			Charging interest is to be shown as a transaction for that account. 
			The date and the amount of the charge is to be recorded for that account along with the transaction type (interest earned).  



-->

<?php 
include "../tom/verify_manager.php";
$_SESSION['helptext'] = "'To Calculate the Interest for a Deposit Account<br> <br> <strong>Step 1: </strong> Select the Deposit Account. <br><br><strong>Step 2: </strong> Confirm the account details are correct. <br><br> <strong>Step 3 </strong> Click the Submit button. <br><br> <strong>Step 4 </strong> The interest will be calculated for the account and added to the balance.'";
include 'head.php';
?>

    <form name="calcint_deposit_ac" id="calcint_deposit_ac" method="post"  action="calcint_deposit_ac.php" onsubmit = "confirmInterest()">             
    <h2>Calculate Interest on Deposit Accounts <img src="../common/images/help-01.png" alt="Help" id="helpbtn" onmousedown="frameToggleHelp() " > </h2>          
	<fieldset class="fullwidth"> 
	<legend> Select Deposit Account </legend>
	
	<label>Calculate Interest On</label>
	<button type = "button"  id = "interestButton" value="Calculate" onclick = "calcAllDeposits()">All Deposit Accounts</button>				<!--  Automatically allows manager to choose all deposit accounts to be selected-->
  
  	&nbsp; &nbsp; &nbsp;or&nbsp; 
  	
	<!-- Select by deposit account ID -->
	<label> Individual Deposit Account</label>
	<?php include 'interest_listbox.php';?>      									<!-- Manager to indivdually select a deposit account-->
	
	</fieldset>

	<!-- DISPLAY USER SELECTION    style="visibility: hidden;"  -->
	<fieldset class="halfwidth"   > 
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
	
	
	
	</fieldset>
	<!-- DESPOSIT ACCOUNT DETAILS -->

	<fieldset class="halfwidth"   > 
	<legend>Account/Deposit Details </legend>
	<label >Account Number </label>
	<div id="accountIdDIV"> &nbsp;</div>	
	<input type = "hidden" id = "accountID" name = "accountID">

	
	<label>Current Balance </label>
	<div id = "balanceDIV"> &nbsp;</div>
	<input type = "hidden" id = "balance" name = "balance">

	
	</fieldset>		

	
	 </form>

		<input type="reset" value="Clear" onclick = "clearInterst()" >
	
		<input type="submit" value="Submit" onclick = "confirmInterest()"> 
	

		
	</body>	
		
	</html>
	

<script>
	
	function confirmInterest()
	{
		var ok = confirm("Are these the correct account details?");
	
	
		if(ok)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	function clearInterst()
	{
		//ensures user wants to clear the account details on screen
		confirm("are you sure you want to clear these account details ?");
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