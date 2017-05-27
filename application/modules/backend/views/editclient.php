<!-- build:css({.tmp,app}) styles/app.min.css -->

<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.css"/>

<style>
.messageContainer {
	color:red;
	margin-left:3%;
}
</style>
<!-- endbuild -->
<div class="container">

  <div class="content">

    <div class="content-container">

      

      <div class="content-header">
        <h2 class="content-header-title">Edit Client </h2>
       
      </div> <!-- /.content-header -->
      <div class="row">

        <div class="col-md-8 col-md-offset-2">
				<form class="form-validation " method="POST" action="" name="user_form" id="user_form" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
							
							<div class="row"> 
							<label>Company Name</label>
								<div class="col-md-12 form-group"> 
									<input type="text" class="form-control" name="data[company_name]" value="<?php echo $client['company_name'];?>" placeholder="Company Name" required/>
								</div>
								<div class="messageContainer"></div>
								
							</div>
							<div class="row"> 
							<label>
							 First Name
							</label>
								<div class="col-md-12 form-group"> 
									<input type="text" class="form-control" name="data[first_name]" placeholder="First Name" value="<?php if(isset($client['first_name'])) echo $client['first_name'];?>" required/>
								</div>
								<div class="messageContainer"></div>
								
							</div>
							
						
						
						
						<div class="row"> 
						<label>
						Last Name
						</label>
							<div class="col-md-12 form-group"> 
								<input type="text" class="form-control" name="data[last_name]" placeholder="Last Name" value="<?php if(isset($client['last_name'])) echo $client['last_name'];?>" required/>
							</div>
							<div class="messageContainer"></div>
							
						</div>
						
	
							<div class="row"> 
						<label>
						Mobile Number
						</label>
							<div class="col-md-12 form-group"> 
								<input type="text" class="form-control" name="data[mobile]" placeholder="Name" value="<?php if(isset($client['mobile'])) echo $client['mobile'];?>"/>
								
							</div>
							<input type="hidden" class="form-control" name="data[hospital_id]" value ="<?php if(isset($client['hospital_id'])) echo $client['hospital_id'];?>" />
							<div class="messageContainer"></div>
							
						</div>
						<div class="row"> 
							<label>Email</label>
								<div class="col-md-12 form-group"> 
									<input type="text" class="form-control" name="data[email]" value="<?php echo $client['email'];?>" placeholder="Company Name" required/>
								</div>
								<div class="messageContainer"></div>
								
							</div>
						
							
							<div class="row"> 
							<label>Password</label>
								<div class="col-md-12 form-group"> 
									<input type="text" class="form-control" name="data[text_password]" value="<?php echo $client['text_password'];?>" placeholder="Company Name" required/>
								</div>
								<div class="messageContainer"></div>
								
							</div>
							</div>
						
											
						
					
					
						<div class=" col-md-6">
								
								<input type="hidden" name="data[id]" value="<?php echo $client['id'];?>">
								
								
							
					
						
						<div class="row"> 
						<label>
						Address
						</label>
							<div class="col-md-12 form-group"> 
								<input type="text" class="form-control" name="data[address]" placeholder="address"  value="<?php if(isset($client['address'])) echo $client['address'];?>" required/>
							</div>
							<div class="messageContainer"></div>
						</div>
						<div class="row"> 
						<label>
						Zip Code
						</label>
							<div class="col-md-12 form-group"> 
								<input type="text"  class="form-control" name="data[pincode]" placeholder="Pincode" value="<?php if(isset($client['pincode'])) echo $client['pincode'];?>" required/>
							</div>
							<div class="messageContainer"></div>
						</div>
						<div class="row"> 
						<label>
						City Name
						</label>
							<div class="col-md-12 form-group"> 
								<input type="text" class="form-control" name="data[locality]" placeholder="City" id="locality" value="<?php if(isset($client['locality'])) echo $client['locality'];?>" required/>
								<input type="hidden" class="form-control" name="latitude" placeholder="City" id="latitude" value= " <?php if(isset($client['latitude'])) echo $client['latitude'];?>" />
								<input type="hidden" class="form-control" name="longitude" placeholder="City" id="longitude" value = "<?php if(isset($client['locality'])) echo $client['longitude'];?> " />
							</div>
							<div class="messageContainer"></div>
						</div>
						
						<div class="row"> 
						<label>
						State
						</label>
							<div class="col-md-12 form-group"> 
								<input type="text" class="form-control" name="data[state]" placeholder="City" id="" value="<?php if(isset($client['state'])) echo $client['state'];?>" required/>
						
							</div>
							<div class="messageContainer"></div>
						</div>
						
						<div class="row"> 
								<label>
								Package
								</label>
									<div class="col-md-12 form-group"> 
										<select class="form-control" name="data[package_id]"  id="verified" required>
											<option value="">Select</option>
											<?php foreach($package as $item) {  ?>
											<option value="<?php echo $item['id']; ?>"  <?php if($item['id']== $client['package_id']) { echo 'selected';}?>><?php echo $item['name']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="messageContainer"></div>
								</div>
								
							
							
								<div class="row"> 
							<label>Is Verified</label>
							<div class="col-md-12 form-group"> 
								<select class="form-control" name="data[verified]"  id="verified" required>
									<option value="">Select</option>
									<option value="1" <?php if($client['verified']==1) echo "selected";?>>Yes</option>
									<option value="0" <?php if($client['verified']==0) echo "selected";?>>No</option>
									
								</select> 
							</div>
							<div class="messageContainer"></div>
						</div>
						
						
						
					
						
						</div>
							</div>
						
								
						<div class="form-group pull-right" style="margin-top:10px">
							<button type="submit" class="btn btn-primary m-r">
							Update
							</button>
						</div>
						 </form>
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
    	        url: "<?php echo base_url(); ?>admin/update_client",
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
    	            	window.location.href = "<?php echo base_url(); ?>admin/client_list";
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
        		types: ['(cities)'],
                componentRestrictions: {country: 'USA'}
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
    
    