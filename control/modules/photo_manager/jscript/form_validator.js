// JavaScript Document

function get_value()
{
   for (var i=0; i < document.albumform.album.length; i++)
   {
   if (document.albumform.album[i].checked)
      {
         var ab = document.albumform.album[i].value;
		 show_name(ab);
      }
   }

}

function show_name(val)
{
	if(val == "New")
	{
		document.getElementById("existalbum").style.display = "none";
		document.getElementById("e_album_name").style.display = "none";
		
		document.getElementById("n_album_name").style.display = "block";
		document.getElementById("albumname").style.display = "block";
	}
	else
	{
		document.getElementById("existalbum").style.display = "block";
		document.getElementById("e_album_name").style.display = "block";
		
		document.getElementById("n_album_name").style.display = "none";
		document.getElementById("albumname").style.display = "none";
	}
}

function get_cat_name(c)
{
   if(c == "New")
   {
	   document.getElementById("e_cat").style.display = "none";
	   document.getElementById("cat").style.display = "block";
   }
   else if(c == "Existing")
   {
	   document.getElementById("cat").style.display = "none";
	   document.getElementById("e_cat").style.display = "block";
   }
   else
   {
	   document.getElementById("cat").style.display = "none";
	   document.getElementById("e_cat").style.display = "none";
   }
}

function open_exist_cat()
{
   var ex = document.getElementById('album_cat').value;
   if(ex == "Existing")
   {
	   document.getElementById("e_cat").style.display = "block";
   }
   else
   {
	   document.getElementById("e_cat").style.display = "none";
   }
}

function get_dim()
{
	for (var i=0; i < document.albumform.size.length; i++)
   {
   if (document.albumform.size[i].checked)
      {
         var si = document.albumform.size[i].value;
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

function show_files()
{
	var ch = document.getElementById('multi').checked;
	if(ch != true)
	{
		document.getElementById("numfiles").style.display = "none";
		document.getElementById("fileField").disabled = false;
		document.getElementById("caption").disabled = false;
		document.getElementById("desc").disabled = false;
		document.getElementById("button").disabled = true;
	}
	else
	{
		document.getElementById("numfiles").style.display = "block";
		document.getElementById("fileField").disabled = true;
		document.getElementById("caption").disabled = true;
		document.getElementById("desc").disabled = true;
		document.getElementById("button").disabled = false;
	}
	document.getElementById("button").disabled = false;
}

function enablebtn()
{
	var fi = document.getElementById("fileField").value;
	if(fi != "")
	{
		document.getElementById("button").disabled = false;
	}
	
}

function set_thumb()
{
	for (var i=0; i < document.albumform.thumb.length; i++)
   {
   if (document.albumform.thumb[i].checked)
      {
         var tb = document.albumform.thumb[i].value;
		 show_thumb(tb);
      }
   }	
}

function show_thumb(val)
{
    if(val != "No")
	{
		document.getElementById("thumb").style.display = "block";
	}
	else
	{
		document.getElementById("thumb").style.display = "none";
	}
}

function openEdit()
{
	document.getElementById("savechange").style.display = "block";
	document.getElementById("abname").disabled = false;
}

