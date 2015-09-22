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
    //get the existing records
    $query =   "SELECT accountNumber, balance, loanAmount, term, 
                    monthlyRepayment 
                FROM loanAccount 
                WHERE accountNumber=" . $_POST['account'];
    $oReply = mysql_fetch_object(mysql_query($query, $con));
    //assign the old values to variables to make them easier to work with
    $oLoanAmount = $oReply->loanAmount;
    $oBalanceWithMinus = $oReply->balance;
    $oTerm = $oReply->term;
    $oAccountNumber = $oReply->accountNumber;
    $oMonthlyRepayment = $oReply->monthlyRepayment;
    //removes the '-' from the beginning of the string
    $oBalance = substr($oBalanceWithMinus, 1, strlen($oBalanceWithMinus) - 1);
    if($_POST['amount'] < $oLoanAmount) {
        die("Loan amounts can only be increased. If you would like to decrease the amount of the loan, please lodge the amount to decrease the loan by in the lodgements screen");
    }
    if($_POST['term'] != $oTerm){
        $termUpdate =   "UPDATE loanAccount
                        SET term=" . $_POST['term'] . 
                            ", monthlyRepayment=" . $_POST['monthlyRepayment'] . " 
                        WHERE accountNumber=" . $_POST['account'];
        mysql_query($termUpdate, $con);
        echo "Loan details changed";
    }
    if($_POST['balance'] != $oBalance){
        //see if the balance has increased or decreased
        if($_POST['balance'] > $oBalance){
            $difference = $_POST['balance'] - $oBalance;
            $balanceUpdate =    "UPDATE loanAccount 
                                SET balance=" . ($oBalanceWithMinus - $difference) . 
                                " WHERE accountNumber=" . $_POST['account'];
            mysql_query($balanceUpdate, $con);
            //get a new transactionId
            $sql = "SELECT MAX(transactionID) as oldId FROM transaction";
            $oldId = mysql_fetch_object(mysql_query($sql, $con));
            $newID = $oldId->oldId + 1;
            //insert a new record
            date_default_timezone_set("UTC");
            $newTransIns = "INSERT into transaction(
                                transactionID,accountNumber,amount,date,
                                balanceAfter,type) 
                            VALUES('" . $newID . "','" . $_POST['account'] . 
                                "','" . $difference . "','" . 
                                date('Y-m-d h:m:s') . "','" . 
                                ($oBalanceWithMinus - $difference) . "','debit')";
            mysql_query($newTransIns, $con);
            echo "Loan Details Changed";
        } else {
            $difference = $oBalance - $_POST['balance'];
            $balanceUpdate =    "UPDATE loanAccount 
                                SET balance=" . ($oBalanceWithMinus + $difference) . 
                                " WHERE accountNumber=" . $_POST['account'];
            mysql_query($balanceUpdate, $con);
            //get a new transactionId
            $sql = "SELECT MAX(transactionID) as oldId FROM transaction";
            $oldId = mysql_fetch_object(mysql_query($sql, $con));
            $newID = $oldId->oldId + 1;
            //insert a new record
            date_default_timezone_set("UTC");
            $newTransIns = "INSERT into transaction(
                                transactionID,accountNumber,amount,date,
                                balanceAfter,type) 
                            VALUES('" . $newID . "','" . $_POST['account'] . 
                                "','" . $difference . "','" . 
                                date('Y-m-d') . "','" . 
                                ($oBalanceWithMinus + $difference) . "','credit')";
            mysql_query($newTransIns, $con);
            echo "Loan Details Changed";
        }
    }
    if($_POST['amount'] != $oLoanAmount) {
        //update loan amount AND balance
        if($_POST['amount'] > $oLoanAmount) {
            //add the difference to the balance and the loan amount, 
            //and lodge a debit transaction
            $difference = $_POST['amount'] - $oLoanAmount;
            //add the difference on to the old loanAmount in the DB
            $amountUpdate = "UPDATE loanAccount 
                            SET loanAmount=" . ($difference + $oLoanAmount) . 
                                ",balance=" . ($oBalanceWithMinus - $difference) .
                            " WHERE accountNumber=" . $_POST['account'];
            mysql_query($amountUpdate, $con);
            //lodge this as a transaction
            $sql = "SELECT MAX(transactionID) as oldId FROM transaction";
            $oldId = mysql_fetch_object(mysql_query($sql, $con));
            $newID = $oldId->oldId + 1;
            //insert a new record
            date_default_timezone_set("UTC");
            $newTransIns = "INSERT into transaction(
                                transactionID,accountNumber,amount,date,
                                balanceAfter,type) 
                            VALUES('" . $newID . "','" . 
                                $_POST['account'] . "','" . 
                                $difference . "','" . 
                                date('Y-m-d h:m:s') . 
                                "','" . ($oBalanceWithMinus - $difference) . 
                                "','debit')";
            mysql_query($newTransIns, $con);
            echo "Loan details changed";
        }
    }
    if($_POST['monthlyRepayment'] != $oMonthlyRepayment) {
        $paymentUpdate =    "UPDATE loanAccount 
                            SET monthlyRepayment=" . 
                                $_POST['monthlyRepayment'] .
                            " WHERE accountNumber=" . 
                                $_POST['account'];
        mysql_query($paymentUpdate,$con);
    }
    mysql_close($con);	
?>