function validate_txt()
{
	var roles = document.getElementById('roleT').value;
	var fname = document.getElementById('fullnames').value;
	var uid = document.getElementById('username').value;
	var pwd1 = document.getElementById('password').value;
	var pwd2 = document.getElementById('password2').value;
	
	if(fname == "" || uid == "" || pwd1 == "" || pwd2 == "")
	{
		document.getElementById('showMsg').innerHTML = 'Please Make Sure No Field Is Empty!';	
		return false;
	}
	else if(roles == "Administrator")
	{
		document.getElementById('showMsg').innerHTML = 'Please You Cannot Add This User As Administrator!';
		return false;
	}
	else if(pwd1 != pwd2)
	{
		document.getElementById('showMsg').innerHTML = 'Password Mismatch!';
		return false;
	}
	else
	{
		submit();
		return true;
		//window.location.reload();
	}
}

function validate_upd()
{
	var u_fname = document.getElementById('fullname').value;
	var u_id = document.getElementById('user_name').value;
	if(document.getElementById('c_pwd').checked)
	{
		var cng = document.getElementById('c_pwd').value;
		var u_pwd1 = document.getElementById('pass_word').value;
		var u_pwd2 = document.getElementById('pass_word2').value;
		if(u_fname == "" || u_id == "" || u_pwd1 == "" || u_pwd2 == "")
		{
			document.getElementById('showupdMsg').innerHTML = 'Please Make Sure No Field Is Empty!';
			return false;
		}
		else if(u_pwd1 != u_pwd2)
		{
			document.getElementById('showupdMsg').innerHTML = 'Password Mismatch!';
			return false;
		}
		else
		{
			//submit();
		    return true;
		}
	}
	else
	{
		//var cng = "No";
		if(u_fname == "" || u_id == "")
		{
			document.getElementById('showupdMsg').innerHTML = 'Please Make Sure No Field Is Empty!';
			 return false;
		}
		else
		{
		    return true;
		}
	}
	
}

function clearFields()
{
	document.getElementById('fullnames').value = "";
	document.getElementById('username').value = "";
	document.getElementById('password').value = "";
	document.getElementById('password2').value = "";
}

function showPWD()
{
	
	
	if(document.getElementById('c_pwd').checked)
	{
		document.getElementById('showpwd').style.display = "block";
	}
	else
	{
		document.getElementById('showpwd').style.display = "none";
	}
}

function closeTAB(url)
{
	window.location = url;
}

function load_DataGrid_Next(url)
{
		
		var xmlObj = ajaxObj();
		xmlObj.onreadystatechange = function()
		{
			
					
			if(xmlObj.readyState == 4)
			{
				
				//document.getElementById('msgUser2').innerHTML = xmlObj.responseText;
				
			}
			loadGridUser(url);
			document.getElementById('msgUser2').innerHTML = '';
			
		}
		//
		var tme = Math.random();
		//window.open(url);
		xmlObj.open("GET", url, true);
		xmlObj.send(null);
}

function loadGridUser(url)
{
		
		var xmlObj = ajaxObj();
		xmlObj.onreadystatechange = function()
		{
			
			document.getElementById('msgUser').innerHTML = 'Please Wait...';
			
			if(xmlObj.readyState == 4)
			{
				document.getElementById('showmsgUser').innerHTML = xmlObj.responseText;	
				document.getElementById('msgUser').innerHTML = '';
			}
			
			
		}
		//
		var tme = Math.random();
		
		var url = url + "&rnd=" + tme;
		//window.open(url);
		xmlObj.open("GET", url, true);
		xmlObj.send(null);
}

// JavaScript Document
function ajaxObj(){
try{
		return new XMLHttpRequest();
	}catch(e){
		try{
			return activeXObject('msxml2.XMLHttp');
		}catch(e){
			try{
				return activeXObject('microsoft.XMLHttp');
			}catch(e){
				alert("Browser doesn't support ajax");
			}
		}
	}
}


