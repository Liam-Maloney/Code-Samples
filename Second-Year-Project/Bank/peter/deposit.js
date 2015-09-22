/*

Group:				BANK
Student Number:		C00186095
Student Name:		CIARA MCMAHON
Description:		Java script file contains functions used for the following screens
					Calculate Interest on Deposit Account
					Open a Deposit Account
					Close a Deposit Account
					View a Deposit Account
					Deposit Account History

*/


function populate()
{
	// method to populate customer number listbox with details from customer table in bank database 
		// -------------- populate the customer details ----------------------------------

	var details = document.getElementById("listbox");
	var result = details.options[details.selectedIndex].value;
	var customerDetails = result.split('#');
	
	document.getElementById("customerIdDiv").innerHTML = customerDetails[0];
	document.getElementById("customerId").value = customerDetails[0];
	document.getElementById("customerNameDiv").innerHTML = customerDetails[1];
	document.getElementById("customerName").value = customerDetails[1];
	
	//document.getElementById("nameListbox").value = [1];	// populate name listbox with customer name
	
	document.getElementById("customerAddressDiv").innerHTML = customerDetails[2];
	document.getElementById("customerAddress").value = customerDetails[2];
	document.getElementById("customerDOBDiv").innerHTML = customerDetails[3];
	document.getElementById("customerDOB").value = customerDetails[3];
	
	// -------------- populate the deposit account details ----------------------------------
			var details2 = document.getElementById("listbox_account");
			var result = details.options[details2.selectedIndex].value;
			var accountDetails = result.split('#');
	
			document.getElementById("accountIdDIV").innerHTML = accountDetails[4];
			document.getElementById("accountID").value = accountDetails[4];
		
			document.getElementById("balanceDIV").innerHTML = accountDetails[5];
			document.getElementById("balance").value = accountDetails[5];
	
}


function fillBox()
{
	// method to populate customer name listbox with details from customer table in bank database 
	// -------------- populate the customer details ----------------------------------
	var details = document.getElementById("nameListbox");
	var result = details.options[details.selectedIndex].value;
	var customerDetails = result.split('#');
	
	document.getElementById("customerIdDiv").innerHTML = customerDetails[0];
	document.getElementById("customerId").value = customerDetails[0];
	
	
	document.getElementById("customerNameDiv").innerHTML = customerDetails[1];
	document.getElementById("customerName").value = customerDetails[1];
	
	
	document.getElementById("customerAddressDiv").innerHTML = customerDetails[2];
	document.getElementById("customerAddress").value = customerDetails[2];
	document.getElementById("customerDOBDiv").innerHTML = customerDetails[3];
	document.getElementById("customerDOB").value = customerDetails[3];
	
	// -------------- populate the deposit account details ----------------------------------
			var details2 = document.getElementById("listbox_account");
			var result = details.options[details2.selectedIndex].value;
			var accountDetails = result.split('#');
	
			document.getElementById("accountIdDIV").innerHTML = accountDetails[4];
			document.getElementById("accountID").value = accountDetails[4];
		
			document.getElementById("balanceDIV").innerHTML = accountDetails[5];
			document.getElementById("balance").value = accountDetails[5];	
	
}

function fillAccount()
{
	// method to populate account details in view_deposit_ac.html.php
	
	var details = document.getElementById("listbox_account");
	var result = details.options[details.selectedIndex].value;
	var accountDetails = result.split(',');
	
	document.getElementById("accountIdDIV").innerHTML = accountDetails[0];
	document.getElementById("accountID").value = accountDetails[0];
	
	document.getElementById("balanceDIV").innerHTML = accountDetails[1];
	document.getElementById("balance").value = accountDetails[1];


}

function toggleLock()
{
	
	
	if(document.getElementById("confirm").value == "Confirm Customer Details")
	{
		// will disable customer fields - will be Read only.
		
		document.getElementById("customerId").disabled = true;
		document.getElementById("customerName").disabled = true;
		document.getElementById("customerAddress").disabled = true;
		document.getElementById("customerDOB").type = "date";
		document.getElementById("customerDOB").disabled = true;
		document.getElementById("confirm").value = "Create Deposit Account";
	}
	else
	{
		document.getElementById("customerId").disabled = false;
		document.getElementById("customerName").disabled = false;
		document.getElementById("customerAddress").disabled = false;
		document.getElementById("customerDOB").disabled = false;
		document.getElementById("confirm").value = "Account Details";
	}
}


function confirmDetails() 
{

	if(document.getElementById("confirm").value == "submit")
		{
			document.getElementById("confirm").type = "submit";
		}
	else{
			var response = confirm('Are these customer details correct ?');
	
			if(response)
			{
				document.getElementById("listbox").disabled = true;			// disable listboxs when details are confirmed
				document.getElementById("nameListbox").disabled = true;

				document.getElementById("balance").disabled = false;
				document.getElementById("confirm").type = "button";
				document.getElementById("confirm").value = "submit";
			
				return true;
			}
	}
	//var response = confirm('Are these customer details correct ?');
	

}

function checkClear()
{
	// if clear button clicked, ensure user wants details cleared from form
	confirm("are you sure you want to clear these customer details ?");
	if(confirm)
	{
	
		document.getElementById("customerId").innerHTML = "<br> ";
		document.getElementById("customerName").innerHTML = "<br>";
		document.getElementById("customerAddress").innerHTML = "<br><br><br><br>";
		document.getElementById("customerDOB").innerHTML = "<br>";
		
	
	
	document.getElementById("customerIdDiv").innerHTML = "</br>";	
	document.getElementById("customerNameDiv").innerHTML = "</br>";
	document.getElementById("customerAddressDiv").innerHTML = "</br></br></br></br>";
	document.getElementById("customerDOBDiv").innerHTML = "</br>";
	
	
	}
	else
	{
		return false
	}
}

function check()
{
	var ok = confirm("Are all the details correct?");
	
	if(ok)
	{
		return true;
	}
	else 
	{
		return false;
	}
}


