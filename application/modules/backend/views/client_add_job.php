<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.css"/>
<div class="content-view">
	<div class="card" style="padding:20px">
		<form class="form-validation form-horizontal" method="POST" action="" name="user_form" id="user_form" enctype="multipart/form-data">
			<div class="card-block" style="padding-bottom:40px">
		   		<div class="row">
		   		<div class="col-md-4">
		   			<div class="row">
		   			
				   			<h6 class="text-danger"> <b>Basic Information</b></h6>
				   			</div>
				   			
				   				<?php if($_SESSION['admin']['user_role']==5 || $_SESSION['admin']['user_role']==4 || $_SESSION['admin']['user_role']==3){?>
			         		<div class="row">
				         		<div class="col-md-12">
						         	<div class="row"> 
											Select Hospital
										<div class="col-md-12 input-group">
											<select class="form-control" name="hospital_id">
												<?php foreach($hospitallist as $item){?>
												<option value="<?php echo $item['id']?>"><?php echo $item['hospital_name']?></option>
												<?php }?>
											</select>
										</div>
										<div class="messageContainer text-danger"></div>
									</div>
				         		</div>
			         	</div>
			         	
			         	<?php } ?>
			         	<div class="row">
				         	<div class="col-md-12">
					         	<div class="row"> 
										Job Name
									<div class="col-md-12 input-group">
										<input type="text" name="jobname" id= "jobname" class="form-control" required>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>
				         	</div>
			         	</div>
			         	<div class="row">
				         	<div class="col-md-12">
					         	<div class="row"> 
										Job Priority
									<div class="col-md-12 input-group">
										<select name="priority" id="priority" class="form-control" >
											<option value="">Select</option>
											<option value="0">AM</option>
											<option value="1">Timed</option>
											<option value="2">Stat</option>
											<option value="3">Today</option>
										</select>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>
				         	</div>
			         	</div>
			         	
			         	<div class="row">
				         	<div class="col-md-12">
				         		<div class="row"> 
										Description
									<div class="col-md-12 input-group">
										<textarea  name="jobdesc" class="form-control" rows="3"> </textarea>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>
				         	 </div>
				         </div>
	         			<div class="row">
				        	<div class="col-md-12">
				        		<div class="row"> 
										Patient Name
									<div class="col-md-12 input-group">
										<input type="text" name="pname" id= "pname" class="form-control" required>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>
				        	</div>
			        	</div>
			        	<div class="row">
				         	<div class="col-md-12">
				         		<div class="row"> 
										Room Number
									<div class="col-md-12 input-group">
										<input type="text" name="rnumber" id= "rnumber" class="form-control" required>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>
				         	</div>
			         	</div>
			         	<div class="row"> 
				         	<div class="col-md-12">
				         		<div class="row"> 
										Tests
									<div class="col-md-12 input-group">
										<input type="text" name="tests" id= "tests" class="form-control" required>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>
				         	</div>
			         	</div>
			         	<div class="row"> 
				         	<div class="col-md-12">
				         		<div class="row"> 
										Caller
									<div class="col-md-12 input-group">
										<input type="text" name="caller" id= "caller" class="form-control" required>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>
				         	</div>
			         	</div>
			         	<div class="row"> 			         	
		         			<div class="col-md-12">
		         				<div class="row"> 
										Special instrunction
									<div class="col-md-12 input-group">
										<textarea  name="sintruction" class="form-control" rows="1"> </textarea>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>
		         			</div>
	         			</div>
					   
				      </div>
				      <div class="col-md-4">
				      
				         <div class="row"> 
					   		<h6 class="text-danger"> <b>Contact</b></h6>
					   	</div>
					   	<div class="row">
				        	<div class="col-md-12">
				        		<div class="row"> 
										First Name
									<div class="col-md-12 input-group">
										<input type="text" name="fname" id= "fname" class="form-control" required>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>	
				        	</div>
				        </div>
				        <div class="row"> 
				         	<div class="col-md-12">
				         		<div class="row"> 
										Last Name
									<div class="col-md-12 input-group">
										<input type="text" name="lname" id= "end_dalnamete" class="form-control" required>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>	
				         	</div>
				         </div>
				         <div class="row"> 
				         	<div class="col-md-12">
				         		<div class="row"> 
										Mobile No
									<div class="col-md-12 input-group">
										<input type="text" name="mobno" id= "mobno" class="form-control" required>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>	
				         	</div>
				         </div>
				         <div class="row"> 
				         	<div class="col-md-12">
				         		<div class="row"> 
										Email Id
									<div class="col-md-12 input-group">
										<input type="email" name="email" id= "email" class="form-control" required>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>	
				         	</div>
				         </div>
				         <div class="row"> 
				         	<div class="col-md-12">
				         		<div class="row"> 
										Delivery Date
									<div class="col-md-12 input-group">
										<input type="text" name="delivery_date" id= "start_date" class="form-control">
									</div>
									<div class="messageContainer text-danger"></div>
								</div>	
				         	</div>
				         </div>
				         <div class="row"> 
				         	<div class="col-md-12">
				         		<div class="row">
										Delivery Time
									<div class="input-group bootstrap-timepicker timepicker">
							            <input id="timepicker1" type="text" name = "delivery_time" class="form-control input-small">
							            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
							        </div>
									<div class="messageContainer text-danger"></div>
								</div>	
				         	</div>
				         </div>
		         	</div>
			   		<div class="col-md-4">
				   			<div class="row">
					   		<h6 class="text-danger"> <b>Address</b></h6>
					   	</div>
					    <div class="row">
				        	<div class="col-md-12">
				        		<div class="row"> 
										Location/ Lookup Name
									<div class="col-md-12 input-group">
										<input type="text" name="lookupname" id= "lookupname" class="form-control" required>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>
				        	</div>
				        </div>
				        <div class="row">
				         	<div class="col-md-12">
				         		<div class="row"> 
										Apartment / Suit / Building
									<div class="col-md-12 input-group">
										<input type="text" name="building" id= "building" class="form-control" required>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>
				         	</div>
				         </div>
				         	<div class="row">
				         	<div class="col-md-12">
				         		<div class="row"> 
										Street
									<div class="col-md-12 input-group">
										<input type="text" name="street" class="form-control" id ="locality" required>
										<input type="hidden" class="form-control" name="latitude" placeholder="City" id="latitude" required/>
										<input type="hidden" class="form-control" name="longitude" placeholder="City" id="longitude" required/>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>
				         	</div>
				         </div>
				        <div class="row">
				        	<div class="col-md-12">
				         		<div class="row"> 
										City
									<div class="col-md-12 input-group">
										<input type="text" name="city" id= "city" class="form-control" onkeyup="ajaxSearch()" required>
									 <div id="suggestions"  style="position:absolute;background-color:#fff;z-index:1000;width:90%;font-size:1.3em;top:40px;box-shadow:0px 3px 3px #f0f0f0" >
										 <div id="autoSuggestionsList" ></div>
									</div>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>
				         	</div>
				         </div>
				         <div class="row">
				         	<div class="col-md-12">
				         		<div class="row"> 
										State/Region
									<div class="col-md-12 input-group">
										<input type="text" name="state" id= "state" class="form-control" onkeyup="ajaxSearch1()" required>
										<div id="suggestions"  style="position:absolute;background-color:#fff;z-index:1000;width:90%;font-size:1.3em;top:40px;box-shadow:0px 3px 3px #f0f0f0" >
											<div id="autoSuggestionsList1" ></div>
										 </div>
									</div>									
								</div>
								<div class="messageContainer text-danger"></div>
							</div>
						</div>
					
				         <div class="row">
				         	<div class="col-md-12"> 
				         		<div class="row"> 
										Zip Code
									<div class="col-md-12 input-group">
										<input type="text" name="postalcode" id= "postalcode" class="form-control" required>
									</div>
									<div class="messageContainer text-danger"></div>
								</div>	
				         	</div>
				         </div>
				    
	         		</div>
		         	
	         	</div>
	         	
	         	<div class="col-md-12 pull-right" style="margin-top:10px"> <button type="submit" class="btn btn-primary m-r">Submit</button> </div> 
         	<br><br>
         	</div>
         	
         </form>
	</div>
