<!-- build:css({.tmp,app}) styles/app.min.css -->

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
				<div class="card card-block" style="padding:20px">
				<h2>Add User</h2>
				<div class="form-control" id="response" style="display: none"> </div>
				<form class="form-validation form-horizontal" method="POST" action="" name="user_form" id="user_form" enctype="multipart/form-data">
						<div class="form-group m-b">
						<label>
						First Name
						</label>
						<div class="row"> 
						
							<div class="col-md-10 input-group"> 
								<input type="text" class="form-control" name="data[first_name]" placeholder="First Name" value="<?php if(isset($user['first_name'])) echo $user['first_name'];?>" required/>
							</div>
							<div class="messageContainer"></div>
							
						</div>
						</div>
						<div class="form-group m-b">
						<label>
						Last Name
						</label>
						<div class="row"> 
							<div class="col-md-10 input-group"> 
								<input type="text"  class="form-control" name="data[last_name]" placeholder="Last Name"  value="<?php if(isset($user['last_name'])) echo $user['last_name'];?>" required/>
							</div>
							<div class="messageContainer"></div>
						</div>
						</div>
						<div class="form-group m-b">
						<label>
						Email
						</label>
						<div class="row"> 
						
							<div class="col-md-10 input-group"> 
								<input type="email" class="form-control" name="data[email]" placeholder="email"  value="<?php if(isset($user['email'])) echo $user['email'];?>" required/>
							</div>
							<div class="messageContainer"></div>
							
						</div>
						</div>
						
						<div class="form-group m-b">
						<label>
						Mobile No.
						</label>
						<div class="row"> 
							<div class="col-md-10 input-group"> 
								<input type="text"  class="form-control" name="data[mobile]" placeholder="Mobile"  value="<?php if(isset($user['mobile'])) echo $user['mobile'];?>" required/>
								<input type="hidden"  class="form-control" name="data[id]" placeholder="Mobile"  value="<?php if(isset($user['id'])) echo $user['id'];?>" required/>
							</div>
							<div class="messageContainer"></div>
						</div>
						</div>
						<div class="form-group pull-right">
							<button type="submit" class="btn btn-primary m-r">
							Update
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
				url: "<?php echo base_url(); ?>admin/update_user",
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
						window.location.href = "<?php echo base_url(); ?>admin/user_list";
					}
				}

			});
				return false;  //stop the actual form post !important!
		}

    </script>	