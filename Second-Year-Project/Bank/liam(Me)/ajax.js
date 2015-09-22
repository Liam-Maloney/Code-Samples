/*
AUTHOR:     Liam Maloney
PURPOSE:    This file contains Javascript used 
            on my (Liam Maloney) individual work units.
DATE:       23 March 2015
*/

function clearValidity(){
    //Clears Custom Validity on change of all three inputs
    //on 3 input pages
    document.getElementById("custname").setCustomValidity('');
    document.getElementById("accNumbers").setCustomValidity('');
    document.getElementById("customerNumber").setCustomValidity('');
}

function clearForm() { 
    //This function clears all the input elements on the 
    //Open Loan Account Form
	document.getElementById("customerNumber").readOnly = false;
	document.getElementById("custname").readOnly = false;
	document.getElementById("term").readOnly = true;
	document.getElementById("amount").readOnly = true;
	document.getElementById("confirm").value = "Confirm Customer Details";
    //original state of the onsubmit attribute must be reset
	document.getElementById("loanForm").setAttribute(
        "onsubmit", "confirmDetails(); return false;");
	document.getElementById("namedetail").innerHTML = "";
	document.getElementById("adddetail").innerHTML = "";
	document.getElementById("dobdetail").innerHTML = "";
	document.getElementById("accountNumber").innerHTML = "";
	document.getElementById("phonedetail").innerHTML = "";
	document.getElementById("payments").innerHTML = "";
	document.getElementById("term").value = "";
	document.getElementById("amount").value = "";
	document.getElementById("custname").value = "";
	document.getElementById("customerNumber").value = "";
}

function clearFormAmend(callingPage) {
    //Form for clearning the form present on the amend
    //loan account page
    if(callingPage == "amend"){
        document.getElementById("amend_loan_ac").setAttribute(
            "onsubmit", "confirmDetailsAmend(); return false;");
    }
    document.getElementById("customerNumber").readOnly = false;
    document.getElementById("customerNumber").value = "";
	document.getElementById("custname").readOnly = false;
    document.getElementById("custname").value = "";
    document.getElementById("accNumbers").readOnly = false;
    document.getElementById("accNumbers").value = "";
    document.getElementById("amount").readOnly = true;
    document.getElementById("amount").value = "";
    document.getElementById("accNo").innerHTML = "";
    document.getElementById("term").readOnly = true;
    document.getElementById("term").value = "";
    document.getElementById("repayments").readOnly = true;
    document.getElementById("repayments").value = "";
    document.getElementById("Balance").readOnly = true;
    document.getElementById("Balance").value = "";
    document.getElementById("confirm").value = "Amend Details";
    document.getElementById("namedetail").innerHTML = "";
	document.getElementById("adddetail").innerHTML = "";
	document.getElementById("dobdetail").innerHTML = "";
	document.getElementById("phonedetail").innerHTML = "";
}

function confirmDetailsAmend() {
    //preps the amend screen for next stage
    //of input by locking out relevant fields and
    //setting a new form onsubmit attribute
    document.getElementById("customerNumber").readOnly = true;
	document.getElementById("custname").readOnly = true;
    document.getElementById("accNumbers").readOnly = true;
    document.getElementById("amount").readOnly = false;
    document.getElementById("term").readOnly = false;
    document.getElementById("Balance").readOnly = false;
    document.getElementById("confirm").value = "Update Details";
    document.getElementById("amend_loan_ac").setAttribute(
        "onsubmit", "updateDetailsConfirm(); return false;");
}

function updateDetailsConfirm() {
    //confirms the user would like to save the 
    //entered changes in the loan amend screen, calls updateLoanDetails, 
    //and then clears the form for the next input
    if(confirm("Are you sure you would like to update this account and save changes?")) {
        updateLoanDetails();
        clearFormAmend("amend");
    }
}

function resetHistory(tableToHide) {
    //hides the relevant history table in the event of a reset
    document.getElementById(tableToHide).style.visibility = "hidden";
}