</div>

	
	<script src="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.js"></script>
	<script src="<?php echo asset_url();?>vendor/bootstrap/jquery.form.js"></script>
	<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
	<script src="<?php echo asset_url(); ?>js/bootstrap-timepicker.min.js"></script>
	  
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
    	      
    	    	'jobname': {
    	       	 validators: {
    	                notEmpty: {
    	                    message: ' job name is required and cannot be empty'
    	                }
    	            }
    	        },
    	        
    	    	'priority': {
    	       	 validators: {
    	                notEmpty: {
    	                    message: ' Priority is required and cannot be empty'
    	                }
    	            }
    	        },
    	        
    	        'pname': {
    	       	 validators: {
    	                notEmpty: {
    	                    message: ' Patient name is required and cannot be empty'
    	                }

    	            }
    	       	},

    	        'rnumber': {
       	       	 validators: {
       	                notEmpty: {
       	                    message: 'Room number is required and cannot be empty'
       	                }

       	            }
       	       	},

       	     'tests': {
       	       	 validators: {
       	                notEmpty: {
       	                    message: 'Test is required and cannot be empty'
       	                }

       	            }
       	       	},

       	     'caller': {
       	       	 validators: {
       	                notEmpty: {
       	                    message: 'Caller is required and cannot be empty'
       	                }

       	            }
       	       	},

       	     'lookupname': {
       	       	 validators: {
       	                notEmpty: {
       	                    message: 'Lookup is required and cannot be empty'
       	                }

       	            }
       	       	},

       	     'state': {
       	       	 validators: {
       	                notEmpty: {
       	                    message: 'State is required and cannot be empty'
       	                }

       	            }
       	       	},

       	     'city': {
       	       	 validators: {
       	                notEmpty: {
       	                    message: 'City is required and cannot be empty'
       	                }

       	            }
       	       	},

       	     'street': {
       	       	 validators: {
       	                notEmpty: {
       	                    message: 'Street is required and cannot be empty'
       	                }

       	            }
       	       	},

       	     'building': {
       	       	 validators: {
       	                notEmpty: {
       	                    message: 'Building is required and cannot be empty'
       	                }

       	            }
       	       	},

       	     'postalcode': {
       	       	 validators: {
       	                notEmpty: {
       	                    message: 'Postalcode is required and cannot be empty'
       	                }

       	            }
       	       	},

       	     'fname': {
       	       	 validators: {
       	                notEmpty: {
       	                    message: 'Street is required and cannot be empty'
       	                }

       	            }
       	       	},

       	     'lname': {
       	       	 validators: {
       	                notEmpty: {
       	                    message: 'Street is required and cannot be empty'
       	                }

       	            }
       	       	},

       	     'mobno': {
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

       	     'email': {
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
      		save_user ();
      	}); 

      function save_user () {
  		dataString = $("#user_form").serialize();
  	    $(".text-danger").hide();
  	   	$.ajax({
  	    	type: "POST",
  	        url: "<?php echo base_url(); ?>client/client_save_job",
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
  	            alert("Job added successfully.");
	  	        <?php if($_SESSION['admin']['user_role']==5 || $_SESSION['admin']['user_role']==4 || $_SESSION['admin']['user_role']==3) {?>
					window.location.href = "<?php echo base_url(); ?>admin/job/assignment/"+resp.id;
				<?php } else {?>
		        		window.location.href = "<?php echo base_url(); ?><?php if($_SESSION['admin']['user_role']==3 || $_SESSION['admin']['user_role']==4|| $_SESSION['admin']['user_role']==5){?>admin/job_list <?php } else {?>client/job_list<?php }?>";
				<?php }?>
			          	}
  	    	}
  		});
  	   	return false;  //stop the actual form post !important!
  	}
      $(document).ready(function() {
          $("#start_date").datepicker({format:"dd-mm-yyyy"}).datepicker("setDate", "0");
          $('#timepicker1').timepicker();
          });
      
