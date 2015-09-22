<?php
    $hostname = "bank.candept.com";    
    $username = "banker";	           
    $password = "javascript";		   
    $dbname = "bank";		           
    $con = mysql_connect($hostname,$username,$password);

    if(!$con) {
      die('Could not connect: ' . mysql_error());
    }

    if (!mysql_select_db($dbname, $con)) {
        die( "Error in selecting the database" . mysql_error());
    }
?>