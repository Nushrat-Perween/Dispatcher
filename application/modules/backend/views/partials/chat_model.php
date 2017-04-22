<div class="modal fade sidebar-modal chat-panel" tabindex="-1" role="dialog" aria-labelledby="chat-panel" aria-hidden="true">
        <div class="modal-dialog" style="width:60%" >
          <div class="modal-content" id="chat_sidebar">
          <div class="chat-header">
<a class="pull-right" href="javascript:;" data-dismiss="modal">
<i class="material-icons">close</i>
</a>
<div class="chat-header-title">People</div>
</div>
<div class="modal-body flex scroll-y">
<div class="chat-group">
<div class="chat-group-header">Online</div>

<?php foreach($chat_admin as $row) {
	if($row['is_logged_in'] == 1) {
		?>
                <a href="javascript:;" data-toggle="modal" data-target=".chat-message" onclick="open_chat_box(`<?php echo $row['id'];?>`,`<?php echo $row['first_name']." ".$row['last_name'];?>`,`<?php if($row['last_visit_date'] != "0000-00-00 00:00:00") { echo date('d-m-Y g:i A',strtotime($row['last_visit_date']));} else { echo "NA";}?>`);">
                  <span class="status-online"></span>
                  <span><?php echo $row['first_name']." ".$row['last_name'];?></span>
                </a>
                <?php 
               	 	}
                }?>
                
              </div>
             
              <div class="chat-group">
                <div class="chat-group-header">Other</div>
                  <?php foreach($chat_admin as $row) {
               	 	if($row['is_logged_in'] == 0) {
                ?>
                <a href="javascript:;" data-toggle="modal" data-target=".chat-message" onclick="open_chat_box(`<?php echo $row['id'];?>`,`<?php echo $row['first_name']." ".$row['last_name'];?>`,`<?php if($row['last_visit_date'] != "0000-00-00 00:00:00") { echo date('d-m-Y g:i A',strtotime($row['last_visit_date']));} else { echo "NA";}?>`);">
                  <span class="status-offline"></span>
                  <span><?php echo $row['first_name']." ".$row['last_name'];?></span>
                </a>
                <?php 
               	 	}
                }?>
                
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade chat-message" tabindex="-1" role="dialog" aria-labelledby="chat-message" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="chat-header">
              <div class="pull-right dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="material-icons">more_vert</i>
                </a>
                <div class="dropdown-menu" role="menu">
                  <a class="dropdown-item" href="javascript:;">Delete conversation</a>
                  <a class="dropdown-item" href="javascript:;" data-dismiss="modal">Close chat</a>
                </div>
              </div>
              <div class="chat-conversation-title">
                <img src="<?php echo base_url();?>assets/images/face1.jpg" class="avatar avatar-xs img-circle m-r-1 pull-left" alt="">
                <div class="overflow-hidden" id="receiver_name">
                  <span ><strong>Charles Wilson</strong></span>
                  <small>Last seen today at 03:11</small>
                </div>
              </div>
            </div>
            <div class="modal-body flex scroll-y" id="chat_box" style="height:300px">
              <p class="text-xs-center text-muted small text-uppercase bold m-b-1">Yesterday</p>
              <div class="chat-conversation-user them">
                <div class="chat-conversation-message">
                  <p>Hey.</p>
                </div>
              </div>
              <div class="chat-conversation-user them">
                <div class="chat-conversation-message">
                  <p>How are the wife and kids, Taylor?</p>
                </div>
              </div>
              <div class="chat-conversation-user me">
                <div class="chat-conversation-message">
                  <p>Pretty good, Samuel.</p>
                </div>
              </div>
              <p class="text-xs-center text-muted small text-uppercase bold m-b-1">Today</p>
              <div class="chat-conversation-user them">
                <div class="chat-conversation-message">
                  <p>Curabitur blandit tempus porttitor.</p>
                </div>
              </div>
              <div class="chat-conversation-user me">
                <div class="chat-conversation-message">
                  <p>Goodnight!</p>
                </div>
              </div>
              <div class="chat-conversation-user them">
                <div class="chat-conversation-message">
                  <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
                </div>
              </div>
            </div>
            <div class="chat-conversation-footer">
                <button class="chat-left">
                  <i class="material-icons">face</i>
                </button>
                <input type="hidden" id="receiver_id" value="">
                <div class="chat-input" id="message" contenteditable=""></div>
                <button class="chat-right">
                  <i class="material-icons">photo</i>
                </button>
              </div>
          </div>
        </div>
      </div>
     
      <script>
      
      function open_chat_box (id,name,last_visit) {
    		document.getElementById('receiver_id').value = id;
    		user_info = '<span ><strong>'+name+'</strong></span>';
    		if(last_visit != "NA") {
    		user_info = user_info+'<small>Last seen at '+last_visit+'</small>';
    		}
    		document.getElementById('receiver_name').innerHTML = user_info; 
               
    		$.post("<?php echo base_url();?>admin/open_chat_box",{"receiver_id":id},function(data){
    			 	$('#chat_box').html(data);
    			 	var scrolltoh = $('#chat_box')[0].scrollHeight;
    		   		$('#chat_box').scrollTop(scrolltoh);
    		});
    	}
  	
   // method to trigger when user hits enter key
      $('.chat-input').on("keyup", function(event) {
          if(event.keyCode == '13'){
      		set_chat_msg();
          }
      });
      
      function set_chat_msg () { 	
      	 var message = document.getElementById('message').innerHTML;
      	message = message.substring(0, message.length - 15);
      	 var receiver_id = document.getElementById('receiver_id').value;
      	
      	 $.post("<?php echo base_url();?>admin/save_chat",{"message":message,"receiver_id":receiver_id},function(data){
      		 document.getElementById('message').innerHTML="";
      		$('#chat_box').html(data);
      		var scrolltoh = $('#chat_box')[0].scrollHeight;
       		$('#chat_box').scrollTop(scrolltoh);
      	 });
      	
      }
      
    //automatically refresh after every 1000 milliseconds.
      chat_data = {'fetch':1};
      window.setInterval(function(){
      	 $.post("<?php echo base_url();?>admin/get_chat_people",{},function(data){
      			 	$('#chat_sidebar').html(data);
      		    
      		 });
      var	id = document.getElementById('receiver_id').value;
		
           
		$.post("<?php echo base_url();?>admin/open_chat_box",{"receiver_id":id},function(data){
			 	$('#chat_box').html(data);
			 	var scrolltoh = $('#chat_box')[0].scrollHeight;
		   		$('#chat_box').scrollTop(scrolltoh);
		});
      }, 3000);
      </script>