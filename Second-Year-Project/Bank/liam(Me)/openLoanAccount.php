<?php
/*
AUTHOR:     Liam Maloney
PURPOSE:    Opens a new loan account and makes
            insertions in to the relevant tables
DATE:       23 March 2015
*/	
    include 'db.inc.php'; 
    //decode the passed in json object
	$accountDetails = json_decode($_POST['details']); 
    //convert the loan
	$negativeBalance = (floatval($accountDetails->{'loanAmount'}) - 
						floatval($accountDetails->{'loanAmount'}) - 
						floatval($accountDetails->{'loanAmount'}));
	$sql = "INSERT into accountHolder(
                customerNumber,accountNumber,
                accountType) 
            VALUES('" . $accountDetails->{'customerNumber'} .
				"','" . $accountDetails->{'accountNumber'} . 
                "','" . $accountDetails->{'accountType'} . "')";
	mysql_query($sql, $con);
	//set default date timezone
    date_default_timezone_set("UTC");
    $sql = "INSERT into loanAccount(
                accountNumber,balance,loanAmount,term,
                monthlyRepayment,openDate,closed) 
            VALUES('" . $accountDetails->{'accountNumber'} . 
                "','" . $negativeBalance . "','" . 
                $accountDetails->{'loanAmount'} . 
                "','" . $accountDetails->{'term'} . "','" 
					. $accountDetails->{'monthlyRepayment'} . 
                "','" . date('Y-m-d') .  "','0')";	
    mysql_query($sql, $con);
    $sql = "SELECT MAX(transactionID) as oldId FROM transaction";
    mysql_query($sql, $con);
    $oldId = mysql_fetch_object(mysql_query($sql, $con));
    $newID = $oldId->oldId + 1;
    $sql = "INSERT into transaction(
                transactionID,accountNumber,amount,date,balanceAfter,type) 
            VALUES('" . $newID . "','" . 
                $accountDetails->{'accountNumber'} . "','" . 
                $accountDetails->{'loanAmount'} . "','" . 
                date('Y-m-d h:m:s') . "','" . 
                $negativeBalance . "','withdrawl')";
    mysql_query($sql, $con);
    echo true;
	mysql_close($con);
?>