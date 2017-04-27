<!-- page stylesheets -->
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/datatables/media/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/dist/css/bootstrap.css"/>

<!-- page stylesheets -->
<style>
td{font-size:0.9em;padding:5px 5px 5px 5px !important;text-align:center}
th{text-align:center}
hr{margin-bottom:0rem}
.icon-arrow-left {
color:black;
}
.modal-body {
position: relative;
    padding-left: 20%;
    padding-right: 20%;
}
.dataTables_wrapper {
    overflow-x: scroll;
}
.thead-inverse th {
color: #fff;
    background-color: #0275d8;
}
.prev,.next{
color:#fff;
background-color: #0275d8;
}
</style>
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
</script>
<div class="content-view">

	<div class="card">
		<div class="card-header no-bg b-a-0">
			<div class="dropdown pull-left " style="padding:3px 5px 4px 5px">
				<H2>List Of Jobs</H2>
			</div>
			<!--<button class="btn bg-warning btn-sm pull-right no-radius" onclick="display_filter();" >
			<i class="fa fa-filter" aria-hidden="true"> </i> Filter -->
			<!-- </button> -->
			<div class="dropdown pull-right bg-primary" style="padding:3px 5px 4px 5px">
				<select class="bg-primary" style="border:0" id="period" onchange="period_filter ();">
					<option value="">Period</option>
					<option value="1">Today</option>
					<option value="2">This week</option>
					<option value="3">This month</option>
					<option value="4">This year</option>
				</select>
			</div>
			<div class="dropdown pull-right bg-warning" style="padding:3px 5px 4px 5px">
				<select class="bg-warning" style="border:0" id="priority" onchange="priority_filter ();">
					<option value="">Priority</option>
					<option value="0">AM</option>
					<option value="1">Timed</option>
					<option value="2">Stat</option>
					<option value="3">Today</option>
				</select>
			</div>
			<div class="dropdown pull-right bg-success" style="padding:3px 5px 4px 5px">
				<select class="bg-success" style="border:0" id="status" onchange="status_filter ();">
					<option value="">Status</option>
					<?php foreach($job_status_list as $row) {?>
					<option value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
					<?php }?>
				</select>
			</div>
			<div class="dropdown pull-right bg-purple" style="padding:3px 5px 4px 5px">
				<select class="bg-purple" style="border:0" id="action" onchange="action_filter ();">
					<option value="">State</option>
					<?php foreach($job_action_list as $row) {?>
					<option value="<?php echo $row['id']; ?>"><?php echo $row['action']; ?></option>
					<?php }?>
				</select>
			</div>
			<br>
			<div id="filter_div" style="display:block;margin-top:35px">
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-12">
						<label class="col-md-12 control-label">Custom Date Range (dd-mm-yy) :</label>
						</div>
					</div>
					<?php
					    $startdate = date('Y-m-d');
					    $startdate = date('d-m-Y');
					 ?>
					<div class="row">
						<div class="col-md-12 form-group">
							<div class="row">
								<div class="form-group">
									<div class="col-md-11 input-group" style="margin-left:10px;">
										<div class="input-group input-daterange">
											<input placeholder="From" type="text" style="height:40px" name="startdate" id="startdate" value="<?php echo $startdate;?>" class="form-control ">
											<span class="input-group-addon btn-success" style="border:0">-</span>
											<input placeholder="To" type="text" value="" style="height:40px" name="enddate" id="enddate" class="form-control datepicker">
											<span class="input-group-addon btn-success" style="border:0">-</span>
											<select class="form-control" id="time_period" onchange="time_period_filter ();">
												<option value="">Time Period</option>
												<option value="AM">AM</option>
												<option value="PM">PM</option>
											</select>
										</div>
										<span class="input-group-addon bg-success"><button id="range_button" style="background-color:transparent;color:white;border:0" >Go</button></span>
										<span class="input-group-addon bg-primary"><button onclick="resetdate();" style="background-color:transparent;color:white;border:0">Reset</button></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="col-md-4"> -->
				<!-- <div class="row"> -->
				<!-- <div class="col-md-12"> -->
				<!-- <label class="col-md-12 control-label">Search by Job ID:</label> -->
				<!-- </div> -->
				<!-- </div> -->
				
				<!-- <div class="row"> -->
				<!-- <div class="col-md-12 form-group"> -->
				<!-- <div class="row"> -->
				<!-- <div class="form-group"> 
				<div class="col-md-11 input-group" style="margin-left:10px;">
				<input placeholder="ID" type="text" value="" style="height:40px" name="job_id" id="job_id" class="form-control ">
				<span class="input-group-addon bg-success"><button id="jobid_button" style="background-color:transparent;color:white;border:0" >Go</button></span>
				<span class="input-group-addon bg-primary"><button onclick="resetjobid();" style="background-color:transparent;color:white;border:0">Reset</button></span>
				<!-- </div> -->
				<!-- </div> -->
				<!-- </div> -->
				<!-- </div> -->
				<!-- </div> -->
				<!-- </div> -->
				
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-12">
							<label class="col-md-12 control-label">Search by Job Name:</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<div class="row">
								<div class="form-group">
									<div class="col-md-11 input-group" style="margin-left:10px;">
										<input placeholder="Job Name" type="text" value="" style="height:40px" name="job_name" id="job_name" class="form-control ">
										<span class="input-group-addon bg-success"><button id="jobname_button" style="background-color:transparent;color:white;border:0" >Go</button></span>
										<span class="input-group-addon bg-primary"><button onclick="resetjobname();" style="background-color:transparent;color:white;border:0">Reset</button></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br><br><br><br><br><br>
			<div class="dataTables_wrapper">
				<table class="table table-bordered datatable" id="table_id1">
					<thead class="thead-inverse">
						<tr>
							<th> Job Name </th>
							<th > Delivery Date </th>
							<th > Delivery Time </th>
