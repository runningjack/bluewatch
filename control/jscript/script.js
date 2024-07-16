function validate_login()
{
	    var u = document.getElementById("uid").value;
		var p = document.getElementById("pwd").value;
	
		if(u == "" || p == "")
		{
			document.getElementById("error").innerHTML = "* Please Make Sure All Fields Are Filled!";
			return false;
		}
		else
		{
			submit();
			return true;
		}

}

	function validate_forget()
	{
			var mail = document.getElementById("email").value;
			var veri = document.getElementById("veri").value;
		
			if(veri == "" || mail == "")
			{
				document.getElementById("errMsg").innerHTML = "* Please Make Sure All Fields Are Filled!";
				return false;
			}
			var mai = validateEmail(mail);
			if(!mai)
			{
				document.getElementById("errMsg").innerHTML = "* Invalid Email Format!";
				return false;
			}		
			else
			{
				submit();
				return true;
			}
	}

	function validateEmail(elementValue)
	{  
	    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	   return emailPattern.test(elementValue);  
	}  