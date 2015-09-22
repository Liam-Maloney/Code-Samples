<?php
/*
AUTHOR:     Liam Maloney
PURPOSE:    Returns the history of a loan account
            by looking at the transaction table
            the details are built up in a json 
            object containing an associative array.
DATE:       23 March 2015
*/
    include 'db.inc.php';
    $historyGet =   "SELECT date, amount, type, balanceAfter 
                    FROM transaction 
                    WHERE accountNumber=" . $_POST['account'];
    $reply = mysql_query($historyGet, $con);
    $firstEntry = true;
    //echo beginning of the json format
    echo '{"history":[';
    while($values = mysql_fetch_array($reply)) {
        if($firstEntry){
            //if it is the first entry which is being inserted
            //the a comma should go at the end of the addition
            $record = '{"date":"' . $values['date'] . 
                '","amount":"' . $values['amount'] . 
                '","type":"' . $values['type'] . 
                '","balanceAfter":"' . 
                $values['balanceAfter'] . '"}';
            $firstEntry = false;
        } else {
            //comma now goes at the beginning of the string
            $record = ',{"date":"' . $values['date'] . 
                '","amount":"' . $values['amount'] . 
                '","type":"' . $values['type'] . 
                '","balanceAfter":"' . 
                $values['balanceAfter'] . '"}';
        }
        echo $record;
    }   
    echo "]}"; //close off the json object
?>