<?php 
include "../tom/verify_user.php";
$_SESSION['helptext'] = "'To open a loan account for an " .
"<strong>existing customer</strong>:<br><br>Step 1: Select " .
"the customer to whom the account will be assigned by " .
"selecting from the Customer Name drop down, or by typing " .
"their customer number in the Customer Number area at the " .
"top of the form.  Then click Confirm Customer Details." .
"<br><br>Step 2: Enter a Loan Amount and Loan Term - Monthly " .
"Repayments are then calculated.  If these monthly repayments " .
"are acceptable, click Confirm Loan Details to continue." .
"<br><br>Step 3:  After confirming all details, click the " .
"Open Account button to open the account.'";
include 'head.php';
?>
<!--    
    AUTHOR:     Liam Maloney
    PURPOSE:    This screen provides an interface to open loan
                accounts for existing customers.
    DATE:       23 March 2015
-->
    <!--Note Returning False here stops form submission-->
    <form id="loanForm" onsubmit="confirmDetails(); return false;">
		<img src="help-01.png" alt="Help" id="helpbtn" onmousedown="frameToggleHelp()">
		<h2>Open Loan Account</h2>
		<fieldset class="fullwidth"> 
			<legend> Select Customer </legend>
			<label for="custNumber">Customer Number :</label>
				<input list="custnumbers" required pattern="[0-9]*" title="1648..." placeholder="Whole number above 0" type="text" oninvalid="this.setCustomValidity('Please Enter a Customer Number here in digit format with no punctuation (0-9)')" onchange="this.setCustomValidity(''); document.getElementById('custname').setCustomValidity('');" name="inputArea" id="customerNumber" onfocus='populateDatalist("populateCustNo", "custNoDropPopulate.php")' oninput="checkPresence('customerNumber')" autocomplete="off">
            <datalist id="custnumbers">
                <div id="populateCustNo"><option value='null'></div>
            </datalist>
			<label for="custname">Customer Name :</label>
			<input list="custnames" name="inputArea" required title="Bloggs, Joe" placeholder="Surname, FirstName" onchange="this.setCustomValidity(''); document.getElementById('customerNumber').setCustomValidity('');" id="custname" onfocus='populateDatalist("populateCustNames", "custDropDownPopulate.php")' oninput="checkPresence('custname')" oninvalid="this.setCustomValidity('Please select a customer from this drop down menu in the format SURNAME,[space]FIRSTNAME.  To add a customer, proceed to the Add Customer screen under Customers in the menu')" autocomplete="off" pattern="[a-zA-Z]+, [a-zA-Z]+">
            <datalist id="custnames">
				<div id="populateCustNames">
                    <option value='clickToPopulate'>
                </div>
            </datalist>
		</fieldset>
		<!--Displays the currently selected customers details-->
			<fieldset class="halfwidth">
				<legend> Customer Details </legend>
					<label class="detailLabels">Name :</label>
					<div id="namedetail"></div>
					<label class="detailLabels">Address :</label>
					<div id="adddetail"><br><br><br><br></div>
					<label class="detailLabels">Date of Birth :</label>
					<div id="dobdetail"></div>
					<label class="detailLabels">Telephone :</label>
					<div id="phonedetail"></div>
					<br><br>
			</fieldset>
			<fieldset class="halfwidth">
                <!--Form entry for opening loan details-->
				<legend> Account/Loan Details </legend>
					<label class="detailLabels">Account No :</label>
					<div id="accountNumber"></div>
					<label class="detailLabels">Loan Amount :</label>
					<div id="loanAmount">
                        <input type='text' required 
    pattern="^([0]*[1-9]{1}[0-9]{0,}(\.\d?\d?)?)|([0]*\.[0-9][1-9])|([0]*\.[1-9][0-9]?)" 
                               id='amount' name='inputArea' oninput='calculateRepayments()' 
                               readOnly='true' title="1032.34" 
                               placeholder="Two decimal point number" >
                    </div>
					<label class="detailLabels">Term (Months) :</label><br>
					<div id="loanTerm">
                        <input type='text' required pattern='[1-9][0-9]*' id='term' 
                               name='inputArea' oninput='calculateRepayments()' 
                               readOnly='true' title="24" placeholder="Whole Number">
                    </div>
					<label class="detailLabels">Payments :</label><br>
					<div id="payments"></div>
					<br><br>
			</fieldset>
			<input type="submit" value="Confirm Customer Details" id="confirm">
			<input type="reset" value="Clear" onclick="clearForm()">
	</form>
</body>	
</html>
			