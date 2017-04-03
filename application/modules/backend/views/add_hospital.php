<!-- build:css({.tmp,app}) styles/app.min.css -->
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
		<div class="col-md-12"> 
				<div class="card card-block" style = "padding-left:40px">
				<h2>Add Hospital</h2>
				<div class="form-control" id="response" style="display: none"> </div>
				<form class="form-validation form-horizontal" method="POST" action="" name="user_form" id="user_form" enctype="multipart/form-data">
				<div class="row">
						<div class="form-group col-md-4">
						<div class="row"> 
						 First Name
							<div class="col-md-12 input-group"> 
								<input type="text" class="form-control" name="data[first_name]" placeholder=" First Name" required/>
							</div>
							<div class="messageContainer"></div>
							
						</div>
						</div>
						<div class="form-group col-md-4">
						<div class="row"> 
						Last Name
							<div class="col-md-12 input-group"> 
								<input type="text" class="form-control" name="data[last_name]" placeholder="Last Name" required/>
							</div>
							<div class="messageContainer"></div>
							
						</div>
						</div>
						<div class="form-group col-md-4">
						<div class="row"> 
						Hospital Name
							<div class="col-md-12 input-group"> 
								<input type="text" class="form-control" name="data[name]" placeholder="Hospital Name" required/>
							</div>
							<div class="messageContainer"></div>
							
						</div>
						</div>
						</div>
						<div class="row">
						<div class="form-group col-md-4">
						<div class="row"> 
						Email
							<div class="col-md-12 input-group"> 
								<input type="email" class="form-control" name="data[email]" placeholder="Email" required/>
							</div>
							<div class="messageContainer"></div>
						</div>
						</div>
						
						<div class="form-group col-md-4">
						<div class="row"> 
						Mobile Number
							<div class="col-md-12 input-group"> 
								<input type="text" class="form-control" name="data[mobile]" placeholder="Mobile number" required/>
							</div>
							<div class="messageContainer"></div>
							
						</div>
						</div>
						<div class="form-group col-md-4">
						
						<div class="row"> 
						Pincode
							<div class="col-md-12 input-group"> 
								<input type="text"  class="form-control" name="data[pincode]" placeholder="Pincode" required/>
								<input type="hidden"  class="form-control" name="password" value ="<?php echo $password['text_password'] ?>" placeholder="Pincode" required/>
							</div>
							<div class="messageContainer"></div>
						</div>
						</div>
						</div>
						<div class="row">
						<div class="form-group col-md-4">
						<div class="row"> 
						Street
							<div class="col-md-12 input-group"> 
								<input type="text" class="form-control" name="data[locality]" placeholder="Street" id="locality" required/>
								<input type="hidden" class="form-control" name="latitude" placeholder="City" id="latitude" required/>
								<input type="hidden" class="form-control" name="longitude" placeholder="City" id="longitude" required/>
							</div>
							<div class="messageContainer"></div>
						</div>
						</div>
						<div class="form-group col-md-4">
						<div class="row"> 
						Address
							<div class="col-md-12 input-group"> 
								<input type="text" class="form-control" name="data[address]" placeholder="Address" required/>
							</div>
							<div class="messageContainer"></div>
						</div>
						</div>
						</div>						
						<div class="form-group pull-right">
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
  

    <script src="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>vendor/bootstrap/jquery.form.js"></script>
    <!-- end page scripts -->

    <!-- initialize page scripts -->
    <script type="text/javascript">
   // $('.form-validation').validate();
    $("#user_form").submit(function(e) {
        e.preventDefault();
    });
      $('#user_form').bootstrapValidator({
    		container: function($field, validator) {
    	    	return $field.parent().next('.messageContainer');
    	    },
    	   	feedbackIcons: {
    	       	validating: 'glyphicon glyphicon-refresh'
    	   	},
    	   	excluded: ':disabled',
    	    fields: {
    	      
    	        'data[password]': {
    	       	 validators: {
    	                notEmpty: {
    	                    message: ' Password is required and cannot be empty'
    	                }
    	            }
    	        },
    	        
    	        'data[verified]': {
    	       	 validators: {
    	                notEmpty: {
    	                    message: ' Verified is required and cannot be empty'
    	                }
    	            }
    	        },
    	        'data[mobile]': {
    	       	 validators: {
    	                notEmpty: {
    	                    message: ' Mobile No. is required and cannot be empty'
    	                },
    	                regexp: {
    	                    regexp: '^[7-9][0-9]{9}$',
    	                    message: 'Invalid Mobile Number'
    	                }
    	            }
    	       	},

    	         'data[email]': {
    	       	 validators: {
    	                notEmpty: {
    	                    message: ' Email is required and cannot be empty'
    	                },
    	                regexp: {
    	                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
    	                    message: 'The value is not a valid email address'
    	                }
    	            }
    	       }
    	       
    	    }

      }).on('success.form.bv', function(e) {
        	// Prevent form submission
        		e.preventDefault();
        		save_client ();
        	}); 

        function save_client () {
    		dataString = $("#user_form").serialize();
    	    $(".text-danger").hide();
    	   	$.ajax({
    	    	type: "POST",
    	        url: "<?php echo base_url(); ?>admin/save_hospital",
    	        data: dataString,
    	        dataType: 'json',
    	        success: function(resp){
    	        	if(resp.status == '0') {
    	           		$("#response").addClass('alert-danger');
    					$("#response").html(resp.msg);
    					$("#response").show();
    					
    						
    	           	} else {
    	           // 	$("#user_form").reset();
    	            	$('#reset').click();
    	            	$("#response").show();
    	            	$("#response").addClass('alert-success');
    	            	$("#response").html(resp.msg);
    	            alert("Hospital added successfully.");
    	            	window.location.href = "<?php echo base_url(); ?>admin/hospital_list";
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
            componentRestrictions: {country: 'in'}
        };
        var i=0;
        var input = document.getElementById('locality');
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
        
    
         input = document.getElementById('locality1');
       var  autocomplete1 = new google.maps.places.Autocomplete(input, options);
        autocomplete1.addListener('place_changed', function () {
            var place = autocomplete1.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
           
            $('#latitude1').val(place.geometry.location.lat());
            $('#longitude1').val(place.geometry.location.lng());
          i=0;
        });
    }
    </script>