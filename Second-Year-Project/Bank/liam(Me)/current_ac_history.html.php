<?php 
include "../tom/verify_user.php";
$_SESSION['helptext'] = "'To show the history of a current account:<br><br>" .
"Step 1: Select the account by customer number, name, or select the account" . 
"directly by it's number.<br><br>Step 2: Confirm that the account details by" . 
"clicking the Show History button.<br><br>'";
include 'head.php';
?>
<!--    
    AUTHOR:     Liam Maloney
    PURPOSE:    This screen shows the transaction history
                of a specific Current Account
    DATE:       23 March 2015
-->
<form name="loan_ac_history" id="loan_ac_history" 
      onsubmit="showHistory('currentHistory', 'currentHistoryFill'); return false;">             
    <h2>Current Account History 
        <img src="../common/images/help-01.png" alt="Help" id="helpbtn" 
             onmousedown="frameToggleHelp()" > 
    </h2>          
    <fieldset class="fullwidth"> 
		<legend> Select Account By</legend>
		<div id="selectAccountByCenter">
            <div id="custNumberReposition">
                <label class="amendViewDetailLabels" for="custNumber">
                    Customer Number :</label>
                <input class="amendViewDetailInputs" title="1648..." 
                       placeholder="Whole number above 0" list="custnumbers" 
                       required pattern="[0-9]*" type="text" 
                       oninvalid="this.setCustomValidity('Please Enter a Customer Number here in digit format with no punctuation (0-9)')" onchange="clearValidity()" name="inputArea" id="customerNumber" onfocus='populateDatalist("populateCustNo", "custNoDropPopulate.php")' 
                       oninput="checkPresenceThreeWayHistory('customerNumber', 'current')" 
                       autocomplete="off">
                <datalist id="custnumbers">
                <div id="populateCustNo">
                    <option value='null'>
                </div>
                </datalist>
		  </div>
		  <div id="custNameReposition"> 
              <label class="amendViewDetailLabels" for="custname">
                  Customer Name :
              </label>
		      <input class="amendViewDetailInputs" list="custnames" name="inputArea" 
                     required onkeydown="this.value=''" onchange="clearValidity()" 
                     id="custname" onfocus='populateDatalist("populateCustNames", "custDropDownPopulate.php")'
                     oninput="checkPresenceThreeWayHistory('custname', 'current')"
                     oninvalid="this.setCustomValidity('Please select a customer from this drop down menu in the format SURNAME,[space]FIRSTNAME.  To add a customer, proceed to the Add Customer screen under Customers in the menu')" 
                     autocomplete="off" title="Bloggs, Joe" 
                     placeholder="Surname, FirstName" pattern="[a-zA-Z]+, [a-zA-Z]+">
		<datalist id="custnames">
			<div id="populateCustNames"><option value='clickToPopulate'></div>
		</datalist>
        </div>
		<label class="amendViewDetailLabels" for="custname">Account Number :</label>
		<input class="amendViewDetailInputs" title="10" placeholder="Whole number above 0" 
               list="accountnums" id="accNumbers" name="accountnums" 
               oninput="checkPresenceThreeWayHistory('accNumbers', 'current')" 
               oninvalid="this.setCustomValidity('Please Enter an Account Number here in digit format with no punctuation (0-9)')" onchange="clearValidity()" required pattern="[0-9]*" autocomplete="off">
		<datalist id="accountnums">
			<div id="populateAccountNums">
                <?php include 'currentAccDropDownPopulate.php'; ?>
            </div>
		</datalist>
	</fieldset>
    </div>
        <input type="submit" value="Print Details" id="confirm">
        <input type="reset" value="Clear" onclick="resetHistory('currentHistory')">
    </form>
    <fieldset class="fullwidth" id="currentHistory" style="visibility: hidden;">
        <legend>Account History</legend>
        <div id="history">    
            <table>
                <tr class="headings">
                    <th>Date</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Balance</th>
                </tr>
            </table>
            <table id="loanHistoryTable">
                <div id="currentHistoryFill">
                </div>
            </table>
        </div>    
    </fieldset>
</body>	
</html>
			