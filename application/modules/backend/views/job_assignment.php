<!-- build:css({.tmp,app}) styles/app.min.css -->
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/dist/css/bootstrap.css"/>
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.css"/>
<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-timepicker.min.css">

<style>
.messageContainer {
	color:red;
	margin-left:3%;
}
</style>
<!-- endbuild -->
<div class="content-view" style="margin-left:30%">
<div class="row">
<div class="col-md-offset-3 col-md-6">
<div class="card card-block">
<h2>Assign Job To Fieldworker </h2><br>
<div class="form-control" id="response" style="display: none"> </div>
<form class="form-validation form-horizontal" method="POST" action="" name="assign_form" id="assign_form" enctype="multipart/form-data">

<input type="hidden"  value="<?php echo $job_id;?>" name="data[id]" id="id">


<div class="form-group m-b">
<label>
Start Date
</label>
<div class="row">

<div class="col-md-10 input-group">
	<input  type="text" value="<?php if(isset($job)) {if($job['start_date'] != NULL)echo date("d-m-Y",strtotime($job['start_date']));else echo date("d-m-Y"); } else echo date("d-m-Y");?> " name="data[start_date]" id="start_date" placeholder="Start Date" class="form-control" />
	<span class="input-group-addon" ><i class="fa fa-calendar"></i></span></div>
<div class="messageContainer"></div>
	
</div>
</div>

<div class="form-group m-b">
<label>
Start Time
</label>
<div class="row">

<div class="col-md-10 input-group">
	<input  type="text" value="<?php if(isset($job)) {if($job['start_time'] != NULL)echo date("g:i A",strtotime($job['start_time'])); }?>" name="data[start_time]" id="start_time" placeholder="Start Date" class="form-control" />
	<span class="input-group-addon" ><i class="fa fa-clock-o"></i></span></div>
<div class="messageContainer"></div>
	
</div>
</div>

<div class="form-group m-b">
<label>
Estimated Duration
</label>
<div class="row">

<div class="col-md-10 input-group">
	<input  type="text" value="<?php if(isset($job)) { if($job['estimated_duration'] != NULL)echo $job['estimated_duration']; }?>" name="data[estimated_duration]" id="estimated_duration" placeholder="Duration" class="form-control" />
	<span class="input-group-addon" >Hr</span></div>
<div class="messageContainer"></div>
	
</div>
</div>

<div class="form-group m-b">
<label>
Fieldworker
</label>
<div class="row">
<div class="col-md-10 input-group">
<select name="data[assign_to]" id="assign_to" class="form-control">
<option value="">Select </option>
<?php foreach ($field_worker as $row) {?>
<option value="<?php echo $row['id'];?>" <?php if($job['assign_to'] == $row['id']) echo "selected";?>><?php echo $row['first_name']. " ".  $row['last_name'];?></option>
<?php }?>
</select>
</div>
<div class="messageContainer"></div>
</div>
</div>

<div class="form-group m-b">
<label>
Job Priority
</label>
<div class="row">
<div class="col-md-10 input-group">
<select name="data[priority]" id="priority" class="form-control">
<option value="">Select </option>
<option value="0" <?php if(isset($job)) { if($job['priority'] == 0) { echo "selected";}}?>>Low</option>
<option value="1" <?php if(isset($job)) { if($job['priority'] == 1) { echo "selected";}}?>>Medium</option>
<option value="2" <?php if(isset($job)) { if($job['priority'] == 1) { echo "selected";}}?>>Heigh</option>

</select>
</div>
<div class="messageContainer"></div>
</div>
</div>

<div class="form-group m-b">
<label>
 Job Type
</label>
<div class="row">
	<div class="col-md-10 input-group">
		<select name="data[job_type_id]" id="job_type_id" class="form-control">
			<option value="">Select </option>
			<option value="0" <?php if(isset($job)) { if($job['job_type_id'] == 0) { echo "selected";}}?>>One Time Job</option>
			<option value="1" <?php if(isset($job)) { if($job['job_type_id'] == 1) { echo "selected";}}?>>Regular Job</option>
		</select>
	</div>
	<div class="messageContainer"></div>
