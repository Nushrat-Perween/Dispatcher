<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/selectize.bootstrap3.css">
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
                    <th data-filterable="true" data-sortable="true"> Name </th>
                    <th data-filterable="true" data-sortable="true">Branch </th>
                    <th data-filterable="true" data-sortable="true" >Client</th>
					<th >Present</th>
					<th > Action </th>
					
					
					
                    </tr>
                  </thead>
                  <tbody>
					<?php
					    $sr=0;
					    foreach($fieldworker_list as $row) {
					        $sr++;$str="";
					        ?>
					<tr>
						<td><?php echo $sr ; ?> </td>
						<td> <?php if($row['first_name']!="" || $row['last_name']!="") echo $row['first_name']." ".$row['last_name']; else echo "NA";?> </td>
						<td> <?php if($row['branch_name'] != "") echo $row['branch_name']; else echo "Not Assigned";?></td>
						<td>  <?php  foreach($data as $row1) { if($row['id']==$row1['driver_id']) { $str=$str. $row1['name']."&nbsp;,";}} echo substr_replace($str,'',-2);?> </td>
						<td> <?php  echo $row['attendance'];?> </td>
						
						<td> <a href="" onclick="edit_assign_hospital ('<?php echo $row['id'];?>');" data-toggle="modal" data-backdrop="static"  data-target="#modal-login1">Assign Client</a></td>
						
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
 
 <div class="modal fade "  id="modal-login1" tabindex="-1" role="dialog"  aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header" >
<h3 id="modal-login-label" class="web_dialog_title">
<button type="button" data-dismiss="modal" aria-hidden="true" id="close_button"
class="close">&times;</button>
<label id="pop_up_title">Assign Client </label>

</h3>
</div>

<div class="modal-body " id="modal_body">
<br> <br> <br> <br> <br> <br> <br><br> <br> <br> <br> <br> <br> <br>

</div>
</div>
</div>
</div>     
 <script src="<?php echo asset_url();?>js/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo asset_url();?>js/plugins/datatables/DT_bootstrap.js"></script>
  <script src="<?php echo asset_url();?>js/plugins/tableCheckable/jquery.tableCheckable.js"></script>
  <script src="<?php echo asset_url();?>js/plugins/icheck/jquery.icheck.min.js"></script>
  <script src="<?php echo asset_url();?>js/selectize.min.js"></script>
  <script type="text/javascript">
  
  function edit_assign_hospital (field_worker_id) {
	    document.getElementById('pop_up_title').innerHTML = "Assign Hospital";
	    $.post("<?php echo base_url();?>admin/edit_assign_hospital",{"field_worker_id":field_worker_id},function(data){
	           document.getElementById('modal_body').innerHTML=data;

				$("#hospital_id").selectize({
				    plugins: ['remove_button'],
				    delimiter: ',',
				    persist: false,
				    create: function(input) {
				        return {
				            value: input,
				            text: input
				        }
				    }
				});
			
	           });
	}

  function assign_hospital (driver_id) {
	var hospital_id=   $("#hospital_id").val();
	 $.post("<?php echo base_url();?>admin/assign_hospital_to_driver",{"driver_id":driver_id,"hospital_id": hospital_id},function(data){

			if(data.status == 1) {
				alert(data.msg);
			 	window.location.reload();
			}
			else {
				alert(data.msg);
			}
			
	 },'json');
  }
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
        var action = '<a href="" onclick="edit_assign_hospital (`'+data[index].id+'`);" data-toggle="modal" data-backdrop="static"  data-target="#modal-login1">Assign Client</a>';
                 var row = [];
                 row.push(data[index].sr);
                 row.push(data[index].name);
                 row.push(data[index].branch_name);
                 row.push(data[index].attendance);
                 row.push(action);

                 oTable.fnAddData(row);
                 });
}
</script>