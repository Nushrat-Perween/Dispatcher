
<div class="app no-padding no-footer layout-static">
<div class="session-panel">
<div class="session">
<div class="session-content">
<div class="card card-block form-layout" style="max-width:450px">
<form class="form-horizontal form-validate-signin" method="post"  id="loginForm" action="">
<div class="text-xs-center m-b-3">
<img src="<?php echo asset_url();?>images/logo-icon.png" height="80" alt="" class="m-b-1"/>
<p class="text-muted">
Sign in with your app id to continue.
</p>
</div>
<fieldset class="form-group">
<label for="username">
<?php //echo phpinfo(); ?>
Enter your username
</label>
<input type="text" class="form-control form-control-lg" id="username" placeholder="username" required/>
</fieldset>
<fieldset class="form-group">
<label for="password">
Enter your password
</label>
<input type="password" class="form-control form-control-lg" id="password" placeholder="********" required/>
</fieldset>
<label class="custom-control custom-checkbox m-b-1">
<input type="checkbox" class="custom-control-input">
<span class="custom-control-indicator"></span>
<span class="custom-control-description">Stay logged in</span>
</label>
<button class="btn btn-primary btn-block btn-lg" type="submit" id="mainlogin">
Login
</button>
<div class="divider">
<span>
OR
</span>
</div>
<div class="text-xs-center">
<a href="forgot.html">
Forgot password?
</a>
</div>
</form>
</div>
</div>
</div>
</div>
</div>

<script src="<?php echo asset_url();?>script/validator/jquery.validate.min.js"></script>
<!-- end page scripts -->
<!-- initialize page scripts -->
<script type="text/javascript">
$('#loginForm').validate();
$('#loginForm').submit(function () {
	loginUser();
	 return false;
	});

function loginUser()
{

	var referrer =  $(location).attr('href');
		$.post( base_url + "authlogin",{username: $('#username').val(), password: $('#password').val()},function(data) {
			if(data.status == 1) {
				//alert(data.msg);
				window.location.href = base_url+"dashboard";
							
			} else {
				alert(data.msg);
				//alert(base_url);
				window.location.href = base_url;
			}
		},'json');
}
</script>
<!-- end initialize page scripts -->

