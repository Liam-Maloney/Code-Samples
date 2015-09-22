	<?php 
	/*
	* File Produced By: Tom Anderson - C00174844 - 2015
	* Purpose: 			To add a customer to the database
	*/
	include "verify_user.php";
	/* set the help text */
	$_SESSION['helptext'] = "To add a customer : <br //><br //> (1) Enter the appropriate details in the fields provided.<br //>".
							"<br //>(2)When the details are entered click the Save button to save the customer and confirm that the details are correct when prompted.<br //>".
							
							"<br //><br //>The Address 2 and Guarantor fields are optional, all other fields are required. The form may be reset at any time by clicking the clear button";
	include 'head.php';
	?>
	            <form name="add_customer" id="add_customer" method="post"  action="add_customer.php" onsubmit="return confirm('Please confirm these details are correct')" >             
	                <h2>Add Customer  <img src="../common/images/help-01.png" alt="Help" id="helpbtn" onmousedown="frameToggleHelp()" > </h2>          
	                    <fieldset class="halfwidth"> 
	                		<legend> Name / Address </legend>
							<label for="firstname">First Name :</label>
							<input type="text" name="firstname" id="firstname" required pattern="[a-zA-Z-]+"  title="Please use letters of the alphabet and hyphens only" />  
							<label for="surname">Surname :</label>
							<input type="text" name="surname" id="surname" required pattern="[a-zA-Z -]+"  title="Please use letters of the alphabet, spaces and hyphens only" />
	                        <label for ="address1">Address 1 :</label>
	                        <input type="text" id="address1" name="address1" pattern="[0-9a-zA-Z ,.-]+" required  title="Please use letters of the alphabet, numbers, spaces, full stops, and hyphens only" /><br />
							<label for ="address2">Address 2 :</label>
	                        <input type="text"id="address2" name="address2" pattern="[a-zA-Z ,.-]+"  title="Please use letters of the alphabet, spaces, full stops, and hyphens only" /><br />
							<label for ="town">Town :</label>
	                        <input type="text"id="town" name="town" pattern="[a-zA-Z .]+"required title="Please use letters of the alphabet, spaces or full stops only" /><br />
							<label for ="county">County :</label>
	                        <select id="county" name="county" required title="Please select a county">
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
	                    <!-- END HALF WIDTH ADDRESS-->

	                      <fieldset class="halfwidth"> 
	                	<legend> Details </legend>
	                        <label for="dob">Date of Birth :</label>
	                         <input type="date" id="dob" name="dob"  required  onblur="checkDatePast(this.value)"/><br />
	                        <label for="phone">Telephone :</label>
	                        <input type="text"id="phone" name="phone"  required pattern="[0-9 -]+" title="Please use numbers, spaces, or hyphens only"/><br />
	                        <label for="occupation">Occupation :</label>
	                        <input type="text"id="occupation" name="occupation"  required pattern="[a-zA-Z -]+" title="Please use letters of the alphabet, spaces or hyphens only"  /><br />
							<label for="salary">Salary :</label>
	                        <input type="text"id="salary" name="salary" required pattern="[0-9.]+"/ title="Please use numbers only" ><br />
							<label for="myemail">Email :</label>
	                        <input type="email" id="myemail" name="myemail"  required /><br />
							<label for="guarantor">Guarantor :</label>
	                        <input type="text"id="guarantor" name="guarantor" pattern="[a-zA-Z -]+"  title="Please use letters of the alphabet, spaces or hyphens only" /><br />
							
	                      </fieldset>
	                
	                <input type="reset" name="clear" value="Clear"></input>
	                <input type="submit" name="submit" value="Save"></input>

	            </form>
		<?php
		/* pop up a confirmation message  when we successfully create an account */
		if (ISSET ($_SESSION['accountNumber']))
		{
			echo "<script>alert('Created account No ". $_SESSION['accountNumber'] . " for customer " . $_SESSION['firstname']." ".$_SESSION['surname']."');</script>";
		}
		unset( $_SESSION['accountNumber']);
		
		?>
			</body>	
			
		</html>
				