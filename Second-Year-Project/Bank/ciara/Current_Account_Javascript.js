/*The following code is broken in to different section based of the file being used*/


/* Open Current Account Java functions*/
function populate(caller) 
{	//populat function for open current account
	var Details;
	var targetID;
	var result;

	if( caller.name == "UserID")
	{	Details = document.getElementById('listbox');
		targetID = document.getElementById(caller.value);
		
		if(targetID == null)
		{
			empty();
		}	
		else{result = targetID.value;}
		
		document.getElementById('listbox').disabled =true; //if the lsitbox is not disabled it check the list box  to the 
	}
	else
	{	Details = document.getElementById('listbox');
		result = Details.options[Details.selectedIndex].value;
	}
	
	var personalDetails = result.split(',');
	document.getElementById("CustomerID").innerHTML = personalDetails[0];
	document.getElementById("UserID").value= personalDetails[0];
	document.getElementById("CustomerName").innerHTML = personalDetails[1];
	document.getElementById("CustomerAddress").innerHTML = personalDetails[2];
	document.getElementById("CustomerDOB").type = "text";
	document.getElementById("CustomerDOB").innerHTML = personalDetails[3];
	
	document.getElementById('listbox').disabled =false;
}/*end of populate*/

function empty()
{	/*this function is used to clear the divs for the customer detail breaks are used to keep everything the same size
	this function is to clear the open current account page*/
	document.getElementById("CustomerID").innerHTML = "</br>";	
	document.getElementById("CustomerName").innerHTML = "</br>";
	document.getElementById("CustomerAddress").innerHTML = "</br></br></br></br>";
	document.getElementById("CustomerDOB").innerHTML = "</br>";
	
}/*end of empty*/

function myCreate()
{
var reponse = confirm("Are you sure hyou want to proceed with this action");

	if(reponse == true)
	{	// this one is for the open current account
		alert("A new current account has been created for customer account: " + document.getElementById("UserID").value);
		return true;
	}
	else
	{	
		return false;
	}
}/* end of myCreate*/
/*This ends the Open current account functions*/

/*This beings the Amend current account functions*/
function pop(caller) 
{	//populate function for close & admend current account
	var Details;
	var targetID;
	var result;

	if(caller.name == "UserID")
	{
		Details = document.getElementById('listbox');
		targetID = document.getElementById(caller.value);
		
		if(targetID == null)
		{
			clean();	
		}
		else
		{
			result = targetID.value;
		}
		document.getElementById('listbox').disabled =true;
	}
	else
	{
		Details = document.getElementById('listbox');
		result = Details.options[Details.selectedIndex].value;
	}
	
	var personalDetails = result.split(',');
	document.getElementById("UserID").value= personalDetails[0];
	document.getElementById("CustomerID").innerHTML = personalDetails[0];
	document.getElementById("CustomerName").innerHTML = personalDetails[1];
	
	document.getElementById("Home").innerHTML = personalDetails[3];
	document.getElementById("DOB").innerHTML = "text";
	document.getElementById("DOB").innerHTML = personalDetails[4];
	ShowAccounts(personalDetails[0]);//this is to pass the user ID to the account list
	
	document.getElementById('listbox').disabled =false;
}/*end of pop*/

function clean()
{	//to clear the divs in the admend file
	document.getElementById("CustomerID").innerHTML = "</br>";	
	document.getElementById("CustomerName").innerHTML = "</br>";
	document.getElementById("Balance").innerHTML = "</br>";
	document.getElementById("Limit").innerHTML = "</br>";
}/*end of clean*/

function myUpdate()
{// this one is for the open current account
var reponse = confirm("Are you sure you want to proceed with this action");

	if(reponse == true)	{	
		alert("Account " + document.getElementById("AccountID").value + " has been updated");
		return true;
	}
	else{	
		return false;
	}
}/* end of myUpdate*/
/*This ends the Amend current account functions*/

