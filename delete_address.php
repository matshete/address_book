<html>
<head>
  <title>Delete Address</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
  

</head>

<body style="font-family: Arial, Helvetica, sans-serif; color: Blue; background-color: silver;">

<form id="myform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

<h2 style="background-color: #F5DEB3;">View Contacts</h2>

<div class='displaycontact'>


<?php

include "Functions.php";

//**********************************************
//*
//*  SELECT from table and display Results
//*
//**********************************************
$db = connectDatabase();

$sql_statement  = "SELECT id,name, surname, mobile,email ";
$sql_statement .= "FROM address ";
$sql_statement .= " ORDER BY name, surname ";

$result = mysqli_query($db,$sql_statement);

$outputDisplay = "";
$myrowcount = 0;

if (!$result) {
	$outputDisplay .= "<br /><font color=red>MySQL No: ".mysqli_errno();
	$outputDisplay .= "<br />MySQL Error: ".mysqli_error();
	$outputDisplay .= "<br />SQL Statement: ".$sql_statement;
	$outputDisplay .= "<br />MySQL Affected Rows: ".mysqli_affected_rows()."</font><br />";
} else {

	$outputDisplay  = "<h3>Contacts Table Data</h3>";

	$outputDisplay .= '<table border=1 style="color: black;">';
	$outputDisplay .= '<tr><th>Delete?</th><th>ID</th><th>Last Name</th><th>First Name</th><th>Phone</th><th>Email</th></tr>'."\n";

	$numresults = mysqli_num_rows($result);

	for ($i = 0; $i < $numresults; $i++)
	{
		if (!($i % 2) == 0)
		{
			 $outputDisplay .= "<tr style=\"background-color: #F5DEB3;\">";
		} else {
			 $outputDisplay .= "<tr style=\"background-color: white;\">";
		}

		$row = mysqli_fetch_array($result);

		$id 	   = $row['id'];
		$lastname  = $row['name'];
		$firstname = $row['surname'];
		$phone 	   = $row['mobile'];
		$email     = $row['email'];

        if (isset($_POST[$id]))
        {
        	$checked = $_POST[$id];
        } else {
        	$checked = 'N';
        }

		if ($checked == 'Y')
		{
			deleteContact($db, $id, $lastname, $firstname, $phone, $email);
		} else {

			$myrowcount++;

			$outputDisplay .= "<td><input type='checkbox' name='".$id."' value='Y'></td>";
			$outputDisplay .= "<td>".$id."</td>";
			$outputDisplay .= "<td>".$lastname."</td>";
			$outputDisplay .= "<td>".$firstname."</td>";
			$outputDisplay .= "<td>".$phone."</td>";
			$outputDisplay .= "<td>".$email."</td>";
			$outputDisplay .= "</tr>\n";
		}
	}

	$outputDisplay .= "</table>";

}

$outputDisplay .= '<br /><input type="submit" value="Delete Contact" />';
$outputDisplay .= "<br /><br /><b>Number of Rows in Results: $myrowcount </b><br /><br />";

$outputDisplay .= '<br /><a href = "index.php"> GO Back Home</a>';
print $outputDisplay;

?>
</div>

</form>
</body>
</html>