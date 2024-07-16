function Check(chk)
{
	if(document.form1.deleteWeb.checked==true){
	for (i = 0; i < chk.length; i++)
	chk[i].checked = true ;
	}else{
	
	for (i = 0; i < chk.length; i++)
	chk[i].checked = false ;
	}
}

function verify_checkbox()
{
	var chkbtnall = document.getElementById("deleteWeb").checked;
	if(chkbtnall == false)
	{ 
	  var ctn = 0;
	  var chkbtn = document.form1.web;	
	  var num = chkbtn.length;
	  for(var i=0; i<num; i++) { if (chkbtn[i].checked){ ctn++; } }
	  if(ctn >= 1)
	  { 
	    submit();
		return true;
	  }
	  else
	  {
		  document.getElementById("error").innerHTML = "* Please Select All Records You Want To Delete!";
	      return false;
	  }
	}
	else
	{
		submit();
		return true;
	}
	
	
	
}