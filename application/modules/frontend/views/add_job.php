
    <!-- page stylesheets -->
    <link rel="stylesheet" href="<?php echo asset_url();?>vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>vendor/x-editable/dist/inputs-ext/address/address.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>vendor/x-editable/dist/inputs-ext/contacts/contact.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>vendor/x-editable/dist/inputs-ext/typeaheadjs/lib/typeahead.js-bootstrap.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>vendor/select2/select2.css">
    <!-- end page stylesheets -->

    <!-- build:css({.tmp,app}) styles/app.min.css -->
    <link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo asset_url();?>vendor/pace/themes/blue/pace-theme-minimal.css"/>
    <link rel="stylesheet" href="<?php echo asset_url();?>vendor/font-awesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?php echo asset_url();?>vendor/animate.css/animate.css"/>
    <link rel="stylesheet" href="<?php echo asset_url();?>styles/app.css" id="load_styles_before"/>
    <link rel="stylesheet" href="<?php echo asset_url();?>styles/app.skins.css"/>
    <!-- endbuild -->
    <style>
    .datepicker.dropdown-menu {
    font-size: 0.8125rem;
    display: none;
    visibility: visible;
    padding: 1rem;
    border-color: rgba(0, 0, 0, 0.1);
    opacity: 1;
    margin-top: 223px;
    margin-left: 534px;
    border-radius: 2px;
    box-shadow: 0 0.0625rem 1px transparent;
}
    .editable-error-block {
    color:red;
    }
.table-bordered th, .table-bordered td {
    border-color: rgba(0, 0, 0, 0);
    border-top: 0;
    border-left: 0;
}
</style>

 <div class="content-view">
            <div class="card card-block">
              <h2>Add New Job</h2	>
              <div class="m-b-2">
                
                <label class="c-input c-checkbox m-r-3">
                  <input type="checkbox" id="autoopen"/>
                  <span class="c-indicator">
                  </span>
                  auto-open next field
                </label>
              </div>
           <table id="user" class="table table-bordered align-middle">
                <tbody>
                <tr>
                  <td colspan="4" style="background-color: #e6e6e6">Information</td>
                  </tr>
                  <tr>
                    <td width="20%">
                      <b>Job ID <span class='require'></span></b>
                    </td>
                    <td width="30%">
						
						<?php echo $job_id;?>
                    </td>
                    <td width="20%">
                      <b>Job Name</b>
                    </td>
                    <td width="30%">
                      <a href="#" id="job_name" class="myeditable" data-type="text"  data-name="data[job_name]" data-title="Enter Job Name">
                    <?php echo $job_id;?>
                      </a>
                    </td>
                  </tr>
                  
                  <tr>
                    <td colspan="1" width="20%">
                      <b>Description</b>
                    </td>
                    <td colspan="3"  width="80%">
                      <a href="#" class="myeditable" data-type="textarea" data-name="data[description]" id="description" data-title="Enter description">
                      </a>
                    </td>
                  </tr>
                  <tr>
                  <td colspan="4" style="background-color: #e6e6e6">Additional Information</td>
                  </tr>
                  <tr>
                    <td width="20%">
                      <b>Patient Name <span class='require'>*</span></b>
                    </td>
                    <td width="30%">
                      <a href="#" class="myeditable" data-type="text" data-name="add_info[name]" id="name" data-title="Enter Patient Name">
                      </a>
                    </td>
                    <td width="20%">
                      <b>Room Number <span class='require'>*</span></b>
                    </td>
                    <td width="30%">
                      <a href="#" class="myeditable" data-type="text" data-name="add_info[room_no]" id="room_no" data-title="Enter room no.">
                      </a>
                    </td>
                    
                  </tr>
                  
                  <tr>
                    <td width="20%">
                      <b>Tests<span class='require'>*</span></b>
                    </td>
                    <td width="30%">
                      <a href="#" class="myeditable" data-type="text" data-name="add_info[test]" id="test" data-title="Enter Tests">
                      </a>
                    </td>
                    <td width="20%">
                      <b>Caller<span class='require'>*</span></b>
                    </td>
                    <td width="30%">
                      <a href="#" class="myeditable" data-type="text" data-name="add_info[caller]" id="caller" data-title="Enter Callers">
                      </a>
                    </td>
                  </tr>
                 
                  <tr>
                    <td colspan="1" width="20%">
                      <b>Special Instructions<span class='require'>*</span></b>
                    </td>
                    <td colspan="3" width="80%">
                      <a href="#" class="myeditable" data-type="textarea" data-name="add_info[special_instruction]" id="special_instruction" data-title="Enter Callers">
                      </a>
                    </td>
                  </tr>
                  <tr>
                  <td colspan="4" style="background-color: #e6e6e6">Location Address</td>
                  </tr>
                  <tr>
                    <td colspan="1" width="20%">
                      Address
                    </td>
                     <td colspan="3" width="80%">
                      <a href="#"  class="myeditable" id="address" data-name="address" data-type="address" data-title="Please, fill address">
                      </a>
                    </td>
                  </tr>
                  <tr>
                     <td colspan="1" width="20%">
                      Contact
                    </td>
                     <td colspan="3" width="80%">
                      <a href="#" class="myeditable"  id="contact" data-name="contact" data-type="contact" data-title="Please, fill contacts">
                      </a>
                    </td>
                  </tr>

                   <tr>
                  <td colspan="4" style="background-color: #e6e6e6">Schedule</td>
                  </tr>
                  <tr>
                    <td width="20%">
                      <b>Job Pattern<span class='require'>*</span></b>
                    </td>
                    <td width="30%">
                      <a href="#" class="myeditable" data-type="select" data-name="data[job_type_id]" id="job_type_id" data-source="/job_type_id" data-title="Enter Job Type">
                      </a>
                    </td>
                     

                  </tr>
                  
