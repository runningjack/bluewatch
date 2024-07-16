function exittingWindow()
{
	var status=confirm('Do you want to save score entries before leaving this page?');
	if(!status)
	{
		return;
	}else
	{
		$('#cmdSave').trigger('click');
		return false;
	}
}


function setMessage(t,msg)
{
	if(!t)
	{
		$("#indicator_block")
		.empty()
		.addClass("deactivate_block");
	}else
	{
		$("#indicator_block")
		.empty()
		.append(msg)
		.removeClass("deactivate_block");
	}

}
function goSort()
{
	var key=$("#sort_by").val();

	if(key!='0')
	{
		//$("#indicator_block")
		//.empty()
		//.append("Sorting student list by "+key)
		//.removeClass("deactivate_block");
		setMessage(1,"Sorting student list on "+key);
		$("#actiontype").val(1);
		$("#actionname").val("sort");
		$("#layerform").submit();
	}else
	{

		setMessage(1,"Please select a sorting criteria");
	}

}

function filterStudent()
{

	setMessage(1,"Filtering student lists please wait...");
	$("#actiontype").val(2);
	$("#actionname").val("filter");
	$("#layerform").submit();
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
		$("#csDepartment").attr("disabled",false);
		setMessage(0,null);
	});
}
function loadStudySelect(deptId)
{
	//clear the seelect box
	var targetObject=$("#csStudy");

	$.post("ajaxDispatcher.php",{studyDepartmentID:deptId},function(data){
		//alert(data);
		var child_nodes=data.getElementsByTagName('study');
		//load the department select object
		var myselect=document.getElementById("csStudy");
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

			optiontag.value=child_nodes[k].getAttribute('studyId');

			optiontag.appendChild(document.createTextNode(child_nodes[k].getAttribute('studyName')));
			myselect.appendChild(optiontag);



		}
		//enable the department select object if it is loaded
		$("#csStudy").attr("disabled",false)
		setMessage(0,null);
	});

}
function loadStudentFaculties(cid)
{
	$.post("ajaxDispatcherReloaded.php",{requestKey:'loadClassFaculty',courseId:cid},
		       function(data){
		       	var child_data=data.getElementsByTagName('faculty');
		        var targetObject=document.getElementById("csFaculty");
		        if(targetObject.firstChild)
		        {
		 	      while(targetObject.firstChild)
		 	      {
		 		   targetObject.removeChild(targetObject.firstChild);
		 	      }
		       }
		       for(var i=0;i<child_data.length;i++)
		       {
		 	       var optiontag=document.createElement("option");
	  	               optiontag.value=child_data[i].getAttribute('facultyId');
	  	               optiontag.appendChild(document.createTextNode(child_data[i].getAttribute('facultyName')));
	  	               targetObject.appendChild(optiontag);
		       }
		       $("#csFaculty").attr("disabled",false);
		       	setMessage(0,null);
		       });

}
function loadStudentDepartments(fid,cid)
{
	$.post("ajaxDispatcherReloaded.php",{requestKey:'loadClassDepartment',courseId:cid,facultyId:fid},
		       function(data){
		       	var child_data=data.getElementsByTagName('department');
		        var targetObject=document.getElementById("csDepartment");
		        if(targetObject.firstChild)
		        {
		 	      while(targetObject.firstChild)
		 	      {
		 		   targetObject.removeChild(targetObject.firstChild);
		 	      }
		       }
		       for(var i=0;i<child_data.length;i++)
		       {
		 	       var optiontag=document.createElement("option");
	  	               optiontag.value=child_data[i].getAttribute('deptId');
	  	               optiontag.appendChild(document.createTextNode(child_data[i].getAttribute('deptName')));
	  	               targetObject.appendChild(optiontag);
		       }
		       $("#csFaculty").attr("disabled",false);
		       	setMessage(0,null);
		       });
}
function loadStudentStudys(did,cid)
{
	$.post("ajaxDispatcherReloaded.php",{requestKey:'loadClassStudy',courseId:cid,departmentId:did},
		       function(data){
		       	var child_data=data.getElementsByTagName('study');
		        var targetObject=document.getElementById("csStudy");
		        if(targetObject.firstChild)
		        {
		 	      while(targetObject.firstChild)
		 	      {
		 		   targetObject.removeChild(targetObject.firstChild);
		 	      }
		       }
		       for(var i=0;i<child_data.length;i++)
		       {
		 	       var optiontag=document.createElement("option");
	  	               optiontag.value=child_data[i].getAttribute('studyId');
	  	               optiontag.appendChild(document.createTextNode(child_data[i].getAttribute('studyName')));
	  	               targetObject.appendChild(optiontag);
		       }
		       $("#csStudy").attr("disabled",false);
		       	setMessage(0,null);
		       });
}


