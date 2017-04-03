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
<h2>Assign Zone Area</h2><br>
<div class="form-control" id="response" style="display: none"> </div>
<form class="form-validation form-horizontal" method="POST" action="" name="locality_form" id="locality_form" enctype="multipart/form-data">

<!-- <div class="form-group m-b"> -->
<!-- <label> -->
<!-- Select City -->
<!-- </label> -->
<!-- <div class="row"> -->
<!-- <div class="col-md-10 input-group"> -->
<!-- <select class="form-control" name="data[city_id]"  id="city_id" required> -->
<!-- <option value="">Select</option> -->
<?php //foreach ($city as $row) {?>
<!-- 	<option value="<?php echo $row['id'];?>"><?php echo $row['city_name'];?></option>-->
	<?php //}?>
<!-- </select> -->
<!-- </div> -->
<!-- <div class="messageContainer"></div> -->
<!-- </div> -->
<!-- </div> -->

<div class="form-group m-b">
<label>
Select Locality
</label>
<div class="row">
<div class="col-md-10 input-group">
<select class="form-control" name="data[id]"  id="id" required>
<option value="">Select</option>
<?php foreach ($locality as $row) {?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
	<?php }?>
</select>
</div>
<div class="messageContainer"></div>
</div>
</div>

<div class="form-group m-b">
<label>
Select Zone
</label>
<div class="row">
<div class="col-md-10 input-group">
<select class="form-control" name="data[zone_id]"  id="zone_id" required>
<option value="">Select</option>
<?php foreach ($zone as $row) {?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
	<?php }?>
</select>
</div>
<div class="messageContainer"></div>
</div>
</div>


<div class="form-group">
<button type="submit" class="btn btn-primary m-r">
Submit
</button>
<button type="reset" id="reset" class="btn btn-default" >
Reset
</button>
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


			'data[id]': {
			validators: {
				notEmpty: {
					message: ' Locality is required and cannot be empty'
				}
			}
		},
		 
		'data[zone_id]': {
		validators: {
			notEmpty: {
				message: ' Zone is required and cannot be empty'
			}
		}
		}

		}
	}).on('success.form.bv', function(e) {
		// Prevent form submission
		e.preventDefault();
		update_locality ();
	});

		function update_locality () {
			dataString = $("#locality_form").serialize();
			$(".text-danger").hide();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/save_assigned_zone_area",
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
						alert("Locality assigned successfully.");
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