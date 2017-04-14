<link rel="stylesheet" href="<?php echo asset_url();?>vendor/c3/c3.min.css">	
		 <div class="content-view">
            <div class="row">
             <a href="<?php echo base_url();?>admin/job_list">
              <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span><?php echo $totaljob[0]['total_job'];?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                 	Total Job
                  </div>
                </div>
              </div>
              </a>
              <a href="<?php echo base_url();?>admin/job_list">
	               <div class="col-sm-6 col-md-4 col-lg-2">
	                <div class="card card-block ">
	                  <h5 class="m-b-0 v-align-middle text-overflow">
						<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
							<span ><i class="material-icons " aria-hidden="true">
	                      group
	                    </i></span>
	                    </span>
	                    <span> <?php echo $newjob[0]['new_job'];?></span>
	                  </h5>
	                  <div class="small text-overflow text-muted">
	                    &nbsp
	                  </div>
	                  <div class="small text-overflow">
	                 New  Job
	                  </div>
	                </div>
	              </div>
	          </a>
              <a href="<?php echo base_url();?>admin/job_list?status=0">
	           	<div class="col-sm-6 col-md-4 col-lg-2">
	                <div class="card card-block ">
	                  <h5 class="m-b-0 v-align-middle text-overflow">
						<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
							<span ><i class="material-icons " aria-hidden="true">
	                      group
	                    </i></span>
	                    </span>
	                    <span> <?php echo $pendingjob[0]['pending_job'];?></span>
	                  </h5>
	                  <div class="small text-overflow text-muted">
	                    &nbsp
	                  </div>
	                  <div class="small text-overflow">
	                 Pending Job
	                  </div>
	                </div>
	              </div>
	          </a>
              <a href="<?php echo base_url();?>admin/job_list?status=1">
	           	<div class="col-sm-6 col-md-4 col-lg-2">
	                <div class="card card-block ">
	                  <h5 class="m-b-0 v-align-middle text-overflow">
						<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
							<span ><i class="material-icons " aria-hidden="true">
	                      group
	                    </i></span>
	                    </span>
	                    <span><?php echo $completedjob[0]['completed_job'];?></span>
	                  </h5>
	                  <div class="small text-overflow text-muted">
	                    &nbsp
	                  </div>
	                  <div class="small text-overflow">
	                Completed Job
	                  </div>
	                </div>
	              </div>
	          </a>
              <a href="<?php echo base_url();?>admin/job_list?status=2">
	               <div class="col-sm-6 col-md-4 col-lg-2">
	                <div class="card card-block ">
	                  <h5 class="m-b-0 v-align-middle text-overflow">
						<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
							<span ><i class="material-icons " aria-hidden="true">
	                      group
	                    </i></span>
	                    </span>
	                    <span> <?php echo $cancejob[0]['cancel_job'];?></span>
	                  </h5>
	                  <div class="small text-overflow text-muted">
	                    &nbsp
	                  </div>
	                  <div class="small text-overflow">
	                Cancel Job
	                  </div>
	                </div>
	              </div>
              </a>
            </div>
         
          </div>
  