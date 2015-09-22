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

function pop(caller) 
{	//populate function for adment current account
	var Details;
	var targetID;
	var result;

	if( caller.name == "UserID")
	{
		Details = document.getElementById('listbox');
		targetID = document.getElementById(caller.value);
		
		if(targetID == null)
			clean();	
		
		result = targetID.value;
		
		document.getElementById('listbox').disabled =true;
	}
	else if( caller.name == "AccountID")
	{
		Details = document.getElementById('listbox');
		targetID = document.getElementById(caller.value);
		
		if(targetID == null)
			clean();
		else	
			result = targetID.value;
		
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
	document.getElementById("AccID").innerHTML = personalDetails[2];
	document.getElementById("AccountID").value = personalDetails[2];
	document.getElementById("Balance").innerHTML = personalDetails[3];
	document.getElementById("Limit").innerHTML = personalDetails[4];
	
	document.getElementById('listbox').disabled =false;
}/*end of pop*/

function closing(caller) 
{	//populate function for adment current account
	var Details;
	var targetID;
	var result;

	if( caller.name == "UserID")
	{
		Details = document.getElementById('listbox');
		targetID = document.getElementById(caller.value);
		
		if(targetID == null)
			clean();	
		
		result = targetID.value;
		
		document.getElementById('listbox').disabled =true;
	}
	else if( caller.name == "AccountID")
	{
		Details = document.getElementById('listbox');
		targetID = document.getElementById(caller.value);
		
		if(targetID == null)
			clean();
		else	
			result = targetID.value;
		
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
	document.getElementById("Home").innerHTML = personalDetails[2];
	document.getElementById("DOB").innerHTML = personalDetails[3];
	document.getElementById("AccID").innerHTML = personalDetails[4];
	document.getElementById("AccountID").value = personalDetails[4];
	document.getElementById("Balance").innerHTML = personalDetails[5];
	document.getElementById("Limit").innerHTML = personalDetails[6];
	
	document.getElementById('listbox').disabled =false;
}/*end of closing*/

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
		document.getElementById('listbox').disabled = true; //if the lsitbox is not disabled it check the list box  to the 
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
	Showdetails(personalDetails[0]);//this is to pass the user ID to the account list
	
	document.getElementById('listbox').disabled =false;
}/*end of Withdraw*/

function Showdetails(Customer)
{
	var Details = document.getElementById('Accountlist');
	var loop=1;
	var accountDetails;
	var checkdetails;
	
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
			document.getElementById("AccID").innerHTML = "</br>";
			document.getElementById("Balance").innerHTML = "</br>";
		}
		loop++;
	}
}

function showBal()
{
	var Details = document.getElementById('Accountlist');
	var result = Details.options[Details.selectedIndex].value;
	
	var personalDetails = result.split(',');
	document.getElementById("AccID").innerHTML = personalDetails[0];
	document.getElementById("Balance").innerHTML = personalDetails[1];
	
}

function myCreate()
{
var reponse = confirm("Are you sure you want to proceed with this action");

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

function empty()
{	/*this function is used to clear the divs for the customer detail breaks are used to keep everything the same size
	this function is to clear the open current account page*/
	document.getElementById("CustomerID").innerHTML = "</br>";	
	document.getElementById("CustomerName").innerHTML = "</br>";
	document.getElementById("CustomerAddress").innerHTML = "</br></br></br></br>";
	document.getElementById("CustomerDOB").innerHTML = "</br>";
	
}/*end of empty*/

function clean()
{	//to clear the divs in the admend file
	document.getElementById("CustomerID").innerHTML = "</br>";	
	document.getElementById("CustomerName").innerHTML = "</br>";
	document.getElementById("AccID").innerHTML = "</br>";
	document.getElementById("Balance").innerHTML = "</br>";
	document.getElementById("Limit").innerHTML = "</br>";
}/*end of clear*/

function Cleanup()
{ 
	var Details = document.getElementById('Accountlist');
	var loop=1;

	while(loop <= Details.options.length)
	{
		Details.options[loop].hidden = true;	
		loop++;
	}
	
	document.getElementById("CustomerID").innerHTML = "</br>";	
	document.getElementById("CustomerName").innerHTML = "</br>";
	document.getElementById("CustomerAddress").innerHTML = "</br></br></br></br>";
	document.getElementById("CustomerDOB").innerHTML = "</br>";
	document.getElementById("accountDetails").innerHTML = "</br>";
	document.getElementById("Balance").innerHTML = "</br>";
}