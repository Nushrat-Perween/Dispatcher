
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
.table-bordered th, .table-bordered td {
	border-color: rgba(0, 0, 0, 0);
	border-top: 0;
	border-left: 0;
}
</style>
<div class="content-view">
<div class="card card-block">
<h2>Update Job</h2	>
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
<b>Job ID <span class='require'>*</span></b>
</td>
<td width="30%">
<a href="#" id="id" class="myeditable" data-type="text" data-pk="1" data-name="data[id]" data-title="Enter Job ID">
1234567
</a>
</td>
<td width="20%">
<b>Job Name</b>
</td>
<td width="30%">
<a href="#" id="job_name" class="myeditable" data-type="text"  data-name="data[job_name]" data-title="Enter Job Name">
1234567
</a>
</td>
</tr>

<tr>
<td colspan="1" width="20%">
<b>Description</b>
</td>
<td colspan="3"  width="80%">
<a href="#" class="myeditable" data-type="textarea" data-name="data[description]" id="description" data-title="Enter description">
Blood bag should give to Patient ID 12345
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
<a href="#" class="myeditable" data-type="text" data-name="data[patient_id]" id="patient_id" data-title="Enter Patient ID">
Rajveer Singh
</a>
</td>
<td width="20%">
<b>Room Number <span class='require'>*</span></b>
</td>
<td width="30%">
<a href="#" class="myeditable" data-type="text" data-name="data[room_number]" id="room_number" data-title="Enter Patient ID">
Room 123
</a>
</td>

</tr>

<tr>
<td width="20%">
<b>Tests<span class='require'>*</span></b>
</td>
<td width="30%">
<a href="#" class="myeditable" data-type="text" data-name="data[test]" id="test" data-title="Enter Tests">
Asthema
</a>
</td>
<td width="20%">
<b>Caller<span class='require'>*</span></b>
</td>
<td width="30%">
<a href="#" class="myeditable" data-type="text" data-name="data[caller]" id="caller" data-title="Enter Callers">
ABC
</a>
</td>
</tr>
 
<tr>
<td colspan="1" width="20%">
<b>Special Instructions<span class='require'>*</span></b>
</td>
<td colspan="3" width="80%">
<a href="#" class="myeditable" data-type="textarea" data-name="data[special_instruction]" id="special_instruction" data-title="Enter Callers">
Give bag to patient hand
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
<a href="#" id="address" data-type="address" data-pk="1" data-title="Please, fill address">
test address
</a>
</td>
</tr>
<tr>
<td colspan="1" width="20%">
Contact
</td>
<td colspan="3" width="80%">
<a href="#" id="contact" data-type="contact" data-pk="1" data-title="Please, fill contacts">
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
<td width="20%">
Date
</td>
<td width="30%">
<a href="#" class="myeditable" id="date" data-type="combodate" data-template="D MMM YYYY  HH:mm" data-format="YYYY-MM-DD HH:mm" data-viewformat="MMM D, YYYY, HH:mm" data-title="Setup event date and time">
</a>
</td>
</tr>

<tr>
<td width="20%">
Duration
</td>
<td width="30%">
<a href="#" class="myeditable" id="duration" data-type="combodate" data-template="HH:mm" data-format="HH:mm" data-viewformat="HH:mm"   data-title="Setup event time">
</a>
</td>
<td width="20%">
<b>Priority<span class='require'>*</span></b>
</td>
<td width="30%">
<a href="#" class="myeditable" data-type="select" data-name="data[priority]" id="priority" data-source="/priority" data-title="Enter Priority">
</a>
</td>
</tr>

<tr>
<td width="20%">
<b>Assign To<span class='require'>*</span></b>
</td>
<td width="30%">
<a href="#" class="myeditable" id="assign_to" data-name="data[assign_to]" data-type="select"  data-source="/assign_to" data-title="Select Assign To">

</a>
</td>
<td width="20%">
<b>Time Zone<span class='require'>*</span></b>
</td>
<td width="30%">
<a href="#" class="myeditable" id="time_zone" data-name="data[time_zone]"  data-type="select"  data-source="/time_zone" data-title="Select Time Zone">

