 <!-- endbuild -->
	<style>
	 .border{border-bottom: 0.0625rem solid rgba(0, 0, 0, 0.07);margin-bottom:5px}
	 .card {
	 margin-bottom: 0.5rem;
    border: 0;
    box-shadow: none;
    border-radius: none
}
.content-header-title{font-size:16px}
.timeline-body{text-align:center;color:#000}
	</style>
<div class="container">
  <div class="content">
    <div class="content-container">
      <div class="content-header">
        <h2 class="content-header-title"> Job Detail  </h2>
      </div> <!-- /.content-header -->
      <div class="row">
			<div class="col-lg-6 " >
			<div class="col-lg-12">
			
				<h6 class="content-header-title"> <b> 	Job Summary </b></h6>
				<hr/>
				
					<p class="card-text ">
					<span class="col-md-6"> <b>Name : </b></span>
					<span class="col-md-6 "> <?php echo $job_details[0]['job_name'];?></span>
					</p>
					<p class="card-text">
					<span class="col-md-6"><b>Job ID :</b> </span>
					<span class="col-md-6 "> <?php echo getJobID($job_details[0]['job_id']);?> </span>
					</p>
					<p class="card-text">
					<span class="col-md-6 "> <b>Type :</b>  </span>
					<span class="col-md-6 " style=""><?php echo $job_details[0]['test'];?></span>
					</p>
					<p class="card-text">
					<span class="col-md-6 "> <b>Pattern :</b>  </span>
					<span class="col-md-6 " style=""> <?php echo $job_details[0]['caller'];?></span>
					</p>
					<p class="card-text">
					<span class="col-md-6 "> <b> Priority :</b>  </span>
					<span class="col-md-6" style=""><?php if($job_details[0]['priority'] ==0) echo "AM"; else if($job_details[0]['priority'] == 1) echo "Timed"; else if($job_details[0]['priority'] == 2) echo "Stat"; else if($job_details[0]['priority'] == 3) echo "Today"; else echo "Not Define";?></span>
					</p>
					<p class="card-text">
					<span class="col-md-6 "> <b> Created On :</b>  </span>
					<span class="col-md-6 " style=""><?php echo date("d-m-Y g:i A",strtotime($job_details[0]['created_date']));?></span>
					</p>
					<p class="card-text">
					<span class="col-md-6 "> <b> Status :</b>  </span>
					<span class="col-md-6 "> <?php echo $job_details[0]['status'];?> </span>
					</p>
				
				
			</div>
		
			
			<div class="col-lg-12">
				<br/><br/>
					
					<h6 class="content-header-title"> <b> 	Scheduled Time</b></h6>
				<hr/>
				<p class="card-text ">
				<span class="col-md-6"> <b>Scheduled Start : </b></span>
				<span class="col-md-6 "> <?php if($job_details[0]['start_date'] != "" || $job_details[0]['start_time'] != "") { echo date("d-m-Y",strtotime($job_details[0]['start_date'])); if($job_details[0]['start_time'] != "") echo " ".date("g:i A",strtotime($job_details[0]['start_time'])); } else echo  "NA";?></span>
				</p>
				<p class="card-text">
				<span class="col-md-6"><b>Scheduled End :</b> </span>
				<span class="col-md-6 "> <?php if($job_details[0]['start_date'] != "" || $job_details[0]['start_time'] != "") { echo date("d-m-Y",strtotime($job_details[0]['start_date'])); if($job_details[0]['schedule_end_time'] != "") echo " ".date("g:i A",strtotime($job_details[0]['schedule_end_time'])); } else echo  "NA";?> </span>
				</p>
				<p class="card-text">
				<span class="col-md-6"><b>Estimated Duration : </b> </span>
				<span class="col-md-6 "> <?php echo $job_details[0]['estimated_duration'];?> </span>
				</p>
				
				
			</div>
			
			<div class="col-lg-12">
				<div class="card no-border">
				<br/><br/>
					<h6 class="content-header-title"> <b> 	Actual Time</b></h6>
					
					<hr />
					<div class="card-block">
					<p class="card-text ">
					<span class="col-md-6"> <b>Actual Start :</b></span>
					<span class="col-md-6 "> <?php if(isset($job_action[0])) echo date("g:i A",strtotime($job_action[0]['last_location_time'])); else echo "NA";?></span>
					</p>
					<p class="card-text">
					<span class="col-md-6"><b>Actual End :</b> </span>
					<span class="col-md-6 "> <?php if(isset($job_action[7])) echo date("g:i A",strtotime($job_action[7]['last_location_time'])); else echo "NA";?>
					 </span>
					</p>
					<p class="card-text">
					<span class="col-md-6"><b>Time On Job :</b> </span>
					<span class="col-md-6 "> <?php if(isset($job_action[0]) && isset($job_action[7]))  echo $job_action[7]['last_location_time'] - $job_action[0]['last_location_time']; else echo  "NA";?> </span>
					</p>
					<p class="card-text">
					<span class="col-md-6"><b>Suspended Time : </b> </span>
					<span class="col-md-6 "> <?php if($job_details[0]['delivery_time'] != "") echo $job_details[0]['delivery_time']; else echo  "NA";?> </span>
					</p>
					<p class="card-text">
					<span class="col-md-6"><b>Total Job On Time :</b> </span>
					<span class="col-md-6 "> <?php if($job_details[0]['time_on_job'] != "") echo $job_details[0]['time_on_job']; else echo  "NA";?> </span>
					</p>
					
					</div>
				</div>
			</div>
			</div>

			<div class="col-lg-6 " >
				<div class="col-lg-12">
				
					<h6 class="content-header-title"> <b> 	Pickup Address </b></h6>
					<hr/>
					<div class="card-block">
					<p class="card-text">
					<span class="col-md-6 "> <b>Pickup Street :</b>  </span>
					<span class="col-md-6 " style=""><?php echo $job_details[0]['pickup_street'];?></span>
					</p>
					<p class="card-text">
					<span class="col-md-6 "> <b>Address :</b>  </span>
					<span class="col-md-6 " style=""><?php echo $job_details[0]['pickup_building'];?></span>
					</p>
					<p class="card-text">
					<span class="col-md-6 "> <b>Zip code :</b>  </span>
					<span class="col-md-6 " style=""><?php echo $job_details[0]['pickup_postalcode'];?></span>
					</p>
					<p class="card-text">
					<span class="col-md-6 "> <b>City :</b>  </span>
					<span class="col-md-6 " style=""><?php echo $job_details[0]['pickup_city'];?></span>
					</p>
					<p class="card-text">
					<span class="col-md-6 "> <b>Lookup Name :</b>  </span>
					<span class="col-md-6 " style=""> <?php echo $job_details[0]['pickup_lookup_name'];?></span>
					</p>
					</div>
					<br/><br/>
				</div>
			</div>
			
			<div class="col-lg-6">
			 
				<div class="col-lg-12">
					<br/><br/>
					<h6 class="content-header-title"> <b> 	Delivery Address</b></h6>
					<hr/>
					<div class="card-block">
						<p class="card-text">
							<span class="col-md-6 "> <b>Pickup Street :</b>  </span>
							<span class="col-md-6 " style=""><?php echo $job_details[0]['delivery_street'];?></span>
						</p>
						<p class="card-text">
							<span class="col-md-6 "> <b>Address :</b>  </span>
							<span class="col-md-6 " style=""><?php echo $job_details[0]['delivery_address'];?></span>
						</p>
						<p class="card-text">
							<span class="col-md-6 "> <b>Zip code :</b>  </span>
							<span class="col-md-6 " style=""><?php echo $job_details[0]['delivery_zipcode'];?></span>
						</p>
						<p class="card-text">
							<span class="col-md-6 "> <b>City :</b>  </span>
							<span class="col-md-6 " style=""><?php echo $job_details[0]['delivery_city'];?></span>
						</p>
						<p class="card-text">
					<span class="col-md-6 "> <b>Lookup Name :</b>  </span>
					<span class="col-md-6 " style=""> <?php echo $job_details[0]['delivery_lookup_name'];?></span>
					</p>
					</div>
				</div>
				<div class="col-lg-12">
				<hr/>
					<h6 class="content-header-title"> <b> 	Additional Information</b></h6>
					
					<div class="card-block">
					<p class="card-text ">
					<span class="col-md-6"> <b>Patient Name : </b></span>
					<span class="col-md-6 "> <?php echo $job_details[0]['patient_name'];?></span>
					</p>
					<p class="card-text">
					<span class="col-md-6"><b>Room Number :</b> </span>
					<span class="col-md-6 "> <?php echo $job_details[0]['room_no'];?> </span>
					</p>
					<p class="card-text">
					<span class="col-md-6 "> <b>Tests :</b>  </span>
					<span class="col-md-6 " style=""><?php echo $job_details[0]['test'];?></span>
					</p>
					<p class="card-text">
					<span class="col-md-6 "> <b>Caller :</b>  </span>
					<span class="col-md-6 " style=""> <?php echo $job_details[0]['caller'];?></span>
					</p>
					<p class="card-text">
					<span class="col-md-6 "> <b> Special Instruction :</b>  </span>
					<span class="col-md-6 " style=""><?php echo $job_details[0]['special_instruction'];?></span>
					</div>
				</div>
			</div>
			<div class="col-lg-12 " >
				
			</div>

</div>
 </div>
  </div>
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