/*-----------------------------AJAX RELATED FUNCTIONS-----------------------------

    "AJAX is a group of interrelated Web development techniques used on the 
    client-side to create asynchronous Web applications. With Ajax, web 
    applications can send data to and retrieve from a server asynchronously 
    (in the background) without interfering with the display and behavior 
    of the existing page. Data can be retrieved using the XMLHttpRequest object." 
                                                  --Wiki Article on AJAX--
    
    Any functions employing AJAX (potentially) will take the following format:
    
        1.  Set up an XMLHttpRequest object.
        2.  Take desired parameters from the DOM
        3.  Encode these values in to a variable, with special chars encoded.
        4.  Open a desired file (usually PHP), and send in the parameter variable
            via POST/GET
        5.  When the ready state of the server changes, check to see if the 
            finished signal has been given (IE: server status is 200 and 
            readyStage is 4).
        6.  Access the servers response through the XMLHttpObject.
        7.  Repopulate appropriate values to appropropriate places in DOM
        
        NOTE:   Javascript Object Notation (JSON) is used where many variables are
                passed between the Javascript and PHP.
                
----------------------------------------------------------------------------------*/

function amendCalculateRepayments() {
    //calculates the displays loan repayments on the amend loan screen
    getRate = new XMLHttpRequest();
		if (!(document.getElementById("amount").value == "" || 
              document.getElementById("term").value == "")) {
			getRate.onreadystatechange = function () {	
				if(getRate.status==200 && getRate.readyState==4) {
					if(calculateInterest("term", "amount") == "NaN") {
						document.getElementById("payments").innerHTML = "";
					}
					else {
                        //displays the monthly repayments with intest factored in
						document.getElementById("repayments").value = 
                            calculateInterest("term", "amount");
					}
				}
            }
        } else {
			document.getElementById("repayments").value = "";
		}
        //using GET as values are only being pulled
		getRate.open("GET", "getLoanRate.php", true);
		getRate.send();
}

function closeAccount() {
    //this function calls php to close the account specified
    if(confirm("Are you sure you would like to close this loan account?")) {
        closer = new XMLHttpRequest();
        closer.onreadystatechange = function () {
            if(closer.status == 200 && closer.readyState==4) {
                if(closer.response == "accountNotEmpty"){
                    alert("The account balance must be 0 in order for a " + 
                          "closure to take place.");
                    clearFormAmend();
                } else if(closer.response == "closed") {
                    alert("The account was succesfully closed");
                    clearFormAmend();
                }
            }
        }
        parameters = "account=" + document.getElementById("accNumbers").value;
        closer.open("POST","closeLoanAccount.php", false);
        closer.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        closer.send(parameters);
    } else {
        alert("Closure canceled");
    }
}

function showHistory(tableToShow) {
    //Takes in id of division in which a table is contained
    //and fills this table with a history of transactions
    document.getElementById(tableToShow).style.visibility = "visible";
    historyGetter = new XMLHttpRequest();
    historyGetter.onreadystatechange = function () {
        if(historyGetter.status == 200 && historyGetter.readyState == 4) {
            //Transactions are stored in a JSON object
            jsonArr = JSON.parse(historyGetter.response);
            historyTable = document.getElementById("loanHistoryTable");
            //clears any previous history in the table
            historyTable.innerHTML=""; 
            for(i = 0; i < jsonArr.history.length; i++){
                //insert data in to table by first
                //inserting a row, and then assign 
                //values to the new cells in the inserted
                //rows
                newRow = historyTable.insertRow(0);
                newDate = newRow.insertCell(0);
                type = newRow.insertCell(1);
                amount = newRow.insertCell(2);
                prevBal = newRow.insertCell(3);
                //JSON object contains an array named
                //"history"
                newDate.innerHTML = jsonArr.history[i].date;
                type.innerHTML = jsonArr.history[i].type;
                amount.innerHTML = jsonArr.history[i].amount;
                prevBal.innerHTML = jsonArr.history[i].balanceAfter;
            }
        }
    }
    parameters = "account=" + document.getElementById("accNumbers").value;
    historyGetter.open("POST","getLoanHistory.php", false);
    historyGetter.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    historyGetter.send(parameters);
}

function updateLoanDetails() {
    //read in all possibly changed data, and send 
    //it to the php script for processing
    loanUpdater = new XMLHttpRequest();
    loanUpdater.onreadystatechange = function () {
        if(loanUpdater.status == 200 && loanUpdater.readyState == 4) {
              if(loanUpdater.response == "success") {
                  alert("Loan Details Changed");
              } else {
                  //will echo back why the loan details
                  //were not updated
                  alert(loanUpdater.response);
              }
        }
    }
    loanUpdater.open("POST","updateLoanDetails.php", false);
    loanUpdater.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //pull the new details from the html form
    term = document.getElementById("term").value;
    amount = document.getElementById("amount").value;
    balance = document.getElementById("Balance").value;
    account = document.getElementById("accNo").innerHTML;
    monthRepay = document.getElementById("repayments").value;
    loanUpdater.send("term=" + term + "&balance=" + balance + "&amount=" + amount + 
                     "&account=" + account + "&monthlyRepayment=" + monthRepay);
}

