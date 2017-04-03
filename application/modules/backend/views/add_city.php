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
<h2><?php if(isset($city)) { echo "Update ";} else { echo "Add ";}?> City</h2>
<br>
<div class="form-control" id="response" style="display: none"> </div>
<form class="form-validation form-horizontal" method="POST" action="" name="city_form" id="city_form" enctype="multipart/form-data">
<?php  if(isset($city)) { ?>
<input type="hidden"  value="<?php echo $city['id'];?>" name="data[id]" id="id">
<?php }?>
<div class="form-group m-b">
<label>
City Name :
</label>
<div class="row">
<div class="col-md-10 input-group">
<input type="text"  class="form-control" name="data[city_name]" id="city_name" value="<?php if(isset($city)) {echo $city['city_name'];}?>" placeholder="City" required/>
</div>
<div class="messageContainer"></div>
</div>
</div>


<div class="form-group">
<?php if(isset($city)) {?>
<button type="submit" class="btn btn-primary m-r">
Update
</button>
<a href="<?php echo base_url();?>admin/city_list"><button type="button" class="btn btn-default" >
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
$("#city_form").submit(function(e) {
	e.preventDefault();
});
	$('#city_form').bootstrapValidator({
		container: function($field, validator) {
			return $field.parent().next('.messageContainer');
		},
		feedbackIcons: {
			validating: 'glyphicon glyphicon-refresh'
		},
		excluded: ':disabled',
		fields: {


			'data[city_name]': {
			validators: {
				notEmpty: {
					message: ' City name is required and cannot be empty'
				}
			}
		}
		 
		}
	}).on('success.form.bv', function(e) {
		// Prevent form submission
		e.preventDefault();
		<?php if(isset($city)) {?>
			update_city ();
		<?php } else {?>
			save_city ();
		<?php }?>
	});

		function save_city () {
			dataString = $("#city_form").serialize();
			$(".text-danger").hide();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/save_city",
				data: dataString,
				dataType: 'json',
				success: function(resp){
					if(resp.status == '0') {
						$("#response").addClass('alert-danger');
						$("#response").html(resp.msg);
						$("#response").show();
							

					} else {
						// 	$("#city_form").reset();
						$('#reset').click();
						$("#response").show();
						$("#response").addClass('alert-success');
						$("#response").html(resp.msg);
						alert("City added successfully.");
						//window.location.href = "<?php echo base_url(); ?>admin/add_city";
					}
				}

			});
				return false;  //stop the actual form post !important!
		}
		
		function update_city () {
			dataString = $("#city_form").serialize();
			$(".text-danger").hide();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/update_city",
				data: dataString,
				dataType: 'json',
				success: function(resp){
					if(resp.status == '0') {
						$("#response").addClass('alert-danger');
						$("#response").html(resp.msg);
						$("#response").show();
							

					} else {
						// 	$("#city_form").reset();
						$('#reset').click();
						$("#response").show();
						$("#response").addClass('alert-success');
						$("#response").html(resp.msg);
						alert("City updated successfully.");
						//window.location.href = "<?php echo base_url(); ?>admin/add_city";
					}
				}

			});
				return false;  //stop the actual form post !important!
		}
		</script>