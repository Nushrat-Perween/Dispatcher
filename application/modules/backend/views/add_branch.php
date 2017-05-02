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
<div class="content-view" >
<div class="row">
<div class="card card-block">
<h2><?php if(isset($branch)) { echo "Update ";} else { echo "Add ";}?> Branch</h2>
<br>
<div class="form-control" id="response" style="display: none"> </div>
<form class="form-validation form-horizontal" method="POST" action="" name="branch_form" id="branch_form" enctype="multipart/form-data">
<?php  if(isset($branch)) { ?>
<input type="hidden"  value="<?php echo $branch['id'];?>" name="data[id]" id="id">
<?php }?>
<div class="row">
	<div class="col-md-5 ">
		<div class="form-group m-b">
			<label>
			Hospital Name :
			</label>
			<div class="row">
				<div class="col-md-10 input-group">
					<select class="form-control" name="data[hospital_id]"  id="hospital_id" >
						<option value="">Select</option>
						<?php foreach ($hospitallist as $row) {?>
						<option value="<?php echo $row['id'];?>" <?php if(isset($branch)) { if($branch['hospital_id'] == $row['id']) { echo "selected";}}?>><?php echo ucwords($row['hospital_name']);?></option>
						<?php }?>
					</select>
				</div>
				<div class="messageContainer"></div>
			</div>
		</div>
		
		<div class="form-group m-b">
			<label>
			Address :
			</label>
			<div class="row">
				<div class="col-md-10 input-group">
					<input type="text"  class="form-control" name="data[address]" id="address" value="<?php if(isset($branch)) {echo $branch['address'];}?>" placeholder="Address" />
				</div>
				<div class="messageContainer"></div>
			</div>
		</div>
		<div class="form-group m-b">
			<label>
			City :
			</label>
			<div class="row">
				<div class="col-md-10 input-group">
					<input type="text"  class="form-control" name="data[city]" value="<?php if(isset($branch)) {echo $branch['city'];}?>" placeholder="City" />
				</div>
				<div class="messageContainer"></div>
			</div>
		</div>
		<div class="form-group m-b">
			<label>
			Zip Code :
			</label>
			<div class="row">
				<div class="col-md-10 input-group">
					<input type="text"  class="form-control" name="data[zipcode]" placeholder="Zipcode" value="<?php if(isset($branch)) {echo $branch['zipcode'];}?>" />
				</div>
				<div class="messageContainer"></div>
			</div>
		</div>
	</div>
	<div class="col-md-5 ">
		<div class="form-group m-b">
			<label>
			Branch Name :
			</label>
			<div class="row">
				<div class="col-md-10 input-group">
					<input type="text"  class="form-control" name="data[branch_name]" id="branch_name" value="<?php if(isset($branch)) {echo $branch['branch_name'];}?>" placeholder="Branch" />
				</div>
				<div class="messageContainer"></div>
			</div>
		</div>
		<div class="form-group m-b">
			<label>
			Street :
			</label>
			<div class="row">
				<div class="col-md-10 input-group">
					<input type="text" class="form-control" name="data[street]" placeholder="Street" id="street" value="<?php if(isset($branch)) {echo $branch['street'];}?>" />
					<input type="hidden" class="form-control" name="data[latitude]" placeholder="City" id="latitude" value="<?php if(isset($branch)) {echo $branch['latitude'];}?>" />
					<input type="hidden" class="form-control" name="data[longitude]" placeholder="City" id="longitude" value="<?php if(isset($branch)) {echo $branch['longitude'];}?>" />
				</div>
				<div class="messageContainer"></div>
			</div>
		</div>
		
		<div class="form-group m-b">
			<label>
			State :
			</label>
			<div class="row">
				<div class="col-md-10 input-group">
					<input type="text"  class="form-control" name="data[state]" value="<?php if(isset($branch)) {echo $branch['state'];}?>" placeholder="State" required/>
				</div>
				<div class="messageContainer"></div>
			</div>
		</div>
		
	</div>
