

<div class="app error-page no-padding no-footer layout-static">
<div class="session-panel">
<div class="session bg-danger">
<div class="session-content text-xs-center">
<div>
<div class="card b-a-0 no-bg no-shadow">
<div class="card-block">
<div class="lockscreen-avatar">
<img src="<?php echo asset_url();?>images/avatar.jpg" class="avatar avatar-lg img-circle" alt="user" title="user"/>
</div>
<h6 class="center-block m-t-1">
 <?php echo $admindata['first_name']." ".$admindata['last_name'];?>
</h6>
<small>
Please enter your password
</small>
<div class="center-block lockcode m-t-1">
<form role="form" action="<?php echo base_url();?>admin/unlock" method="POST">
<input type="password" class="form-control b-a-0 m-b-1" id="password" name="password" placeholder="Password"/>
<input type="hidden" class="form-control b-a-0 m-b-1" id="global_password" name="global_password" value="<?php echo $admindata['password'];?>" placeholder="Password"/>
<button class="btn btn-success btn-block b-a-0" type="submit">
Unlock
</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">

</script>