<!-- 							<th > Start&nbsp;Date </th> -->
<!-- 							<th > Start&nbsp;Time </th> -->
<!-- 							<th > End&nbsp;Date </th> -->
<!-- 							<th > End&nbsp;Time </th> -->
							<th>Re-&nbsp;Assign </th>
							<th > Priority </th>
							<th > State</th>
							<th > Status </th>
							<th > Job Assignment </th>
						</tr>
					</thead>
					<tbody >
						<?php
						    $sr=0;
						    foreach($job as $row) {
						        $sr++;
						    ?>
						<tr>
							<td><a href="<?php echo base_url();?>client/edit_client_job/<?php echo $row['id']?>">Edit</a></td>
							<td> <u><a href="job_detail/<?php echo $row['id']?>"><?php echo $row['job_name'];?></a></u></td>
							<td> <?php if($row['delivery_date'] == NULL) echo 'NA';else echo date("d-m-Y",strtotime($row['delivery_date']));?> </td>
							<td> <?php if($row['delivery_time'] == NULL) echo 'NA';else echo date("g:i A",strtotime($row['delivery_time']));?>   </td>
							<!--  <td> <?php if($row['start_date'] == NULL) echo 'NA';else echo date("d-m-Y",strtotime($row['start_date']));?>   </td>
							<td> <?php if($row['start_time'] == NULL) echo 'NA';else echo date("g:i A",strtotime($row['start_time']));?>   </td>
							<td> <?php if($row['end_date'] == NULL) echo 'NA';else echo date("d-m-Y",strtotime($row['end_date']));?>  </td>
							<td> <?php if($row['end_time'] == NULL) echo 'NA';else echo date("g:i A",strtotime($row['end_time']));?>   </td>-->
							<td> <a href=""  class="txt-warning" onclick="edit_assign_job_to_fieldworker ('<?php echo $row['id'];?>','<?php echo $row['assign_to'];?>');" data-toggle="modal" data-backdrop="static"  data-target="#modal-login1"><i class="fa fa-edit text-primary"></i>&nbsp;<?php if($row['fieldworker_name'] == "" or $row['fieldworker_name'] == NULL) echo "Not Assigned"; else echo $row['fieldworker_name'];?> </a></td>
							<td> <?php if($row['priority'] ==0) echo "AM"; else if($row['priority'] == 1) echo "Timed"; else if($row['priority'] == 2) echo "Stat"; else if($row['priority'] == 3) echo "Today"; else echo "Not Define";?> </td>
							<td> <a href=""  class="txt-warning" data-toggle="modal" data-backdrop="static"  onclick="edit_action ('<?php echo $row['id'];?>','<?php echo $row['action_id'];?>');" data-target="#modal-login1"><i class="fa fa-edit text-primary"></i>&nbsp;<?php echo $row['action'];?> </a> </td>
							<td> <?php echo $row['status'];?>  </td>
							<td><a href="<?php echo base_url();?>admin/job/assignment/<?php echo $row['id'];?>" class="bg-green" style="margin:2px">&nbsp;&nbsp;<i class="fa fa-pencil text-white"></i>&nbsp;Assign&nbsp;&nbsp;</a></td>
						<?php }?>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- endbuild -->

