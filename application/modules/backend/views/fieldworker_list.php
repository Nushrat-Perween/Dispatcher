
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
        <h2 class="content-header-title"> Driver List 	</h2>
       
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
					<th data-filterable="true" data-sortable="true"> Mobile No. </th>
					<th data-filterable="true" data-sortable="true"> Email </th>
					<th> User Role </th>
					<th >Status</th>
					<th > Last Job Assigned </th>
					
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
						<!-- <td> <?php //if($row['email'] != "") echo $row['email']; else echo "NA";?> </td> -->
						<td> <?php if($row['mobile'] != "") echo $row['mobile']; else echo "NA";?> </td>
						<td> <?php if($row['email'] != "") echo $row['email']; else echo "NA";?> </td>
						
						<td> <?php if($row['role_name'] != "") echo $row['role_name']; else echo "NA";?></td>
						<td> <?php if($row['verified'] == 1)echo "Verified";else echo "Not Verified";?></td>
						<td> <?php if($row['job_id'] != "") echo getJobID($row['job_id']); else echo "Not Assigned";?></td>
						
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
                 row.push(data[index].mobile);
                 row.push(data[index].email);
                 row.push(data[index].role_name);
                 row.push(data[index].verified);
                 row.push(data[index].job_id);

              
                 oTable.fnAddData(row);
                 });
}
</script>