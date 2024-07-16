function load_priv(val)
{
		var xmlObj = ajaxObj();
		xmlObj.onreadystatechange = function()
		{
			
			document.getElementById('sMsg').innerHTML = "Please Wait...";
			if(xmlObj.readyState == 4)
			{
				document.getElementById('showPrivileges').innerHTML = xmlObj.responseText;
				document.getElementById('sMsg').innerHTML = "";
			}
			
			
		}
		//
		var tme = Math.random();
		var url = val + "&rnd=" + tme;
		//window.open(url);
		xmlObj.open("GET", url, true);
		xmlObj.send(null);
}

function load_PrivDataGrid_Next(url)
{
		
		var xmlObj = ajaxObj();
		xmlObj.onreadystatechange = function()
		{
			
					
			if(xmlObj.readyState == 4)
			{
				
				//document.getElementById('msgUser2').innerHTML = xmlObj.responseText;
				
			}
			loadGridPriv(url);
			document.getElementById('msgPriv2').innerHTML = '';
			
		}
		//
		var tme = Math.random();
		//window.open(url);
		xmlObj.open("GET", url, true);
		xmlObj.send(null);
}


function loadGridPriv(url)
{
		
		var xmlObj = ajaxObj();
		xmlObj.onreadystatechange = function()
		{
			
			document.getElementById('msgPriv2').innerHTML = 'Please Wait...';
			
			if(xmlObj.readyState == 4)
			{
				document.getElementById('showmsgPriv').innerHTML = xmlObj.responseText;	
				document.getElementById('msgPriv2').innerHTML = '';
			}
			
			
		}
		//
		var tme = Math.random();
		
		var url = url + "&rnd=" + tme;
		//window.open(url);
		xmlObj.open("GET", url, true);
		xmlObj.send(null);
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