function populateDatalist(datalistName, populatorFile) {   		
    //datalistName should contain the id in to which the
    //<options> will be inserted
    //populatorFile identifies the php file which will return the data
    //values returned in format "<option value=" . $someVariable . ">"
    
    //This function dynamically updates the entries in datalists and
    //drop down selectors in certain pages.
    
    populater = new XMLHttpRequest();
    populater.onreadystatechange = function () {
        if(populater.status == 200 && populater.readyState == 4) {
            document.getElementById(datalistName).innerHTML = populater.response;
        }
    }
    populater.open("GET", populatorFile, true);
    populater.send();
}

function filterAccountNums(customerNum, callingPage) {
    //This provides a method of filtering the account numbers
    //in the account number datalist by sending the currently
    //present customer number to a database query
	if(customerNum != "") {
        filter = new XMLHttpRequest();
        filter.onreadystatechange = function () {
		  if(filter.status == 200 && filter.readyState == 4) {
              document.getElementById("populateAccountNums").innerHTML = 
                  filter.response;
		  }
        }  
        //next lines needed to differenciate between when the method is
        //filtering loan account numbers or current account numbers
        if(callingPage == "current"){
	       filter.open("POST","currentAccountNumFilter.php", false);
        } else {
           filter.open("POST","accountNumFilter.php", false);
        }
        filter.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        filter.send("customerNum=" + customerNum);
    }
}

function populateAccountNumbers (callingPage) {
	//populates account numbers with no filter
	pop = new XMLHttpRequest();
	pop.onreadystatechange = function () {
		if(pop.status == 200 && pop.readyState == 4) {
			document.getElementById("populateAccountNums").innerHTML = pop.response;
		}
	}
	if(callingPage == 'current'){
        pop.open("GET", "currentAccDropDownPopulate.php", false);
    } else {
        pop.open("GET", "accDropDownPopulate.php", false);
    }
	pop.send();
}

function fillLoanDetails() {
    //gets the details of a loan account based on an
    //account number which is present in the HTML page
    loanFiller = new XMLHttpRequest();
    loanFiller.onreadystatechange = function () {
        if(loanFiller.status == 200 && loanFiller.readyState == 4) {
            var jsonLoanDetails = JSON.parse(loanFiller.response);
            //fill the details to the relevant areas
            removeMinus = jsonLoanDetails.balance;
            removeMinus = removeMinus.substring(1, removeMinus.length);
            document.getElementById("Balance").value = removeMinus;
            document.getElementById("accNo").innerHTML = jsonLoanDetails.accountNumber;
            document.getElementById("amount").value = jsonLoanDetails.loanAmount;
            document.getElementById("repayments").value = jsonLoanDetails.monthlyRepayment;
            document.getElementById("term").value = jsonLoanDetails.term;
        }
    }
    loanFiller.open("POST","getLoanDetails.php", true);
	loanFiller.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	loanFiller.send("account=" + document.getElementById("accNumbers").value);
}