//       $(function() {
          
//           $("#start_date").datepicker({
//               dateFormat: "dd-mm-yyyy"
//           }).datepicker("setDate", "0");
//           $('#timepicker1').timepicker();
//       });
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
    function ajaxSearch()
    {
    	$('#autoSuggestionsList').show();
        var input_data = $('#city').val();

        if (input_data.length === 0)
        {
            $('#suggestions').hide();
        }
        else
        {

            var post_data = {
                'city': input_data,
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                };

            $.ajax({
                type: "POST",
                url: base_url+"admin/searchcity",
                data: post_data,
                success: function (data) {
                    // return success
                    if (data.length > 0) {
                        $('#suggestions').show();
                        $('#autoSuggestionsList').addClass('auto_list');
                        $('#autoSuggestionsList').html(data);
                    }
                }
             });

         }
     }
     function fill(id)
     {
    	 var value = $('#div'+id).text();
    	 //alert(value);
    	 $('#city').val(value);
    	 $('#autoSuggestionsList').hide();
    	 
     }
     function ajaxSearch1()
     {
     	$('#autoSuggestionsList1').show();
         var input_data = $('#state').val();

         if (input_data.length === 0)
         {
             $('#suggestions').hide();
         }
         else
         {

             var post_data = {
                 'state': input_data,
                 '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                 };

             $.ajax({
                 type: "POST",
                 url: base_url+"admin/searchstate",
                 data: post_data,
                 success: function (data) {
                     // return success
                     if (data.length > 0) {
                         $('#suggestions').show();
                         $('#autoSuggestionsList1').addClass('auto_list');
                         $('#autoSuggestionsList1').html(data);
                     }
                 }
              });

          }
      }
      function fill1(id)
      {
     	 var value = $('#div1'+id).text();
     	 //alert(value);
     	 $('#state').val(value);
     	 $('#autoSuggestionsList1').hide();
     	 
      }
    </script>