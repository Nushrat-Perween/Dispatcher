
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
				<h2>Add Package</h2>
				<div class="form-control" id="response" style="display: none"> </div>
				<form class="form-validation form-horizontal" method="POST" action="" name="user_form" id="user_form" enctype="multipart/form-data">
						<div class="form-group m-b">
						<label>
						Name
						</label>
						<div class="row"> 
						
							<div class="col-md-10 input-group"> 
								<input type="text" class="form-control" name="data[name]" placeholder=" Name" required/>
							</div>
							<div class="messageContainer"></div>
							
						</div>
						</div>
						<div class="form-group m-b">
						<label>
						Time Duration
						</label>
						<div class="row"> 
							<div class="col-md-10 input-group"> 
								<input type="text"  class="form-control" name="data[timeduration]" placeholder="time duration" required/>
							</div>
							<div class="messageContainer"></div>
						</div>
						</div>
					
						<div class="form-group m-b">
						<label>
						Price
						</label>
						<div class="row"> 
							<div class="col-md-10 input-group"> 
								<input type="text"  class="form-control" name="data[price]" placeholder="price" required/>
							</div>
							<div class="messageContainer"></div>
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
    	      
    	        'data[name]': {
    	       	 validators: {
    	                notEmpty: {
    	                    message: ' Password is required and cannot be empty'
    	                }
    	            }
    	        }, 
    	        'data[price]': {
       	       	 validators: {
       	                notEmpty: {
       	                    message: ' Password is required and cannot be empty'
       	                }
       	            }
       	        }, 
       	     'data[timeduration]': {
    	       	 validators: {
    	                notEmpty: {
    	                    message: ' Password is required and cannot be empty'
    	                }
    	            }
    	        },  
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
  	        url: "<?php echo base_url(); ?>admin/save_package",
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
  	            alert("Package added successfully.");
  	            	window.location.href = "<?php echo base_url(); ?>admin/package_list";
  	          	}
  	    	}
  	 
  		});
  	   	return false;  //stop the actual form post !important!
  	}

    </script>	