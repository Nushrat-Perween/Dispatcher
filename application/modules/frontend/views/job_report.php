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
	</style>
<div class="content-view">
<div class="card">
<div class="card-header no-bg b-a-0">

<div class="dropdown pull-left " style="padding:3px 5px 4px 5px">
<H2>Job Report</H2>
</div>

<button class="btn bg-warning btn-sm pull-right no-radius" onclick="display_filter();" data-toggle="modal" data-target=".bd-example-modal-sm">
<i class="fa fa-filter" aria-hidden="true"> </i> Filter
</button>
<div class="dropdown pull-right bg-purple" style="padding:3px 5px 4px 5px">
<select class="bg-purple" style="border:0" id="period" onchange="period_filter ();">
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
	<option value="0">Low</option>
	<option value="1">Medium</option>
	<option value="2">Heigh</option>
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

<div class="dropdown pull-right bg-warning" style="padding:3px 5px 4px 5px">
<select class="bg-warning" style="border:0" id="branch" onchange="branch_filter ();">
	<option value="<?php echo $global_branch_id;?>">Branch</option>
	<?php foreach($branch_list as $row) {?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['branch_name']; ?></option>
	<?php }?>
	<option value="">All Branch</option>
</select>
</div>
<br>
<div id="filter_div" style="display:none;margin-top:35px">
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-12">
				<label class="col-md-12 control-label">Custom Date Range (dd-mm-yy):</label>
			</div>
		</div>
		
		<?php 

			$startdate = date('Y-m-d');
			$startdate = date('d-m-Y',strtotime('-7 days',strtotime($startdate)));
										
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
						</div>
						<span class="input-group-addon bg-success"><button id="range_button" style="background-color:transparent;color:white;border:0" onclick="filter();">Go</button></span>
						<span class="input-group-addon bg-primary"><button onclick="resetdate();" style="background-color:transparent;color:white;border:0">Reset</button></span>
					</div>
					</div>
				</div>
			
			</div>
		</div>
											
	</div>
	<div class="col-md-4">
		<div class="row">
			<div class="col-md-12">
				<label class="col-md-12 control-label">Search by Job ID:</label>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12 form-group">
				<div class="row">
					<div class="form-group">
					<div class="col-md-11 input-group" style="margin-left:10px;">
							<input placeholder="ID" type="text" value="" style="height:40px" name="job_id" id="job_id" class="form-control ">
							<span class="input-group-addon bg-success"><button id="jobid_button" style="background-color:transparent;color:white;border:0" >Go</button></span>
							<span class="input-group-addon bg-primary"><button onclick="resetjobid();" style="background-color:transparent;color:white;border:0">Reset</button></span>
						</div>	
					</div>
				</div>
			</div>
		</div>
		</div>
		

</div>	
<br>	<br>			
<div class="card-block">
<table class="table table-bordered datatable" id="table_id1">
<thead>
<tr>
<th width="10px;" style="padding-right:0px"> </th>
<th width="10px" style="padding-right:0px"> </th>
<th width="5%">Job ID </th>
<th width="5%"> Job Name </th>
<th width="10%"><i class="fa fa-calendar text-success" aria-hidden="true"> </i> Created Date </th>
<th width="10%"><i class="fa fa-calendar text-success" aria-hidden="true"> </i> Start Date </th>
<th width="10%"><i class="fa fa-calendar text-success" aria-hidden="true"> </i> End Date </th>
<th width="10%"><i class="fa fa-bank text-success" aria-hidden="true"> </i> Branch </th>
<th width="15%"><i class="fa fa-motorcycle text-success" aria-hidden="true"> </i> Assign </th>
<th width="15%"><i class="fa fa-motorcycle text-success" aria-hidden="true"> </i> Priority </th>
<th width="30%;text-align:left"><i class="fa fa-cogs text-success" aria-hidden="true"> </i>   Status </th>
</tr>
</thead>
<tbody >

