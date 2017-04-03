  <?php if(!isset($global_user_id)) {
  	echo '<script>
	alert("For continue please login.");
	</script>';
  	
  	redirect(base_url()."login");
  } else {
  	auto_logout();
  	if($_SESSION['lock_count'] >= 1 and $_SESSION['lock_count'] <= 4) {
  		redirect(base_url()."lock_screen");
  	} else if($_SESSION['lock_count'] >4 ) {
  		redirect(base_url()."login");
  	}
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
	
	var pusher = new Pusher('<?php echo $pusher_key;?>'); 
	var channel = pusher.subscribe('test_channel');
	channel.bind('my_event', function(data) {

		$.post("<?php echo base_url();?>notification/getAllNotification",{},function(data) {
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
				text: data.message,
				image: '<?php echo asset_url()."/images/logo-icon.png";?>',
				sticky: true
			});
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
                <img src="<?php echo base_url();?>assets/images/logo_white.png" alt="logo"/>
              </a>
              <!-- /logo -->
            </div>
            <a class="navbar-item navbar-spacer-right navbar-heading hidden-md-down" href="<?php echo base_url();?>dashboard">
             <h2><b>Dispatcher Tool</b></h2>
            </a>
            <div class="navbar-search navbar-item">
              <form class="search-form">
                <i class="material-icons">search</i>
                <input class="form-control" type="text" placeholder="Search" />
              </form>
            </div>
            <div class="navbar-item nav navbar-nav">
              <div class="nav-item nav-link dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                  <span>English</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="javascript:;">English</a>
                  <a class="dropdown-item" href="javascript:;">Russian</a>
                </div>
              </div>
              <div class="nav-item nav-link dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="material-icons">notifications</i>
                  <span class="tag tag-danger" id="notification_count"><?php echo $notification_count;?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right notifications">
                  <div class="dropdown-item">
                    <div class="notifications-wrapper" >
                      <ul class="notifications-list" id="notification_bar">
                      
                        <?php
								foreach ($notification as $row) {
								
									if ($row ['notification_type'] == 0) {
										echo " <li>".$row['title']."<br>".$row['notification']."</li>";
									} 
											
								 }?>
<!--                         <li> -->
<!--                           <a href="javascript:;"> -->
<!--                             <span class="notification-icon"> -->
<!--                               <span class="circle-icon bg-info text-white">J</span> -->
<!--                             </span> -->
<!--                             <div class="notification-message"> -->
<!--                               <b>Jack Hunt</b> -->
<!--                               has -->
<!--                               <b>joined</b> -->
<!--                               mailing list -->
<!--                               <span class="time">9 days ago</span> -->
<!--                             </div> -->
<!--                           </a> -->
<!--                         </li> -->
                       
                      </ul>
                    </div>
                    <div class="notification-footer">Notifications</div>
                  </div>
                </div>
              </div>
              <a href="javascript:;" class="nav-item nav-link nav-link-icon" data-toggle="modal" data-target=".chat-panel" data-backdrop="false">
                <i class="material-icons">chat_bubble </i>
              </a>
              <div class="nav-item nav-link dropdown">
               <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo base_url();?>assets/images/avatar.jpg" style ="position: relative;width: 25px;height: 25px;display: inline-block;" alt="" class="img-responsive img-circle"/>&nbsp;
				<span class="hidden-xs">
					<?php echo $first_name." ".$last_name;?>   <i class="material-icons">arrow_drop_down</i>
				</span>
				</a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="<?php echo base_url();?>logout"><i class="fa fa-key"></i>Log Out</a>
                  </div>
                  </div>
            
            </div>
          </div>
        </nav>
  