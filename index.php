<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Address Book </title>

	<script type="text/javascript" src="js/validation.js"></script>
	
</head>

<body style="font-family: Arial, Helvetica, sans-serif; color: Blue; background-color: silver;">


<div id="addcontact">
	<form method="post">
	<h2 style="background-color: #F5DEB3;">Add Address Book to our Database</h2>

	<p>
	First Name:<br />
	<input type="text" name="firstname" id="firstname" size="30" />
	</p>

	<p>
	Last Name:<br />
	<input type="text" name="lastname" id="lastname" size="30" />
	</p>

	<p>
	Contact Information:
	<input type="radio" name="contact" id="rbphone" value="Phone" checked="checked" /> Phone
	<input type="radio" name="contact" id="rbemail" value="Email" /> Email <br />

	<input type="text" name="phoneormemail" id="phoneormemail" size="40" />
	</p>
	

	<p>
	<input type="button" value="Submit Information" onclick="addToContacts();" />
	<input type="reset" />
	</p>

	<p><a href="" onclick="return viewContacts();">View Address Book</a></p>
	<p><a href="edit_address.php">Edit Address</a></p>
	<p><a href="delete_address.php" >Remove Address</a></p>


	</form>
	
	<div id="errordiv" style="color: red;"></div>

</div>

<div id="showcontact">
</div>



</body>
</html>