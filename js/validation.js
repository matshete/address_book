
		var XMLHttpRequestObject = false;

		if (window.XMLHttpRequest) {
		  XMLHttpRequestObject = new XMLHttpRequest();
		} else if (window.ActiveXObject) {
		  XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		function validateForm()
		{

			errmsg = '';

			var firstname = document.getElementById('firstname').value;

			if (firstname == null || firstname == "")
			{
			  errmsg += "<br />You must enter a First Name";
  			}

			var lastname = document.getElementById('lastname').value;

			if (lastname == null || lastname == "")
			{
			  errmsg += "<br />You must enter a Last Name";
  			}

			var phoneormemail = document.getElementById('phoneormemail').value;

			if (phoneormemail == null || phoneormemail == "")
			{
			  errmsg += "<br />You must enter a Phone Number or Email";
  			}

		
			return errmsg;
		}

		// Add address book scripts
		function addToContacts()
		{

		  var errmsg = validateForm();

		  if (errmsg != '')
		  {
		     processAdd(errmsg);
		     return false;
		  }

		  if(XMLHttpRequestObject) {

		    XMLHttpRequestObject.open("POST", "add_contacts.php");

		    XMLHttpRequestObject.setRequestHeader('Content-Type',
		      'application/x-www-form-urlencoded');

		    XMLHttpRequestObject.onreadystatechange = function()
		    {
		      if (XMLHttpRequestObject.readyState == 4 &&
		        XMLHttpRequestObject.status == 200) {

		          var returnedData = XMLHttpRequestObject.responseText;
					//alert("RD" + returnedData);
		          processAdd(returnedData);
		      }
		    }

			var firstname = document.getElementById('firstname').value;
			var lastname = document.getElementById('lastname').value;

			var phoneormemail  = document.getElementById('phoneormemail').value;

			var rbphone = document.getElementById('rbphone');

			if (rbphone.checked)
			{
				var contactchoice = 'P';
			} else {
				var contactchoice = 'E';
			}

			

            var data  = firstname + '|' + lastname + '|';
                data += contactchoice + '|' + phoneormemail + '|';
               

		    XMLHttpRequestObject.send("data=" + data);
		  }

		  return false;

		}
		
		function processData(returnedData)
		{

		  if (returnedData.substr(0,5) == 'ERROR')
		  {
		  	var errorDiv = document.getElementById('errordiv');
		  	errorDiv.innerHTML = "ERROR ON DATABASE";
		  } else {
		    var contactDiv = document.getElementById('showcontact');

		    var divData = "<h3>Contacts</h3>" + returnedData;
		  	contactDiv.innerHTML = divData;

		  	contactDiv.style.visibility = "visible";

		  }

		  return false;
		}


		function viewContacts()
		{

		  if(XMLHttpRequestObject) {

		    XMLHttpRequestObject.open("POST", "view_address.php");

		    XMLHttpRequestObject.setRequestHeader('Content-Type',
		      'application/x-www-form-urlencoded');

		    XMLHttpRequestObject.onreadystatechange = function()
		    {
		      if (XMLHttpRequestObject.readyState == 4 &&
		        XMLHttpRequestObject.status == 200) {

		          var returnedData = XMLHttpRequestObject.responseText;
					//alert("RD" + returnedData);
		          processData(returnedData);
		      }
		    }

			var data = 'dummy';

		    XMLHttpRequestObject.send("data=" + data);
		  }

		  return false;

		}
		
		function processAdd(returnedData)
		{
			var showcontactDiv = document.getElementById('showcontact');

			showcontactDiv.innerHTML = returnedData;

			showcontactDiv.style.visibility = "visible";

		  	return false;
		}