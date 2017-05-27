
<div class="container">

  <div class="content">

    <div class="content-container">
      <div class="content-header">
      <div class="dropdown pull-right bg-primary" style="padding:7px 5px 4px 5px">
					<select class="bg-primary" style="border:0" id="cep">
					<option value="">Fieldworker</option>
					<?php foreach($fieldworker as $row) {?>
					<option value="<?php echo $row['id']; ?>"><?php echo $row['first_name']; ?></option>
					<?php }?>
					</select>
			</div>
        <h2 class="content-header-title"> Schedule 	</h2>
      
		
		
      </div> <!-- /.content-header -->
      <div class="row">

        <div class="col-md-12">

          <div class="portlet">
            <div class="portlet-content">           

              <div class="table-responsive">

              <table 
                class="table table-striped table-bordered table-hover table-highlight table-checkable" 
                data-provide="datatable" 
                data-display-rows="10"
                data-info="true"
                data-search="true"
                data-length-change="true"
                data-paginate="true"
              >
                  <thead>
                    <tr>
                    <th> Job Name </th>
					<th > Start Time </th>
					<th > End Time </th>
					<th > Last Action </th>
					<th>Current Location</th>
					<th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
					
					<tr>
					<td> </td>
					<td> </td>
					<td> </td>
					<td> </td>
					<td> </td>
					<td> </td>
					</tr>
					
                  </tbody>
                </table>
              </div> <!-- /.table-responsive -->
              

            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet -->

        

        </div> <!-- /.col -->

      </div> <!-- /.row -->
    </div>
  </div>
 </div>
      
 <script src="<?php echo asset_url();?>js/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo asset_url();?>js/plugins/datatables/DT_bootstrap.js"></script>
  <script src="<?php echo asset_url();?>js/plugins/tableCheckable/jquery.tableCheckable.js"></script>
  <script src="<?php echo asset_url();?>js/plugins/icheck/jquery.icheck.min.js"></script>
  
 <script>
Pusher.log = function(message) {
    if (window.console && window.console.log) {
        window.console.log(message);
    }
};

var pusher = new Pusher('<?php echo $pusher_key;?>');
var channel = pusher.subscribe('test_channel');
channel.bind('my_event', function(data) {
             if(data.notification_type == 1 || data.notification_type == 2) {
             //			$.post("<?php echo base_url();?>admin/update_jobList_through_pusher",{},function(res) {
             // 				tableid="table_id1";
             // 				update_dataTable(res,tableid);
             // 			},'json');
             }
             });


	
function update_dataTable () {

	 $.get("<?php echo base_url();?>admin/getfieldworkerschedule/"+$('#cep').val(),{},function(data){
	    var oTable = $("#schedular").dataTable();
	   
	    oTable.fnClearTable();
	    var row = [];
	    $(data).each(function(index) {
	                 row.push(data[index].job_name);
	                 row.push(data[index].start_time);
	                 row.push(data[index].end_time);
	                 row.push(data[index].action);
	                 row.push(data[index].current_location);
	                 row.push(data[index].status);
	                 oTable.fnAddData(row);
	                 });

},'json');	
}
    
});

</script>



	




</script>