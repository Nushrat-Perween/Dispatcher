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
                 <div class="nav-item nav-link dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="material-icons">notifications</i>
                  <span class="tag tag-danger" id="notification_count"><?php echo $admin_notification_count;?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right notifications">
                  <div class="dropdown-item">
                    <div class="notifications-wrapper" >
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
              <a href="javascript:;" class="nav-item nav-link nav-link-icon" data-toggle="modal" data-target=".chat-panel" data-backdrop="false">
                <i class="material-icons">chat_bubble</i>
              </a>
                <div class="nav-item nav-link dropdown">
               <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo base_url();?>assets/images/avatar.jpg" style ="position: relative;width: 25px;height: 25px;display: inline-block;" alt="" class="img-responsive img-circle"/>&nbsp;
				<span class="hidden-xs">
					<?php echo $admindata['first_name']." ".$admindata['last_name'];?>   <i class="material-icons">arrow_drop_down</i>
				</span>
				</a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="<?php echo base_url();?>admin/logout"><i class="fa fa-key"></i>Log Out</a>
                  </div>
                  </div>
            </div>
          </div>
        </nav>
        
        <script type="text/javascript">
	// Enable pusher logging - don't include this in production


	Pusher.log = function(message) {
		if (window.console && window.console.log) {
			window.console.log(message);
		}
	};
	var client_id = <?php echo $this->session->userdata('admin')['client_id'];?>;
	var hospital_id = <?php echo $this->session->userdata('admin')['hospital_id'];?>;
	var role = <?php echo $this->session->userdata('admin')['user_role'];?>;
	var pusher = new Pusher('<?php echo $pusher_key;?>'); 
	var channel = pusher.subscribe('test_channel');
	channel.bind('my_event', function(data) {
		if(data.notification_type == 1) {
			if(role == 3 || role == 4 || role == 5 ) {
				if(client_id == data.client_id) {
					if( role == 5 ) {
						if(hospital_id == data.hospital_id) {
							$.post("<?php echo base_url();?>admin/getAllNotification",{},function(data) {
								$("#notification_count").empty();
								$("#notification_bar").empty();
							
							
								var divdata = "";
								document.getElementById('notification_count').innerHTML = data.notification_count;
								 $(data.notification).each(function(index) {
									  divdata = divdata+"<li>"+data.notification[index].title+"<br>"+data.notification[index].notification+"</li>";
								 });
								
								document.getElementById('notification_bar').innerHTML = divdata;
								//alert(JSON.stringify(data));
							},'json');
						
							// General Notification
							// Play sound
						    document.getElementById('audiotag1').play ();
							$.gritter.add ({
								title: data.title,
								text: data.admin_message,
								image: '<?php echo asset_url()."/images/logo-icon.png";?>',
								sticky: true
							});
						}
					} else {
						$.post("<?php echo base_url();?>admin/getAllNotification",{},function(data) {
							$("#notification_count").empty();
							$("#notification_bar").empty();
						
						
							var divdata = "";
							document.getElementById('notification_count').innerHTML = data.notification_count;
							 $(data.notification).each(function(index) {
								  divdata = divdata+"<li>"+data.notification[index].title+"<br>"+data.notification[index].notification+"</li>";
							 });
							
							document.getElementById('notification_bar').innerHTML = divdata;
							//alert(JSON.stringify(data));
						},'json');
					
						// General Notification
						// Play sound
					    document.getElementById('audiotag1').play ();
						$.gritter.add ({
							title: data.title,
							text: data.admin_message,
							image: '<?php echo asset_url()."/images/logo-icon.png";?>',
							sticky: true
						});
					}
				}
			}
		} else if(data.notification_type == 2) {
			if(role == 3 || role == 4 || role == 5 || role == 6) {
				if(client_id == data.client_id) {
					if(role == 6) {
						if(hospital_id == data.hospital_id) {
							$.post("<?php echo base_url();?>admin/getAllNotification",{},function(data) {
								$("#notification_count").empty();
								$("#notification_bar").empty();
							
							
								var divdata = "";
								document.getElementById('notification_count').innerHTML = data.notification_count;
								 $(data.notification).each(function(index) {
									 alert(data.notification[index].title);
									 alert(data.notification[index].notification);
									  divdata = divdata+"<li>"+data.notification[index].title+"<br>"+data.notification[index].notification+"</li>";
								 });
								
								document.getElementById('notification_bar').innerHTML = divdata;
								//alert(JSON.stringify(data));
							},'json');
						
							// General Notification
							// Play sound
						    document.getElementById('audiotag1').play ();
							$.gritter.add ({
								title: data.title,
								text: data.admin_message,
								image: '<?php echo asset_url()."/images/logo-icon.png";?>',
								sticky: true
							});
						}
					} else {
						$.post("<?php echo base_url();?>admin/getAllNotification",{},function(data) {
							$("#notification_count").empty();
							$("#notification_bar").empty();
						
						
							var divdata = "";
							document.getElementById('notification_count').innerHTML = data.notification_count;
							 $(data.notification).each(function(index) {
								 alert(data.notification[index].title);
								 alert(data.notification[index].notification);
								  divdata = divdata+"<li>"+data.notification[index].title+"<br>"+data.notification[index].notification+"</li>";
							 });
							
							document.getElementById('notification_bar').innerHTML = divdata;
							//alert(JSON.stringify(data));
						},'json');
					
						// General Notification
						// Play sound
					    document.getElementById('audiotag1').play ();
						$.gritter.add ({
							title: data.title,
							text: data.admin_message,
							image: '<?php echo asset_url()."/images/logo-icon.png";?>',
							sticky: true
						});
					}
				}
			}
		}
		return true;
	});
</script>
