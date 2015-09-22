<?php 
/*
* File Produced By: Tom Anderson - C00174844 - 2015
* Purpose: 			
*/
include "verify_user.php";
$_SESSION['helptext'] = "To View or Edit a customer record : <br><br>".
						"Enter or select the customer name or number from the appropriate select customer box<br><br>".
						"Click Amend when the correct customer is selected. <br><br>".
						"Edit the details and click save, check the record and confirm when prompted.";
include 'head.php';
?>
            <form name="amend_customer" id="amend_customer" method="post" onsubmit="return confirmCheck()" action="amend_customer.php" >             
                <h2>Amend Customer  <img src="../common/images/help-01.png" alt="Help" id="helpbtn" onmousedown="frameToggleHelp() " > </h2>          
			  <fieldset class="fullwidth$">
			  <legend>Select Customer</legend>
			  	<label for="selectnumber">Customer Number :</label>
						<?php
						include 'cust_no_datalist.php';
						?>
						
						<label for="selectname">Customer Name :</label>
						<?php
						include 'cust_name_datalist.php';
						?>
                        
			  </fieldset>
			  
			  <fieldset class="halfwidth"> 
                		<legend> Name / Address </legend>
						 <label for="fname">First Name :</label>
						 <input type="text"id="fname" name="fname"  required disabled pattern=[a-zA-Z -]+"  title="Please use letters of the alphabet, spaces and hyphens only" />  <br />
						<label for="sname">Surname :</label>
						<input type="text" name="sname" id="sname" required disabled pattern=[a-zA-Z -]+"  title="Please use letters of the alphabet, spaces and hyphens only" />  
						
                        <label for ="address1">Address 1 :</label>
                        <input type="text" id="address1" name="address1" pattern="[0-9a-zA-Z ,.-]+" required disabled title="Please use letters of the alphabet, numbers, spaces, full stops, and hyphens only" /><br />
						<label for ="address2">Address 2 :</label>
                        <input type="text"id="address2" name="address2" disabled  pattern="[a-zA-Z ,.-]+"  title="Please use letters of the alphabet, spaces, full stops, and hyphens only" /><br />
						<label for ="town">Town :</label>
                        <input type="text"id="town" name="town" pattern="[a-zA-Z .]+" required  disabled  title="Please use letters of the alphabet, spaces or full stops only" /><br />
						<label for ="county">County :</label>
                        <select id="county" name="county" required title="Please select a county"  disabled >
                                                        <option selected disabled hidden value=''></option>
							<option value="Antrim">Antrim</option>
							<option value="Armagh">Armagh</option>
							<option value="Carlow">Carlow</option>
							<option value="Cavan">Cavan</option>
							<option value="Clare">Clare</option>
							<option value="Cork">Cork</option>
							<option value="Derry">Derry</option>
							<option value="Donegal">Donegal</option>
							<option value="Down">Down</option>
							<option value="Dublin">Dublin</option>
							<option value="Fermanagh">Fermanagh</option>
							<option value="Galway">Galway</option>
							<option value="Kerry">Kerry</option>
							<option value="Kildare">Kildare</option>
							<option value="Kilkenny">Kilkenny</option>
							<option value="Laois">Laois</option>
							<option value="Leitrim">Leitrim</option>
							<option value="Limerick">Limerick</option>
							<option value="Longford">Longford</option>
							<option value="Louth">Louth</option>
							<option value="Mayo">Mayo</option>
							<option value="Meath">Meath</option>
							<option value="Monaghan">Monaghan</option>
							<option value="Offaly">Offaly</option>
							<option value="Roscommon">Roscommon</option>
							<option value="Sligo">Sligo</option>
							<option value="Tipperary">Tipperary</option>
							<option value="Tyrone">Tyrone</option>
							<option value="Waterford">Waterford</option>
							<option value="Westmeath">Westmeath</option>
							<option value="Wexford">Wexford</option>
							<option value="Wicklow">Wicklow</option>
						</select>
						 </fieldset>
						 
		<fieldset class="halfwidth"> 
                	<legend> Details </legend>
						
                        <label for="dob">Date of Birth :</label>
                        <input type="date" id="dob" name="dob"  required  disabled  onblur="checkDatePast(this.value)"/><br />
                        <label for="phone">Telephone :</label>
                        <input type="text"id="phone" name="phone"  required disabled  pattern="[0-9 -]+" title="Please use numbers, spaces, or hyphens only"/><br />
                        <label for="occupation">Occupation :</label>
                        <input type="text"id="occupation" name="occupation"  required  disabled pattern="[a-zA-Z -]+" title="Please use letters of the alphabet, spaces or hyphens only"  /><br />
						<label for="salary">Salary :</label>
                        <input type="text"id="salary" name="salary" required  disabled pattern="[0-9.]+"/ title="Please use numbers only" ><br />
						<label for="myemail">Email :</label>
                        <input type="email" id="myemail" name="myemail"  disabled  required /><br />
						<label for="guarantor">Guarantor :</label>
                        <input type="text"id="guarantor" name="guarantor"  disabled  pattern="[a-zA-Z -]+"  title="Please use letters of the alphabet, spaces or hyphens only" /><br />
						
                      </fieldset>
                <input type="button" name="actionbtn" id="actionbtn" value="Amend" onclick="unLock()"></input>
                <input type="reset" name="clear" value="Clear" onclick="lock()" ></input>

            </form>
