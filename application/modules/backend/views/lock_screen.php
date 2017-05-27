

    
 <hr class="account-header-divider">

<div class="account-wrapper">

  <div class="account-logo">
    <img src="<?php echo asset_url();?>img/logo-login.png" alt="Target Admin">
  </div>

    <div class="account-body">

      <h3 class="account-body-title">Lock Screen</h3>

      <h5 class="account-body-subtitle">  <h5 class="account-body-subtitle"> <?php echo $admindata['first_name']." ".$admindata['last_name'];?></h5>
      <div class="form-control" id="response" style="display: none"> </div><br>

      <form class="form account-form" action="unlock" method="POST">

        <div class="form-group">
          <label for="forgot-email" class="placeholder-hidden">Please enter your password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Your Password" tabindex="1">
        </div> <!-- /.form-group -->
			<input type="hidden" class="form-control b-a-0 m-b-1" id="global_password" name="global_password" value="<?php echo $admindata['password'];?>" placeholder="Password"/>
        <div class="form-group">
          <button type="submit" class="btn btn-secondary btn-block btn-lg" tabindex="2">
            Unlock &nbsp; <i class="fa fa-"></i>
          </button>
        </div> <!-- /.form-group -->

        <div class="form-group">
          <a href="<?php echo base_url()?>"><i class="fa fa-angle-double-left"></i> &nbsp;Back to Login</a>
        </div> <!-- /.form-group -->
      </form>

    </div> <!-- /.account-body -->

  </div> <!-- /.account-wrapper -->


