<?php 
include "../tom/verify_user.php";
$_SESSION['helptext'] = "' To close a current account for a <b>existing customer</b></br></br>Step 1:Select the customer to which the account will be assigned by entering the Customer Number or by selecting the Customer name from the list of customer provided once selected the details will display</br></br> Step 2: Step 2: Once the correct customer is selected click confirm to close account'";
include 'head.php';
?>
<form name="close_current_ac" id="close_current_ac" method="post"  action="close_current.php" >             
<h2>Close Current Account <img src="../common/images/help-01.png" alt="Help" id="helpbtn" onmousedown="frameToggleHelp() " > </h2>          
	<fieldset class="fullwidth"><!--boarder-->
		<legend>Select Customer</legend></br><!--text in the boarder-->

		<label for="UserID">Customer Number</label>
		<input type="text" id="UserID" name="UserID" placeholder="Enter a customer ID!" pattern="[0-9]+" oninput="pop(this)" title="User ID's are positive integers"> 
		<!-- above is to enter customer ID while below is a few spaces to seperate the textbox and listbox-->
		
		<label for="listbox">Customer Name</label>
		<?php   include 'Customers.php'; ?> 
	</fieldset>
	
	<fieldset class="halfwidth"> <!--again a boarder-->
		<legend>Customer Details</legend>
		<!--the divs are used to display details the breaks are to stop the div from messing up the alinement's of the labels-->
		<label>Customer ID  </label><div id="CustomerID" name="CustomerID">&nbsp;<br></div>
		<label>Name </label> <div id="CustomerName" name="CustomerName">&nbsp;<br></div>
		<label>Address </label><div  id="Home" name="Home">&nbsp;<br></br></br></br></div>
		<label>Date of Birth </label><div id="DOB" name="DOB">&nbsp;</div>
	</fieldset>
	
	<fieldset class="halfwidth"> <!--again a boarder-->
		<legend>Customer Details</legend>
		<!--the divs are used to display details the breaks are to stop the div from messing up the alinement's of the labels-->
		<label>Select account</label>
		<?php include 'accounts.php'?>	
		
		<label>Account ID</label>
			<input type="text" id="AccID" name="AccID" placeholder="Account ID" disabled></input >
		<label>Balance </label>
			<input type="text" id="Balance" name="Balance" placeholder="Balance" disabled></input >
		<label>Overdraft Limit </label>
			<input type="text" id="Limit" name="Limit" disabled placeholder="Account limit" pattern="[0-9]+" title="Whole positive integer values " required></input >
			</br>
	</fieldset>
	
	<input type="submit" id="Confirm" name="Confirm" value="Confirm" onclick="myDelete()">
	<input type="reset" id="clear" name="clear" value="clear" onclick="clean()">

</form>
</body>	
</html>