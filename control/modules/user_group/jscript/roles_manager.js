 //JavaScript Document
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

function showAddrole()
{ 
	var state = document.getElementById('addRole').style.display;
	if(state != "none")
	{
		document.getElementById('addRole').style.display = 'none';
		document.getElementById('msgRole2').innerHTML = '';
		document.getElementById('msgRole').innerHTML = '';
	}
	else
	{
		document.getElementById('addRole').style.display = 'block';
		document.getElementById('msgRole2').innerHTML = '';
		document.getElementById('msgRole').innerHTML = '';
	}
	
}

function showDisablerole()
{ 
	var stat = document.getElementById('disableRole').style.display;
	if(stat != "none")
	{
		document.getElementById('disableRole').style.display = 'none';
		document.getElementById('msgRole2').innerHTML = '';
	}
	else
	{
		document.getElementById('disableRole').style.display = 'block';
		document.getElementById('msgRole2').innerHTML = '';
	}
	
}

function ajaxaddRole(url, role)
{
		
		var xmlObj = ajaxObj();
		xmlObj.onreadystatechange = function()
		{
			
			document.getElementById('msgRole').innerHTML = 'Please Wait...';
			
			if(xmlObj.readyState == 4)
			{
				//document.getElementById('showmsg').innerHTML = xmlObj.responseText;
				//document.getElementById('msg').innerHTML = 'Done!';
				var m = xmlObj.responseText;
				
				if(m == 0)
				{
					document.getElementById('msgRole2').innerHTML = "Role Already Exist!";
				}
				else if(m == 1)
				{
					document.getElementById('msgRole2').innerHTML = "Cannot Add Role!"
				}
				else
				{
					document.getElementById('msgRole2').innerHTML = "Role Added!";
					document.getElementById('role').value = '';
					
				}
				
			}
			
			return;
		}
		//
		var tme = Math.random();
		
		var url = url + "&role=" + role + "&rnd=" + tme;
		//window.open(url);
		xmlObj.open("GET", url, true);
		xmlObj.send(null);
}

function addRole()
{
	var r = document.getElementById('role').value;
	if(r == "")
	{
		document.getElementById('msgRole').innerHTML = 'Please Enter Role!';
	}
	else
	{
		ajaxaddRole('modules/user_group/index.php?CMD=Add Roles', r);
		loadGridRole('modules/user_group/index.php?CMD=Show Roles')
	}
		
}

function disableRole()
{
	var role = document.getElementById('d_role').value;
	if(role == "Administrator")
	{
		document.getElementById('msgRole').innerHTML = 'Please You Cannot Disable Administrator Role!';
	}
	else
	{
		userState('modules/user_group/index.php?CMD=Disable Roles', role);
		loadGridRole('modules/user_group/index.php?CMD=Show Roles')
	}
		
}

function userState(url, role)
{
		
		var xmlObj = ajaxObj();
		xmlObj.onreadystatechange = function()
		{
			
			document.getElementById('msgRole').innerHTML = 'Please Wait...';
			
			if(xmlObj.readyState == 4)
			{
				//document.getElementById('showmsg').innerHTML = xmlObj.responseText;
				//document.getElementById('msg').innerHTML = 'Done!';
				var d = xmlObj.responseText;
				
				if(d == 0)
				{
					document.getElementById('msgRole2').innerHTML = "Process Failed!";
				}
				else
				{
					document.getElementById('msgRole2').innerHTML = "Process Successful!";
				}
		
			}
			
			
		}
		//
		var tme = Math.random();
		
		var url = url + "&role=" + role + "&rnd=" + tme;
		//window.open(url);
		xmlObj.open("GET", url, true);
		xmlObj.send(null);
}

function disableUser(url)
{
		var xmlObj = ajaxObj();
		xmlObj.onreadystatechange = function()
		{
			
			document.getElementById('msgUser').innerHTML = 'Please Wait...';
			
			if(xmlObj.readyState == 4)
			{
				document.getElementById('msgUser').innerHTML = xmlObj.responseText;
				//document.getElementById('msg').innerHTML = 'Done!';
				/*var u = xmlObj.responseText;
				alert(u);
				if(u == 0)
				{
					document.getElementById('msgUser').innerHTML = "Process Failed!";
				}
				else
				{
					document.getElementById('msgUser').innerHTML = "Process Successful!";
				}*/
				
			}
			
			loadGridUser('modules/user_group/index.php?CMD=Show Users')
			
			
		}
		//
		var tme = Math.random();
		
		var url = url + "&rnd=" + tme;
		//window.open(url);
		xmlObj.open("GET", url, true);
		xmlObj.send(null);
}

function load_RoleDataGrid_Next(url)
{
		
		var xmlObj = ajaxObj();
		xmlObj.onreadystatechange = function()
		{
			
					
			if(xmlObj.readyState == 4)
			{
				
				//document.getElementById('msgUser2').innerHTML = xmlObj.responseText;
				
			}
			loadGridRole(url);
			document.getElementById('msgRole2').innerHTML = '';
			
		}
		//
		var tme = Math.random();
		//window.open(url);
		xmlObj.open("GET", url, true);
		xmlObj.send(null);
}


function loadGridRole(url)
{
		
		var xmlObj = ajaxObj();
		xmlObj.onreadystatechange = function()
		{
			
			document.getElementById('msgRole').innerHTML = 'Please Wait...';
			
			if(xmlObj.readyState == 4)
			{
				document.getElementById('showmsgRole').innerHTML = xmlObj.responseText;	
				document.getElementById('msgRole').innerHTML = '';
			}
			
			
		}
		//
		var tme = Math.random();
		
		var url = url + "&rnd=" + tme;
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


