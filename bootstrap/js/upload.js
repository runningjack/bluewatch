function upload(){
        $.ajaxFileUpload({
            url             :'http://localhost/kano/frontdesk/upload/upload_file/', 
            secureuri       :false,
            fileElementId   :'userfile',
            dataType        : 'json',
            data            : {
                'title'             : $('#title').val()
            },
            success : function (data, status)
            {
                //alert("AJAX call successful and this data was returned: " + data.name);
                if(data.status != 'error')
                {
                  //  $("#files").show();
document.getElementById("files").innerHTML="";	  
//$("#files").fadeIn(400).html('\n\<span class="loading">Uploading Please wait...</span>');  
$("#files").fadeIn(400).html('\n\<span class="loading">\n\
<img style="height:150px;width:200px;" src="http://localhost/kano/files/'+data.name+'" align="absmiddle"></span>');
                 document.forms['roomform'].image.value = data.name;
                    
                }
                alert(data.msg);
            }
        });
        return false;
    }
    
  