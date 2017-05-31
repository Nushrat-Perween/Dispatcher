<!-- build:css({.tmp,app}) styles/app.min.css -->
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.css"/>

<style>
.messageContainer {
	color:red;
	margin-left:3%;
}
</style>
<div class="container">

  <div class="content">

    <div class="content-container">

      <div class="content-header">
        <h2 class="content-header-title">Add Client </h2>
       
      </div> <!-- /.content-header -->
      <div class="row">
       <div class="col-md-10 col-md-offset-1">
 		<form class=" form-validation form account-form" method="POST" action="" name="user_form" id="user_form" enctype="multipart/form-data">
        <div class="col-md-6">
        
			 <div class="form-group">
	          <label >Business Name</label>
	       <input type="text" class="form-control" name="data[business_name]" placeholder="Business Name" value="<?php echo $hospital['business_name']; ?>" required/>
	        <div class="messageContainer"></div>
	        </div> <!-- /.form-group -->
	      
	        <div class="form-group">
	          <label >Phone No.</label>
	       <input type="text" class="form-control" name="data[mobile]" placeholder="Phone no." value ="<?php echo $hospital['mobile']; ?>" required/>
	        <div class="messageContainer"></div>
	        </div> <!-- /.form-group -->
	       <div class="form-group">
	          <label >Email Id</label>
	          <input type="email" class="form-control" name="data[email]" placeholder="Email" value ="<?php echo $hospital['email']; ?>" required/>
	       <div class="messageContainer"></div>
	       </div> <!-- /.form-group -->
	      
	       <div class="form-group">
	          <label >Password</label>
	         	 <input type="text" class="form-control" name="data[text_password]" placeholder="Password" value ="<?php echo $hospital['text_password']; ?>" required/>
	       <div class="messageContainer"></div>
	        </div> <!-- /.form-group -->
	          <div class="form-group">
	          <label >Fax No</label>
	         	  <input type="text"  class="form-control" name="data[fax_no]" value ="<?php echo $hospital['fax_no']; ?>" placeholder="Fax No" required/>
	       <div class="messageContainer"></div>
	        </div> <!-- /.form-group -->
			</div>
			
			<div class="col-md-6">
	         <div class="form-group">
	          <label >Address</label>
	         	<input type="text" class="form-control" name="data[address]" placeholder="address" id="locality" value ="<?php echo $hospital['address']; ?>" required/>
								<input type="hidden" class="form-control" name="latitude" placeholder="City" id="latitude" value = "<?php echo $hospital['latitude']?>"/>
								<input type="hidden" class="form-control" name="longitude" placeholder="City" id="longitude"  value = "<?php echo $hospital['latitude']?>"/>
								<input type="hidden" class="form-control" name="id" placeholder="City"  value ="<?php echo $hospital['id']; ?>"/>
								<input type="hidden" class="form-control" name="hospital_id" placeholder="City" value ="<?php echo $hospital['hospital_id']; ?>"/>
	        <div class="messageContainer"></div>
	        </div> <!-- /.form-group -->
	        <div class="form-group">
	          <label >City</label>
	         <input type="text"  class="form-control" name="data[city]" id="city" value ="<?php echo $hospital['city']; ?>" placeholder="City" required/>
	        <div class="messageContainer"></div>
	        </div> <!-- /.form-group -->
	       
	        <div class="form-group">
	          <label >State</label>
	      <input type="text"  class="form-control" name="data[state]" id="state" value ="<?php echo $hospital['state']; ?>" placeholder="State" required/>
	        <div class="messageContainer"></div>
	        </div> <!-- /.form-group -->
	        
	          <div class="form-group">
	          <label >Zip Code</label>
	            <input type="text" class="form-control" name="data[pincode]" placeholder="Pincode" value ="<?php echo $hospital['pincode']; ?>" required/>
	        <div class="messageContainer"></div>
	        </div> <!-- /.form-group -->
	        
	         <div class="form-group">
	          <label >Is Verified</label>
		        <div class="col-md-12 input-group"> 
					<select class="form-control" name="data[verified]"  id="verified" required>
									<option value="">Is Active</option>
									<option value="1" <?php if($hospital['verified']==1) echo "selected";?>>Active</option>
									<option value="0" <?php if($hospital['verified']==0) echo "selected";?>>Dactive</option>
									
								</select> 
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
</div>
      </form>
        </div>
          </div>
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
    	        url: "<?php echo base_url(); ?>admin/update_hospital",
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
    	            alert("Client updated successfully.");
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
            componentRestrictions: {country: 'USA'}
        };
        var i=0;
        var input = document.getElementById('locality');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            $('#city').val(place.address_components[1].long_name);
            $('#state').val(place.address_components[2].long_name);
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