


<div class="container">
  <div class="content">
    <div class="content-container">
		<div class="content-header">
			<div class="dropdown pull-right bg-primary" style="padding:7px 5px 4px 5px">
				<select class="bg-primary" style="border:0" id="month" onchange="monthly_filter ();">
					<option value="">Select Month</option>
					<option value="01">January</option>
					<option value="02">February</option>
					<option value="03">March</option>
					<option value="04">April</option>
					<option value="05">May</option>
					<option value="06">June</option>
					<option value="07">July</option>
					<option value="08">August</option>
					<option value="09">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
			</div>
			<div class="dropdown pull-right bg-danger" style="padding:7px 5px 4px 5px">
				<select class="bg-danger" style="border:0" id="fieldworker" onchange="fieldworker_filter ();">
					<option value="">Select Driver</option>
					<?php foreach ($field_worker as $row) {?>
					<option value="<?php echo $row['id'];?>" ><?php echo $row['first_name']. " ".  $row['last_name'];?></option>
					<?php }?>
				</select>
			</div>
        		<h2 class="content-header-title">
				Attendance 
			</h2>
				
		</div>
		<div class="row">
	        <div class="col-md-12">
	          <div class="portlet">
	            <div class="portlet-content">           
	              <div class="table-responsive">
					<table class="table table-striped table-bordered table-hover table-highlight table-checkable" 
				                data-provide="datatable" 
				                data-display-rows="10"
				                data-info="true"
				                data-search="true"
				                data-length-change="true"
				                data-paginate="true"
				                id="table_id1">
							<thead class="thead-inverse">
								<tr>
									<th data-filterable="true" data-sortable="true"> Date</th>
					                <th data-filterable="true" data-sortable="true"> Action </th>
					                <th > Time </th>
					                <th> Location </th>
					                <th data-filterable="true" data-sortable="true"> Driver Name </th>
					           </tr>
					        </thead>
					   		<tbody>
					        <?php foreach ($attendance_list as $row) {?>
					            <tr>
									<td > <?php  echo date("d-m-Y",strtotime($row['action_time']));?> </td>
					                <td> <?php  echo $row['attendance'];?> </td>
					                <td> <?php  echo date("g:i A",strtotime($row['action_time']));?> </td>
					                <td>
					                     <?php  if($row['location'] == "" OR $row['location'] == NULL) {
								                      echo $row['location'] = "NA";
												} else {
														echo $row['location'];
												}?>
					               </td>
					               <td>
					                     <?php  if($row['fieldworker_name'] == "" OR $row['fieldworker_name'] == NULL) {
								                        echo $row['fieldworker_name'] = "NA";
												} else {
														echo $row['fieldworker_name'];
												}?>
					             </td>
					          </tr>
					       <?php }?>
					        </tbody>
					    </table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	</div>
	</div>
</div>
 <script src="<?php echo asset_url();?>js/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo asset_url();?>js/plugins/datatables/DT_bootstrap.js"></script>
  <script src="<?php echo asset_url();?>js/plugins/tableCheckable/jquery.tableCheckable.js"></script>
  <script src="<?php echo asset_url();?>js/plugins/icheck/jquery.icheck.min.js"></script>
  <script>

$('.datatable').DataTable();

function update_dataTable(data,tableid) {
    
    var oTable = $("#"+tableid).dataTable();
    oTable.fnClearTable();
    
    $(data).each(function(index) {
    	  			var row = [];
                 row.push(data[index].date);
                 row.push(data[index].action);
                 row.push(data[index].time);
                 row.push(data[index].location);
                 row.push(data[index].fieldworker_name);
                 oTable.fnAddData(row);
                 });
}

function fieldworker_filter () {
    $.post("<?php echo base_url();?>admin/filter_fieldworker_attendance",{"admin_id": $('#fieldworker').val(),"month": $('#month').val()},function(data){
           tableid="table_id1";
           update_dataTable(data,tableid);
    							
           },'json');
    
}

function monthly_filter () {
    $.post("<?php echo base_url();?>admin/filter_fieldworker_attendance",{"month": $('#month').val(),"admin_id": $('#fieldworker').val()},function(data){
           tableid="table_id1";
           update_dataTable(data,tableid);
    							
           },'json');
    
}

</script>
