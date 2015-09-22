<?php 
/*
* File Produced By: Tom Anderson - C00174844 - 2015
* Purpose: 			
*/
include "../tom/verify_user.php";
$_SESSION['helptext'] = "To delete a customer :<br> Select the customer from the customer list or enter the customer name or number into the appropriate boxes.<br><br>".
						"Click delete and confirm that the correct customer is selected when prompted.";
include 'head.php';
?>
            <form name="delete_customer" id="delete_customer" method="post" onsubmit="return confirmCheck()" action="delete_customer.php" >             
                <h2>Delete Customer  <img src="../common/images/help-01.png" alt="Help" id="helpbtn" onmousedown="frameToggleHelp() " > </h2>
			  <fieldset class="fullwidth">
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
						<label >Name :</label>
						 <div id="normalname" name="normalname" > <br /></div> 	
                        <label >Address :</label>
                        <div id="address" name="address" /><br /><br /><br /><br /></div>
						 <label >Date of Birth :</label>
                        <div type="date" id="dob" name="dob" ><br /></div>
                        <label >Telephone :</label>
						 <div id="phone" name="phone"><br /></div>
				</fieldset>
						 
		<fieldset class="halfwidth"> 
                	<legend> Details </legend>

                        <label>Occupation :</label>
                        <div id="occupation" name="occupation" ><br /></div>
						<label >Salary :</label>
                        <div id="salary" name="salary"><br /></div>
						<label >Email :</label>
                        <div id="myemail" name="myemail"><br /></div>
						<label >Guarantor :</label>
                        <div id="guarantor" name="guarantor"><br /></div>
						
                      </fieldset>
                <input type="submit" name="actionbtn" id="actionbtn" value="Delete"></input>
                <input type="reset" name="clear" value="Clear" ></input>
			 
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
</script>
<?php
	if ( ISSET($_SESSION['returnMessage']) )
	{		
		echo "<SCRIPT>alert($_SESSION[returnMessage]);</SCRIPT>";
		unset($_SESSION['returnMessage']);
	}
	?>	
		</body>	
	</html>
		
	