<?php 
/*
* File Produced By: Tom Anderson - C00174844 - 2015
* Purpose: 		To change the users password	
*/
include "../tom/verify_user.php";
$_SESSION['helptext'] = 'To change your password: <br><br>Enter your existing  password.<br><br>Enter the new password<br><br>Re-enter the new password<br><br>Click the submit button';
include 'head.php';
?> 

<script>
function check() {
	var input = document.getElementById('confirmpass');
  if (input.value != document.getElementById('newpass').value) {
    input.setCustomValidity('The passwords do not match.');
	return false;
  } else {  
    input.setCustomValidity('');
	return true;
  }
} 
</script>


<form name="epass" id="pass" method="post"  action="changepass.php" onsubmit = "return check()" >           
                
	<h2>Change Password <img src="../common/images/help-01.png" alt="Help" id="helpbtn" onmousedown="frameToggleHelp()"> </h2>          
			
				<fieldset id="login">
						 
						<label for="oldpass">Old Password :</label>
						<input type="password" name="oldpass" id="oldpass" required   title="Please enter your password" />  <br />
						
						<label for="newpass">New Password :</label>
						<input type="password" name="newpass" id="newpass"   title="Please enter the new password" />  <br />
						
						<label for="confirmpass">Confirm New Password :</label>
						<input type="password" name="confirmpass" id="confirmpass"   title="Please repeat your new password" oninput="check()" />  <br />
						
				</fieldset>
				  <input type="submit" name="submit" id="submit" value="Save" input>
                <input type="reset" name="clear" value="Clear" ></input>
            </form>

<?php
	if ( ISSET($_SESSION['returnMessage']) )
	{		
		echo "<SCRIPT>alert($_SESSION[returnMessage]);</SCRIPT>";
		unset($_SESSION['returnMessage']);
	}
?>	
		</body>	
	</html>
			