/*This beings the Close current account functions*/
function closing(caller) 
{	//populate function for adment current account
	var Details;
	var targetID;
	var result;

	if(caller.name == "UserID")
	{
		Details = document.getElementById('listbox');
		targetID = document.getElementById(caller.value);
		
		if(targetID == null)
		{
			cleaning();	
		}
		else
		{
			result = targetID.value;
		}
		document.getElementById('listbox').disabled =true;
	}
	else
	{
		Details = document.getElementById('listbox');
		result = Details.options[Details.selectedIndex].value;
	}
	
	var personalDetails = result.split(',');
	document.getElementById("CustomerID").innerHTML = personalDetails[0];
	document.getElementById("CustomerName").innerHTML = personalDetails[1];
	document.getElementById("Home").innerHTML = personalDetails[2];
	document.getElementById("DOB").innerHTML = personalDetails[3];
	document.getElementById("AccountID").value = personalDetails[4];
	document.getElementById("Balance").innerHTML = personalDetails[5];
	document.getElementById("Limit").innerHTML = personalDetails[6];
	
	document.getElementById('listbox').disabled =false;
}/*end of closing*/

function cleaning()
{	//to clear the divs in the admend file
	document.getElementById("CustomerID").innerHTML = "</br>";	
	document.getElementById("CustomerName").innerHTML = "</br>";
	document.getElementById("AccID").innerHTML = "</br>";
	document.getElementById("Balance").innerHTML = "</br>";
	document.getElementById("Limit").innerHTML = "</br>";
	document.getElementById("Home").innerHTML = "</br></br></br></br>";
	document.getElementById("DOB").innerHTML = "</br>";
}/*end of cleaning*/

function myDelete()
{
var reponse = confirm("Are you sure you want to proceed with this action");

	if(reponse == true)
	{	// this one is for the admend & close current account pages
		alert("Account " + document.getElementById("AccountID").value + " has been closed");
		return true;
	}
	else
	{	
		return false;
	}
}/* end of myDelete*/
/*This ends the Close current account functions*/

/*The following function is share by bought Admend & close */
function myAccounts()
{ 
	var Details = document.getElementById('Accounts');
	var result = Details.options[Details.selectedIndex].value;
	
	var personalDetails = result.split(',');
	document.getElementById("AccID").value = personalDetails[1];
	document.getElementById("Balance").value = personalDetails[2];
	document.getElementById("Limit").value = personalDetails[3];
}

function ShowAccounts(Customer)
{
	var Details = document.getElementById('Accounts');
	var loop=1;
	var accountDetails;
	
	while(loop <= Details.options.length)
	{
		accountDetails = Details.options[loop].value;
		accountDetails = accountDetails.split(',');
		
		if(Customer == accountDetails[0])
		{
			Details.options[loop].hidden = false;	
		}
		else
		{
			Details.options[loop].hidden = true;
			Details.selectedIndex.hidden =true;
			document.getElementById("AccID").value = "";
			document.getElementById("Balance").value = "";			
			document.getElementById("Limit").value = "";
			}
		loop++;
	}
}/*end of ShowAccounts()*/

/*This beings the  Withdraw from accounts functions*/
function Withdraw(caller) //populate function for the withdrawals page
{	
	var Details;
	var targetID;
	var result;
	var personalDetails;
	
	if( caller.name == "UserID")
	{
		Details = document.getElementById('listbox');
		targetID = document.getElementById(caller.value);
		
		if(targetID == null)
		{
			Cleanup();
		}
		else{
			result = targetID.value;
		}
//		document.getElementById('listbox').disabled = true; //if the lsitbox is not disabled it check the list box  to the 
	}
	else
	{
		Details = document.getElementById('listbox');
		result = Details.options[Details.selectedIndex].value;
	} 

	personalDetails = result.split(',');
	document.getElementById("CustomerID").innerHTML = personalDetails[0];
	document.getElementById("UserID").value= personalDetails[0];
	document.getElementById("CustomerName").innerHTML = personalDetails[1];
	document.getElementById("CustomerAddress").innerHTML = personalDetails[2];
	document.getElementById("CustomerPhone").innerHTML = personalDetails[3];
	Showdetails(personalDetails[0]);//this is to pass the user ID to the account list
	
	document.getElementById('listbox').disabled =false;
}/*end of Withdraw*/