function checkPresenceThreeWayHistory(caller, callingPageType) {
    //this function handles filtering of details between three inputs
    //where the user may select from account numbers, customer numbers
    //or customer names
    
    //This version is specific to the history pages
    
    //caller specifies the input box which has called the function, and calling page
    //type specifies the html page the function was called from
    if(caller == "accNumbers") { 
        filterCust = new XMLHttpRequest();
        filterCust.onreadystatechange = function () {
            if(filterCust.status == 200 && filterCust.readyState == 4) {
                //if a record exists for this account nubmer, then
                //fill the relavent details in to the html page
                if(filterCust.response != "doesNotExist"){
                jsonObj = JSON.parse(filterCust.response);
                document.getElementById("customerNumber").value = jsonObj.customerNumber;
                document.getElementById("custname").value = jsonObj.surname + 
                    ", " + jsonObj.firstName;
                } else {
                document.getElementById("customerNumber").value = "";
                document.getElementById("custname").value = "";
                //repopulate all account numbers, callingPageType specifies
                //which page has called the function, and therefore
                //specifies whether to fill the account numbers with
                //current account numbers or loan account numbers
                populateAccountNumbers(callingPageType);
                }
            }
        }
        //specifies the php file to open based on which page type
        //the function was called from
        if(callingPageType == "loan") {
            filterCust.open("POST","getCustNum.php", true);
        } else {
            filterCust.open("POST","currentGetCustNum.php", true);
        }
        filterCust.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        filterCust.send("account=" + document.getElementById("accNumbers").value);
    } else if(caller == "custname" || caller == "customerNumber") {
        //perform a filter on the account numbers
        //based on the value in custname or customerNumber input
        replacer = new XMLHttpRequest();  
        replacer.onreadystatechange = function () {
            if(replacer.status == 200 && replacer.readyState == 4) {    
                if(replacer.response == "noUniqueMatches") {
                    //repopulate the account numbers if 
                    //no unique matches are found
                    populateAccountNumbers(callingPageType);
				    if(caller == "customerNumber") {
                        document.getElementById("custname").value = "";
				    } else if (caller == "firstName") {
                        document.getElementById("customerNumber").value = "";
				    }
                } else {
				    var jsonResponse = JSON.parse(replacer.response);
                    //echo back the customer details in the form of a JSON object
                    //and populate the details in the relevant places
				    if(caller == "customerNumber") {
                        document.getElementById("custname").value = jsonResponse.surname + 
                            ", " + jsonResponse.firstName;
				    } else if (caller == "firstName") {
					   document.getElementById("customerNumber").value = 
                           jsonResponse.customerNumber;
                    }
                    //now perform a filter of the account numbers associated with
                    //this customer number, and send the callingPageType to differenciate
                    //when to filter for loan account numbers vs current account numbers
				    filterAccountNums(document.getElementById("customerNumber").value, 
                                      callingPageType);
                }
            }
        }
        var identifier = document.getElementById(caller).value;
        if(caller == "custname") {
            //if the calling input type is custname, 
            //then reassign this to firstName in order to 
            //attach this as the name for the name:value pairing
            //in the associative array
            caller = "firstName";
            parameters = "callingInput" + "=" + caller + "&" + 
                "identifier='" + identifier.substring(identifier.indexOf(',') + 2, 
                                                      identifier.length) + "'";
        } else {
		  if(identifier == "") { 
              //needed in the event that customer number is empty.  
              //Otherwise error occurs in DB when querying for null value
			identifier = -1;
		  }
		  parameters = "callingInput" + "=" + caller + "&" + 
              "identifier=" + identifier;
        }
        replacer.open("POST", "fillDetails.php", false); 
        //must be set to false here as having the code run as asyncronous 
        //is too fast for the server to respond.  This has implications
        //elsewhere in the code as returned values are also used in this javascript
        //function
        replacer.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        replacer.send(parameters);		
    } 
}

function checkPresenceThreeWay(callingInput, indirectFlag) {
	//this function handles filtering of details between three inputs
    //where the user may select from account numbers, customer numbers
    //or customer names
	if(callingInput == "accNumbers") {
        //see if the input account number has 
        //an entry in the database, and fill customer
        //details in relevant places if this is the case
        fillCustDetailsFromAccountNum();
    } else {
        if(indirectFlag) {
            //if this function has been called from another javascript 
            //function, then perform these actions to complete filling
            //in the rest of the details
            checkPresence(callingInput);
            if(document.getElementById("accNumbers").value == "") {
                //if the account number is empty, then there must
                //be no possibility of there being account details
                //to display, so clear the account detail section
                document.getElementById("Balance").value = "";
                document.getElementById("accNo").innerHTML = "";
                document.getElementById("amount").value = "";
                document.getElementById("repayments").value = "";
                document.getElementById("term").value = "";
            } else {
                //otherwise fill the loan details belonging 
                //to this account number
                fillLoanDetails();
            } 
        } else {
            checkPresence(callingInput);
            document.getElementById("accNumbers").value = "";
            document.getElementById("Balance").value = "";
            document.getElementById("accNo").innerHTML = "";
            document.getElementById("amount").value = "";
            document.getElementById("repayments").value = "";
            document.getElementById("term").value = "";
        }
    }
	if(document.getElementById("custname").value == "" || 
       document.getElementById("customerNumber").value == "") {
        //if either of the custname or customerNumber
        //inputs are empty, then this must mean that other
        //functions found no valid entry in the database for 
        //the supplied values, so clear the related fields
        //and repopulate all account numbers
        populateAccountNumbers();
        document.getElementById("Balance").value = "";
        document.getElementById("accNo").innerHTML = "";
        document.getElementById("amount").value = "";
        document.getElementById("repayments").value = "";
        document.getElementById("term").value = "";

	} else {
        //otherwise filter the available account numbers by the 
        //customer number present
        filterAccountNums(document.getElementById("customerNumber").value);
        document.getElementById("Balance").value = "";
        document.getElementById("accNo").innerHTML = "";
        document.getElementById("amount").value = "";
        document.getElementById("repayments").value = "";
        document.getElementById("term").value = "";
	}		
}

