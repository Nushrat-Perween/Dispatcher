
<div class="account-wrapper">

  <div class="account-logo">
    <img src="<?php echo asset_url();?>img/logo-login.png" alt="Target Admin">
  </div>

    <div class="account-body">

      <h3 class="account-body-title">Welcome back to Dispatcher.</h3>

      <h5 class="account-body-subtitle">Please sign in to get access.</h5>

      <form class="form account-form" id="loginForm" method="post" action = "">
	 <div class="form-group">
          <label for="login-password" class="placeholder-hidden">User name</label>
          <input type="text" class="form-control" id="username" placeholder="Password" tabindex="2">
        </div> <!-- /.form-group -->

        <div class="form-group">
          <label for="login-password" class="placeholder-hidden">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password" tabindex="2">
        </div> <!-- /.form-group -->
        <input type="hidden" class="form-control b-a-0 m-b-1" id="global_password" name="global_password" value="<?php echo $admindata['password'];?>" placeholder="Password"/>

        <div class="form-group clearfix">
          <div class="pull-left">         
            <label class="checkbox-inline">
            <input type="checkbox" class="" value="" tabindex="3">Remember me
            </label>
          </div>

          <div class="pull-right">
            <a href="<?php echo base_url();?>admin/forgot_password">Forgot Password?</a>
          </div>
        </div> <!-- /.form-group -->

        <div class="form-group">
      
          <button type="submit" class="btn btn-primary btn-block btn-lg" tabindex="4" id="mainlogin">
            Signin &nbsp; <i class="fa fa-play-circle"></i>
          </button>
         
        </div> <!-- /.form-group -->

      </form>


    </div> <!-- /.account-body -->

  

  </div> <!-- /.account-wrapper -->
  
  
<script src="<?php echo asset_url();?>script/validator/jquery.validate.min.js"></script>
<!-- end page scripts -->
<!-- initialize page scripts -->
<script type="text/javascript">

$('#loginForm').submit(function () {
	if($('#loginForm').validate()) {
		loginUser();
		 return false;
	}
	});

function loginUser()
{
	var referrer =  $(location).attr('href');
	var username = $('#username').val();
	var password = $('#password').val();
		$.post( base_url + "admin/authlogin",{username:username , password: password},function(data) {
			
			if(data.status == 1) {
				
				window.location.href = base_url+"admin/dashboard";
							
			} else {
				alert(data.msg);
				
				window.location.href = base_url+"admin";
			}
		},'json');
		
}
</script>
<!-- end initialize page scripts -->