<!-- build:css({.tmp,app}) styles/app.min.css -->
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/dist/css/bootstrap.css"/>
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.css"/>

<style>
.messageContainer {
	color:red;
	margin-left:3%;
}
</style>
<div class="content-view">
<div class="card">
<div class="card-header no-bg b-a-0">
<div class="dropdown pull-left " style="padding:3px 5px 4px 5px">
<H2>Profile</H2>
</div>
<br><br>
<div class="card-block">

<div class="panel-body pan">
	<ul class="nav nav-tabs">
		  							<li class="nav-item">
                                            <a class="nav-link active"  data-toggle="tab" href="#profile"
                                               role="tab" aria-controls="basic" aria-expanded="true">Change Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"  data-toggle="tab" href="#change_password"
                                               role="tab" aria-controls="contacts">Change Password</a>
                                        </li>
                                     
		</ul>
		
			<div class="tab-content" id="myTabContent">
				<div id="profile" class="tab-pane fade in active">
					<form name="frmchangeprofile" id="frmchangeprofile" action="" method="post" enctype="multipart/form-data" class="form-validate" autocomplete="off">
							<div class="form-body pal" style="min-height:650px;">
		                    	<div class="row">
		                    		<div class="col-md-12">
										<div class="col-md-6">
			                             	<div class="form-group">
			                             		<?php if($adminusers['profile_pic']!=''){ ?>
													<img src="<?php echo asset_url()?><?php echo $adminusers['profile_pic'];?>"  style="margin-left:15%;border:2px solid grey;width:60%;height:40%" id="profile_pic" alt="Image not available">
												<?php } ?>
			                             	</div>
										 </div>
									 </div>
								 </div><br>
								 <div class="row">
		                    		<div class="col-md-12">
										<div class="col-md-4">
			                             	<div class="form-group" style="margin-left:24%;">
			                             		<?php if($adminusers['profile_pic']!=''){ ?>
													<button type="button" class="btn btn-primary" onclick="display();">Change Profile Picture</button>
												<?php } ?>
													<div id="profile_pic_div" <?php if($adminusers['profile_pic']!=''){?> style="display: none" <?php } ?> >
														<input type="file" name="profile_pic" id="profile_pic" class="form-control" >
													</div>
													<div class="messageContainer"></div>
			                             	</div>
										 </div>
									 </div>
								 </div><br><br>
								 <br>
		                         <div class="row">
		                    		<div class="col-md-12">
										<div class="col-md-6">
			                             	<div class="form-group">
			                             		<label for="selCountry" class="control-label col-sm-2">Role</label>
				                             	<div class="col-sm-8">
				                             		<input  type="text"  name="user_role" class="form-control" value="<?php echo $adminusers['role_name']; ?>" disabled/>
				                             	</div>
			                             	</div>
										 </div>
										 <div class="col-md-6">
			                             	<div class="form-group">
			                             		<label for="selCountry"class="control-label col-sm-4">Name</label>
				                             	<div class="col-sm-8">
				                             		<input  type="text"  name="name" class="form-control" value="<?php echo $adminusers['first_name']." ".$adminusers['last_name']; ?>" disabled/>
				                             	</div>
				                             	<div class="messageContainer"></div>
			                             	</div>
										 </div>
									 </div>
								 </div>
								 <br><br>
		                       <div class="row">
		                    		<div class="col-md-12">
										<div class="col-md-6">
			                             	<div class="form-group">
				                             	<label for="selCountry"class="control-label col-sm-2">Email</label>
				                             	<div class="col-sm-8">
				                             		<input id="email" type="text"  name="email" class="form-control"  value="<?php echo $adminusers['email'];?>" disabled/>
				                             	</div>
				                             	<div class="messageContainer"></div>
			                             	</div>
										 </div>
										 <div class="col-md-6">
			                             	<div class="form-group">
				                             	<label for="selCountry"class="control-label col-sm-4">Mobile Number</label>
				                             	<div class="col-sm-8">
				                             		<input id="mobile" type="text"  name="mobile" class="form-control"  value="<?php echo $adminusers['mobile'];?>"/>
				                             	</div>
				                             	<div class="messageContainer"></div>
			                             	</div>
										 </div>
									 </div>
								 </div><br><br>
		                        <div class="row">
		                        	<div class="col-md-12">
											<input type="submit" name="submit" id="btnchangeprofile" class="btn btn-primary" value="Update"/>
											<input type="button" class="btn btn-primary" value="Cancel" onclick="history.go(-1);" />
									</div>
								</div>
		                    </div>
					</form>
				</div>
				<div id="change_password" class="tab-pane fade">
					<form name="frmchangepassword" id="frmchangepassword" action="" method="post" enctype="multipart/form-data" class="form-validate" autocomplete="off">
						<div id="form1"><!-- Begening of form 1 -->
							<div id="response" class="alert"></div>
							<div class="form-body pal" style="min-height:650px;">
		                    	<div class="row">
									<div class="col-md-6">
		                             	<div class="form-group">
			                             	<label for="selCountry"class="control-label">Enter Your Current Password </label>
			                             	<div>
			                             		<input id="oldpassword" type="password"  name="data[oldpassword]" class="form-control" autocomplete="new-password"/>
			                             	</div>
			                             	<div class="messageContainer"></div>
		                             	</div>
									 </div>
								 </div>
		                         <div class="row">
								 	<div class="col-md-6">
		                            	<div class="form-group">
		                            		<label for="selCountry" class="control-label">Enter New Password </label>
		                            		<div>
		                            			<input id="password" type="password"  name="data[text_password]"class="form-control" autocomplete="new-password"/>
		                            		</div>
		                            		<div class="messageContainer"></div>
		                            	</div>
		                            </div>
								</div>
		                        <div class="row">
		                        	<div class="col-md-6">
		                            	<div class="form-group">
		                            		<label for="selCountry" class="control-label">Enter New Password for confirmation </label>
		                            		<div>
		                            			<input type="password" name="confirm_password" equalTo="#password1" class="form-control" autocomplete="off"/>
		                            		</div>
		                            		<div class="messageContainer"></div>
		                            	</div>
		                             </div>
		                        </div>
		                        <div class="row">
		                        	<div class="col-md-12">
										<input type="submit" name="submit" id="btnchangepassword" class="btn btn-primary" value="Save"/>
										<input type="button" class="btn btn-primary" value="Cancel" onclick="history.go(-1);" />
									</div>
								</div>
		                    </div>
						</div>
					</form>
				</div>
			</div>
		</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">