<!--                    <tr> -->
<!--                     <td width="20%"> -->
<!--                       <b>Date<span class='require'>*</span></b> -->
<!--                     </td> -->
<!--                     <td width="35%"> -->
<!--                       <a href="#" class="myeditable" data-type="combodate" data-format="YYYY-MM-DD" data-viewformat="DD-MM-YYYY" data-template="D - MMM - YYYY" data-pk="1"  data-name="assign_data[start_date]" > -->
                      <?php //echo date('d-m-Y');?>
<!--                       </a> -->
                     
<!--                     </td> -->
<!--                      <td width="10%"> -->
<!--                       Time -->
<!--                     </td> -->
<!--                      <td  width="50%"> -->
                     
<!--                        <a href="#" class="myeditable" id="event" data-type="combodate" data-name="assign_data[start_time]"  data-template="HH:mm" data-format="HH:mm:ss" data-viewformat="HH:mm"   data-title="Time"> -->
                      <?php //echo date('H:i');?>
<!--                       </a>   -->
<!--                     </td> -->

<!--                   </tr> -->
                
                  
                  <tr>
<!--                      <td width="20%"> -->
<!--                       Duration (Hr) -->
<!--                     </td> -->
<!--                      <td width="30%"> -->
<!--                       <a href="#" class="myeditable" id="duration" data-type="text" data-name="assign_data[duration]"  data-template="HH:mm" data-format="HH:mm" data-viewformat="HH:mm"   data-title="Setup event time"> -->
<!--                       </a> -->
<!--                     </td> -->
                    <td width="20%">
                      <b>Priority<span class='require'>*</span></b>
                    </td>
                    <td width="30%">
                      <a href="#" class="myeditable" id="priority" data-name="data[priority]"  data-type="select"  data-source="/priority" data-title="Select priority">
                      </a>
                    </td>
                  </tr>
                  
                  <tr>
<!--                     <td width="20%"> -->
<!--                       <b>Assign To<span class='require'>*</span></b> -->
<!--                     </td> -->
<!--                     <td width="30%"> -->
<!--                       <a href="#" class="myeditable" id="assign_to" data-name="assign_data[assign_to]" data-type="select"  data-source="/assign_to" data-title="Select Assign To"> -->
                      
