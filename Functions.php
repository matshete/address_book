<?php


function connectDatabase()
{
	//**********************************************
	//*
	//*  Connect to MySQL and Database
	//*
	//**********************************************

	$db = mysqli_connect('localhost','root','');

	if (!$db)
	{
		print "<h1>Unable to Connect to MySQL</h1>";
	}

	$dbname = 'address_book';

	$btest = mysqli_select_db($db,$dbname);

	if (!$btest)
	{
		print "<h1>Unable to Select the Database</h1>";
	}

	return $db;
}

function iduResults($statement)
{

	$output = "";
	$outputArray = array();

	$db = connectDatabase();

	if ($db)
	{
		$result = mysqli_query($db,$statement);

		if (!$result) {
			$output .= "ERROR";
			$output .= "<br /><font color=red>MySQL No: ".mysqli_errno();
			$output .= "<br />MySQL Error: ".mysqli_error();
			$output .= "<br />SQL Statement: ".$statement;
			$output .= "<br />MySQL Affected Rows: ".mysqli_affected_rows()."</font><br />";

		} else {
			$output = mysqli_affected_rows($db);
		}

	} else {

		$output =  'ERROR-No DB Connection';

	}

	return $output;
}

function selectResults($statement)
{

	$output = "";
	$outputArray = array();

	$db = connectDatabase();

	if ($db)
	{
		$result = mysqli_query($db,$statement);

		if (!$result) {
			$output .= "ERROR";
			$output .= "<br /><font color=red>MySQL No: ".mysqli_errno();
			$output .= "<br />MySQL Error: ".mysqli_error();
			$output .= "<br />SQL Statement: ".$statement;
			$output .= "<br />MySQL Affected Rows: ".mysqli_affected_rows($db)."</font><br />";

			array_push($outputArray, $output);

		} else {

			$numresults = mysqli_num_rows($result);

			array_push($outputArray, $numresults);

			for ($i = 0; $i < $numresults; $i++)
			{
				$row = mysqli_fetch_array($result);

				array_push($outputArray, $row);
			}
		}

	} else {

		array_push($outputArray, 'ERROR-No DB Connection');

	}

	return $outputArray;
}

function updateContact($db, $myid, $mylastname, $myfirstname, $myphone, $myemail)
{

	$statement 	= "update address ";
	$statement .= " set name = '".$myfirstname."', ";
	$statement .= "     surname =  '".$mylastname."', ";
	$statement .= "     mobile =  '".$myphone."', ";
	$statement .= "     email =  '".$myemail."' ";
	$statement .= "where id = '".$myid."' ";

	$result = mysqli_query($db,$statement);

	if ($result)
	{
		echo "<br>Contact Updated: ".$mylastname.", ".$myfirstname;
		return $myid;
	} else {
		echo("<h4>MySQL No: ".mysqli_errno($result)."</h4>");
		echo("<h4>MySQL Error: ".mysqli_error($result)."</h4>");
		echo("<h4>SQL: ".$statement."</h4>");
		echo("<h4>MySQL Affected Rows: ".mysqli_affected_rows($result)."</h4>");

		return 'NotUpdated';
	}
}

function deleteContact($db, $id, $lastname, $firstname, $phone,$email)
{
	$statement 	= "DELETE FROM address ";
	$statement .= "WHERE id = '".$id."' ";

	$result = mysqli_query($db,$statement);

	if ($result)
	{
		echo "<br />Contact deleted: ".$lastname.", ".$firstname;
	} else {
		echo("<h4>MySQL No: ".mysqli_errno($result)."</h4>");
		echo("<h4>MySQL Error: ".mysqli_error($result)."</h4>");
		echo("<h4>SQL: ".$statement."</h4>");
		echo("<h4>MySQL Affected Rows: ".mysqli_affected_rows($result)."</h4>");
	}
}

?>