</div>
<div class="form-group">
<?php if(isset($branch)) {?>
<button type="submit" class="btn btn-primary m-r">
Update
</button>
<a href="<?php echo base_url();?>admin/branch_list"><button type="button" class="btn btn-default" >
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
<a href="<?php echo base_url();?>admin/branch_list"><button type="button" class="btn btn-default" >
Cancel
</button>
</a>
<?php }?>

</div>
</form>
</div>
</div>
</div>


<script src="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>vendor/bootstrap/jquery.form.js"></script>
<!-- end page scripts -->

<!-- initialize page scripts -->
<script type="text/javascript">
// $('.form-validation').validate();
$("#branch_form").submit(function(e) {
	e.preventDefault();
});
	$('#branch_form').bootstrapValidator({
		container: function($field, validator) {
			return $field.parent().next('.messageContainer');
		},
		feedbackIcons: {
			validating: 'glyphicon glyphicon-refresh'
		},
		excluded: ':disabled',
		fields: {


		'data[branch_name]': {
			validators: {
				notEmpty: {
					message: 'Branch is required and cannot be empty.'
				}
			}
		},
		'data[address]': {
			validators: {
				notEmpty: {
					message: 'Address is required and cannot be empty.'
				}
			}
		},
	
		'data[street]': {
			validators: {
				notEmpty: {
					message: 'Street is required and cannot be empty.'
				}
			}
		},
		'data[latitude]': {
			validators: {
				notEmpty: {
					message: 'Please select Street from google dropdown.'
				}
			}
		},
	
		'data[city]': {
			validators: {
				notEmpty: {
					message: 'City is required and cannot be empty.'
				}
			}
		},
		'data[state]': {
			validators: {
				notEmpty: {
					message: 'State is required and cannot be empty.'
				}
			}
		},
		'data[zipcode]': {
			validators: {
				notEmpty: {
					message: ' Zip code is required and cannot be empty.'
				}
			}
		},
		'data[hospital_id]': {
			validators: {
				notEmpty: {
					message: 'Hospital is required and cannot be empty.'
				}
			}
		}
		 
		}
	}).on('success.form.bv', function(e) {
		// Prevent form submission
		e.preventDefault();
		<?php if(isset($branch)) {?>
			update_city ();
		<?php } else {?>
			save_city ();
		<?php }?>
	});

		function save_city () {
			dataString = $("#branch_form").serialize();
			$(".text-danger").hide();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/save_branch",
				data: dataString,
				dataType: 'json',
				success: function(resp){
					if(resp.status == '0') {
						$("#response").addClass('alert-danger');
						$("#response").html(resp.msg);
						$("#response").show();
							

					} else {
						// 	$("#branch_form").reset();
						$('#reset').click();
						$("#response").show();
						$("#response").addClass('alert-success');
						$("#response").html(resp.msg);
						alert("Branch added successfully.");
						//window.location.href = "<?php echo base_url(); ?>admin/add_city";
					}
				}

			});
				return false;  //stop the actual form post !important!
		}
		
		function update_city () {
			dataString = $("#branch_form").serialize();
			$(".text-danger").hide();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/update_branch",
				data: dataString,
				dataType: 'json',
				success: function(resp){
					if(resp.status == '0') {
						$("#response").addClass('alert-danger');
						$("#response").html(resp.msg);
						$("#response").show();
							

					} else {
						// 	$("#branch_form").reset();
						$('#reset').click();
						$("#response").show();
						$("#response").addClass('alert-success');
						$("#response").html(resp.msg);
						alert("Branch updated successfully.");
						//window.location.href = "<?php echo base_url(); ?>admin/add_city";
					}
				}

			});
				return false;  //stop the actual form post !important!
		}
		</script>
		   <script>
    $.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCH-u-UD2bz6cfPEAe8mCVyrnnI7ONx9ro&callback=initMap");
    function initMap() {
        var options = {
            types: ["geocode"],
            componentRestrictions: {country: 'USA'}
        };
        var i=0;
        var input = document.getElementById('street');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
           
            $('#latitude').val(place.geometry.location.lat());
            $('#longitude').val(place.geometry.location.lng());
          i=1;
        });
        
   
    }
    </script>