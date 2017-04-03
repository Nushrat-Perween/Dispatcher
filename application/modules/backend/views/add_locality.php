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
<h2><?php if(isset($locality)) { echo "Update ";} else { echo "Add ";}?> Locality</h2><br>
<div class="form-control" id="response" style="display: none"> </div>
<form class="form-validation form-horizontal" method="POST" action="" name="locality_form" id="locality_form" enctype="multipart/form-data">
<?php  if(isset($locality)) { ?>
<input type="hidden"  value="<?php echo $locality['id'];?>" name="data[id]" id="id">
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
	<option value="<?php echo $row['id'];?>" <?php if(isset($locality)) { if($locality['city_id'] == $row['id']) { echo "selected";}}?>><?php echo $row['city_name'];?></option>
	<?php }?>
</select>
</div>
<div class="messageContainer"></div>
</div>
</div>

<div class="form-group m-b">
<label>
Locality Name
</label>
<div class="row">

<div class="col-md-10 input-group">
<input type="text" class="form-control goolge_city" data-type="geo_code" id="locality" name="data[name]"  value="<?php if(isset($locality)) {echo $locality['name'];}?>" required/>
</div>
<div class="messageContainer"></div>
	
</div>
</div>

<div class="form-group m-b">
<label>
Latitude
</label>
<div class="row">
<div class="col-md-10 input-group">
	<input type="text" class="form-control" name="data[latitude]" id="locality_latitude" value="<?php if(isset($locality)) {echo $locality['latitude'];}?>" placeholder="latitude" required readonly/>
</div>
<div class="messageContainer"></div>
</div>
</div>
<div class="form-group m-b">
<label>
Longitude 
</label>
<div class="row">
<div class="col-md-10 input-group">
	<input type="text" class="form-control" name="data[longitude]" id="locality_longitude" value="<?php if(isset($locality)) {echo $locality['longitude'];}?>" placeholder="longitude" required readonly/>

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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtGPmn8ziQzPa8kbmciGjEwfIBdyvf4Zs&signed_in=true&libraries=places&callback=initGoogleAutoSuggest" async defer></script> 
<script src="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>vendor/bootstrap/jquery.form.js"></script>
<!-- end page scripts -->

<!-- initialize page scripts -->
<script type="text/javascript">
// $('.form-validation').validate();
$("#locality_form").submit(function(e) {
	e.preventDefault();
});
	$('#locality_form').bootstrapValidator({
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
					message: ' City is required and cannot be empty'
				}
			}
		},
		 
		'data[name]': {
		validators: {
			notEmpty: {
				message: ' Locality is required and cannot be empty'
			}
		}
		},
		 
		'data[latitude]': {
		validators: {
			notEmpty: {
				message: ' Latitude is required and cannot be empty'
			}
		}
		},
		 
		'data[longitude]': {
		validators: {
			notEmpty: {
				message: ' Longitude is required and cannot be empty'
			}
		}
		}

		}
	}).on('success.form.bv', function(e) {
		// Prevent form submission
		e.preventDefault();
		<?php if(isset($locality)) {?>
			update_locality ();
		<?php } else {?>
			save_locality ();
		<?php }?>
	});

		function save_locality () {
			dataString = $("#locality_form").serialize();
			$(".text-danger").hide();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/save_locality",
				data: dataString,
				dataType: 'json',
				success: function(resp){
					if(resp.status == '0') {
						$("#response").addClass('alert-danger');
						$("#response").html(resp.msg);
						$("#response").show();
							

					} else {
						// 	$("#locality_form").reset();
						$('#reset').click();
						$("#response").show();
						$("#response").addClass('alert-success');
						$("#response").html(resp.msg);
						alert("Locality added successfully.");
						//window.location.href = "<?php echo base_url(); ?>admin/add_locality";
					}
				}

			});
				return false;  //stop the actual form post !important!
		}
		
		function update_locality () {
			dataString = $("#locality_form").serialize();
			$(".text-danger").hide();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/update_locality",
				data: dataString,
				dataType: 'json',
				success: function(resp){
					if(resp.status == '0') {
						$("#response").addClass('alert-danger');
						$("#response").html(resp.msg);
						$("#response").show();
							

					} else {
						// 	$("#locality_form").reset();
						$('#reset').click();
						$("#response").show();
						$("#response").addClass('alert-success');
						$("#response").html(resp.msg);
						alert("Locality updated successfully.");
						//window.location.href = "<?php echo base_url(); ?>admin/add_locality";
					}
				}

			});
				return false;  //stop the actual form post !important!
		}

		function initGoogleAutoSuggest() {
			var options = {
					  		types: ['(cities)'],
					  		componentRestrictions: {country: "in"}
					 	};
			$( ".goolge_city" ).each(function( index, element ) {
				var autocomplete = new google.maps.places.Autocomplete(element, options);
				autocomplete.addListener('place_changed', function(){
					if($(element).attr("data-type") == "city_name") {
						var place = autocomplete.getPlace();
						$(element).val(place.address_components[1].short_name);
					}
					if($(element).attr("data-type") == "geo_code") {
						var place = autocomplete.getPlace();
						var input_id = $(element).attr("id");
						$("#"+input_id+"_latitude").val(place.geometry.location.lat());
						$("#"+input_id+"_longitude").val(place.geometry.location.lng());
					}
				});
			});
		}
		</script>