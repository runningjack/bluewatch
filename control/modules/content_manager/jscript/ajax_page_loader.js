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



function load_page(urls)
{
	
	
		var xmlObj = ajaxObj();
		xmlObj.onreadystatechange = function()
		{
			
				document.getElementById('disablerLoading').className = 'show';
			
			if(xmlObj.readyState == 4)
			{
				document.getElementById('showcontent').innerHTML = xmlObj.responseText;
				document.getElementById('disablerLoading').className = 'noshow';
				
			}
			
			
		}
		//
		var tme = Math.random();
		
		var url = "modules/content_manager/switch.php?" + urls + "&rnd=" + tme;
		//window.open(url);
		xmlObj.open("GET", url, true);
		xmlObj.send(null);

	
}

function check_search()
{
	if(document.getElementById('search_page').value == "")
	{
		document.getElementById("error").innerHTML = "* Search Field Empty!";
		return false;
	}
	else
	{
		var str = document.getElementById('search_page').value;
		load_page('CMD=Search For Web Page&val=' + str);
	}
}