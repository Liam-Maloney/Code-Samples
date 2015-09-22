<?php
/*
AUTHOR:     Liam Maloney
PURPOSE:    returns the details of a customer
            associated with a particular account number
DATE:       23 March 2015
*/
	include 'db.inc.php';
	$accountNum = $_POST['account'];
	$query = 	"SELECT customer.customerNumber, 
                    firstName, surname 
				FROM customer 
				INNER JOIN accountHolder
				ON customer.customerNumber=
                    accountHolder.customerNumber 
				WHERE accountHolder.accountNumber=" . 
                    $accountNum . " AND accountType='loan'";
	$reply = mysql_query($query, $con);
    $names = mysql_fetch_object($reply);
    if(mysql_affected_rows() == 1) {
        echo json_encode($names);
    }
    else {
        echo "doesNotExist";
    }
    mysql_close($con);	
?>