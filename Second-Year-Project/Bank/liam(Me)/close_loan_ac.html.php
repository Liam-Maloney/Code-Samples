<?php 
include "../tom/verify_user.php";
$_SESSION['helptext'] = "'To<strong>close</strong> a loan account:<br><br>" . 
"Step 1: Select the account by customer number, name, or select the account " . 
"directly by it's number.<br><br>Step 2: Confirm the account details<br><br>Step " . 
"3:  After confirming all details, click the close button to close the account.'";
include 'head.php';
?>

<!--    
    AUTHOR:     Liam Maloney
    PURPOSE:    This screen is used to close a loan account whose balance
                is 0
    DATE:       23 March 2015
-->
<form name="clostLoanAccount" id="closeLoanAccount" 
      onsubmit="closeAccount(); return false;">             
    <h2>Close Loan Account 
        <img src="../common/images/help-01.png" alt="Help" 
             id="helpbtn" onmousedown="frameToggleHelp() " > 
    </h2>
	<fieldset class="fullwidth"> 
		<legend> Select Account By</legend>
		<div id="selectAccountByCenter">
            <div id="custNumberReposition">
                <label class="amendViewDetailLabels" for="custNumber">
                    Customer Number :
                </label>
                <input class="amendViewDetailInputs" list="custnumbers" required pattern="[0-9]*" type="text" 
                       oninvalid="this.setCustomValidity('Please Enter a Customer Number here in digit format with no punctuation (0-9)')" onchange="clearValidity()" title="1648..." placeholder="Whole number above 0" name="inputArea" id="customerNumber" onfocus='populateDatalist ("populateCustNo", "custNoDropPopulate.php")' oninput="checkPresenceThreeWay('customerNumber', 'loan')" autocomplete="off">
                <datalist id="custnumbers">
                    <div id="populateCustNo"><option value='null'></div>
                </datalist>
            </div>
		<div id="custNameReposition"> 
            <label class="amendViewDetailLabels" 
                   for="custname">
                Customer Name :
            </label>
		<input class="amendViewDetailInputs" list="custnames" name="inputArea" required onchange="clearValidity()" id="custname" onfocus='populateDatalist("populateCustNames", "custDropDownPopulate.php")' oninput="checkPresenceThreeWay('custname', 'loan')" title="Bloggs, Joe" placeholder="Surname, FirstName" oninvalid="this.setCustomValidity('Please select a customer from this drop down menu in the format SURNAME,[space]FIRSTNAME.  To add a customer, proceed to the Add Customer screen under Customers in the menu')" autocomplete="off" pattern="[a-zA-Z]+, [a-zA-Z]+">
		<datalist id="custnames">
			<div id="populateCustNames"><option value='clickToPopulate'></div>
		</datalist>
        </div>
		<label class="amendViewDetailLabels" for="custname">
            Account Number :
        </label>
		<input class="amendViewDetailInputs" title="10" placeholder="Whole number above 0" list="accountnums" id="accNumbers" name="accountnums" oninput="checkPresenceThreeWay('accNumbers', 'loan')" oninvalid="this.setCustomValidity('Please Enter an Account Number here in digit format with no punctuation (0-9)')" onchange="clearValidity()" required pattern="[0-9]*" autocomplete="off">
		<datalist id="accountnums">
			<div id="populateAccountNums">
                <?php include 'accDropDownPopulate.php'; ?>
            </div>
		</datalist>
	</fieldset>
    </div>
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
        <legend> Account/Loan Details </legend>
        <label class="detailLabels">Account No :</label>
        <div id="accNo"></div>
        <label class="detailLabels">Loan Amount :</label>
        <div id="loanAmount">
            <input type='text' id='amount' 
                               name='amount' 
                               readOnly='true'>
        </div>
        <label class="detailLabels">Term (Months) :</label><br>
        <div id="loanTerm">
            <input type='text' id='term' name='inputArea' 
                   readOnly='true' 
                   oninput="amendCalculateRepayments()">
        </div>
        <label class="detailLabels">
            <span class="paymentAdjust"> 
                Monthly Payments : 
            </span>
        </label><br>
        <input type="text" class="inputRepos" id="repayments" 
                           readOnly='true'>
        <label class="detailLabels">Balance :</label><br>
		<input type="text" id="Balance" class="inputRepos" 
                           readOnly='true'>	
    </fieldset>
    <input type="submit" value="Close Account" id="confirm">
    <input type="reset" value="Clear" onclick="clearFormAmend('close')">
</form>
</body>	
</html>
			