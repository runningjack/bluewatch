<script>
 /*    $('.budget_percent').on("change",function() {
        var selectedPerc =  $(this).val();
        var project_total_budget = $('#project_total_budget').val();
        var elementName = $(this).attr('id').split("_");
        var currentPercValue = project_total_budget*(selectedPerc/100);
        var currentIndex = elementName[1];
        $('#department_budget_1').val(currentPercValue);
        
      
        console.log(elementName);
   
}); */




function calculateBudgetSubHeadSum(objectPro)
{
        $("#error_display").hide();
        let target_total_id = $(objectPro).attr('target_total_id');
        let field_value_id = $(objectPro).attr('field_value_id');
        let index = $(objectPro).attr('index');
        let element_index = $(objectPro).attr('element_index');
        let revenue_header_id = $(objectPro).attr('revenue_header_id');

        console.log("+++++++++++++++++++++++++++++++++++++++++++++++++++++++++");
        console.log("target_total_id : "+target_total_id );
        console.log("field_value_id : "+field_value_id );
        console.log("index : "+index );
        console.log("element_index : "+element_index );
        console.log("revenue_header_id : "+revenue_header_id );
        console.log("+++++++++++++++++++++++++++++++++++++++++++++++++++++++++");

        //element_index

        // alert(index);
       
        //target_total_id,field_value_id,index
        var selectedPerc =  $(objectPro).val();
        var project_total_budget = $('#'+target_total_id).val();
       
       // var elementName = $(objectPro).attr('id').split("_");
    
        var currentPercValue = project_total_budget*(selectedPerc/100);
        var currentIndex = index;
        var selectedDepartment = [];
        console.log("----------currentPercValue-----------");
        console.log("project_total_budget :" + project_total_budget);
        console.log("currentPercValue :" + currentPercValue);
        console.log("----------currentPercValue-----------");

        $('#'+"header_"+revenue_header_id+"_"+index).val(currentPercValue);


//budget_percentage_head_amount_1
 
        var total = 0;
        $( ".budget_percentage_head_amount_"+currentIndex ).each( function(){
        total += parseFloat( $( this ).val() ) || 0;
          $( this ).removeClass("input_error");
        });


        $( ".budget_head_amount_"+currentIndex ).each( function(){
        total += parseFloat( $( this ).val() ) || 0;
          $( this ).removeClass("input_error");
        });


       // $("#savebutton").prop("disabled",false);
     

       // $('#allocated_amount').text(total);
        if(total> project_total_budget)
        {            
            $("#error_display").show();
            $("#savebutton").prop("disabled",true);
            $('#department_budget_'+currentIndex).addClass('input_error');
        }else
        {
          $("#error_display").hide();
            $("#savebutton").prop("disabled",false);
            $('#department_budget_'+currentIndex).removeClass('input_error');
        }    
        

        // $( ".department" ).each( function(){
        
        //     selectedDepartment.push(parseFloat( $( this ).val() ) || 0);
        // }); 
        // selectedDepartment.forEach(function (item, index) {    
        // $('#department_'+currentIndex+' option').each(function() {
        //             if ( $(this).val() == item ) {
        //               //  $(this).remove();
        //             }
        //         });
        
        //     });

       

     
}













function calculateBudget(objectPro)
{
        $("#error_display").hide();
        var selectedPerc =  $(objectPro).val();
        var project_total_budget = $('#project_total_budget').val();
        var elementName = $(objectPro).attr('id').split("_");
       // alert(elementName);
        var currentPercValue = project_total_budget*(selectedPerc/100);
        var currentIndex = elementName[1];
        var selectedDepartment = [];
        $('#department_budget_'+currentIndex).val(currentPercValue);

        var total = 0;
        $( ".budget_shared" ).each( function(){
        total += parseFloat( $( this ).val() ) || 0;
          $( this ).removeClass("input_error");
        });
       // $("#savebutton").prop("disabled",false);

        $('#allocated_amount').text(total);
        if(total>project_total_budget)
        {            
            $("#error_display").show();
            $("#savebutton").prop("disabled",true);
            $('#department_budget_'+currentIndex).addClass('input_error');
        } else  {            
            $("#error_display").hide();
            $("#savebutton").prop("disabled",false);
            $('#department_budget_'+currentIndex).removeClass('input_error');
        }       
        

        $( ".department" ).each( function(){
        
            selectedDepartment.push(parseFloat( $( this ).val() ) || 0);
        });


        //budget_head_amount_
        

        selectedDepartment.forEach(function (item, index) {
    
        $('#department_'+currentIndex+' option').each(function() {
                    if ( $(this).val() == item ) {
                      //  $(this).remove();
                    }
                });
        
            });

       

     
}


function validateHeaderSum(objectPro)
{
  //  $("#savebutton").prop("disabled",false);
    var selectedPerc =  $(objectPro).val();
       
        var elementName = $(objectPro).attr('id').split("_"); 
        var currentIndex = elementName[2];
        var project_total_budget = $('#department_budget_'+currentIndex).val();
        var sum = 0;
        $("#error_display_"+currentIndex).hide();

    $(".budget_head_amount_"+currentIndex).each( function(){
        var curr_value = parseFloat( $( this ).val() ) || 0;
        sum = sum + curr_value;         
    });

    if(sum>(100)*project_total_budget)
    {
        $("#error_display_"+currentIndex).text("Budget Sum "+ sum +" is greater that allocated amount of " + project_total_budget);
      //  $("#error_display_"+currentIndex).show();
     //   $("#savebutton").prop("disabled",true);
    }
}

</script>