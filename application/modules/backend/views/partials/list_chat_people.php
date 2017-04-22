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
            
