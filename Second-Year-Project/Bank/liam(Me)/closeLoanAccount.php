<?php
/*
AUTHOR:     Liam Maloney
PURPOSE:    This set an account as closed if the balance
            equals 0
DATE:       23 March 2015
*/

    include 'db.inc.php';
    $checkBalance = "SELECT balance 
                    FROM loanAccount 
                    WHERE accountNumber=" . $_POST['account'];
    $reply = mysql_query($checkBalance, $con);
    $value = mysql_fetch_array($reply);
    if($value['balance'] != 0){
        echo "accountNotEmpty";
    } else {
        $close =    "UPDATE loanAccount 
                    SET closed=1 
                    WHERE accountNumber=" . $_POST['account'];
        mysql_query($close, $con);
        echo "closed";
    }
?>