<?php
																							
	$sr=0;
	foreach($job as $row) {
	$sr++;
	
		
?>	
<tr>
<td style="padding-left:5px !important"><a href="<?php echo base_url();?>job/job_on_map"><i class="fa fa-map text-warning" aria-hidden="true"> </i></a></td>
<td style="padding-left:5px !important"><a href="<?php echo base_url();?>edit_job/<?php echo $row['id'];?>"><i class="fa fa-external-link-square text-red" aria-hidden="true"></i></a></td>
<td><a href="<?php echo base_url();?>edit_job/<?php echo $row['id'];?>"><span class="tag bg-red"> <?php echo getJobID($row['id']);?>  </span> </a></td>
<td> <?php echo $row['job_name'];?>   </a></td>
<td> <?php if($row['created_date'] == '0000-00-00 00:00:00') echo 'NA';else echo date("d-m-Y",strtotime($row['created_date']));?>   </td>
<td> <?php if($row['start_date'] == '0000-00-00 00:00:00') echo 'NA';else echo date("d-m-Y",strtotime($row['start_date']));?>   </td>
<td> <?php if($row['end_date'] == '0000-00-00 00:00:00') echo 'NA';else echo date("d-m-Y",strtotime($row['end_date']));?>  </td>
<td> <?php echo $row['branch_name'];?>  </td>
<td> <?php echo $row['assign_to'];?> </td>
<td> <?php if($row['priority'] ==0) echo "Low"; else if($row['priority'] == 1) echo "Medium"; else if($row['priority'] == 2) echo "Heigh"; else echo "Not Define";?> </td>
<td> <?php echo $row['status'];?>  </td>


<?php }?>
</tbody>

</table>
</div>
</div>
</div>
</div>
   <!-- endbuild -->

    <!-- page scripts -->
    <script src="<?php echo asset_url();?>vendor/datatables/media/js/jquery.dataTables.js"></script>
    <script src="<?php echo asset_url();?>vendor/datatables/media/js/dataTables.bootstrap4.js"></script>
    <script src="<?php echo asset_url();?>vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js"></script>
   
    <script type="text/javascript">
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
      function resetdate()
      {
      	
      	document.getElementById('startdate').value="";
      	document.getElementById('enddate').value="";
      }

      function update_dataTable(data,tableid) {
    		
    		var oTable = $("#"+tableid).dataTable();
    	    oTable.fnClearTable();
    	  
    	    $(data).each(function(index) {
        var map ='<a><i class="fa fa-map text-warning" aria-hidden="true"> </i></a>';
        var edit = '<a href="<?php echo base_url();?>edit_job/'+data[index].id+'"><i class="fa fa-external-link-square text-red" aria-hidden="true"></i></a>';
        var job_id = '<a href="<?php echo base_url();?>edit_job/'+data[index].id+'"><span class="tag bg-red"> '+data[index].job_id+'  </span> </a>';
    	  	var row = [];
    	    	row.push(map);
    	    	row.push(edit);
    	    	row.push(job_id);
    	    	row.push(data[index].job_name);
    	    	row.push(data[index].created_date);
    	    	row.push(data[index].start_date);
    	    	row.push(data[index].end_date);
    	    	row.push(data[index].branch_name);
    	    	row.push(data[index].assign_to);
    	    	row.push(data[index].priority);
    	    	row.push(data[index].status);
    	    	
    	    	oTable.fnAddData(row);
    	    });
    	}
    	$("#range_button").click(function() {
    		$.post("<?php echo base_url();?>filter_job",{"startdate": $('#startdate').val(),"enddate": $('#enddate').val(),"branch": $('#branch').val(),"company_id":'<?php echo $global_company_id;?>'},function(data){
    			tableid="table_id1";
    			update_dataTable(data,tableid);
    				
    		},'json');
    	});
    	
    	$("#jobid_button").click(function() {
    		$.post("<?php echo base_url();?>filter_job",{"job_id": $('#job_id').val(),"company_id":'<?php echo $global_company_id;?>'},function(data){
    			tableid="table_id1";
    			update_dataTable(data,tableid);
    							
    		},'json');
    			
    	});
    
    	function period_filter () {
    		$.post("<?php echo base_url();?>filter_job",{"period": $('#period').val(),"branch": $('#branch').val(),"company_id":'<?php echo $global_company_id;?>'},function(data){
    			tableid="table_id1";
    			update_dataTable(data,tableid);
    							
    		},'json');
    			
    	}
    
    	function status_filter () {
    		$.post("<?php echo base_url();?>filter_job",{"status": $('#status').val(),"branch": $('#branch').val(),"company_id":'<?php echo $global_company_id;?>'},function(data){
    			tableid="table_id1";
    			update_dataTable(data,tableid);
    							
    		},'json');
    			
    	}
    	
    	function priority_filter () {
    		$.post("<?php echo base_url();?>filter_job",{"priority": $('#priority').val(),"branch": $('#branch').val(),"company_id":'<?php echo $global_company_id;?>'},function(data){
    			tableid="table_id1";
    			update_dataTable(data,tableid);
    							
    		},'json');
    			
    	}
    
    	function branch_filter () {
    		$.post("<?php echo base_url();?>filter_job",{"branch": $('#branch').val(),"company_id":'<?php echo $global_company_id;?>'},function(data){
    			tableid="table_id1";
    			update_dataTable(data,tableid);
    							
    		},'json');
    			
    	}
    

    </script>
