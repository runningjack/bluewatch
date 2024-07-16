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



function submit_webpage()
{
	
		
		var name = document.getElementById('page_name').value;
		var title = document.getElementById('page_title').value;
		var desc = document.getElementById('desc').value;
		var cat = document.getElementById('cat').value;
		var pub = document.getElementById('publish').value;
		var content = document.getElementById('b').value;
		
	    var xmlObj = ajaxObj();
		xmlObj.onreadystatechange = function()
		{
			
			document.getElementById('enableLoading').className = 'show';
			if(xmlObj.readyState == 4)
			{
				document.getElementById('showcontent').innerHTML = xmlObj.responseText;
				document.getElementById('enableLoading').className = 'noshow';
								
			}
			
		}
		//
		var tme = Math.random();
		var url = "modules/content_manager/libs/create_page.php?" + "name=" + name + "&title=" + title + "&desc=" + desc + "&cat=" + cat +"&pub=" + pub + "&cont=" + content + "&rnd=" + tme;
		xmlObj.open("POST", url, true);
		xmlObj.send(null);
	
}