// JavaScript Document

function form_chk()
{
        var name = document.getElementById("page_name").value;
		var title = document.getElementById("page_title").value;
		var desc = document.getElementById("desc").value;
	
		if(name == "" || title == "" || desc == "")
		{
			document.getElementById("errMsg").innerHTML = "* Please Make Sure All Fields Are Filled!";
			return false;
		}
		else
		{
			submit();
			return true;
		}
}

function showparent(str)
{
	if (str == "Child")
	{
		document.getElementById('parent_name').style.display='block';
		document.getElementById('tit').style.display='block';
		
		
	}else{
		document.getElementById('parent_name').style.display='none';
		document.getElementById('tit').style.display='none';
	
		
	}
	
}

function validate_name()
{
	var ch = document.getElementById('validate').checked;
	var pname = document.getElementById("page_name").value;
	if(ch != true)
	{
		document.getElementById("page_title").disabled = true;
		document.getElementById("desc").disabled = true;
		document.getElementById("cat").disabled = true;
		document.getElementById("submit").disabled = true;
		document.getElementById("page_name").disabled = false;
		document.getElementById("errMsg").innerHTML = "";

	}
	else
	{
		if(pname == "")
		{
			document.getElementById("errMsg").innerHTML = "* Enter web page name!";
			document.getElementById("page_name").disabled = true;
		}
		else
		{
			ajaxSessioncreator();
			document.getElementById("page_title").disabled = false;
			document.getElementById("desc").disabled = false;
			document.getElementById("cat").disabled = false;
			document.getElementById("submit").disabled = false;
			
		}
		
	}
}

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

function ajaxSessioncreator()
{
		var xmlObj = ajaxObj();
		xmlObj.onreadystatechange = function()
		{
			
			document.getElementById("errMsg").innerHTML = "Please wait...";
			if(xmlObj.readyState == 4)
			{
				//document.getElementById('showcontent').innerHTML = xmlObj.responseText;
				document.getElementById("errMsg").innerHTML = "Thanks Done!";
				
			}
			
			
		}
		//
		//document.getElementById("error").innerHTML = "Please wait...";
		var na = document.getElementById("page_name").value;
		var tme = Math.random();
		var val = "CMD=Create Session&pagename=" + na;
		var url = "modules/content_manager/switch.php?" + val + "&rnd=" + tme;
		//window.open(url);
		xmlObj.open("GET", url, true);
		xmlObj.send(null);
}