<script>                                                        
function populate(index)
{	//Check where the index came from and use the appropriate array
	if ( noarray[index] !== undefined && index == noarray[index].id) {
		var details = noarray[index];
	} else if ( namearray[index] !== undefined && index == namearray[index].sname + ", " + namearray[index].fname ){
		var details = namearray[index];
	//clear all the boxes and quit if the index is invalid
	} else {
		document.getElementById("selectnumber").value = "";
		document.getElementById("selectname").value = "";
		document.getElementById("selectnumber").value = "";
		document.getElementById("fname").value = "";
		document.getElementById("sname").value = "";
		document.getElementById("address1").value = "";
		document.getElementById("address2").value = "";
		document.getElementById("town").value = "";
		document.getElementById("county").value = "";
		document.getElementById("dob").value = "";
		document.getElementById("phone").value = "";
		document.getElementById("myemail").value = "";
		document.getElementById("occupation").value = "";
		document.getElementById("salary").value = "";
		document.getElementById("guarantor").value = "";
		imatchHeight() ;
		return 1;
	}
	//set all the outputs to the values related to the selected item
	try {		
		document.getElementById("normalname").innerHTML = details.normalname;
		document.getElementById("address").innerHTML = details.address;
		document.getElementById("dob").innerHTML = details.dob;	
		document.getElementById("phone").innerHTML = details.phone;
	} catch (error){
		document.getElementById("fname").value = details.fname;
		document.getElementById("sname").value = details.sname;
		document.getElementById("address1").value = details.address1;
		document.getElementById("address2").value = details.address2;
		document.getElementById("town").value = details.town;
		document.getElementById("county").value = details.county;
		document.getElementById("dob").value = details.dob;	
		document.getElementById("phone").value = details.phone;
		document.getElementById("myemail").value = details.email;
		document.getElementById("occupation").value = details.occupation;
		document.getElementById("salary").value = details.salary;
		document.getElementById("guarantor").value = details.guarantor;
		document.getElementById("selectnumber").value = details.id;
		document.getElementById("selectname").value = details.sname + ", " + details.fname;	
		imatchHeight() ;
		return 0;
	}
		try {
		document.getElementById("myemail").innerHTML = details.email;
		document.getElementById("occupation").innerHTML = details.occupation;
		document.getElementById("salary").innerHTML = details.salary;
		document.getElementById("guarantor").innerHTML = details.guarantor;		
	} catch (error) {
		
	}
	document.getElementById("selectnumber").value = details.id;
	document.getElementById("selectname").value = details.sname + ", " + details.fname;	
	imatchHeight() ;
	}
//confirmation popup 
function confirmCheck()
{	var response;
	response = confirm('Are you sure you want to save the changes?');
	return response;
} 
//function to unlock the read only inputs or submit the form if they have already been unlocked
function unLock()
{	//only run this if we have a valid account selected	
	if (document.getElementById("fname").text != "") {
		
	//if we have already changed the button text to save - change type to submit and the form will submit	
	if (document.getElementById("actionbtn").value == "Save") {
		document.getElementById("selectnumber").disabled = false;
		document.getElementById("actionbtn").type = "submit";
	//otherwise allow user to edit the values - stop user from selecting another customer - and change the button text to save 
	} else {
		document.getElementById("fname").disabled = false;
		document.getElementById("sname").disabled = false;
		document.getElementById("address1").disabled = false;
		document.getElementById("address2").disabled = false;		
		document.getElementById("town").disabled = false;
		document.getElementById("county").disabled = false;		
		document.getElementById("dob").disabled = false;
		document.getElementById("phone").disabled = false;		
		document.getElementById("myemail").disabled = false;
		document.getElementById("occupation").disabled = false;
		document.getElementById("salary").disabled = false;
		document.getElementById("guarantor").disabled = false;
		document.getElementById("selectnumber").disabled = true;
		document.getElementById("selectname").disabled = true;
		document.getElementById("actionbtn").value = "Save";
		document.getElementById("actionbtn").type = "button";
	}		
}}
//function to reset the writeable config of the inputs and the action button when we clear the form 
function lock() {
		
		document.getElementById("fname").disabled = true;
		document.getElementById("sname").disabled = true;
		document.getElementById("address1").disabled = true;
		document.getElementById("address2").disabled = true;
		document.getElementById("town").disabled = true;
		document.getElementById("county").disabled =true;
		document.getElementById("dob").disabled = true;
		document.getElementById("phone").disabled =true;
		document.getElementById("myemail").disabled =true;
		document.getElementById("occupation").disabled =true;
		document.getElementById("salary").disabled = true;
		document.getElementById("guarantor").disabled = true;
		document.getElementById("selectnumber").disabled = false;
		document.getElementById("selectname").disabled = false;
		document.getElementById("actionbtn").value = "Amend";
		document.getElementById("actionbtn").type = "button";
	}
//confirmation popup 
function confirmCheck()
{	var response;
	response = confirm('Are you sure you want to save the changes?');
	return response;
} 
</script>
		</body>	
		
	</html>
			