<div class="modal fade "  id="modal-login1" tabindex="-1" role="dialog"  aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header" >
<h3 id="modal-login-label" class="web_dialog_title">
<button type="button" data-dismiss="modal" aria-hidden="true" id="close_button"
class="close">&times;</button>
<label id="pop_up_title">Assign Field Worker </label>

</h3>
</div>

<div class="modal-body " id="modal_body">
<br> <br> <br> <br> <br> <br> <br><br> <br> <br> <br> <br> <br> <br>

</div>
</div>
</div>
</div>
<!-- page scripts -->
<script src="<?php echo asset_url();?>vendor/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo asset_url();?>vendor/datatables/media/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo asset_url();?>vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">

function edit_assign_job_to_fieldworker (job_id,field_worker_id) {
    document.getElementById('pop_up_title').innerHTML = "Assign Job To Field Worker";
    $.post("<?php echo base_url();?>admin/job/edit_assign_fieldworker",{"job_id":job_id,"field_worker_id":field_worker_id},function(data){
           document.getElementById('modal_body').innerHTML=data;
           });
}

function update_assign_job_to_fieldworker (job_id) {
    //alert(id);
    if($('#field_worker_id').val().length > 0)
    {
        ajaxindicatorstart("Please wait. System is processing your request......");
        $.post("<?php echo base_url();?>admin/job/save_fieldworker_to_job",{"id":job_id,"assign_to": $('#field_worker_id').val()},function(data){
               if(data.status) {
               document.getElementById('update_job_alert').style.display = "block";
               document.getElementById('not_update_job_alert').style.display = "none";
               alert("Updated Successfully.");
               $.post("<?php echo base_url();?>admin/filter_job",{},function(data1){
                      tableid="table_id1";
                      update_dataTable(data1,tableid);
                      document.getElementById("close_button").click(); 
                      ajaxindicatorstop();
                      },'json');
               } else {
               document.getElementById('not_update_job_alert').style.display = "block";
               document.getElementById('update_job_alert').style.display = "none";
               ajaxindicatorstop();
               }
               
               },'json');
    } else {
        alert("Please select field worker.");
    }
    
}

function edit_action (id,action_id) {
    document.getElementById('pop_up_title').innerHTML = "Update Job Action";
    $.post("<?php echo base_url();?>admin/job/edit_job_action",{"id":id,"action_id":action_id},function(data){
           document.getElementById('modal_body').innerHTML=data;
           });
}

function update_job_action (id) {
    //alert(id);
    if($('#action_id').val().length > 0)
    {
        ajaxindicatorstart("Please wait. System is processing your request......");
        $.post("<?php echo base_url();?>admin/job/update_job_action",{"id":id,"action_id": $('#action_id').val()},function(data){
               if(data.status) {
               document.getElementById('update_job_alert').style.display = "block";
               document.getElementById('not_update_job_alert').style.display = "none";
               alert("Updated Successfully.");
               $.post("<?php echo base_url();?>admin/filter_job",{},function(data1){
                      tableid="table_id1";
                      update_dataTable(data1,tableid);
                      document.getElementById("close_button").click(); 
                      ajaxindicatorstop();
                      },'json');
               } else {
               document.getElementById('not_update_job_alert').style.display = "block";
               document.getElementById('update_job_alert').style.display = "none";
               ajaxindicatorstop();
               }
               
               },'json');
    } else {
        alert("Please select field worker.");
    }
    
}

$('.datatable').DataTable();

function display_filter() {
    $("#filter_div").slideToggle("slow");
}

$(document).ready(function() {
                  $("#startdate").datepicker({format:"dd-mm-yyyy"});
                  $("#enddate").datepicker({format:"dd-mm-yyyy"});
                  });

function resetjobid()
{
    document.getElementById('job_id').value="";
    
}

function resetjobname()
{
    document.getElementById('job_name').value="";
    
}

function resetdate()
{
    
    document.getElementById('startdate').value="";
    document.getElementById('enddate').value="";
    document.getElementById('time_period').value="";
}

