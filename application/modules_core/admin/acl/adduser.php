<script type="text/javascript">
$(document).ready(function(){
	//bind the submit button
	$("#cmdsubmit").bind("click",saveOfficer2);
	//bind the faculty box
	$("#csFaculty").change(function(){
		var theValue=$(this).val();
		if(theValue==0)
		{
			//$("#csDepartment").attr("disabled",true);
		}else
		{
			flashMessage(2,"Loading selected faculty departments please wait...");
			loadDepartmentSelect(theValue);
		}

	});
	//bind group
	$("#csGroup").change(function(){
		var theid=$(this).val();
		if(theid>0)
		{
			setupOfficerType(theid);
		}
	});

});
function saveOfficer2()
{
	var textFields=$("input");
	var textPwd=[];
	var errorArr=[];
	for(var k=0;k<textFields.length;k++)
	{
		 var e=textFields[k];
		 if(e.type=='text' || e.type=='password')
		 {
	           if(e.id!="csOthernames" && e.value.length==0)
	           {
	           	 errorArr.push(e.id.substr(2));
	           	 break;
	           }else if(e.type=="password")
	           {
	           	 textPwd.push(e.value);
	           }
		 }
	}

	if(errorArr.length>0)
	{
		alert("please enter the value for "+ errorArr.pop()+"");
		return;
	}else
	{
		 if(textPwd[0]!=textPwd[1])
		 {
		 	alert("Password mismatched,please correct your password");
		 	return;
		 }else
		 {
		 	 $("select").each(function(){
		 	 	if($(this).is(":enabled"))
		 	 	{
		 	 		var sid=$(this).attr("id");
		 	 		//var sval=$(this).val();
		 	 		if($(this).val()==0)
		 	 		{
		 	 			errorArr.push(sid.substr(2));
		 	 			return false;
		 	 		}

		 	 	}
		 	 });

		 	  if(errorArr.length>0)
		 	  {
		 	  	alert("Please select "+ errorArr.pop()+" from the options");
		 	  	return;
		 	  }else
		 	  {
		 	  	//alert("We are ready to go");
		 	  	$("#addOfficer").submit();
		 	  }
		 }

	}

}
function loadDepartmentSelect(fid)
{
	//clear the seelect box
	var targetObject=$("#csDepartment");

	  $.post("ajaxDispatcher.php",{facultyID:fid},function(data){
	  	  //alert(data);
	  	  var child_nodes=data.getElementsByTagName('department');
	  	   //load the department select object
	  	   var myselect=document.getElementById("csDepartment");
	  	   //clear the object before loading it
	  	   if(myselect.firstChild)
	  	   {
	  	   	  while(myselect.firstChild)
	  	   	  {
	  	   	  	myselect.removeChild(myselect.firstChild);
	  	   	  }
	  	   }
	  	   for(var k=0;k<child_nodes.length;k++)
	  	   {
	  	       var optiontag=document.createElement("option");

	  	           optiontag.value=child_nodes[k].getAttribute('deptId');

	  	           optiontag.appendChild(document.createTextNode(child_nodes[k].getAttribute('deptName')));
	  	           myselect.appendChild(optiontag);



	  	   }
	  	   //enable the department select object if it is loaded
	  	   //$("#csDepartment").attr("disabled",false);
	  	   flashMessage(1,"");
	  });


}
function cancelUpdate()
{
	window.history.go(-1);
	return;
}
function setupOfficerType(groupid)
{
	var gid=parseInt(groupid);
	activateAll();
	switch(gid)
	{
		case 1://SP
		case 6:// DSA
		//$("#csLevel").attr("disabled",true);

		case 12:// BS
		case 13://PGDEAN
		case 14: // M
		case 11: //IA
		case 10://Academic Secretary
		 	 $("#faculty_id").attr("disabled",true);
		     $("#programme_id").attr("disabled",true);
		     $("#department_id").attr("disabled",true);
		//	 $("#csLevel").attr("disabled",true);
 	 	//	$("#csHostel").attr("disabled",true);

		   break;
		case 16:// MIS Op		
		case 17://DVC
		case 18://Directors
        case 20:// Intercontinental bank group
        case 22:// Officers for changing jambno to matno
		case 24:
		    $("#faculty_id").attr("disabled",true);
		     $("#programme_id").attr("disabled",true);
		     $("#department_id").attr("disabled",true);
		    //$("#csLevel").attr("disabled",true);
 	 	    //$("#csHostel").attr("disabled",true);

		   break;
		case 25:
		     
		    
		   //  $("#csHostel").attr("disabled",true);
			// $("#programme_id").attr("disabled",true);
			 
		 break;
                 case 4: // HA

		     $("#faculty_id").attr("disabled",false);
		     $("#programme_id").attr("disabled",false);
		     $("#department_id").attr("disabled",false);
                     break ;
		case 15: // HA

		     $("#faculty_id").attr("disabled",true);
		     $("#programme_id").attr("disabled",true);
		     $("#department_id").attr("disabled",true);
		     //$("#csLevel").attr("disabled",true);
		   break;

		case 9: //DN
		case 7:
		case 3://Faculty examination officer
		     $("#programme_id").attr("disabled",true);
		     $("#department_id").attr("disabled",true);
		    // $("#csHostel").attr("disabled",true);
		    // $("#csLevel").attr("disabled",true);
		     break;

	    case 8:// HOD
		//$("#csHostel").attr("disabled",true);
		// $("#csLevel").attr("disabled",true);
		 break;
	    case 19://Registration Officer(Department)
	    case 21: //Departmental examination officer
	        
             $("#csLevel").attr("disabled",true);
		     $("#csHostel").attr("disabled",true);
		     break;
		     default:
		     $("#faculty_id").attr("disabled",true);
		     $("#programme_id").attr("disabled",true);
		     $("#department_id").attr("disabled",true);
			// $("#csLevel").attr("disabled",true);
 	 		//$("#csHostel").attr("disabled",true);
			 
			 
		
			 
	}
	return;
}
function activateAll()
{
	var mycounter=0;
	$("select").each(function(index,mebo){

		$(this).attr("disabled",false);
	});

	return;
}
</script>

