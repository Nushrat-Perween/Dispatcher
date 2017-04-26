<?php if(!isset($global_admin_id)) {
  	echo '<script>
	alert("For continue please login.");
	</script>';
  	
  	redirect(base_url()."admin");
  } else {
  	auto_admin_logout();
  
  }
 
  ?>

<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/jquery.gritter.css" />
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="<?php echo asset_url();?>js/jquery.gritter.js"></script>
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
<nav class="header navbar">
          <div class="header-inner">
           <audio id="audiotag1" src="<?php echo asset_url();?>sound/doorbell.wav" preload="auto"></audio>
            <div class="navbar-item navbar-spacer-right brand hidden-lg-up">
              <!-- toggle offscreen menu -->
              <a href="javascript:;" data-toggle="sidebar" class="toggle-offscreen">
                <i class="material-icons">menu</i>
              </a>
              <!-- /toggle offscreen menu -->
              <!-- logo -->
              <a class="brand-logo hidden-xs-down">
                <img src="<?php echo asset_url();?>images/logo_white.png" alt="logo"/>
              </a>
              <!-- /logo -->
            </div>
            <a class="navbar-item navbar-spacer-right navbar-heading hidden-md-down" href="<?php echo base_url();?>admin/dashboard">
              <span>Dispature Tool</span>
            </a>
            <div class="navbar-item nav navbar-nav">
             <?php if( $_SESSION['admin']['user_role']==3 || $_SESSION['admin']['user_role']==4 || $_SESSION['admin']['user_role']==5){?>
              <div class="nav-item nav-link dropdown">
             
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="material-icons">notifications</i>
                  <span class="tag tag-danger" id="notification_count"><?php echo $admin_notification_count;?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right notifications">
                  <div class="dropdown-item">
                    <div class="notifications-wrapper">
                      <ul class="notifications-list" id="notification_bar">
                       <?php
								foreach ($admin_notification as $row) {
								
										echo " <li>".$row['title']."<br>".$row['notification']."</li>";
											
								 }?>
                      </ul>
                    </div>
                    <div class="notification-footer">Notifications</div>
                  </div>
                </div>
              </div>
              <?php }?>
              <?php if( $_SESSION['admin']['user_role']==3 || $_SESSION['admin']['user_role']==4 || $_SESSION['admin']['user_role']==5 || $_SESSION['admin']['user_role']==6){?>
              <a href="javascript:;" class="nav-item nav-link nav-link-icon" data-toggle="modal" data-target=".chat-panel" data-backdrop="false">
                <i class="material-icons">chat_bubble</i>
              </a>
              <?php }?>
                <div class="nav-item nav-link dropdown">
               <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <img src='<?php  if($admindata['profile_pic']!='') {echo asset_url().$admindata['profile_pic'];} else { echo base_url()."assets/images/avatar.jpg"; }?>' style ="position: relative;width: 25px;height: 25px;display: inline-block;" alt="" class="img-responsive img-circle"/>&nbsp;
				<span class="hidden-xs">
					<?php echo $admindata['first_name']." ".$admindata['last_name'];?>   <i class="material-icons">arrow_drop_down</i>
				</span>
				</a>
                	<div class="dropdown-menu dropdown-menu-right">
                	<a class="dropdown-item" href="<?php echo base_url();?>admin/profile"><i class="fa fa-user"></i> Profile</a>
                  <a class="dropdown-item" href="<?php echo base_url();?>admin/logout"><i class="fa fa-key"></i> Log Out</a>
                  </div>
                  </div>
            </div>
          </div>
        </nav>