</script>


<script src="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>vendor/bootstrap/jquery.form.js"></script>
   

<!-- initialize page scripts -->
<!-- initialize page scripts -->
<script type="text/javascript">
function display()
{
	document.getElementById("profile_pic_div").style.display = 'block';
}
$('#frmchangepassword').bootstrapValidator({
	 container: function($field, validator) {
      	return $field.parent().next('.messageContainer');
      },
     feedbackIcons: {
         validating: 'glyphicon glyphicon-refresh'
     },
     excluded: ':disabled',
     fields: {
    	 'data[oldpassword]': {
             validators: {
                 notEmpty: {
                     message: 'Current Password is required and cannot be empty'
                 }
             }
         },
         'data[text_password]': {
             validators: {
                 notEmpty: {
                     message: 'New Password is required and cannot be empty'
                 }
             }
         },
         confirm_password: {
             validators: {
                 notEmpty: {
                     message: 'New Password for confirmation is required and cannot be empty'
                 },
                 identical: {
                     field: 'data[text_password]',
                     message: 'The new password and its confirm password must be same'
                 }
             }
         }
     }
}).on('success.form.bv', function(e) {
    // Prevent form submission
    e.preventDefault();
    updateUserPassword();
});
function updateUserPassword() {
	var options = {
 			target : '#response', // target element(s) to be updated with server response 
 			beforeSubmit : showChangePasswordRequest, // pre-submit callback 
 			success :  showChangePasswordResponse,
 			url : base_url+'admin/profile/editpassword',
 			semantic : true,
 			dataType : 'json'
 		};
		$('#frmchangepassword').ajaxSubmit(options);
}

function showChangePasswordRequest(formData, jqForm, options){
		var queryString = $.param(formData);
	return true;
	}
function showChangePasswordResponse(resp, statusText, xhr, $form){
	if(resp.status == 0) {
   		$("#response").addClass('alert-danger');
		$("#response").html(resp.msg);
		$("#response").show();
   	} else {
   		$("#response").removeClass('alert-danger');
    	$("#response").addClass('alert-success');
    	$("#response").html(resp.msg);
    	$("#response").show();
    	alert(resp.msg);
    	window.location.reload();
  	}
}

$('#frmchangeprofile').bootstrapValidator({
	 container: function($field, validator) {
     	return $field.parent().next('.messageContainer');
     },
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    	'photo': {
            validators: {
                file: {
                    extension: 'jpeg,jpg,png,gif',
                    type: 'image/jpeg,image/png,image/gif,image/jpg',
                    maxSize: 2097152,   // 2048 * 1024
                    message: 'The selected file is not valid'
                }
            }
        },
        'mobile': {
            validators: {
                notEmpty: {
                    message: 'Phone Number is required and cannot be empty'
                }
            }
        }
    }
}).on('success.form.bv', function(e) {
   // Prevent form submission
   e.preventDefault();
   updateUserProfile();
});
function updateUserProfile() {
	var options = {
			target : '#response', // target element(s) to be updated with server response 
			beforeSubmit : showChangeProfileRequest, // pre-submit callback 
			success :  showChangeProfileResponse,
			url : base_url+'admin/profile/editprofile',
			semantic : true,
			dataType : 'json'
		};
		$('#frmchangeprofile').ajaxSubmit(options);
}

function showChangeProfileRequest(formData, jqForm, options){
		var queryString = $.param(formData);
	return true;
	}
function showChangeProfileResponse(resp, statusText, xhr, $form){
	if(resp.status == 0) {
  		$("#response").addClass('alert-danger');
		$("#response").html(resp.msg);
		$("#response").show();
  	} else {
  		$("#response").removeClass('alert-danger');
   	$("#response").addClass('alert-success');
   	$("#response").html(resp.msg);
   	$("#response").show();
   	alert(resp.msg);
   	window.location.reload();
 	}
}
</script>
<!-- end initialize page scripts -->