<script type="text/JavaScript"> 
    
    function randomNumber(limit){
	return Math.floor(Math.random()*limit);
        
}
    
    $(function() {
$("#faculty_id").change(function(){	
         //$("#loadlga").html("<img src='images/zoho-busy.gif' alt='loading' />").css("display", "inline");
         var faculty_id = document.getElementById('faculty_id').value; 
         $("#loaddepartment").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
 		
 		$("#department_id").load("<?php echo base_url('admin/ajax/load_departments'); ?>",{non: randomNumber(9), valu: faculty_id }, function(response, status, xhr){
           
           $("#loaddepartment").css("display", "none");
           
           if(status == 'error'){
        	   $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
 								  '<br />Error Code: '+xhr.status+
 								  '<br />Error Message: '+xhr.statusText);
    	   }
 			//if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
 		 });
 		 //if(xmlhttp.readystate == 4) document.getElementById("loaddeptunit").style.display = "none";		         
		 
	});
 
      
});    
    
function loadcourses(id){	
        // alert(id);
         var level_id = document.getElementById('level_id').value; 
         var department_id = document.getElementById('department_id').value; 
         $("#loadcourse").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
 		
 		$("#course_id").load("<?php echo base_url('admin/ajax/load_courses'); ?>",{non: randomNumber(9), level: level_id,dept:department_id }, function(response, status, xhr){
           
           $("#loadcourse").css("display", "none");
           
           if(status == 'error'){
        	   $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
 								  '<br />Error Code: '+xhr.status+
 								  '<br />Error Message: '+xhr.statusText);
    	   }
 			//if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
 		 });
 		 //if(xmlhttp.readystate == 4) document.getElementById("loaddeptunit").style.display = "none";		         
		 
	}
        
        function addmore(){
        
        
        
         var course_id = document.getElementById('course_id').value;
         var course_status = document.getElementById('course_status').value;
         
         $("#loadmore").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
 	 
         document.getElementById("more_course").innerHTML=""; 	
          
         $("#more_course").load("<?php echo base_url('admin/ajax/load_more'); ?>",{non: randomNumber(9),course_id:course_id, course_status:course_status }, function(response, status, xhr){
           
           $("#loadmore").css("display", "none");
           
       
           if(status == 'error'){
        	   $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
 								  '<br />Error Code: '+xhr.status+
 								  '<br />Error Message: '+xhr.statusText);
    	   }
 			//if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
 		 });
 		 //if(xmlhttp.readystate == 4) document.getElementById("loaddeptunit").style.display = "none";		         
	//alert('submit intercepted');
           //     e.preventDefault(e);
     return false;
        
        }
        //load courses that are already added
        $( document ).ready(function() {
       
                
         $("#loadmore").html("<img src='<?php echo base_url("bootstrap/images/zoho-busy.gif");?>' alt='loading' />").css("display", "inline");
 		
         $("#more_course").load("<?php echo base_url('admin/ajax/load_more'); ?>",{non: randomNumber(9) }, function(response, status, xhr){
           
           $("#loadmore").css("display", "none");
           
           if(status == 'error'){
        	   $('#errordisplay').html('<p>There was an error making the AJAX request</p>'+
 								  '<br />Error Code: '+xhr.status+
 								  '<br />Error Message: '+xhr.statusText);
    	   }
 			//if(xhr.status >=200 && xhr.status <300) $("#loading").css("display", "");
 		 });
        
        });
        
  function checkUncheckAll(theElement) {
     var theForm = theElement.form, z = 0;
	 for(z=0; z<theForm.length;z++){
      if(theForm[z].type == 'checkbox' && theForm[z].name != 'checkall' && theForm[z].name != 'spill'){
	  theForm[z].checked = theElement.checked;
	  }
     }
    }      
        

    function OnSubmitForm(){
              //alert(document.pressed);
              if(document.pressed == 'Delete')
              {
               document.myform.action ="<?php echo base_url('student/courses/deleteadded');?>";
              }
              else
              if(document.pressed == 'Preview')
              {
                document.myform.action ="<?php echo base_url('student/courses/preview');?>";
              }
               else{
              
             // alert('form end');
              return false;
              }
            }
    
     </script>
     
     <?php

