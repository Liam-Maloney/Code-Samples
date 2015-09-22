<!--
Group:				BANK
Student Number:		C00186095
Student Name:		CIARA MCMAHON
Description:		To allow for extra javascript and css files for the following screens
					Calculate Interest on Deposit Account
					Open a Deposit Account
					Close a Deposit Account
					View a Deposit Account
					Deposit Account History

-->

 <!DOCTYPE HTML>

<html lang="en">

 <head>
	 <script type="text/javascript" src="../common/iframe.js"></script>
	 <script type="text/javascript" src="deposit.js"></script>
	 <link rel="stylesheet" type="text/css" href="../common/style.css">
	<link rel="stylesheet"  href="../common/iframe.css">
	 <link rel="stylesheet" type="text/css" href="deposit.css">
	 <link rel="stylesheet" type="text/css" href="view_deposit.css">

 </head>
	<body onmousedown="ihideMenu()"  <?php	echo 'onload="loadHelp(' . $_SESSION['helptext'] . ')"'; ?>	>