<!--                       </a> -->
<!--                     </td> -->
                     <td colspan="1" width="20%">
                      <b>Send Job To Mobile Device<span class='require'>*</span></b>
                    </td>
                    <td colspan="3" width="80%">
                      <a href="#" class="myeditable" id="send_job_to_mobile" data-name="data[send_job_to_mobile]"  data-type="select"  data-source="/send_job_to_mobile" data-title="Select send job to mobile">
                      
                      </a>
                    </td>
                  </tr>
                  
                  
                  </tbody>
                  </table>
          

    <div>
    				<button type="button" id="save-btn"  class="btn btn-primary btn-icon loading-demo m-r-xs m-b-xs">
                      <i class="material-icons">
                        send
                      </i>
                      <span>
                        Add
                      </span>
                    </button>
    <button id="reset-btn" class="btn pull-right">Reset</button>
    </div>
          
          
    <script src="<?php echo asset_url();?>vendor/pace/pace.js"></script>
    <script src="<?php echo asset_url();?>vendor/tether/dist/js/tether.js"></script>
    <script src="<?php echo asset_url();?>vendor/fastclick/lib/fastclick.js"></script>
    <script src="<?php echo asset_url();?>scripts/constants.js"></script>
    <!-- endbuild -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtGPmn8ziQzPa8kbmciGjEwfIBdyvf4Zs&signed_in=true&libraries=places&callback=initGoogleAutoSuggest" async defer></script>
    <!-- page script -->
    <script src="<?php echo asset_url();?>vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js"></script>
    <script src="<?php echo asset_url();?>vendor/x-editable/dist/inputs-ext/address/address.js"></script>
    <script src="<?php echo asset_url();?>vendor/x-editable/dist/inputs-ext/contacts/contact.js"></script>
    <script src="<?php echo asset_url();?>vendor/x-editable/dist/inputs-ext/typeaheadjs/typeaheadjs.js"></script>
    <script src="<?php echo asset_url();?>vendor/x-editable/dist/inputs-ext/typeaheadjs/lib/typeahead.js"></script>
    <script src="<?php echo asset_url();?>vendor/moment/moment.js"></script>
    <script src="<?php echo asset_url();?>vendor/jquery-mockjax/dist/jquery.mockjax.js"></script>
    <script src="<?php echo asset_url();?>vendor/select2/select2.js"></script>
    <!-- end page script -->

    <!-- initialize page script-->
    <script src="<?php echo asset_url();?>scripts/table/x-editable.js"></script>
    <!-- end initialize page script -->
    <script type="text/javascript">
   
    $(document).ready(function() {
		$("#start_date").datepicker({format:"dd-mm-yyyy"});
	 	});
 	
    	    $.mockjax({
    	        url: '/priority',
    	        responseText: {
    	            0: 'Low',
    	            1: 'Medium',
    	            2: 'Heigh'
    	        }
    	    }); 

    	   
    	    
    	    $.mockjax({
    	        url: '/send_job_to_mobile',
    	        responseText: {
    	        	 "": 'Select when to send',
    	            0: 'Now',
    	            1: '1 Day before the schedule day start',
    	            2: 'On'
    	        }
    	    }); 


    	    $.mockjax({
    	        url: '/job_type_id',
    	        responseText: {
    	            "": 'Select job type',
    	            0: 'One Time Job',
    	            1: 'Regular Job'
    	        }
    	    }); 
    	    
    	    $.mockjax({
    	        url: '/newuser',
    	        responseTime: 300,
    	        responseText: '{ "id": 1 }'
    	    });             
    	    
    	   //init editables 
    	   $('.myeditable').editable({
    	      url: '/post',
    	      placement: 'right'
    	   });

    	   $.mockjax({
   		    url: '/assign_to',
   		    response: function (settings) {
   		      this.responseText = 
   		    	 
   		    	 <?php echo $response;?>;
   		    }
   		  });

    	   //make username required
    	   $('#job_name').editable('option', 'validate', function(v) {
    	       if(!v) return 'Required field!';
    	   });
    	   
    	   //automatically show next editable
    	   $('.myeditable').on('save.newuser', function(){
    	       var that = this;
    	       setTimeout(function() {
    	           $(that).closest('tr').next().find('.myeditable').editable('show');
    	       }, 200);
    	   });
    	   
    	   //create new user
    	   $('#save-btn').click(function() {
        	 //  alert("di");
    	       $('.myeditable').editable('submit', { 
    	           url: '<?php echo base_url();?>add_job', 
    	           ajaxOptions: {
    	               dataType: 'json' //assuming json response
    	           },           
    	           success: function(data, config) {
    	               if(data.status) {  //record created, response like {"id": 2}
    	                   //set pk
    	                   $(this).editable('option', 'pk', data.status);
    	                   //remove unsaved class
    	                   $(this).removeClass('editable-unsaved');
    	                   //show messages
    	                   var msg = 'New job created! Now editables submit individually.';
    	                   $('#msg').addClass('alert-success').removeClass('alert-error').html(msg).show();
    	                   $('#save-btn').hide(); 
    	                   alert('New job created successfully!');
    	                   $(this).off('save.newuser'); 
    	               	window.location.href = "<?php echo base_url(); ?>job_list";                  
    	               } else if(data && data.errors){ 
    	                   //server-side validation error, response like {"errors": {"username": "username already exist"} }
    	                   config.error.call(this, data.errors);
    	               }               
    	           },
    	           error: function(errors) {
    	               var msg = '';
    	               if(errors && errors.responseText) { //ajax error, errors = xhr object
    	                   msg = errors.responseText;
    	               } else { //validation error (client-side or server-side)
    	                   $.each(errors, function(k, v) { msg += k+": "+v+"<br>"; });
    	               } 
    	               $('#msg').removeClass('alert-success').addClass('alert-error').html(msg).show();
    	           }
    	       });
    	   }); 
    	   
    	   //reset
    	   $('#reset-btn').click(function() {
    	       $('.myeditable').editable('setValue', null)
    	                       .editable('option', 'pk', null)
    	                       .removeClass('editable-unsaved');
    	                       
    	       $('#save-btn').show();
    	       $('#msg').hide();                
    	   });
    	 

    </script>

    <!-- build:js({.tmp,app}) script/app.min.js -->
    

  
 
