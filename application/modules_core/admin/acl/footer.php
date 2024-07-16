

	
	</div> 
	
</div></div>



<?php echo "<script src='" . base_url('bootstrap/js/upload.js') . "' type='text/javascript'></script>"; ?>

<?php echo "<script src='" . base_url('bootstrap/js/jquery.nanoscroller/jquery.nanoscroller.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.sparkline/jquery.sparkline.min.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.easypiechart/jquery.easy-pie-chart.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.nestable/jquery.nestable.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.nestable/jquery.nestable.js') . "' type='text/javascript'></script>"; ?>


<?php echo "<script src='" . base_url('bootstrap/js/jquery.select2/select2.min.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/bootstrap.slider/js/bootstrap-slider.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.gritter/js/jquery.gritter.js') . "' type='text/javascript'></script>"; ?>

<?php echo "<script src='".base_url('bootstrap/js/jquery.datatables/jquery.datatables.min.js') ."' type='text/javascript'></script>"; ?>                                   
<?php echo "<script src='".base_url('bootstrap/js/jquery.datatables/bootstrap-adapter/js/datatables.js') . "' type='text/javascript'></script>"; ?> 
<?php echo "<script src='".base_url('bootstrap/js/jquery.gritter/js/jquery.gritter.js') . "' type='text/javascript'></script>"; ?> 
 <?php echo "<script src='".base_url('bootstrap/js/jquery.niftymodals/js/jquery.modalEffects.js') . "' type='text/javascript'></script>"; ?> 

	<?php echo "<script src='" . base_url('bootstrap/js/bootstrap.switch/bootstrap-switch.min.js') . "' type='text/javascript'></script>"; ?>
	<?php echo "<script src='" . base_url('bootstrap/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js') . "' type='text/javascript'></script>"; ?>

	<?php echo "<script src='" . base_url('bootstrap/js/jquery.icheck/icheck.min.js') . "' type='text/javascript'></script>"; ?>

     <?php echo "<script src='" . base_url('bootstrap/js/behaviour/general.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.ui/jquery-ui.js') . "' type='text/javascript'></script>"; ?>




<script type="text/javascript">
      //Add dataTable Functions jjjjj
     /* var functions = $('<div class="btn-group"><button class="btn btn-default btn-xs" type="button">Actions</button><button data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle" type="button"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul role="menu" class="dropdown-menu pull-right"><li><a href="#">Edit</a></li><li><a href="#">Copy</a></li><li><a href="#">Details</a></li><li class="divider"></li><li><a href="#">Remove</a></li></ul></div>');
      $("#datatable tbody tr td:last-child").each(function(){
        $(this).html("");
        functions.clone().appendTo(this);
      });*/
      
      $(document).ready(function(){
        //initialize the javascript
        //App.init();
        App.dataTables();
        $('.md-trigger').modalEffects();
        
       /* Formating function for row details */
        function fnFormatDetails ( oTable, nTr )
        {
            var aData = oTable.fnGetData( nTr );
            var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
            sOut += '<tr><td>Rendering engine:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
            sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
            sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
            sOut += '</table>';
             
           // return sOut;
        }
       
        /*
         * Insert a 'details' column to the table
         
        var nCloneTh = document.createElement( 'th' );
        var nCloneTd = document.createElement( 'td' );
        nCloneTd.innerHTML = '<img class="toggle-details" src="<?php echo base_url('bootstrap/images/plus.png');?>" />';
        nCloneTd.className = "center";
         
        $('#datatable2 thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );
         
        $('#datatable2 tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );*/
         
        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#datatable2').dataTable( {
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']]
        });
         
        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $('#datatable2').delegate('tbody td img','click', function () {
            var nTr = $(this).parents('tr')[0];
            if ( oTable.fnIsOpen(nTr) )
            {
                /* This row is already open - close it */
                this.src = "images/plus.png";
                oTable.fnClose( nTr );
            }
            else
            {
                /* Open this row */
                this.src = "<?php echo base_url('bootstrap/images/minus.png');?>";
                oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
            }
        } );
        
      $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
     $('.dataTables_length select').addClass('form-control');    


      });
    </script>


    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
      });
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php echo "<script src='" . base_url('bootstrap/js/behaviour/voice-commands.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/bootstrap/dist/js/bootstrap.min.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.flot/jquery.flot.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.flot/jquery.flot.pie.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.flot/jquery.flot.resize.js') . "' type='text/javascript'></script>"; ?>
<?php echo "<script src='" . base_url('bootstrap/js/jquery.flot/jquery.flot.labels.js') . "' type='text/javascript'></script>"; ?>

<?php  echo "<script src='" . base_url('bootstrap/js/ajaxfileupload.js') . "' type='text/javascript'></script>"; ?>

</body>


</html>
