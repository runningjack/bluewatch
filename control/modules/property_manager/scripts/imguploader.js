// JavaScript Document
$(function(){
		  	var count = 0;
		   
	$("#box1-d").click(function(){
		var box_val = $('#box-r:checked').val();
		if(box_val == "yes")
		{
			$("#main-size").slideDown('slow', function(){});
		}else{
			$("#main-size").slideUp('slow', function(){});
			}
	});
	

	
	$("#addthumb").live('click', function(){
			$('<input type=\"file\" id=\"thumb_' + count + '\" name=\"img[]\" /><a href=\"javascript:;\" id=\"remove_' + count + '\"> Remove</a><br id=\"mybr_' + count + '\" />').appendTo('#thumbarea');
			
					count++;					
			
	});
	
	$("#thumbarea > a").live('click', function(){

				var defid = $(this).attr("id");
				
				$('#'+defid).remove();
				var d = defid.substr(-1);
				$("#mybr_"+ d).remove();
				$("#thumb_"+d).remove();
				
			});
	
	$("#thumb-d").click(function(){
		var thumb_val = $('#thumb-r:checked').val();
		if(thumb_val == "yes")
		{
			$("#thumb-size").slideDown('slow', function(){});
		}else{
			$("#thumb-size").slideUp('slow', function(){});
			}
	});
	
	
	$("#home_thumb").click(function(){
		var thumba_val = $('#hthumb-r:checked').val();
		if(thumba_val == "yes")
		{
			$("#homethumb-size").slideDown('slow', function(){});
		}else{
			$("#homethumb-size").slideUp('slow', function(){});
			}
	});
	
});