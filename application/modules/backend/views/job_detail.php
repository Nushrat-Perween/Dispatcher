<link rel="stylesheet" href="<?php echo asset_url();?>styles/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo asset_url();?>styles/app.css" id="load_styles_before"/>
    <link rel="stylesheet" href="<?php echo asset_url();?>styles/font-awesome/css/font-awesome.css"/>
    <!-- endbuild -->
	<style>
	 .border{border-bottom: 0.0625rem solid rgba(0, 0, 0, 0.07);margin-bottom:5px}
	 .card {
	 margin-bottom: 0.5rem;
    border: 0;
    box-shadow: none;
    border-radius: none
}
.timeline-body{text-align:center;color:#000}
	</style>
<div class="content-view">
<div class="row">
<div class="col-lg-6 " >
<div class="col-lg-12">
<div class="card">
<div class="card-header">
Job Summary
</div>
<div class="card-block">
<p class="card-text ">
<span class="col-md-3"> <b>Name : </b></span>
<span class="col-md-9 "> <?php echo $job_details[0]['job_name'];?></span>
</p>
<p class="card-text">
<span class="col-md-3"><b>Job ID :</b> </span>
<span class="col-md-9 "> <?php echo getJobID($job_details[0]['job_id']);?> </span>
</p>
<p class="card-text">
<span class="col-md-3 "> <b>Type :</b>  </span>
<span class="col-md-9 " style=""><?php echo $job_details[0]['test'];?></span>
</p>
<p class="card-text">
<span class="col-md-3 "> <b>Pattern :</b>  </span>
<span class="col-md-9 " style=""> <?php echo $job_details[0]['caller'];?></span>
</p>
<p class="card-text">
<span class="col-md-3 "> <b> Priority :</b>  </span>
<span class="col-md-9 " style=""><?php if($job_details[0]['priority'] ==0) echo "AM"; else if($job_details[0]['priority'] == 1) echo "Timed"; else if($job_details[0]['priority'] == 2) echo "Stat"; else if($job_details[0]['priority'] == 3) echo "Today"; else echo "Not Define";?></span>
</p>
<p class="card-text">
<span class="col-md-3 "> <b> Created On :</b>  </span>
<span class="col-md-9 " style=""><?php echo date("d-m-Y g:i A",strtotime($job_details[0]['created_date']));?></span>
</p>
<p class="card-text">
<span class="col-md-3 "> <b> Status :</b>  </span>
<span class="col-md-6 "> <?php echo $job_details[0]['status'];?> </span>
</p>
</div>
</div>
</div>
</div>
<div class="col-lg-6 " >
<div class="col-lg-12">
<div class="card">
<div class="card-header">
Pickup Address
</div>
<div class="card-block">
<p class="card-text ">
<span class="col-md-6"> <b>Contact Name : </b></span>
<span class="col-md-6 border"> <?php echo $job_details[0]['contact_name'];?></span>
</p>
<p class="card-text">
<span class="col-md-6"><b>Contact Number :</b> </span>
<span class="col-md-6 border"> <?php echo $job_details[0]['mobile'];?> </span>
</p>
<p class="card-text">
<span class="col-md-6 "> <b>Pickup Street :</b>  </span>
<span class="col-md-6 border" style=""><?php echo $job_details[0]['pickup_street'];?></span>
</p>
<p class="card-text">
<span class="col-md-6 "> <b>Lookup Name :</b>  </span>
<span class="col-md-6 border" style=""> <?php echo $job_details[0]['pickup_lookup_name'];?></span>
</p>
<p class="card-text">
<span class="col-md-6 "> <b> Type :</b>  </span>
<span class="col-md-6 border" style=""><?php echo $job_details[0]['pickup_lookup_name'];?></span>
</p>
</div>
</div>
</div>
</div>
<div class="col-lg-6">
 
<div class="col-lg-12">
<div class="card no-border">
<div class="card-header no-border">
Delivery Address
</div>
<div class="card-block">
<p class="card-text ">
<span class="col-md-6"> <b>Contact Name : </b></span>
<span class="col-md-6 border"> <?php echo $job_details[0]['del_name'];?></span>
</p>
<p class="card-text">
<span class="col-md-6"><b>Contact Number :</b> </span>
<span class="col-md-6 border"> <?php echo $job_details[0]['del_mobile'];?> </span>
</p>
<p class="card-text">
<span class="col-md-6"><b>Delivery Date :</b> </span>
<span class="col-md-6 border"> <?php echo $job_details[0]['delivery_date'];?> </span>
</p>
<p class="card-text">
<span class="col-md-6"><b>Delivery Time : </b> </span>
<span class="col-md-6 border"> <?php echo $job_details[0]['delivery_time'];?> </span>
</p>
<p class="card-text">
<span class="col-md-6"><b> Priority :</b>  </span>
<span class="col-md-6 border"><?php if($job_details[0]['priority'] ==0) echo "AM"; else if($job_details[0]['priority'] == 1) echo "Timed"; else if($job_details[0]['priority'] == 2) echo "Stat"; else if($job_details[0]['priority'] == 3) echo "Today"; else echo "Not Define";?></span>
</p>
<p class="card-text">
<span class="col-md-6"> <b> Created On :</b> </span>
<span class="col-md-6 border"> <?php echo (isset($job_details[0]['created_date']) && !empty($job_details[0]['created_date']))?date("d-m-Y", strtotime($job_details[0]['created_date'])):'NA';?></span>
</p>
<p class="card-text">
<span class="col-md-6"><b> Status :</b>  </span>
<span class="col-md-6 border"> <?php echo $job_details[0]['status'];?> </span>
</p>
</div>
</div>
</div>
</div>

<div class="col-lg-6">
<div class="col-lg-12">
<div class="card no-border">
<div class="card-header no-border">
Scheduled Time
</div>
<div class="card-block">
<p class="card-text ">
<span class="col-md-6"> <b>Scheduled Start : </b></span>
<span class="col-md-6 border"> <?php if($job_details[0]['start_date'] != "" || $job_details[0]['start_time'] != "") { echo date("d-m-Y",strtotime($job_details[0]['start_date'])); if($job_details[0]['start_time'] != "") echo " ".date("g:i A",strtotime($job_details[0]['start_time'])); } else echo  "NA";?></span>
</p>
<p class="card-text">
<span class="col-md-6"><b>Scheduled End :</b> </span>
<span class="col-md-6 border"> <?php if($job_details[0]['start_date'] != "" || $job_details[0]['start_time'] != "") { echo date("d-m-Y",strtotime($job_details[0]['start_date'])); if($job_details[0]['schedule_end_time'] != "") echo " ".date("g:i A",strtotime($job_details[0]['schedule_end_time'])); } else echo  "NA";?> </span>
</p>
<p class="card-text">
<span class="col-md-6"><b>Estimated Duration : </b> </span>
<span class="col-md-6 border"> <?php echo $job_details[0]['estimated_duration'];?> </span>
</p>
</div>
</div>
</div>
</div>

<div class="col-lg-6">
<div class="col-lg-12">
<div class="card no-border">
<div class="card-header no-border">
Actual Time
</div>
<div class="card-block">
<p class="card-text ">
<span class="col-md-6"> <b>Actual Start :</b></span>
<span class="col-md-6 border"> <?php if(isset($job_action[0])) echo date("g:i A",strtotime($job_action[0]['last_location_time'])); else echo "NA";?></span>
</p>
<p class="card-text">
<span class="col-md-6"><b>Actual End :</b> </span>
<span class="col-md-6 border"> <?php if(isset($job_action[7])) echo date("g:i A",strtotime($job_action[7]['last_location_time'])); else echo "NA";?>
 </span>
</p>
<p class="card-text">
<span class="col-md-6"><b>Time On Job :</b> </span>
<span class="col-md-6 border"> <?php if(isset($job_action[0]) && isset($job_action[7]))  echo $job_action[7]['last_location_time'] - $job_action[0]['last_location_time']; else echo  "NA";?> </span>
</p>
<p class="card-text">
<span class="col-md-6"><b>Suspended Time : </b> </span>
<span class="col-md-6 border"> <?php if($job_details[0]['delivery_time'] != "") echo $job_details[0]['delivery_time']; else echo  "NA";?> </span>
</p>
<p class="card-text">
<span class="col-md-6"><b>Total Job On Time :</b> </span>
<span class="col-md-6 border"> <?php if($job_details[0]['time_on_job'] != "") echo $job_details[0]['time_on_job']; else echo  "NA";?> </span>
</p>

</div>
</div>
</div>
</div>

<div class="col-lg-12 " >
<div class="col-lg-12">
<div class="card">
<div class="card-header">
Additional Information
</div>
<div class="card-block">
<p class="card-text ">
<span class="col-md-3"> <b>Patient Name : </b></span>
<span class="col-md-9 "> <?php echo $job_details[0]['patient_name'];?></span>
</p>
<p class="card-text">
<span class="col-md-3"><b>Room Number :</b> </span>
<span class="col-md-9 "> <?php echo $job_details[0]['room_no'];?> </span>
</p>
<p class="card-text">
<span class="col-md-3 "> <b>Tests :</b>  </span>
<span class="col-md-9 " style=""><?php echo $job_details[0]['test'];?></span>
</p>
<p class="card-text">
<span class="col-md-3 "> <b>Caller :</b>  </span>
<span class="col-md-9 " style=""> <?php echo $job_details[0]['caller'];?></span>
</p>
<p class="card-text">
<span class="col-md-3 "> <b> Special Instruction :</b>  </span>
<span class="col-md-9 " style=""><?php echo $job_details[0]['special_instruction'];?></span>
</div>
</div>
</div>
</div>
<div class="col-lg-12 " >
<div class="col-lg-12">
<div class="card">
<div class="card-header">
Job Actions
</div>
<div class="card-block">
<?php foreach($job_action as $row) {?>
<div class="col-md-12">
<p class="card-text ">
<span class="col-md-6"> <b><?php echo $row['action_name'];?> </b></span>
<span class="col-md-6 "> Duration : 0m</span>
<span class="col-md-10 "> <?php echo date("d-m-Y",strtotime($row['last_location_date']))." ".date("g:i A",strtotime($row['last_location_time']))."<br>".$row['last_known_location'];?></span>
</p>
</div>
<div class="col-md-12">
<hr>
</div>
<?php }?>
</div>
</div>
</div>
</div>
</div>
<?php if(isset($delivery_status1) && !empty($delivery_status1)) { 
	foreach($delivery_status1 as $delivery_status)
	{
 		if($delivery_status['action_id'] == 2) { ?>
<div class="text-xs-center m-b-2">
<div class="btn-group btn-group-sm timeline-toggle" data-toggle="buttons">
<label class="btn btn-default active">
<input type="radio" name="timelineType" id="centered" value="centered" autocomplete="off" checked> Centered
</label>
<label class="btn btn-default">
<input type="radio" name="timelineType" id="stacked" value="stacked" autocomplete="off"> Stacked
</label>
</div>
</div>
<div class="timeline">
<!-- timeline item-->

<div class="timeline-card">
<div class="timeline-icon bg-danger text-white">
<i class="fa fa-map">
 
</i>
</div>

<section class="timeline-content">
<div class="timeline-body">
<div class="timeline-heading bg-default text-success">
Accepted
</div>
<p>
<?php if($delivery_status['last_location_date'] == NULL) echo 'NA';else echo date("d-m-Y",strtotime($delivery_status['last_location_date']));?>  <?php if($delivery_status['last_location_time'] == NULL) echo 'NA';else echo date("g:i A",strtotime($delivery_status['last_location_time']));?> 
</p>
<p>
<?php echo $delivery_status['last_known_location']; ?>
</p>
</div>
<div class="timeline-date">
<?php if($delivery_status['last_location_time'] == NULL) echo 'NA';else echo date("g:i A",strtotime($delivery_status['last_location_time']));?>
</div>
</section>
</div>
<?php } ?>
<!-- timeline item-->
<?php if($delivery_status['action_id'] == 3) { ?>
<div class="timeline-card">
<div class="timeline-icon bg-info text-white">
<i class="material-icons">
person
</i>
</div>
<section class="timeline-content">
<div class="timeline-body">
<div class="timeline-heading bg-default text-success">
In route
</div>
<p>
<?php if($delivery_status['last_location_date'] == NULL) echo 'NA';else echo date("d-m-Y",strtotime($delivery_status['last_location_date']));?>  <?php if($delivery_status['last_location_time'] == NULL) echo 'NA';else echo date("g:i A",strtotime($delivery_status['last_location_time']));?>
</p>
<p>
<?php echo $delivery_status['last_known_location']; ?>
</p>
</div>
<div class="timeline-date">
<?php if($delivery_status['last_location_time'] == NULL) echo 'NA';else echo date("g:i A",strtotime($delivery_status['last_location_time']));?>
</div>
</section>
</div>
<?php } ?>
<!-- timeline item-->
<?php if($delivery_status['action_id'] == 4) { ?>
<div class="timeline-card">
<div class="timeline-icon bg-primary text-white">
<i class="material-icons">
explore
</i>
</div>
<section class="timeline-content">
<div class="timeline-body">
<div class="timeline-heading bg-default text-success">
Arrived
</div>
<p>
<?php if($delivery_status['last_location_date'] == NULL) echo 'NA';else echo date("d-m-Y",strtotime($delivery_status['last_location_date']));?>  <?php if($delivery_status['last_location_time'] == NULL) echo 'NA';else echo date("g:i A",strtotime($delivery_status['last_location_time']));?>
</p>
<p>
<?php echo $delivery_status['last_known_location']; ?>
</p>
</div>
<div class="timeline-date">
<?php if($delivery_status['last_location_time'] == NULL) echo 'NA';else echo date("g:i A",strtotime($delivery_status['last_location_time']));?>
</div>
</section>
</div>
<?php } ?>
<!-- timeline item-->
<?php if($delivery_status['action_id'] == 5) { ?>
<div class="timeline-card">
<div class="timeline-icon bg-warning text-white">
<i class="material-icons">
games
</i>
</div>
<section class="timeline-content">
<div class="timeline-body">
<div class="timeline-heading bg-default text-success">
Departed
</div>
<p>
<?php if($delivery_status['last_location_date'] == NULL) echo 'NA';else echo date("d-m-Y",strtotime($delivery_status['last_location_date']));?>  <?php if($delivery_status['last_location_time'] == NULL) echo 'NA';else echo date("g:i A",strtotime($delivery_status['last_location_time']));?>
</p>
<p>
<?php echo $delivery_status['last_known_location']; ?>
</p>
</div>
<div class="timeline-date">
<?php if($delivery_status['last_location_time'] == NULL) echo 'NA';else echo date("g:i A",strtotime($delivery_status['last_location_time']));?>
</div>
</section>
</div>
<?php } ?>
<!-- timeline item-->
<?php if($delivery_status['action_id'] == 6) { ?>
<div class="timeline-card">
<div class="timeline-icon bg-success text-white">
<i class="material-icons">
navigation
</i>
</div>
<section class="timeline-content">
<div class="timeline-body">
<div class="timeline-heading bg-default text-success">
Diparted Off
</div>
<p>
<?php if($delivery_status['last_location_date'] == NULL) echo 'NA';else echo date("d-m-Y",strtotime($delivery_status['last_location_date']));?>  <?php if($delivery_status['last_location_time'] == NULL) echo 'NA';else echo date("g:i A",strtotime($delivery_status['last_location_time']));?>
</p>
<p>
<?php echo $delivery_status['last_known_location']; ?>
</p>
</div>
<div class="timeline-date">
<?php if($delivery_status['last_location_time'] == NULL) echo 'NA';else echo date("g:i A",strtotime($delivery_status['last_location_time']));?>
</div>
</section>
</div>
<?php } ?>
<?php if($delivery_status['action_id'] == 7) { ?>
<div class="timeline-card">
<div class="timeline-icon bg-success text-white">
<i class="material-icons">
navigation
</i>
</div>
<section class="timeline-content">
<div class="timeline-body">
<div class="timeline-heading bg-default text-success">
Diparted Off Submitted
</div>
<p>
<?php if($delivery_status['last_location_date'] == NULL) echo 'NA';else echo date("d-m-Y",strtotime($delivery_status['last_location_date']));?>  <?php if($delivery_status['last_location_time'] == NULL) echo 'NA';else echo date("g:i A",strtotime($delivery_status['last_location_time']));?>
</p>
<p>
<?php echo $delivery_status['last_known_location']; ?>
</p>
</div>
<div class="timeline-date">
<?php if($delivery_status['last_location_time'] == NULL) echo 'NA';else echo date("g:i A",strtotime($delivery_status['last_location_time']));?>
</div>
</section>
</div>
<!-- timeline item-->
<div class="timeline-card">
<div class="timeline-icon bg-default">
<i class="material-icons">
local_library
</i>
</div>
</div>
</div>
<?php } } } ?>

</div>
<!-- 	<script src="script/jquery.js"></script> -->
<!--     <script src="script/bootstrap.js"></script> -->
<!--     <script src="script/main.js"></script> -->

    <!-- page scripts -->
    <!-- end page scripts -->

    <!-- initialize page scripts -->
    <script type="text/javascript">
      $('.timeline-toggle .btn').on('click', function (e) {
        var val = $(this).find('input').val();
        if (val === 'stacked') {
          $('.timeline').addClass('stacked');
        }
        else {
          $('.timeline').removeClass('stacked');
        }
      });
    </script>
    <!-- end initialize page scripts -->