$facelement = array();
               $facelement[''] = '--Select faculty--';
                foreach ($fac as $value) {
                    $facelement[$value->faculty_id] = $value->faculty_name;
                }
                
   $groupelement = array();
               $groupelement[''] = '--Select User Group--';
                foreach ($group as $value) {
                    $groupelement[$value->group_id] = $value->group_name;
                }
                
     $progelement = array();
               $progelement[''] = '--Select User Programme--';
                foreach ($prog as $value) {
                    $progelement[$value->programme_id] = $value->programme_name;
                }           
 
?>
<div class="col-sm-4 col-md-6">
        <div class="block-flat">
           
          <div class="header">							
            <h3>Add New User</h3>
          </div>
             <?php if(isset($message_error)) {?>
             <div class="alert alert-danger alert-white rounded">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-times-circle"></i></div>
								<strong>Error!</strong> <?php echo $message_error; ?>
							 </div>
							 
            <?}?>
            <?php 
             
               
//var_dump($modulesarray);

                
                ?>
          <div class="content">
              <?php $attributes = array( 'id' => 'usersform');
              echo form_open('admin/users/adduser',$attributes);?>
             <div class="form-horizontal"  parsley-validate novalidate>
                 <div class="form-group">
                     <fieldset> <legend> Guest Personal Details </legend>
                          <table style="border: 0;">
                    <tr>
                        <td><label >
                                <strong>Role :</strong></label></td><td>
                                    <?php echo form_dropdown('group', $groupelement, '',' id= "csGroup" required="" class="form-control"'); ?> </td>
                         </tr><tr>   
                        
                        <td><label >
                                <strong>Username :</strong></label></td><td><?php echo form_input($form_username); ?> </td>
                                
                    </tr>
                    <tr>
                       <td><label >
                                <strong>Password :</strong></label></td><td><?php echo form_input($form_password); ?></td> 
                                </tr><tr> 
                        <td><label >
                                <strong>Confirm Password :</strong></label></td><td colspan=""><?php echo form_input($form_confirmpassword); ?></td>
                    </tr>
                    
                
                
                    <tr>
                       
                        <td><label >
                                </label></td><td colspan="4"><input type='submit' name='submit' value='Add User'></td>
                    </tr>
                                     
                    </table>
                     </fieldset>
                   <?php echo form_close(); ?>
                  </div>     
                    
            </div>
              <?php echo form_close(); ?>
          </div>
        </div>				
      </div>
    
  