function update_dataTable(data,tableid) {
    
    var oTable = $("#"+tableid).dataTable();
    oTable.fnClearTable();
    
    $(data).each(function(index) {
                 var order_details = '<u><a href="job_detail/'+data[index].id+'">'+data[index].job_name+'</a></u>';
                 var map ='<a><i class="fa fa-map text-warning" aria-hidden="true"> </i></a>';
                 var edit = '<a href="<?php echo base_url();?>edit_job/'+data[index].id+'"><i class="fa fa-external-link-square text-red" aria-hidden="true"></i></a>';
                 var job_id = '<a href="<?php echo base_url();?>admin/job_detail/'+data[index].id+'"><span class="tag bg-red"> '+data[index].job_id+'  </span> </a>';
                 var assign_to = '<a href=""  class="txt-warning" onclick="edit_assign_job_to_fieldworker (`'+data[index].id+'`,`'+data[index].assign_to+'`);" data-toggle="modal" data-backdrop="static"  data-target="#modal-login1"><i class="fa fa-edit text-primary"></i>&nbsp;'+data[index].fieldworker_name+'</a>';
                 var action = '<a href=""  class="txt-warning" data-toggle="modal" data-backdrop="static"  onclick="edit_action (`'+data[index].id+'`,`'+data[index].action_id+'`);" data-target="#modal-login1"><i class="fa fa-edit text-primary"></i>&nbsp;'+data[index].action+' </a> ';
                 var assign = '<a href="<?php echo base_url();?>admin/job/assignment/'+data[index].id+'" class="bg-green" style="margin:2px">&nbsp;&nbsp;<i class="fa fa-pencil text-white"></i>&nbsp;Assign&nbsp;&nbsp;</a>'
                 var row = [];
                 
                 row.push(order_details);
                 row.push(data[index].delivery_date);
                 row.push(data[index].delivery_time);
//                  row.push(data[index].start_date);
//                  row.push(data[index].start_time);
//                  row.push(data[index].end_date);
//                  row.push(data[index].end_time);
                 row.push(assign_to);
                 row.push(data[index].priority);
                 row.push(action);
                 row.push(data[index].status);
                 row.push(assign);
                 oTable.fnAddData(row);
                 });
}
$("#range_button").click(function() {
                         $.post("<?php echo base_url();?>admin/filter_job",{"time_period": $('#time_period').val(),"startdate": $('#startdate').val(),"enddate": $('#enddate').val()},function(data){
                                tableid="table_id1";
                                update_dataTable(data,tableid);
                                
                                },'json');
                         });

$("#jobid_button").click(function() {
                         $.post("<?php echo base_url();?>admin/filter_job",{"job_id": $('#job_id').val(),"startdate": "","enddate": ""},function(data){
                                tableid="table_id1";
                                update_dataTable(data,tableid);
                                
                                },'json');
                         
                         });
                         
$("#jobname_button").click(function() {
                         $.post("<?php echo base_url();?>admin/filter_job",{"job_name": $('#job_name').val(),"startdate": "","enddate": ""},function(data){
                                tableid="table_id1";
                                update_dataTable(data,tableid);
                                
                                },'json');
                         
                         });

function period_filter () {
    $.post("<?php echo base_url();?>admin/filter_job",{"period": $('#period').val(),"startdate": "","enddate": ""},function(data){
           tableid="table_id1";
           update_dataTable(data,tableid);
    							
           },'json');
    
}

function status_filter () {
    $.post("<?php echo base_url();?>admin/filter_job",{"status": $('#status').val(),"startdate": $('#startdate').val(),"enddate": $('#enddate').val()},function(data){
           tableid="table_id1";
           update_dataTable(data,tableid);
    							
           },'json');
    
}

function action_filter () {
    $.post("<?php echo base_url();?>admin/filter_job",{"action": $('#action').val(),"startdate": $('#startdate').val(),"enddate": $('#enddate').val()},function(data){
           tableid="table_id1";
           update_dataTable(data,tableid);
    							
           },'json');
    
}

function priority_filter () {
    $.post("<?php echo base_url();?>admin/filter_job",{"priority": $('#priority').val(),"startdate": $('#startdate').val(),"enddate": $('#enddate').val()},function(data){
           tableid="table_id1";
           update_dataTable(data,tableid);
    							
           },'json');
    
}

function time_period_filter () {
    $.post("<?php echo base_url();?>admin/filter_job",{"time_period": $('#time_period').val(),"startdate": $('#startdate').val(),"enddate": $('#enddate').val()},function(data){
        tableid="table_id1";
        update_dataTable(data,tableid);
 							
        },'json');
}

</script>