$(document).ready(function(){
	$("#cmdGoSort").bind("click",goSort);
	$("#cmdFilter").bind("click",filterStudent);
	ScoreMan.init();

	$("#csFaculty").change(function(){
		var theValue=$(this).val();
		var cid=$("#csCoursecode").val();
		if(theValue==0||cid==0)
		{
			//$("#csDepartment").attr("disabled",true);
			alert("Please select a course from the options");
		}else
		{
			setMessage(1,"Loading departments please wait...");

			loadStudentDepartments(theValue,cid);

		}

	});
	//bind department change
	$("#csDepartment").change(function(){
		var theValue=$(this).val();
		var cid=$("#csCoursecode").val();

		if(theValue==0||cid==0)
		{
			//$("#csCourse").attr("disabled",true);
			alert("Please select a course from the options");
		}else
		{
			setMessage(1,"Loading course of study please wait...");

			loadStudentStudys(theValue,cid);

		}
	});
	//bind the course field
    $("#csCoursecode").change(function(){
    	var cid=$(this).val();
    	if(cid==0)
    	{

    	}else
    	{
    		setMessage(1,"Loading student faculties please wait...");
    		loadStudentFaculties(cid);
    	}
    });

    $(":checkbox").bind('click',function(){
    	if($(this).is(":checked"))
    	{
    		$(this).attr('value',1);
    	}else
    	{
    		$(this).attr('value',0);
    	}
    });

    update_all_cbk();
});

var ScoreMan={
	errorCode:0,
	errorMessage:null,
	integrityMode:0,
	init:function()
	{
		$("#cmdSave").bind("click",function(){
			ScoreMan.integrityMode=1;
			ScoreMan.processForm();
		});
         //bind the second save command
         $("#cmdSave2").bind("click",function(){
         	ScoreMan.integrityMode=1;
			ScoreMan.processForm();
         });

	},
	acceptValue:function(id)
	{
		$("#"+id).removeClass("errorClass");
		ScoreMan.errorCode=0;
		ScoreMan.errorMessage=null;
		setMessage(0,null);
		return true;
	},
	rejectValue:function(id,msg)
	{
		ScoreMan.errorCode=1;
		ScoreMan.errorMessage=msg;
		//msg=msg+" "+id;
		
		setMessage(1,msg);
		$("#"+id).addClass("errorClass");
		return false;
	},
	checkScoreIntegrity:function()
	{
		var frm=document.getElementById("layerform");
		var inputData=frm.getElementsByTagName("input");
		
		
		var x_element = document.getElementById("x");
        var x = x_element.value;
		
		  
        var y_element = document.getElementById("y");
        var y = y_element.value;
		
		var ereg=/cmdSave|cmdFilter|cmdSelection|cmdGoSort|sort_by|csFaculty|csDepartment|csStudy/;
		for(var k=0;k<inputData.length;k++)
		{

			var e=inputData[k];
			//e.id!="cmdResult" && e.id!="cmdSelection"
			if(e.type!="hidden" && !ereg.test(e.id))
			{
				var t=e.id.split("-")[0];

				 if(ScoreMan.integrityMode==1)
				 {
				 	//dealing with CA scores
				 	var caID=t+"-ca";
				 	var examID=t+"-exam";
				 	//var gradeID=t+"-grade";
				 	if(!ScoreMan.checkCA(caID,x))
				 	{
				 		break;
				 	}
				 	if(!ScoreMan.checkExam(examID,y))
				 	{
				 		break;
				 	}
				 }else
				 {
				 	//dealing with Exam scores
				 	//var examID=t+"-exam";
				 	//if(!ScoreMan.checkExam(examID))
				 	//{
				 	//	break;
				 	//}
				 }
			}else
			{
				continue;
			}
		}
		return;

	},
	checkCA:function(id,x)
	{    
		var val=$("#"+id).val();
		var msg;
		if(isNaN(val))
		{
			msg="The highlighted CA score is not a valid score, must be a number";
			return ScoreMan.rejectValue(id,msg);
		}else
		{
			if(parseFloat(val)>x)
			{
		      msg="The highlighted CA score can not exceed "+x;
			  return ScoreMan.rejectValue(id,msg);
			}else if(parseFloat(val)<0)
			{
				msg="The highlighted CA score can not be less than zero";
			  return ScoreMan.rejectValue(id,msg);
			}
			else
			{
				return ScoreMan.acceptValue(id);
			}
		}
	},
	checkGrade:function(id)
	{
		var reg=/A|B|C|D|E|F/;
		var msg="The highlighted grade value is not a valid one";
		var val=$("#"+id).val();
		if(!val ||!reg.test(val))
		{
			return ScoreMan.rejectValue(id,msg);
		}else
		{
			return ScoreMan.acceptValue(id);
		}
	},
	checkExam:function(id,y)
	{
		var val=$("#"+id).val();
		var msg;
		if(isNaN(val))
		{
			msg="The highlighted Exam score is not a valid score, must be a number";
			return ScoreMan.rejectValue(id,msg);
		}else
		{
			if(parseFloat(val)>y)
			{
		      msg="The highlighted Exam score can not exceed "+ y;
			  return ScoreMan.rejectValue(id,msg);
			}else if(parseFloat(val)<0)
			{
				msg="The highlighted Exam score can not be less than 0";
			  return ScoreMan.rejectValue(id,msg);
			}else
			{
				return ScoreMan.acceptValue(id);
			}
		}
	},
	processForm:function()
	{
		ScoreMan.errorCode=0;
		var frm=document.getElementById("layerform");
		if(frm.elements.length==0)
		{
			alert("There are no students records to work on");
			return;
		}

		ScoreMan.checkScoreIntegrity();
		if(ScoreMan.errorCode>0)
		{
			alert(ScoreMan.errorMessage);
			return;
		}else
		{

			setMessage(1,"Saving records please wait...");
			$("#actiontype").val(3);
			frm.submit();
			return;
		}

	}
};

//find all checkbox in the page and attach event to them
function update_all_cbk()
{
	$(":checkbox").each(function(i,j){
		if($(this).attr('value')>0)
		{
			$(this).attr('checked',true);
		}
	});

}

