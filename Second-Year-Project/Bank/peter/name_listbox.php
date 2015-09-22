<?php

include '../common/db.inc.php';

date_default_timezone_set('Europe/London');			// set time to database format
	$sql = "SELECT customerNumber, firstName,surname,address1,address2,address_town,address_county,birthDate 
	FROM customer 
		
	ORDER BY surname desc ";			// order by surname in descending order and exclude any customer who have been flagged as deleted
	
	if(!$result = mysql_query($sql,$con)) 		// check if query is correct
	{
		die('Error in querying the database' . mysql_error());
	}
	
	
	echo "<select name = 'nameListbox' id = 'nameListbox' onclick = 'fillBox()'>";
	
	
	while($row = mysql_fetch_array($result))
	{
		$id = $row['customerNumber'];
		$name = $row['firstName'] . " " .  $row['surname'];
		$reverseName = $row['surname'].", ". $row['firstName'];
		$dob = $row['birthDate'];
		$dob = date("Y-m-d", strtotime($dob));
		$address = $row['address1'] . "<br>" . $row['address2'] . "<br>" . $row['address_town'] . "<br>" . $row['address_county'];		// concatenate address to one string
		$display = "$id#$name#$address#$dob";
		
		echo "<option value = '$display'>$reverseName </option>";
	}
	
	echo "</select>";
		
	mysql_close($con);

?>