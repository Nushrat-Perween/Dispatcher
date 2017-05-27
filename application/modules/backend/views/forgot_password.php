
    
 <hr class="account-header-divider">

<div class="account-wrapper">

  <div class="account-logo">
    <img src="<?php echo asset_url();?>img/logo-login.png" alt="Target Admin">
  </div>

    <div class="account-body">

      <h3 class="account-body-title">Password Reset</h3>

      <h5 class="account-body-subtitle">We'll email you instructions on how to reset your password.</h5>
      <div class="form-control" id="response" style="display: none"> </div><br>

      <form class="form account-form" method="POST" action="" enctype="multipart/form-data" id="forgot_password_form">

        <div class="form-group">
          <label for="forgot-email" class="placeholder-hidden">Your Email</label>
          <input type="email" class="form-control" id="email" placeholder="Your Email" tabindex="1">
        </div> <!-- /.form-group -->

        <div class="form-group">
          <button type="submit" class="btn btn-secondary btn-block btn-lg" tabindex="2">
            Reset Password &nbsp; <i class="fa fa-refresh"></i>
          </button>
        </div> <!-- /.form-group -->

        <div class="form-group">
          <a href="<?php echo base_url()?>"><i class="fa fa-angle-double-left"></i> &nbsp;Back to Login</a>
        </div> <!-- /.form-group -->
      </form>

    </div> <!-- /.account-body -->

  </div> <!-- /.account-wrapper -->

<script src="<?php echo asset_url();?>vendor/bootstrap/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>vendor/bootstrap/jquery.form.js"></script>
    <script type="text/javascript">
    $("#forgot_password_form").submit(function(e) {
    	e.preventDefault();
    });
    	$('#forgot_password_form').bootstrapValidator({
    		container: function($field, validator) {
    			return $field.parent().next('.messageContainer');
    		},
    		feedbackIcons: {
    			validating: 'glyphicon glyphicon-refresh'
    		},
    		excluded: ':disabled',
    		fields: {


    			'password': {
    			validators: {
    				notEmpty: {
    					message: ' Password is required and cannot be empty'
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
			var dataString = $("#email").val();
			$(".text-danger").hide();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/send_password_reset_instruction",
				data: "email="+ dataString,
				dataType: 'json',
				success: function(resp){
					if(resp.status == '0') {
						$("#response").addClass('alert-danger');
						$("#response").html(resp.msg);
						alert(resp.msg);
					} else {
						$('#reset').click();
						$("#response").show();
						$("#response").addClass('alert-success');
						$("#response").html(resp.msg);
						alert(resp.msg);
						//window.location.href = "<?php echo base_url(); ?>admin/add_city";
					}
				}

			});
				return false;  //stop the actual form post !important!
		}
    </script>

