// JavaScript Document

function form_chk()
{
        var name = document.getElementById("news_name").value;
		var title = document.getElementById("news_title").value;	
		if(name == "" || title == "")
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
	var pname = document.getElementById("news_name").value;
	if(ch != true)
	{
		document.getElementById("news_title").disabled = true;
		document.getElementById("news_cat").disabled = true;
		document.getElementById("fileField").disabled = true;
		document.getElementById("submit").disabled = true;
		document.getElementById("news_name").disabled = false;
		document.getElementById("error").innerHTML = "";

	}
	else
	{
		if(pname == "")
		{
			document.getElementById("error").innerHTML = "* Enter web page name!";
			document.getElementById("news_name").disabled = true;
		}
		else
		{
			ajaxSessioncreator();
			document.getElementById("news_title").disabled = false;
			document.getElementById("news_cat").disabled = false;
			document.getElementById("fileField").disabled = false;
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
			
			document.getElementById("error").innerHTML = "Please wait...";
			if(xmlObj.readyState == 4)
			{
				//document.getElementById('showcontent').innerHTML = xmlObj.responseText;
				document.getElementById("error").innerHTML = 'Thanks Done!';
				
			}
			
			
		}
		//
		//document.getElementById("error").innerHTML = "Please wait...";
		var na = document.getElementById("news_name").value;
		var tme = Math.random();
		var val = "CMD=Create News Session&newsname=" + na;
		var url = "modules/news_cast/index.php?" + val + "&rnd=" + tme;
		//window.open(url);
		xmlObj.open("GET", url, true);
		xmlObj.send(null);
}


function show_img_field()
{
	var chimg = document.getElementById('image').checked;
	if(chimg != true)
	{
		document.getElementById("fileField").style.display = "none";
		document.getElementById("size").style.display = "none";
		document.getElementById("showSpec").style.display = "none";
	}
	else
	{
		document.getElementById("fileField").style.display = "block";
		document.getElementById("size").style.display = "block";
		document.getElementById("showSpec").style.display = "block";
	}
}

function get_dim()
{
	for (var i=0; i < document.form.size.length; i++)
   {
   if (document.form.size[i].checked)
      {
         var si = document.form.size[i].value;
		 show_dim(si);
      }
   }	
}

function show_dim(val)
{
  if(val != "default")
	{
		document.getElementById("dim").style.display = "block";
	}
	else
	{
		document.getElementById("dim").style.display = "none";
	}
}
