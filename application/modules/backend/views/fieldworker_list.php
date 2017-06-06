
<div class="container">

  <div class="content">

    <div class="content-container">
      <div class="content-header">
      
			
	    <button class="btn bg-primary btn-sm pull-right no-radius" onclick="history.go(-1);">
			<i class="fa fa-back" aria-hidden="true"> </i> Back
		</button>&nbsp;&nbsp;
			<div class="dropdown pull-right bg-warning" style="padding:3px 5px 4px 5px;margin-right:15px;background-color:#4cae4c">
					<select class="bg-warning" style="border:0;background-color:#4cae4c" id="branch_id" onchange="branch_filter ();">
						<option value="">Select Branch</option>
						<?php foreach($branchlist as $item){?>
						<option value="<?php echo $item['id']?>"><?php echo $item['branch_name']?></option>
						<?php }?>
					</select>
				</div>
        <h2 class="content-header-title"> Schedule	</h2>
       
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
                data-paginate="true" id="table_id1"
              >
                  <thead>
                    <tr>
                    <th  data-filterable="true" data-sortable="true">Sr.No</th>
                    <th data-filterable="true" data-sortable="true">Branch </th>
					<th data-filterable="true" data-sortable="true"> Name </th>
					<!-- <th width="5%"> Email </th> -->
					<th >Present</th>
					<th > Last Job Assigned </th>
					<th data-filterable="true" data-sortable="true"> Start Time</th>
					<th data-filterable="true" data-sortable="true"> End Time</th>
					
					
					
                    </tr>
                  </thead>
                  <tbody>
					<?php
					    $sr=0;
					    foreach($fieldworker_list as $row) {
					        $sr++;
					        ?>
					<tr>
						<td><?php echo $sr ; ?> </td>
						<td> <?php if($row['branch_name'] != "") echo $row['branch_name']; else echo "Not Assigned";?></td>
						<td> <?php if($row['first_name']!="" || $row['last_name']!="") echo $row['first_name']." ".$row['last_name']; else echo "NA";?> </td>
						<!-- <td> <?php //if($row['email'] != "") echo $row['email']; else echo "NA";?> </td> 
						<td> <?php // if($row['present'] != "") echo $row['present']; else echo "NA";?> </td>-->
						<td> <?php  echo "NA";?> </td>
						<td> <?php if($row['job_id'] != "") echo getJobID($row['job_id']); else echo "Not Assigned";?></td>
						<td> <?php if($row['start_date'] != "") echo date("d-m-Y",strtotime($row['start_date']))." ".date("g:i A",strtotime($row['start_time'])); else echo "NA";?></td>
						<td> <?php if($row['end_date'] == 1)echo date("d-m-Y",strtotime($row['end_date']))." ".date("g:i A",strtotime($row['end_time']));else echo "NA";?></td>
						
						</td>
					</tr>
					
					<?php }?>
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
  <script type="text/javascript">
  
 function branch_filter () {
    $.post("<?php echo base_url();?>admin/filter_driver_list",{"branch_id": $('#branch_id').val()},function(data){
           tableid="table_id1";
           update_dataTable(data,tableid);
    							
           },'json');
    
}
 
function update_dataTable(data,tableid) {
    
    var oTable = $("#"+tableid).dataTable();
    oTable.fnClearTable();
    
    $(data).each(function(index) {
                 var row = [];
                 row.push(data[index].sr);
                 row.push(data[index].branch_name);
                 row.push(data[index].name);
                 row.push('NA');
                 row.push(data[index].job_id);
                 row.push(data[index].start_date);
                 row.push(data[index].end_date);

              
                 oTable.fnAddData(row);
                 });
}
</script>