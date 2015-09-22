<?php 
include "../tom/verify_user.php";
$_SESSION['helptext'] = "'To<strong>amend</strong> a loan account:<br><br>" .
"Step 1: Select the account by customer number, name, or select the account" . 
"directly by it's number.<br><br>Step 2: Confirm that the account details by" . 
"clicking the Amend button.<br><br>Step 3:  After confirming all details," . 
"click the Amend button to modify the account.'";
include 'head.php';
?>
<!--    
    AUTHOR:     Liam Maloney
    PURPOSE:    This screen provides a means to amend Loan Accounts    
    DATE:       23 March 2015
-->
<!--onsubmit contains return false to prevent default form submission-->
<form name="amend_loan_ac" id="amend_loan_ac" 
      onsubmit="confirmDetailsAmend(); return false;">  
    <h2>Amend Loan Account <img src="../common/images/help-01.png" 
                            alt="Help" id="helpbtn" onmousedown="frameToggleHelp() " > 
    </h2>
    <!--following fieldset contains 3 inputs for selecting the customer/account-->
	<fieldset class="fullwidth"> 
		<legend> Select Account By</legend>
		<div id="selectAccountByCenter"><div id="custNumberReposition">
        <label class="amendViewDetailLabels" for="custNumber">Customer Number :</label>
		<input class="amendViewDetailInputs" list="custnumbers" title="1648..." placeholder="Whole number above 0" required pattern="[0-9]*" type="text" oninvalid="this.setCustomValidity('Please Enter a Customer Number here in digit format with no punctuation (0-9)')" onchange="clearValidity()" name="inputArea" id="customerNumber" onfocus='populateDatalist("populateCustNo", "custNoDropPopulate.php")' oninput="checkPresenceThreeWay('customerNumber')" autocomplete="off">
            <!--This datalist will contain the customer numbers-->
		<datalist id="custnumbers">
			<div id="populateCustNo"><option value='null'></div>
		</datalist>
            </div>
		<div id="custNameReposition"> <label class="amendViewDetailLabels" 
                                             for="custname">Customer Name :</label>
		<input class="amendViewDetailInputs" list="custnames" name="inputArea" required title="Bloggs, Joe" placeholder="Surname, FirstName" onchange="clearValidity()" id="custname" onfocus='populateDatalist("populateCustNames", "custDropDownPopulate.php")' oninput="checkPresenceThreeWay('custname')" oninvalid="this.setCustomValidity('Please select a customer from this drop down menu in the format SURNAME,[space]FIRSTNAME.  To add a customer, proceed to the Add Customer screen under Customers in the menu')" autocomplete="off" pattern="[a-zA-Z]+, [a-zA-Z]+">
		<datalist id="custnames">
            <!--contains a list of customer names-->
			<div id="populateCustNames"><option value='clickToPopulate'></div>
		</datalist>
        </div>
        
		<label class="amendViewDetailLabels" for="custname">Account Number :</label>
		<input class="amendViewDetailInputs" title="10" placeholder="Whole number above 0" list="accountnums" id="accNumbers" name="accountnums" oninput="checkPresenceThreeWay('accNumbers')" oninvalid="this.setCustomValidity('Please Enter an Account Number here in digit format with no punctuation (0-9)')" onchange="clearValidity()" required pattern="[0-9]*" autocomplete="off">
		<datalist id="accountnums">
            <!--Contains a list of account numbers-->
			<div id="populateAccountNums"><?php include 'accDropDownPopulate.php'; ?></div>
		</datalist>
	</fieldset>
    </div>
    <fieldset class="halfwidth">
        <!--Contains a display of the currently 
            selected customers details-->
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
        <!--Contains details relating to loans
            Also contains inputs for altering the 
            loan details-->
        <legend> Account/Loan Details </legend>
        <label class="detailLabels">Account No :</label>
        <!--account number will be inserted by Javascript-->
        <div id="accNo"></div>
        <label class="detailLabels">Loan Amount :</label>
        <div id="loanAmount">
            <!--The pattern in the following input will only accept numbers above .01
                to two decimal places-->
            <input type='text' required 
    pattern="^([0]*[1-9]{1}[0-9]{0,}(\.\d?\d?)?)|([0]*\.[0-9][1-9])|([0]*\.[1-9][0-9]?)" 
                   title="10.48" placeholder="Two decimal point number" 
                   id='amount' name='amount' oninput="amendCalculateRepayments()" 
                   readOnly='true'>
        </div>
            <label class="detailLabels">Term (Months) :</label><br>
            <div id="loanTerm">
                <input type='text' required pattern='[1-9][0-9]*' id='term' 
                       name='inputArea' readOnly='true' 
                       oninvalid="this.setCustomValidity('This must be a whole number above 0')"
                       onchange="this.setCustomValidity('')"
                       oninput="amendCalculateRepayments()" title="24" 
                       placeholder="Whole Number">
            </div>
            <label class="detailLabels"><span class="paymentAdjust"> Monthly Payments : </span></label><br>
            <input type="text" class="inputRepos" id="repayments" readOnly='true'>
            <label class="detailLabels">Balance :</label><br>
            <input type="text" id="Balance" class="inputRepos" readOnly='true' 
                   oninvalid="this.setCustomValidity('This must be a decimal number accurate to 2 decimal places')"
                   onchange="this.setCustomValidity('')"
                   title="500" placeholder="Two decimal point number" 
                   pattern="[0-9]*.?([0-9]{1,2})?">
    </fieldset>
            <input type="submit" value="Amend Details" id="confirm">
			<input type="reset" value="Clear" onclick="clearFormAmend('amend')">
</form>
</body>	
</html>
			