<html>
<head>
  <title>Edit Address Information</title>
 
  <style>
	#changecontact {
		position: absolute;
		top: 80px;
		left: 900px;
		width: 300px;
		height: 500px;
		padding: 10px;
		visibility: visible;
	}

	#displaycontact {
		position: absolute;
		top: 80px;
		left: 10px;
		width: 550px;
		height: auto;
		padding: 10px;
		background-color: #CCCCFF;
	}
  </style>

</head>

<body style="font-family: Arial, Helvetica, sans-serif; color: Blue; background-color: silver;">

<form id="myform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

<h2 style="background-color: #F5DEB3;">Edit Address Information</h2>


<div id='changecontact'>
    <h3>Update Adddress</h3>

<?php

if (isset($_POST['updateauthor']))
{
	$updateauthor = $_POST['updateauthor'];
} else {
	$updateauthor = '';
}


include "Functions.php";

$db = connectDatabase();
//**********************************************
//*
//*  Fetch Form Data
//*
//**********************************************

if (isset($_POST['myid']))
{
	$myid = trim($_POST['myid']);
} else {
	$myid = '';
}

if (isset($_POST['mylastname']))
{
	$mylastname = trim($_POST['mylastname']);
} else {
	$mylastname = '';
}

if (isset($_POST['myfirstname']))
{
	$myfirstname = trim($_POST['myfirstname']);
} else {
	$myfirstname = '';
}

if (isset($_POST['myphone']))
{
	$myphone = trim($_POST['myphone']);
} else {
	$myphone = '';
}

if (isset($_POST['myemail']))
{
	$myemail = trim($_POST['myemail']);
} else {
	$myemail = '';
}
if ($updateauthor == 'Save Changes')
{
	if (empty($mylastname) || empty($myfirstname))
	{
		$rtncode = '';
	} else {
		$rtncode = updateContact($db, $myid, $mylastname, $myfirstname, $myphone, $myemail);
	}
}


//**********************************************
//*
//*  SELECT from table and display Results
//*
//**********************************************


$sql_statement  = "SELECT id, name, surname, mobile, email ";
$sql_statement .= "FROM address ";
$sql_statement .= "ORDER BY name ";

$result = mysqli_query($db,$sql_statement);

$outputDisplay = "";
$myrowcount = 0;

if (!$result) {
	$outputDisplay .= "<br /><font color=red>MySQL No: ".mysqli_errno();
	$outputDisplay .= "<br />MySQL Error: ".mysqli_error();
	$outputDisplay .= "<br />SQL Statement: ".$sql_statement;
	$outputDisplay .= "<br />MySQL Affected Rows: ".mysqli_affected_rows($db)."</font><br />";
} else {

	$outputDisplay  = "<h3>Contacts Table Data</h3>";

	$outputDisplay .= '<table border=1 style="color: black;" width="200px">';
	$outputDisplay .= '<tr><th>User ID</th><th>Last Name</th><th>First Name</th><th>Phone</th><th>Email</th></tr>';

	$numresults = mysqli_num_rows($result);

	for ($i = 0; $i < $numresults; $i++)
	{
		if (!($i % 2) == 0)
		{
			 $outputDisplay .= "<tr style=\"background-color: #F5DEB3;\">";
		} else {
			 $outputDisplay .= "<tr style=\"background-color: white;\">";
		}

		$myrowcount++;

		$row = mysqli_fetch_array($result);

		$id 	   = $row['id'];
		$lastname  = $row['name'];
		$firstname = $row['surname'];
		$phone	   = $row['mobile'];
		$email	   = $row['email'];

		if ($updateauthor != 'Save Changes')
		{
			if ($id == trim($updateauthor))
			{
				$myid = $id;
				$mylastname = $lastname;
				$myfirstname = $firstname;
				$myphone 	 = $phone;
				$myemail = $email;
			}
		}

		$outputDisplay .= "<td><input type='submit' name='updateauthor' value='".$id."' /></td>";
		$outputDisplay .= "<td>".$lastname."</td>";
		$outputDisplay .= "<td>".$firstname."</td>";
		$outputDisplay .= "<td>".$phone."</td>";
		$outputDisplay .= "<td>".$email."</td>";

		$outputDisplay .= "</tr>";
	}

	$outputDisplay .= "</table>";

}


print "<input type='hidden' name='myid' size='11' value='".$myid."'/>";

print "<p>Last Name:<br />";
print "<input type='text' name='mylastname' size='20' value='".$mylastname."'/>";
print "</p>";

print "<p>First Name:<br />";
print "<input type='text' name='myfirstname' size='20' value='".$myfirstname."'/>";
print "</p>";

print "<p>Phone:<br />";
print "<input type='text' name='myphone' size='20' value='".$myphone."'/>";
print "</p>";

print "<p>Email:<br />";
print "<input type='text' name='myemail' size='40' value='".$myemail."'/>";
print "</p>";


?>

<br /><input type="submit" name='updateauthor' value="Save Changes" />
<a href = "index.php"> GO Back Home</a>
</div>

<div id='displaycontact'>
	<?php
		$outputDisplay .= "<br /><br /><b>Number of Rows in Results: $myrowcount </b><br /><br />";
		print $outputDisplay;
	?>
</div>

</form>
</body>
</html>