function Showdetails(Customer)
{
	var Details = document.getElementById('Accountlist');
	var loop=1;
	var accountDetails;
	
	while(loop < Details.options.length)
	{
		accountDetails = Details.options[loop].value;
		accountDetails = accountDetails.split(',');
		
		if(Customer == accountDetails[0])
		{
			Details.options[loop].hidden = false;	
		}
		else
		{
			Details.options[loop].hidden = true;
			Details.selectedIndex.hidden =true;
			document.getElementById("AccountID").value = "";
			document.getElementById("Balance").value = "";
		}
		loop++;
	}
}/*end of Showdetails()*/

function Cleanup()
{ 
	var Details = document.getElementById('Accountlist');
	var loop=1;

	document.getElementById("CustomerID").innerHTML = "</br>";	
	document.getElementById("CustomerName").innerHTML = "</br>";
	document.getElementById("CustomerAddress").innerHTML = "</br></br></br></br>";
	document.getElementById("CustomerPhone").innerHTML = "</br>";
	while(loop <= Details.options.length)
	{
		Details.options[loop].hidden = true;	
		loop++;
	}
}

function Withdrawn()
{
var reponse = confirm("Are you sure you want to proceed with this transaction");

	if(reponse == true)
	{	// this one is for the admend & close current account pages
		alert("Account " + document.getElementById("AccID").value + " has been deducted " +  document.getElementById("Amount").value);
		return true;
	}
	else
	{	
		return false;
	}
}/* end of myDelete*/
/*This ends the Withdraw account functions*/

/*This beings the charge current form accounts functions*/
function Charge() 
{	//populate the charge overdraft form for current account
	var Details;
	var targetID;
	var result;

	Details = document.getElementById('listbox');
	result = Details.options[Details.selectedIndex].value;
	
	var personalDetails = result.split(',');
	document.getElementById("CustomerID").innerHTML = personalDetails[0];
	document.getElementById("CustomerName").innerHTML = personalDetails[1];
	document.getElementById("CustomerAddress").innerHTML = personalDetails[2];
	document.getElementById("CustomerPhone").type = "text";
	document.getElementById("CustomerPhone").innerHTML = personalDetails[3];
	Showdetails(personalDetails[0]);	
}/*end of Charge*/

function Tidy()
{	/*this function is used to clear the divs for the customer detail breaks are used to keep everything the same size
	this function is to clear the open current account page*/
	document.getElementById("CustomerID").innerHTML = "</br>";	
	document.getElementById("CustomerName").innerHTML = "</br>";
	document.getElementById("CustomerAddress").innerHTML = "</br></br></br></br>";
	document.getElementById("CustomerPhone").innerHTML = "</br>";
	
}/*end of empty*/

function Chargedrates()
{	var reponse = confirm("Are you sure you want to proceed with this transaction");

	if(reponse == true)
	{	alert("Account " + document.getElementById("AccID").value + " has been charged overdraft of " +  document.getElementById("Amount").value);
		return true;
	}
	else
	{	
		return false;
	}
}/* end of myDelete*/

function showCharge()
{ //Please note that this function is also used buy the charge rates
	var Details = document.getElementById('Accountlist');
	var result = Details.options[Details.selectedIndex].value;
	
	var personalDetails = result.split(',');
	document.getElementById("AccountID").value = personalDetails[1];
	document.getElementById("Balance").value = personalDetails[2];
	document.getElementById("IntRates").value = personalDetails[3];
}

function showBal()
{ //Please note that this function is also used buy the charge rates
	var Details = document.getElementById('Accountlist');
	var result = Details.options[Details.selectedIndex].value;
	
	var personalDetails = result.split(',');
	document.getElementById("AccID").value = personalDetails[1];
	document.getElementById("AccType").value = personalDetails[2];
	document.getElementById("Balance").value = personalDetails[3];
}

function enable(sender)
{
	sender.disabled=false;
}