</div>
</div>

<div class="form-group m-b">
<label>
Time Of Job Notification To Send On Mobile Device
</label>
<div class="row">
	<div class="col-md-10 input-group">
		<select name="data[notification_time]" id="notification_time" class="form-control">
			<option value=""> Select </option>
			<option value="0" <?php if(isset($job)) { if($job['notification_time'] == 0) { echo "selected";}}?>>Now</option>
			<option value="1" <?php if(isset($job)) { if($job['notification_time'] == 1) { echo "selected";}}?>>1 Day before the schedule day start</option>
			<option value="2" <?php if(isset($job)) { if($job['notification_time'] == 2) { echo "selected";}}?>>On</option>
			
		</select>
	</div>
	<div class="messageContainer"></div>
</div>
</div>

<div class="form-group">
<?php if(isset($locality)) {?>
<button type="submit" class="btn btn-primary m-r">
Update
</button>
<a href="<?php echo base_url();?>admin/locality_list"><button type="button" class="btn btn-default" >
Cancel
</button>
</a>
<?php } else {?>
<button type="submit" class="btn btn-primary m-r">
Submit
</button>
<button type="reset" id="reset" class="btn btn-default" >
Reset
</button>
<?php }?>
</div>
</form>
</div>
</div>
</div>
</div>

<script src="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>vendor/bootstrap/jquery.form.js"></script>
<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrap-timepicker.min.js"></script>
<!-- end page scripts -->

<!-- initialize page scripts -->
<script type="text/javascript">

$(document).ready(function() {
	$('#start_time').timepicker(); 
	$("#start_date").datepicker({format:"dd-mm-yyyy"});
 	});
// $('.form-validation').validate();
$("#assign_form").submit(function(e) {
	e.preventDefault();
});
	$('#assign_form').bootstrapValidator({
		container: function($field, validator) {
			return $field.parent().next('.messageContainer');
		},
		feedbackIcons: {
			validating: 'glyphicon glyphicon-refresh'
		},
		excluded: ':disabled',
		fields: {


			'data[assign_to]': {
			validators: {
				notEmpty: {
					message: ' Fieldworker is required and cannot be empty'
				}
			}
		},
			'data[priority]': {
			validators: {
				notEmpty: {
					message: ' Priority is required and cannot be empty'
				}
			}
		},
		 
		'data[job_type_id]': {
		validators: {
			notEmpty: {
				message: ' Job Type is required and cannot be empty'
			}
		}
		},
		 
		'data[notification_time]': {
		validators: {
			notEmpty: {
				message: ' Notification Time is required and cannot be empty'
			}
		}
		},
		 
		'data[start_date]': {
		validators: {
			notEmpty: {
				message: ' Start date is required and cannot be empty'
			}
		}
		},
		
		'data[estimated_duration]': {
		validators: {
			notEmpty: {
				message: ' Estimated duration is required and cannot be empty'
			}
		}
		},
		
		'data[start_time]': {
		validators: {
			notEmpty: {
				message: ' Start time is required and cannot be empty'
			}
		}
		}

		}
	}).on('success.form.bv', function(e) {
		// Prevent form submission
		e.preventDefault();
		update_job_assignment ();
	});

		function update_job_assignment () {
			dataString = $("#assign_form").serialize();
			$(".text-danger").hide();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/job/update_job_assignment",
				data: dataString,
				dataType: 'json',
				success: function(resp){
					if(resp.status == '0') {
						$("#response").addClass('alert-danger');
						$("#response").html(resp.msg);
						$("#response").show();
							

					} else {
						// 	$("#assign_form").reset();
						$('#reset').click();
						$("#response").show();
						$("#response").addClass('alert-success');
						$("#response").html(resp.msg);
						alert("Assigned successfully.");
						//window.location.href = "<?php echo base_url(); ?>admin/add_locality";
					}
				}

			});
				return false;  //stop the actual form post !important!
		}
		
		
	
		</script>