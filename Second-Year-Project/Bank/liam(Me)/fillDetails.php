<?php
/*
AUTHOR:     Liam Maloney
PURPOSE:    This returns customer details
            belonging to undeleted customers
            whose details match either an account
            number or a name (these details are)
            posted in using 'callingInput' and 
            'identifier'
DATE:       23 March 2015
*/
	include 'db.inc.php';
	$query =    "SELECT customerNumber, 
                    firstName, surname, 
                    address1, address2, 
                    address_town, address_county, 
                    birthDate, telephone 
                FROM customer 
                WHERE " . $_POST['callingInput'] . "=" . 
                $_POST['identifier'] . " AND deleted=0";
	$reply = mysql_query($query, $con);                    
	$name = mysql_fetch_array($reply);                    
	$rows = mysql_affected_rows();
	if($rows == 1) { 
        //if only one result was found, 
        //then send the details of this person back
        //echo the string back in json format
		echo json_encode($name);	
	} else {
		echo "noUniqueMatches";
	}
	mysql_close($con);	
?>