</a>
</td>
</tr>

<tr>
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
edit
</i>
<span>
Update
</span>
</button>
<button id="reset-btn" class="btn pull-right">Reset</button>
</div>


<script src="<?php echo asset_url();?>vendor/pace/pace.js"></script>
<script src="<?php echo asset_url();?>vendor/tether/dist/js/tether.js"></script>
<script src="<?php echo asset_url();?>vendor/fastclick/lib/fastclick.js"></script>
<script src="<?php echo asset_url();?>scripts/constants.js"></script>
<!-- endbuild -->

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

<!-- initialize page script -->
<script src="<?php echo asset_url();?>scripts/table/demo-mock.js"></script>
<script src="<?php echo asset_url();?>scripts/table/x-editable.js"></script>
<!-- end initialize page script -->
<script type="text/javascript">


$(function(){
		
	$.mockjax({
		url: '/post',
		responseTime: 500,
		responseText: ''
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
					0: 'Now',
					1: '1 Day before the schedule day start',
					2: 'On'

				}
			});

				//     	    $('#job_type_id').editable({
				//     	    	   type: 'select',
				//  	    	   url: '<?php echo base_url();?>get_branch/<?php echo $global_company_id;?>',
//     	    	   ajaxOptions: {
//     	    	     type: 'put'
//     	    	   }   
//     	    	 });
	    	 
    	
    	    $.mockjax({
    	        url: '/job_type_id',
    	        responseText: {
    	            0: 'One Time Job',
    	            1: 'Regular Job'
    	           
    	        }
    	    }); 
    	    
    	    $.mockjax({
    	        url: '/newuser',
    	        responseTime: 300,
    	        responseText: '{ "id": 1 }'
//    	        responseText: '{"errors": {"username": "username already exist"} }'
    	    });             
    	    
    	   //init editables 
    	   $('.myeditable').editable({
    	      url: '/post',
    	      placement: 'right'
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
        	   //alert("di");
    	       $('.myeditable').editable('submit', { 
    	           url: '<?php echo base_url();?>add_job', 
    	           ajaxOptions: {
    	               dataType: 'json' //assuming json response
    	           },           
    	           success: function(data, config) {
    	               if(data && data.id) {  //record created, response like {"id": 2}
    	                   //set pk
    	                   $(this).editable('option', 'pk', data.id);
    	                   //remove unsaved class
    	                   $(this).removeClass('editable-unsaved');
    	                   //show messages
    	                   var msg = 'New user created! Now editables submit individually.';
    	                   $('#msg').addClass('alert-success').removeClass('alert-error').html(msg).show();
    	                   $('#save-btn').hide(); 
    	                   $(this).off('save.newuser');                   
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
    	}); 

      $(function(){

    	    //remote source (advanced)
    	    $('#task-tags').editable({
    	        mode: 'inline',
    	        select2: {
    	            width: '192px',
    	            placeholder: 'Select Country',
    	            allowClear: true,
    	            //minimumInputLength: 1,
    	            id: function (item) {
    	                return item.CountryId;
    	            },
    	            // Get list of Tags from AJAX request
    	            ajax: {
    	                url: '/getTaskTags',
    	                type: 'post',
    	                dataType: 'json',
    	                data: function (term, page) {
    	                    return { query: term };
    	                },
    	                results: function (data, page) {
    	                    return { results: data };
    	                }
    	            },
    	            formatResult: function (item) {
    	                return item.TagName;
    	            },
    	            formatSelection: function (item) {
    	                return item.TagName;
    	            },
    	            initSelection: function (element, callback) {
    	                return $.get('/getTaskTagById', { 
    	                    query: element.val()
    	                }, function (data) {
    	                    callback(data);
    	                });
    	            } 
    	        } 
    	    });


    	});
    </script>

    <!-- build:js({.tmp,app}) script/app.min.js -->
    

  
 
