
<style>
.table-bordered {
    border: 1px solid #eceeef;
    border-left: 0px;
    border-right: 0px;
}
.table-bordered th, .table-bordered td {
   
    border-right: 0px;
    border-left: 0px;
}
.thead-inverse th {
    color: #fff;
    background-color: #0275d8;
}
</style>
<div class="content-view">

 		<div class="row">
              <div class="col-md-4" style="height:50%">
                <div class="card card-block p-b-0" >
                  <div class="text-xs-center m-b-2">
                    
					<table class="table table-bordered">
                      <thead class="thead-inverse">
                        <tr>
                          <th >
                            <center>Mark Attendance</center>
                          </th>
                          
                        </tr>
                      </thead>
                      </table>
						<br>
					<div style="margin-top:30px;"><?php echo date('l, d F Y');?></div><br>
					<h1><span class="currentTime" id="currentTime" style='color:#e98007'><?php echo date('H : i : s');?></span></h1>
				   	<br><?php //echo $this->session->userdata('attendance_last_action');?>
					<div class="markAttendancePanel" style="margin-bottom: 39px">
					<center>
					<button class="btn btn-large btn-success signOut " style="display:<?php if($this->session->userdata('attendance_last_action')) {echo "block";} else {echo "none";}?>" id="sign_out">Sign Out</button>
					
					<button class="btn btn-large btn-success signIn" style="display:<?php if($this->session->userdata('attendance_last_action')) {echo "none";} else {echo "block";}?>" id="sign_in">Sign In</button>
					</center>
					</div>
                  </div>
          		<br>
          		<br>
          		<br>
          		<br>
          		<br>
          		<br>
          		<br>
                </div>
              </div>
              
			
              <div class="col-md-4">
                <div class="card card-block p-b-0">
                  <div class="text-xs-center m-b-2">
                    <div id="attendance_list">
					<table class="table table-bordered datatable" id="table_id1">
                      <thead class="thead-inverse">
                        <tr>
                          <th colspan="2">
                            <center>Recent Swipes</center>
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      <tr>
                          <td colspan="2" style="text-align:left">
                           <br><br>
                          </td>
                          
                        </tr>
                       
                      <?php foreach ($attendance_list as $row) {?>
                         <tr>
                         <td style="text-align:left">
                            <?php if($row['action'] == 1) { echo "Sign In    - ";} else{ echo "Sign Out - "; }?>
                          </td>
                          <td style="text-align:left">
                            <?php  echo date('d M Y H:i',strtotime($row['action_time']));?>
                          </td>
                          
                        </tr>
                        <?php }?>
                       
                      </tbody>
                    </table>
                    </div>
					<br>
					<br>
					
						 <a href="/v2/attendance/info/attendanceinfo">View More»</a>
		
					
					<br>
                  </div>
          
                </div>
              </div>
           
              <div class="col-md-4">
                <div class="card card-block p-b-0">
                  <div class="text-xs-center m-b-2">
                    <table class="table table-bordered">
                      <thead class="thead-inverse">
                        <tr >
                          <th colspan="2">
                            <center>Monthly Summary</center>
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      
                        <tr >
                          <td class="pull-center" colspan="2">
                         <strong><?php echo date('F Y');?></strong>
                         <br>
                         <br>
                          </td>
                          
                        </tr>
                        <tr>
                          <td style="text-align:left">
                            Present Days
                          </td>
                          <td >
                           0
                          </td>
                        </tr>
                        <tr>
                          <td style="text-align:left">
                            Absent
                          </td>
                           <td >
                            3
                          </td>
                        </tr>
                        <tr>
                          <td style="text-align:left">
                            On Leave
                          </td>
                          <td >
                           0
                          </td>
                        </tr>
                        <tr>
                          <td style="text-align:left">
                            Holidays
                          </td>
                           <td >
                            3
                          </td>
                        </tr>
                        <tr>
                          <td style="text-align:left">
                            LateIn Days
                          </td>
                          <td >
                           0
                          </td>
                        </tr>
                        <tr>
                          <td style="text-align:left">
                            EarlyOut Days
                          </td>
                           <td>
                            3
                          </td>
                        </tr>
                        
                        
                      </tbody>
                    </table>
					&nbsp
				    
					
                  </div>
          
                </div>
              </div>
            </div>
            
       </div>  

    
<script>
$(document).ready(function(){
	display_c();
});
function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
function display_c(){
	
	var refresh=1000; // Refresh rate in milli seconds
	mytime=setTimeout('display_ct()',refresh)
	}
	
function display_ct() {

	var strcount
	var x = new Date()
	
	x1 =  addZero(x.getHours()) + " : " + addZero(x.getMinutes()) + " : " + addZero(x.getSeconds());
	document.getElementById('currentTime').innerHTML = x1;

	tt=display_c();
	}



$("#sign_in").click(function() {
	$.post("<?php echo base_url();?>admin/mark_attendance_as_signin",{},function(data){
		$.post("<?php echo base_url();?>admin/get_latest_attendance",{},function(data){
			var html = '<table class="table table-bordered datatable" id="table_id1">'+
				                '<thead class="thead-inverse">'+
						            '<tr>'+
						              '<th colspan="2">'+
						                '<center>Recent Swipes</center>'+
						              '</th>'+
						              
						            '</tr>'+
						          '</thead>'+
						          '<tbody>'+
						          '<tr>'+
						              '<td colspan="2" style="text-align:left">'+
						               '<br><br>'+
						              '</td>'+
						              
						            '</tr>';
						           
						            $(data).each(function(index) {
						            	html = html +  '<tr>'+
						             '<td style="text-align:left">';
						             html = html +  data[index].action;
						             html = html +   '</td>'+
						              '<td style="text-align:left">';
						              html = html + data[index].time;
						              html = html +   '</td>'+
						              
						            '</tr>';
									});
				           
		            html = html +  '</tbody>'+
       									 '</table>';
		            document.getElementById("attendance_list").innerHTML = html;
		},'json');
						
	});
	document.getElementById("sign_in").style.display = "none";
	document.getElementById("sign_out").style.display = "block";
		
});

$("#sign_out").click(function() {
	$.post("<?php echo base_url();?>admin/mark_attendance_as_signout",{},function(data){
		$.post("<?php echo base_url();?>admin/get_latest_attendance",{},function(data){
			var html = '<table class="table table-bordered datatable" id="table_id1">'+
            '<thead class="thead-inverse">'+
	            '<tr>'+
	              '<th colspan="2">'+
	                '<center>Recent Swipes</center>'+
	              '</th>'+
	              
	            '</tr>'+
	          '</thead>'+
	          '<tbody>'+
	          '<tr>'+
	              '<td colspan="2" style="text-align:left">'+
	               '<br><br>'+
	              '</td>'+
	              
	            '</tr>';
	           
	            $(data).each(function(index) {
	            	html = html +  '<tr>'+
	             '<td style="text-align:left">';
	             html = html +  data[index].action;
	             html = html +   '</td>'+
	              '<td style="text-align:left">';
	              html = html + data[index].time;
	              html = html +   '</td>'+
	              
	            '</tr>';
				});
       
html = html +  '</tbody>'+
						 '</table>';
document.getElementById("attendance_list").innerHTML = html;
		},'json');
						
	});
	document.getElementById("sign_in").style.display = "block";
	document.getElementById("sign_out").style.display = "none";
		
});
</script>