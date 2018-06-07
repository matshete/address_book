<?php

$myData = $_POST['data'];  //This recieves the data passed from the form

list($firstname, $lastname, $contactchoice, $phoneormemail) = explode('|', $myData);

include "Functions.php";


//***************************************
//Add Address Information to Database
//***************************************

$date_added = date('Y-m-d');


$statement  = "INSERT INTO address ";
$statement .= "(name, surname, ";
$statement .= "email, mobile, ";
$statement .= "date_added )";
$statement .= "VALUES (";

$statement .= "'".$lastname."', '".$firstname."', ";

if ($contactchoice == 'Phone')
{
	$statement .= "'".$phoneormemail."', NULL, ";
} else {
	$statement .= "NULL, '".$phoneormemail."', ";
}

$statement .= " '".$date_added."') ";


$rtn = iduResults($statement);

//exit;
//***************************************
//Display New Page
//***************************************

$fullname = $firstname.' '.$lastname;

$rtnmsg = "<p class='topofdiv'>Thank You!  We have received your query</p>";

$rtnmsg .= "<p>Information Submitted for: $fullname </p>";

$rtnmsg .= "<p>Your $contactchoice is $phoneormemail <br />";

print $rtnmsg;

?>