function fillCustDetailsFromAccountNum() {
    //this fills in customer details in the event that
    //a corresponding account number was found in the 
    //database equal to the current value in the 
    //account number input
	filterCust = new XMLHttpRequest();
	filterCust.onreadystatechange = function () {
		if(filterCust.status == 200 && filterCust.readyState == 4) {
            if(filterCust.response != "doesNotExist"){
                jsonObj = JSON.parse(filterCust.response);
                document.getElementById("customerNumber").value = jsonObj.customerNumber;
                checkPresenceThreeWay("customerNumber", true);
            }
            else {
                document.getElementById("customerNumber").value = "";
                document.getElementById("custname").value = "";
                populateAccountNumbers();
            }
		}
	}
	filterCust.open("POST","getCustNum.php", true);
	filterCust.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	filterCust.send("account=" + document.getElementById("accNumbers").value);
}

function checkPresence(callingInput) { 	
    //sends input from an input and checks 
    //to see if a unique entry occurs in the database 
    //for that value.  If unique, then the appropriate 
    //areas on the source page are updated with customer				
    //details.  if not unique, then the areas which
    //show customer details are cleared.
	replacer = new XMLHttpRequest();  
    replacer.onreadystatechange = function () {
        if(replacer.status == 200 && replacer.readyState == 4) {    
			if(replacer.response == "noUniqueMatches") {
				document.getElementById("namedetail").innerHTML = "";
				document.getElementById("adddetail").innerHTML = "<br><br><br><br>";
				document.getElementById("dobdetail").innerHTML = "";
				document.getElementById("phonedetail").innerHTML = "";
                if(callingInput == "accNumbers") {
                      document.getElementById("accNumbers").value = "";
                } else if(callingInput == "customerNumber") {
					document.getElementById("custname").value = "";
				} else if (callingInput == "firstName") {
					document.getElementById("customerNumber").value = "";
				}
			} else {
				var jsonResponse = JSON.parse(replacer.response);
				if(callingInput == "customerNumber") {
					document.getElementById("custname").value = 
                        jsonResponse.surname + ", " + jsonResponse.firstName;
				} else if (callingInput == "firstName") {
					document.getElementById("customerNumber").value = 
                        jsonResponse.customerNumber;
				}
				document.getElementById("namedetail").innerHTML = 
                    jsonResponse.firstName + " " + jsonResponse.surname;
				document.getElementById("adddetail").innerHTML = 
                    jsonResponse.address1 + "<br>" + jsonResponse.address2 + 
                    "<br>" + jsonResponse.address_town + "<br>" + jsonResponse.address_county;
				document.getElementById("dobdetail").innerHTML = jsonResponse.birthDate;
				document.getElementById("phonedetail").innerHTML = jsonResponse.telephone;
			}
        }
    }
	var identifier = document.getElementById(callingInput).value;
    if(callingInput == "custname") {
		callingInput = "firstName";
		parameters = "callingInput" + "=" + callingInput + 
            "&" + "identifier='" + identifier.substring(
                identifier.indexOf(',') + 2, identifier.length) + "'";
	} else {
		if(identifier == "") { 
            //needed in the event that customer number is empty.  
            //Otherwise error occurs in DB when querying for null value
			identifier = -1;
		}
		parameters = "callingInput" + "=" + callingInput + "&" + 
            "identifier=" + identifier;
	}
    replacer.open("POST", "fillDetails.php", false);
	replacer.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	replacer.send(parameters);
}

