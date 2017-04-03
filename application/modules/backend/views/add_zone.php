<!-- build:css({.tmp,app}) styles/app.min.css -->
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/dist/css/bootstrap.css"/>
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.css"/>

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
<h2><?php if(isset($zone)) { echo "Update ";} else { echo "Add ";}?> Zone</h2>
<br>
<div class="form-control" id="response" style="display: none"> </div>
<form class="form-validation form-horizontal" method="POST" action="" name="zone_form" id="zone_form" enctype="multipart/form-data">
<?php  if(isset($zone)) { ?>
<input type="hidden"  value="<?php echo $zone['id'];?>" name="data[id]" id="id">
<?php }?>
<div class="form-group m-b">
<label>
Select City
</label>
<div class="row">
<div class="col-md-10 input-group">
<select class="form-control" name="data[city_id]"  id="city_id" required>
	<option value="">Select</option>
	<?php foreach ($city as $row) {?>
	<option value="<?php echo $row['id'];?>" <?php if(isset($zone)) { if($zone['city_id'] == $row['id']) { echo "selected";}}?>><?php echo $row['city_name'];?></option>
	<?php }?>
</select>
</div>
<div class="messageContainer"></div>
</div>
</div> 

<div class="form-group m-b">
<label>
Name :
</label>
<div class="row">
<div class="col-md-10 input-group">
<input type="text"  class="form-control" name="data[name]" id="name" placeholder="Zone" value="<?php if(isset($zone)) {echo $zone['name'];}?>" required/>
</div>
<div class="messageContainer"></div>
</div>
</div>

<div class="form-group m-b">
<label>
Select Status
</label>
<div class="row">
<div class="col-md-10 input-group">
<select class="form-control" name="data[status]"  id="status" required>
<option value="">Select Status</option>
<option value="1" <?php if(isset($zone)) { if($zone['status'] == 1) { echo "selected";}}?>>Active</option>
<option value="0" <?php if(isset($zone)) { if($zone['status'] == 0) { echo "selected";}}?>>Deactive</option>
</select>
</div>
<div class="messageContainer"></div>
</div>
</div> 

<div class="form-group">
<?php if(isset($zone)) {?>
<button type="submit" class="btn btn-primary m-r">
Update
</button>
<a href="<?php echo base_url();?>admin/zone_list"><button type="button" class="btn btn-default" >
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
<!-- end page scripts -->

<!-- initialize page scripts -->
<script type="text/javascript">
// $('.form-validation').validate();
$("#zone_form").submit(function(e) {
	e.preventDefault();
});
	$('#zone_form').bootstrapValidator({
		container: function($field, validator) {
			return $field.parent().next('.messageContainer');
		},
		feedbackIcons: {
			validating: 'glyphicon glyphicon-refresh'
		},
		excluded: ':disabled',
		fields: {


			'data[city_id]': {
			validators: {
				notEmpty: {
					message: ' City name is required and cannot be empty'
				}
			}
		},
			'data[name]': {
			validators: {
				notEmpty: {
					message: ' Zone name is required and cannot be empty'
				}
			}
		},
			'data[status]': {
			validators: {
				notEmpty: {
					message: ' Status is required and cannot be empty'
				}
			}
		}
			
		}
	}).on('success.form.bv', function(e) {
		// Prevent form submission
		e.preventDefault();
		<?php if(isset($zone)) {?>
		update_zone ();
	<?php } else {?>
		save_zone ();
	<?php }?>
	});

		function save_zone () {
			dataString = $("#zone_form").serialize();
			$(".text-danger").hide();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/save_zone",
				data: dataString,
				dataType: 'json',
				success: function(resp){
					if(resp.status == '0') {
						$("#response").addClass('alert-danger');
						$("#response").html(resp.msg);
						$("#response").show();
							

					} else {
						// 	$("#zone_form").reset();
						$('#reset').click();
						$("#response").show();
						$("#response").addClass('alert-success');
						$("#response").html(resp.msg);
						alert("Zone added successfully.");
						//window.location.href = "<?php echo base_url(); ?>admin/add_zone";
					}
				}

			});
				return false;  //stop the actual form post !important!
		}
		
		function update_zone () {
			dataString = $("#zone_form").serialize();
			$(".text-danger").hide();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/update_zone",
				data: dataString,
				dataType: 'json',
				success: function(resp){
					if(resp.status == '0') {
						$("#response").addClass('alert-danger');
						$("#response").html(resp.msg);
						$("#response").show();
							

					} else {
						// 	$("#zone_form").reset();
						$('#reset').click();
						$("#response").show();
						$("#response").addClass('alert-success');
						$("#response").html(resp.msg);
						alert("Zone updated successfully.");
						//window.location.href = "<?php echo base_url(); ?>admin/add_zone";
					}
				}

			});
				return false;  //stop the actual form post !important!
		}
		</script>