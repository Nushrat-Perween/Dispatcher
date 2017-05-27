<!-- build:css({.tmp,app}) styles/app.min.css -->
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/dist/css/bootstrap.css"/>
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.css"/>
<style>
.messageContainer {
	color:red;
	margin-left:3%;
}
</style>
<div class="app no-padding no-footer layout-static">
	<div class="session-panel">
		<div class="session">
			<div class="session-content">
				<div class="card card-block form-layout">
					
						<form class="form-validation form-horizontal" method="POST" action="" enctype="multipart/form-data" id="reset_password_form">
							<div class="text-xs-center m-b-3">
							<img src="<?php echo asset_url();?>images/logo-icon.png" height="100" alt="" class="m-b-1"/>
							<h5>
							Reset password
							</h5>
							<p class="text-muted">
							Enter your email and we'll send you instructions on how to reset your password.
	                  		</p>
                				</div>
                				<div class="form-control" id="response" style="display: none"> </div><br>
		                <fieldset class="form-group">
		                 
		                  <div class="row">
							<div class="col-md-10 input-group">
								<input type="email" value="<?php echo $emailid;?>" class="form-control form-control-lg" id="email" name="email" placeholder="email address"  readonly/>
							</div>
							<div class="messageContainer"></div>
						</div>
						<br>
		                  <div class="row">
							<div class="col-md-10 input-group">
								<input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="New Password"  autofocus required/>
							</div>
							<div class="messageContainer"></div>
						</div>
						<br>
		                  <div class="row">
							<div class="col-md-10 input-group">
								<input type="password" class="form-control form-control-lg" id="confirm_password" name="confirm_password" placeholder="Confirm Password"  required/>
							</div>
							<div class="messageContainer"></div>
						</div>

		                </fieldset>
		                <button class="btn btn-primary btn-block btn-lg" type="submit">
		                  Reset password
		                </button>

		              </form>
		              <div class="divider">
						<span>
						OR
						</span>
						</div>
						<div class="text-xs-center">
						<a href="<?php echo base_url();?>admin">
			                Log in
			            </a>
					</div>
            		</div>
          </div>

        </div>

      </div>
    </div>

<script src="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>vendor/bootstrap/jquery.form.js"></script>
    <script type="text/javascript">
    $("#reset_password_form").submit(function(e) {
    	e.preventDefault();
    });
    	$('#reset_password_form').bootstrapValidator({
container: function($field, validator) {
	return $field.parent().next('.messageContainer');
},
feedbackIcons: {
	validating: 'glyphicon glyphicon-refresh'
},
excluded: ':disabled',
fields: {

	email: {
        validators: {
            notEmpty: {
                message: 'The Email is required and cannot be empty'
            }
        }
    },
	password: {
        validators: {
            notEmpty: {
                message: 'The Password is required and cannot be empty'
            }
        }
    },
    confirm_password: {
        validators: {
        	notEmpty: {
                message: 'The Confirm Password is required and cannot be empty'
            },
            identical: {
                field: 'password',
                message: 'The password and its confirm must be the same'
            }
        }
    }
 
}
}).on('success.form.bv', function(e) {
	// Prevent form submission
	e.preventDefault();
	send_instruction ();
});

	function send_instruction () {
		dataString = $("#reset_password_form").serialize();
		$(".text-danger").hide();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>admin/save_reset_password",
			data: dataString,
			dataType: 'json',
			success: function(resp){
				if(resp.status == '0') {
					$("#response").addClass('alert-danger');
					$("#response").html(resp.msg);
					$("#response").show();
						

				} else {
					$('#reset').click();
					$("#response").show();
					$("#response").addClass('alert-success');
					$("#response").html(resp.msg);
					alert(resp.msg);
					document.getElementById("reset_password_form").reset();
					$('#reset_password_form').bootstrapValidator('enableFieldValidators', 'password',true);
					$('#reset_password_form').bootstrapValidator('enableFieldValidators', 'confirm_password',true);
					//window.location.href = "<?php echo base_url(); ?>admin/add_city";
					}
				}

			});
				return false;  //stop the actual form post !important!
		}
    </script>

