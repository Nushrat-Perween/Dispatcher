<link rel="stylesheet" href="<?php echo asset_url();?>vendor/c3/c3.min.css">	
		 <div class="content-view">
            <div class="row">
            <?php if($_SESSION['admin']['user_role']!=5){?>
              <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span> <?php echo $totalclient[0]['total_client'];?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                 Total Client
                  </div>
                </div>
              </div>
               <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span><?php echo $newlclient[0]['new_client'];?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                 New Client
                  </div>
                </div>
              </div>
              <?php }?>
               <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span> <?php if(isset($getcustomeralljobdetail[0]['total_job'])) {echo $getcustomeralljobdetail[0]['total_job'];} else { echo "0"; }?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                 Total Job
                  </div>
                </div>
              </div>
               <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span> <?php if(isset($getcustomeralljobdetail[0]['completed_job'])) {echo $getcustomeralljobdetail[0]['completed_job'];} else { echo "0"; }?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                 Completed Job
                  </div>
                </div>
              </div>
               <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span> <?php if(isset($getcustomeralljobdetail[0]['cancel_job'])) {echo $getcustomeralljobdetail[0]['cancel_job'];} else { echo "0"; }?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                 Cancel Job
                  </div>
                </div>
              </div>
               <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span> <?php if(isset($getcustomeralljobdetail[0]['pendin_job'])) {echo $getcustomeralljobdetail[0]['pendin_job'];} else { echo "0"; }?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                 Pending Job
                  </div>
                </div>
              </div>
               <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span> <?php if(isset($getcustomeralljobdetail[0]['not_started_job'])) {echo $getcustomeralljobdetail[0]['not_started_job'];} else { echo "0"; }?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                Not Started Job
                  </div>
                </div>
              </div>
               <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span> <?php if(isset($getcustomeralljobdetail[0]['accepted_job'])) {echo $getcustomeralljobdetail[0]['accepted_job'];} else { echo "0"; }?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                Accepted Job
                  </div>
                </div>
              </div>
               <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span> <?php if(isset($getcustomeralljobdetail[0]['in_route_job'])) {echo $getcustomeralljobdetail[0]['in_route_job'];} else { echo "0"; }?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                In-Route Job
                  </div>
                </div>
              </div>
               <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span> <?php if(isset($getcustomeralljobdetail[0]['arrived_job'])) {echo $getcustomeralljobdetail[0]['arrived_job'];} else { echo "0"; }?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                Arrived Job
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span><?php if(isset($getcustomeralljobdetail[0]['departed_job'])) {echo $getcustomeralljobdetail[0]['departed_job'];} else { echo "0"; }?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                Departed Job
                  </div>
                </div>
              </div>
              
              <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span> <?php if(isset($getcustomeralljobdetail[0]['droppedof_job'])) {echo $getcustomeralljobdetail[0]['droppedof_job'];} else { echo "0"; }?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
               Dropped Off Job
                  </div>
                </div>
              </div>
              
              <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span><?php if(isset($getcustomeralljobdetail[0]['submitted_job'])) {echo $getcustomeralljobdetail[0]['submitted_job'];} else { echo "0"; }?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                Submitted Job
                  </div>
                </div>
              </div>
                  <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span><?php if(isset($getcustomeralljobdetail[0]['stat'])) {echo $getcustomeralljobdetail[0]['stat'];} else { echo "0"; }?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                Stat Job
                  </div>
                </div>
              </div>
                  <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span><?php if(isset($getcustomeralljobdetail[0]['am'])) {echo $getcustomeralljobdetail[0]['am'];} else { echo "0"; }?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                Am Job
                  </div>
                </div>
              </div>
               <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span><?php if(isset($getcustomeralljobdetail[0]['timed'])) {echo $getcustomeralljobdetail[0]['timed'];} else { echo "0"; }?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                Timed Job
                  </div>
                </div>
              </div>
     
           
            </div>
        </div>