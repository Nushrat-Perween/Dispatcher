<!-- build:css({.tmp,app}) styles/app.min.css -->
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/dist/css/bootstrap.css"/>
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.css"/>

<style>
.messageContainer {
	color:red;
	margin-left:35%;
}
</style>
<!-- endbuild -->
<div class="content-view">
<div class="card card-block">
<h2>Add New Fieldworker</h2>
<div class="form-control" id="response" style="display: none"> </div>
<form class="form-validation form-horizontal" method="POST" action="" name="user_form" id="user_form" enctype="multipart/form-data">
<input type="hidden" name="data[company_id]" id="company_id" value="<?php echo $global_company_id;?>">
<input type="hidden" name="data[group_id]" id="group_id" value="<?php echo $global_group_id;?>">
<input type="hidden" name="data[branch_id]" id="branch_id" value="<?php echo $global_branch_id;?>">
<div class="form-group m-b">
<label>
Designation
</label>
<div class="row">
	<div class="col-md-5">
		<select class="form-control" name="data[user_role]"  id="user_role" required>
			<option value="4">Field Worker</option>
		</select>
	</div>
	<div class="messageContainer"></div>
</div>
</div>
		
		<div class="form-group m-b">
		<label>
		Email
		</label>
		<div class="row"> 
		
			<div class="col-md-5"> 
				<input type="email" class="form-control" name="data[email]" placeholder="email" required/>
			</div>
			<div class="messageContainer"></div>
			
		</div>
		</div>
		
		<div class="form-group m-b">
		<label>
		Mobile No.
		</label>
		<div class="row"> 
			<div class="col-md-5"> 
				<input type="text"  class="form-control" name="data[mobile]" placeholder="Mobile" required/>
			</div>
			<div class="messageContainer"></div>
		</div>
		</div>
		<div class="form-group m-b">
		<label>
		Password
		</label>
		<div class="row"> 
			<div class="col-md-5"> 
				<input type="text" class="form-control" name="data[password]" placeholder="password" required/>
			</div>
			<div class="messageContainer"></div>
		</div>
		</div>
				<div class="form-group m-b">
		<label>
		Is Verified
		</label>
		<div class="row"> 
			<div class="col-md-5"> 
				<select class="form-control" name="data[verified]"  id="verified" required>
					<option value="">Select</option>
					<option value="1">Yes</option>
					<option value="0">No</option>
					
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

    	    	
    	        'data[user_role]': {
    	       	 validators: {
    	                notEmpty: {
    	                    message: ' Designation is required and cannot be empty'
    	                }
    	            }
    	        },
    	      
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
    		save_user ();
    	});

    	function save_user () {
    		dataString = $("#user_form").serialize();
    	    $(".text-danger").hide();
    	   	$.ajax({
    	    	type: "POST",
    	        url: "<?php echo base_url(); ?>fieldworker/save_user",
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
    	            alert("User added successfully.");
    	            	window.location.href = "<?php echo base_url(); ?>fieldworker/add";
    	          	}
    	    	}
    	 
    		});
    	   	return false;  //stop the actual form post !important!
    	}
    </script>	