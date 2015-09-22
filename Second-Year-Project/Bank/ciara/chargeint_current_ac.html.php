<?php 
include "../tom/verify_manager.php";
$_SESSION['helptext'] = "'This is the help text that is specific to the Charge Interest on Current Account form'";
include 'head.php';
?>
<form name="chargeint_current_ac" id="chargeint_current_ac"" method="post"  action="chargeint_current_ac.php" onsubmit="return Chargedrates()">             
<h2>Charge Interest on Current Account <img src="../common/images/help-01.png" alt="Help" id="helpbtn" onmousedown="frameToggleHelp() " > </h2>          
<fieldset class="fullwidth"><!--boarder-->
		<legend>Select Customer</legend></br><!--text in the boarder-->

		<label>Charge all overdrawn Customer</label>
		<button type="button"  id="Overdrawns" value="Overdrawns" onclick="calcAllDeposits()">All overdrawn Accounts</button>
		<!-- above is to enter customer ID while below is a few spaces to seperate the textbox and listbox-->
		&nbsp;&nbsp;&nbsp;&nbsp;
		<label for="listbox">Customer Name</label>
		<?php   include 'charge_customers.php'; ?> 
	</fieldset>
	
	<fieldset class="halfwidth"> <!--again a boarder-->
		<legend>Customer Details</legend><!--the divs are used to display details the breaks are to stop the div from messing up the alinement's of the labels-->
		
		<label>Customer ID </label> <div id="CustomerID" name="CustomerID">&nbsp;</div><br>
		<label>Name </label> <div id="CustomerName" name="CustomerName">&nbsp;</div><br>
		<label>Address </label><div  id="CustomerAddress" name="CustomerAddress">&nbsp;</div></br></br></br>
		<label>Telephone </label><div  id="CustomerPhone" name="CustomerPhone">&nbsp;</div>
	</fieldset>
	
	<fieldset class="halfwidth">
		<legend>Charges</legend>
		
		<label>Select account</label>
		<?php include 'charge_account.php'?>
		
		<label>Account ID</label>
		<input type="text" id="AccountID" name="AccountID" placeholder="Account ID" readonly>
		
		<label>Balance </label>
		<input type="text" id="Balance" name="Balance" placeholder="Customer balance" readonly>
		
		<label>Rate</label>
		<input type="text" id="IntRates" name="IntRates" placeholder="Rates charge" readonly required title="Please chose a Customer and account">
	</fieldset>
	
	<input type="submit" id="Confirm" name="Confirm" value="Confirm" >
	<input type="reset" id="clear" name="clear" value="clear" onclick="Tidy()"> <!--the method empty is used to clear the divs-->
</form>
</body>	
</html>