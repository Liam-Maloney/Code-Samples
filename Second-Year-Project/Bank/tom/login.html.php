<?php 
/*
* File Produced By: Tom Anderson - C00174844 - 2015
* Purpose: 			
*/
session_start();
$_SESSION['helptext'] = "Enter a valid username and password combination.<br>You have up to three attempts.<br>";
include 'head.php';
?>
		 
<form name="userlogin" id="userlogin" method="post"  action="login.php" >           
                
	<h2>User Login  <img src="../common/images/help-01.png" alt="Help" id="helpbtn" onmousedown="frameToggleHelp()"> </h2>          
			
				<fieldset id="login">
						 <label for="username">User Name :</label>
						 <input type="text" id="username" name="username" required    title="Please enter a valid username using upper and/or lowercase letters and spaces only" pattern="[a-zA-Z ]+" />  <br />
						<label for="password">Password :</label>
						<input type="password" name="password" id="sname" required   title="Please enter your password" />  <br />
						
				</fieldset>
				  <input type="submit" name="submit" id="submit" value="Login" input>
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
			