function confirmDetails() {	
    //Gets new account number and inserts it in to the html.
    //also opens up the loan amount and term fields for user entry, 
    //and locks out previous fields
    //this is triggered when the user confirms customer details
	document.getElementById("customerNumber").readOnly = true;
	document.getElementById("custname").readOnly = true;
	getAccountId = new XMLHttpRequest();
	getAccountId.onreadystatechange = function () {
		if(getAccountId.status == 200 && getAccountId.readyState == 4) {
            //change the text in the confirm button
			document.getElementById("confirm").value = "Confirm Loan Details";
            //insert the new account number
			document.getElementById("accountNumber").innerHTML = getAccountId.response;
			//unlock the new inputs
            document.getElementById("term").readOnly = false;
            document.getElementById("amount").readOnly = false;
            //sets input validity checking on the newly unlocked inputs
			document.getElementById("term").setAttribute(
                "onchange", "this.setCustomValidity('')");
			document.getElementById("term").setAttribute(
                "oninvalid", "this.setCustomValidity(" + 
                "'The term must be a whole numeric character above 0')");
			document.getElementById("amount").setAttribute(
                "onchange", "this.setCustomValidity('')");
			document.getElementById("amount").setAttribute(
                "oninvalid", "this.setCustomValidity(" + 
                "'The amount must be a numeric character above 0.01')");
			document.getElementById("loanForm").setAttribute(
                "onsubmit", "openLoanAccountConfirmation(); return false;");
		};
	}
	getAccountId.open("GET", "newAccountNo.php", true);
	getAccountId.send();
}

function calculateInterest(termId, amountId) {
    //calculates interest and returns the answer in monthly
    //repayment format.  Accurate to two decimal places
	term = parseFloat(document.getElementById(termId).value);
	amount = parseFloat(document.getElementById(amountId).value);
	interest = parseFloat(amount * getRate.response);
	monthlyRepayments = (amount + interest) / term;
	return monthlyRepayments.toFixed(2);
}

function calculateRepayments() {
    //returns the calculated repayments to the relevant places
    //on the html page
    getRate = new XMLHttpRequest();
    if (!(document.getElementById("amount").value == "" || 
          document.getElementById("term").value == "")) {
        getRate.onreadystatechange = function () {	
            if(getRate.status==200 && getRate.readyState==4) {
                if(calculateInterest("term", "amount") == "NaN") {
                    document.getElementById("payments").innerHTML = "";
                } else {
                    document.getElementById("payments").innerHTML = "€" + 
                        calculateInterest("term", "amount") +" Monthly";
				}
            }
        }
    } else {
        document.getElementById("payments").innerHTML = "";
    }
    getRate.open("GET", "getLoanRate.php", true);
    getRate.send();
}

function openLoanAccountConfirmation() { 
	document.getElementById("confirm").value = "Open Account";
	document.getElementById("term").readOnly = true;
	document.getElementById("amount").readOnly = true;
	var con = confirm("Open Account With the supplied details? " + 
                      "(Confirming will open a new Loan Account and " + 
                      "debit the Principal Sum of the loan from it.  " + 
                      "Clearing will reset the form.)");
	
	if(con){
		openLoanAccount();
	} else {
		clearForm();
	}
}

function openLoanAccount() { 
    //Opens loan account with the appropriate details
    //details are sent as a JSON object, and decoded on the 
    //other side
	var accountNumber = document.getElementById("accountNumber").innerHTML;
	var loanAmount = document.getElementById("amount").value;
	var term = document.getElementById("term").value;
	var customerNumber = document.getElementById("customerNumber").value;
	var monthlyRepayment = calculateInterest("term", "amount");
	var accountType = "loan";
	var JSONDetails = '{"accountNumber":"' + accountNumber 
							+ '","loanAmount":"' + loanAmount 
							+ '","term":"' + term 
							+ '","customerNumber":"' + customerNumber 
							+ '","accountType":"' + accountType 
							+ '","monthlyRepayment":"' + monthlyRepayment 
							+ '"}';
	var JSONDetailObj = JSON.parse(JSONDetails);
	sendAccountData = new XMLHttpRequest();
	sendAccountData.onreadystatechange = function () {
		if(sendAccountData.status==200 && sendAccountData.readyState==4) {
			if(sendAccountData.response) {
				alert("Successfully opened account for customer with supplied details!");
                console.log(sendAccountData.response);
				clearForm();
			}
		}
	}
	sendAccountData.open("POST", "openLoanAccount.php", true);
	sendAccountData.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	sendAccountData.send("details=" + JSON.stringify(JSONDetailObj));
}

/*-----------------------------END AJAX---------------------------*/