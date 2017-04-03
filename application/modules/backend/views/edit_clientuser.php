
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
		<div class=" col-md-12" > 
				<div class="card card-block" style = "padding-left:40px">
				<h2>Edit User</h2>
				
				<div class="form-control" id="response" style="display: none"> </div>
				<form class="form-validation form-horizontal" method="POST" action="" name="user_form" id="user_form" enctype="multipart/form-data">
						<div class="row">
						<div class="form-group col-md-4">
						<div class="row"> 
						User Role
						<input type="hidden"  class="form-control" name="data[id]" placeholder="Last Name" value ="<?php echo $user['id']; ?>" />
							<div class="col-md-12 input-group"> 
								<select class="form-control" name="data[user_role]"  id="verified" required>
									<option value="">Select</option>
									<option value="4" <?php if($user['user_role']==4) echo "selected";?>>Sub Admin</option>
									<option value="5" <?php if($user['user_role']==5) echo "selected";?>>Dispatcher</option>
									<option value="7" <?php if($user['user_role']==7) echo "selected";?>>FieldWorker</option>
								</select>
							</div>
							<div class="messageContainer"></div>
						</div>
						</div>
						<div class="form-group col-md-4">
						<div class="row"> 
								First Name
							<div class="col-md-12 input-group"> 
								<input type="text" class="form-control" name="data[first_name]" placeholder="First Name" value ="<?php echo $user['first_name']; ?>"/>
							</div>
							<div class="messageContainer"></div>
						</div>
						</div>
						<div class="form-group col-md-4">
						
						<div class="row">
								Last Name						
							<div class="col-md-12 input-group"> 
								<input type="text"  class="form-control" name="data[last_name]" placeholder="Last Name" value ="<?php echo $user['last_name']; ?>" required/>
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
								<input type="email" class="form-control" name="data[email]" placeholder="email"  value ="<?php echo $user['email']; ?>" required/>
							</div>
							<div class="messageContainer"></div>
						</div>
						</div>
						<div class="form-group col-md-4">
						<div class="row"> 
						Mobile No.
							<div class="col-md-12 input-group"> 
								<input type="text"  class="form-control" name="data[mobile]" placeholder="Mobile"  value ="<?php echo $user['mobile']; ?>" equired/>
							</div>
							<div class="messageContainer"></div>
						</div>
						</div>
						<div class="form-group col-md-4">
						<div class="row"> 
						Is Verified
							<div class="col-md-12 input-group"> 
								<select class="form-control" name="data[verified]"  id="verified" required>
									<option value="">Select</option>
									<option value="1" <?php if($user['verified']==1) echo "selected";?>>Yes</option>
									<option value="0" <?php if($user['verified']==0) echo "selected";?>>No</option>
									
								</select>
							</div>
							<div class="messageContainer"></div>
						</div>
						</div>
						</div>
						<div class="form-group pull-right">
							<button type="submit" class="btn btn-primary m-r pull-right">
							Submit
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
      		save_user ();
      	}); 

      function save_user () {
  		dataString = $("#user_form").serialize();
  	    $(".text-danger").hide();
  	   	$.ajax({
  	    	type: "POST",
  	        url: "<?php echo base_url(); ?>admin/update_client_user",
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
  	            alert("User updated successfully.");
  	            	window.location.href = "<?php echo base_url(); ?>admin/client_userlist";
  	          	}
  	    	}
  	 
  		});
  	   	return false;  //stop the actual form post !important!
  	}

    </script>	