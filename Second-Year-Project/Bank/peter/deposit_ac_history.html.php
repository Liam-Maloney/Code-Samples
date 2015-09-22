<!--
Group:					BANK
Student Number:			C00186095
Student Name:			CIARA MCMAHON						
Spec Description:		This form should list all the transactions that took place with this account.  
						It should give the date, type and amount of each transaction.  
						It should also state the current balance.  In essence it should read like a normal bank statement.  
						The user should be given the option to print out this screen.

Notes:
•	First select the customer and account required. When confirmed, display the transactions - 
	allow scrolling through transactions if there are more than a screen full.
•	Perhaps you might allow user to suggest dates for the history, e.g. April 2014 - Aug. 2014.

-->
<?php 
include "../tom/verify_user.php";
$_SESSION['helptext'] = "'To View the Deposit Account History Report<br> <br> <strong>Step 1: </strong> Select the Deposit Account. <br><br><strong>Step 2: </strong> Confirm the account details are correct. <br><br> <strong>Step 3 </strong> Click the View button. <br><br> <strong>Step 4 </strong> The transactions history of the selected account will be displayed.'";
include 'head.php';
?>
    <form name="deposit_ac_history" id="deposit_ac_history" method="post"  action="deposit_ac_history.php" onsubmit = "check()">             
    <h2>Deposit Account History <img src="../common/images/help-01.png" alt="Help" id="helpbtn" onmousedown="frameToggleHelp() " > </h2>          
	<fieldset class="fullwidth"> 
	<legend> Select Customer </legend>
	
	<!-- Select by account ID -->
	<label>Account Number</label>
	<?php include 'history_listbox.php';?>      
	
	</fieldset>
	
	
	<!-- Display the selected history of choosen account -->
	
	<fieldset class="fullwidth"> 
	<legend> Deposit Account History </legend>
	
	<label> Customer Number</label>
    <div id="customerIdDiv"><br></div>
	<input type = "hidden" id = "customerId" name = "customerId">
	
	<label> Customer Name</label>
    <div id="customerNameDiv"><br></div> 
	<input type = "hidden" id = "customerName" name = "customerName">
	
	
	
	
	<input type="reset" value="Clear" onclick = "clearHistory()" >
	
	<input type="submit" value="View"  > 
	
	
	
	</fieldset>

 </form>

 </body>	
		
</html>


<script>
	

	
	function clearHistory()
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
			