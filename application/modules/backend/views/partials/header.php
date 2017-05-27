<?php if(!isset($global_admin_id)) {
  	echo '<script>
	alert("For continue please login.");
	</script>';
  	
  	redirect(base_url()."admin");
  } else {
  	auto_admin_logout();
  
  }
 
  ?>




<script src="//js.pusher.com/4.0/pusher.min.js"></script>
<script type="text/javascript">
	// Enable pusher logging - don't include this in production


		Pusher.log = function(message) {
			if (window.console && window.console.log) {
				window.console.log(message);
			}
		};
		var client_id = <?php echo $this->session->userdata('admin')['client_id'];?>;
		var pusher = new Pusher('<?php echo $pusher_key;?>'); 
		var channel = pusher.subscribe('test_channel');
		channel.bind('my_event', function(pusherdata) {
			<?php 
					if($_SESSION['admin']['is_notification_active'] == 1) {
				?>
						$.post("<?php echo base_url();?>admin/getAllNotification",{},function(data) {
							$("#notification_count").empty();
							$("#notification_bar").empty();
						
							var divdata = "";
							document.getElementById('notification_count').innerHTML = data.admin_notification_count;
							 $(data.admin_notification).each(function(index) {
								  divdata = divdata+"<li>"+data.admin_notification[index].title+"<br>"+data.admin_notification[index].notification+"</li>";
							 });
							
							document.getElementById('notification_bar').innerHTML = divdata;
							//alert(JSON.stringify(data));
						},'json');
				
						if(client_id == pusherdata.client_id) {
							// General Notification
							// Play sound
						    document.getElementById('audiotag1').play ();
							$.gritter.add ({
								title: pusherdata.title,
								text: pusherdata.admin_message,
								image: '<?php echo asset_url()."/images/logo-icon.png";?>',
								sticky: true
							});
						}
						<?php }?>
					return true;
			
		});

</script>
<style>
.main-panel > .header .navbar-nav .dropdown-toggle > .tag {
    position: absolute;
    top: 39%;
    font-weight: 800;
    margin-top: -10px;
    right: 0;
    border-radius: 50%;
    border: 1px solid rgba(0, 0, 0, 0.1);
}
</style> 
 <div class="navbar">
 <audio id="audiotag1" src="<?php echo asset_url();?>sound/doorbell.wav" preload="auto"></audio>
  <div class="container">

    <div class="navbar-header">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <i class="fa fa-cogs"></i>
      </button>

      <a class="navbar-brand navbar-brand-image" href="<?php echo base_url();?>admin/dashboard">
        <img src="<?php echo asset_url();?>img/logo.png" alt="Site Logo">
      </a>

    </div> <!-- /.navbar-header -->

    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav noticebar navbar-left">
 <?php if( $_SESSION['admin']['user_role']==3 || $_SESSION['admin']['user_role']==4 || $_SESSION['admin']['user_role']==5){?>
        <li class="dropdown">
          <a href="./page-notifications.html" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell"></i>
            <span class="navbar-visible-collapsed">&nbsp;Notifications&nbsp;</span>
            <span class="badge"><?php echo $admin_notification_count;?></span>
          </a>

          <ul class="dropdown-menu noticebar-menu" role="menu">
            <li class="nav-header">
              <div class="pull-left">
                Notifications
              </div>

              <div class="pull-right">
                <a href="javascript:;">Mark as Read</a>
              </div>
            </li>
 							<?php
								foreach ($admin_notification as $row) { ?>
								
										
											
								
            <li>
              
                <span class="noticebar-item-image">
                  <i class="fa fa-cloud-upload text-success"></i>
                </span>
                <span class="noticebar-item-body">
                  <strong class="noticebar-item-title"><?php echo $row['title'];?></strong>
                  <span class="noticebar-item-text"><?php echo $row['notification'];?></span>
                </span>
              
            </li>
            <?php } ?>
           
          </ul>
        </li>
      <?php }?>


      </ul>

      <ul class="nav navbar-nav navbar-right">   

      

        <li class="dropdown navbar-profile">
          <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
            <img src='<?php  if($admindata['profile_pic']!='') {echo asset_url().$admindata['profile_pic'];} else { echo asset_url()."images/avatar.jpg"; }?>' class="navbar-profile-avatar" alt="">
            <span class="navbar-profile-label">rod@rod.me &nbsp;</span>
            <i class="fa fa-caret-down"></i>
          </a>

          <ul class="dropdown-menu" role="menu">

            <li>
              <a href="<?php echo base_url();?>admin/profile">
                <i class="fa fa-user"></i> 
                &nbsp;&nbsp;My Profile
              </a>
            </li>

            <li class="divider"></li>

            <li>
              <a href="<?php echo base_url();?>admin/logout">
                <i class="fa fa-sign-out"></i> 
                &nbsp;&nbsp;Logout
              </a>
            </li>

          </ul>

        </li>

      </ul>


    </div> <!--/.navbar-collapse -->

  </div> <!-- /.container -->

</div> <!-- /.navbar -->
