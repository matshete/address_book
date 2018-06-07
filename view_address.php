<?php

$myData = $_POST['data'];  //This recieves the data passed from the HTML form

$myTable = "<table border='1' class = 'displaycontacts'>";

$myTable .= "<tr>";
$myTable .= "<th>Last Name</th>";
$myTable .= "<th>First Name</th>";
$myTable .= "<th>Phone</th>";
$myTable .= "<th>Email</th>";
$myTable .= "<th>Date Added</th>";

$myTable .= "</tr>";


//*****************************************************
//Read Contacts Information From File Into HTML table
//*****************************************************

$display = "";
$line_ctr = 0;

include "Functions.php";

$outputDisplay = '';


$statement  = "SELECT id ";
$statement .= "name, surname, ";
$statement .= "email, mobile, ";
$statement .= "date_added ";
$statement .= "FROM address ";
$statement .= "ORDER BY id ";

$sqlResults = selectResults($statement);

$error_or_rows = $sqlResults[0];

if (substr($error_or_rows, 0 , 5) == 'ERROR')
{
	$myTable .= "Error on DB";
	$myTable .= "$error_or_rows";
} else {

	for ($ii = 1; $ii <= $error_or_rows; $ii++)
	{
		$lastname  		= $sqlResults [$ii] ['name'];
		$firstname  	= $sqlResults [$ii] ['surname'];
		$phone  		= $sqlResults [$ii] ['mobile'];
		$email  		= $sqlResults [$ii] ['email'];
		$date_added  	= $sqlResults [$ii] ['date_added'];


		$line_ctr++;

		$line_ctr_remainder = $line_ctr % 2;

		$style = '';

		if ($line_ctr_remainder == 0)
		{
			$style = "style='background-color: #FFFFCC;'";
		} else {
			$style = "style='background-color: white;'";
		}

		$myTable .= "<tr $style >";
		$myTable .= "<td>".$lastname."</td>";
		$myTable .= "<td>".$firstname."</td>";


		if (empty($phone))
		{
			$phone = 'n/a';
		}

		$myTable .= "<td>".$phone."</td>";


		if (empty($email))
		{
			$email = 'n/a';
		}

		$myTable .= "<td>".$email."</td>";

		
		$myTable .= "<td>".$date_added."</td>";

		

		
		$myTable .= "</tr>\n";  //added newline
	}

	print "</table>";
	print "Number of addresses found:".$error_or_rows;
	print $myTable;

}

?>