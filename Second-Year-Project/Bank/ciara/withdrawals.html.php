<?php 
include "../tom/verify_user.php";
$_SESSION['helptext'] = "'Please the select a customer from one of the provided methods available next enter in the amount to be withdrawn then click confirm to complete the action'";
include 'head.php';
?>

<form name="withdrawals" id="withdrawals" method="post"  action="withdrawals.php" onsubmit="return Withdrawn()">             
	<h2>Withdrawals <img src="../common/images/help-01.png" alt="Help" id="helpbtn" onmousedown="frameToggleHelp() " > </h2>          
	<fieldset class="fullwidth"><!--boarder-->
		<legend>Select Customer</legend></br><!--text in the boarder-->

		<label>Customer Number</label>
		<input type="text" id="UserID" name="UserID" placeholder="Enter a customer ID!" pattern="[0-9]+" oninput="Withdraw(this)" title="User ID's are positive integers"> 
		<!-- above is to enter customer ID while below is a few spaces to seperate the textbox and listbox-->
		&nbsp;&nbsp;&nbsp;&nbsp;
		<label for="listbox">Customer Name</label>
		<?php   include 'withdrawals_customers.php'; ?> 
	</fieldset>
	
	<fieldset class="halfwidth"> <!--again a boarder-->
		<legend>Customer Details</legend><!--the divs are used to display details the breaks are to stop the div from messing up the alinement's of the labels-->
		<label>Customer ID  </label><div id="CustomerID" name="CustomerID">&nbsp;</div><br>
		
		<label>Name </label> <div id="CustomerName" name="CustomerName">&nbsp;</div><br>
		<label>Address </label><div  id="CustomerAddress" name="CustomerAddress">&nbsp;</br></br></br></div>	
		<label>Telephone </label><div  id="CustomerPhone" name="CustomerPhone">&nbsp;</div>
	</fieldset>
	
	<fieldset class="halfwidth">
		<legend>Withdrawals</legend>
		
		<label>Select account</label>
		<?php include 'account_type.php'?>
		
		<label>Account ID</label>
		<input type="text" id="AccID" name="AccID">
		
		<label>Type </label>
		<input type="text" id="AccType" name="AccType">
		
		<label>Balance </label>
		<input type="text" id="Balance" name="Balance">
		
		<label>Withdrawal Amount </label>
		<input type="text" id="Amount" name="Amount" placeholder="Withdraws Amount" required pattern="[0-9]+[.][0-9]{2}" title="Whole positive integer values ">
	</fieldset>
	
	<input type="submit" id="Confirm" name="Confirm" value="Confirm" >
	<input type="reset" id="clear" name="clear" value="clear" onclick="Cleanup()"> <!--the method empty is used to clear the divs-->

</form>
</body>	
</html>