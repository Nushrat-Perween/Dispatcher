		 <?php 
		 $total_count_action=0;
		 foreach ($job_actions as $row) { 
		 	$total_count_action += $row['number_count'];
		 }
		
		 ?>
		 <div class="content-view">
            <div class="row">
               <?php foreach ($job_actions as $row) {?>
              <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><?php if($total_count_action != 0) echo round($row['number_count'] /$total_count_action*100); else echo 0;?> %</span>
                    </span>
                    <span><?php echo $row['number_count'];?></span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                   <?php echo $row['action'];?>
                  </div>
                </div>
              </div>
              <?php }?>
              
              
			
            </div>
             <?php foreach ($job_status as $row) {
             $total_count_status = $row['completed'] + $row['in_route'] + $row['pending'] +  $row['cancel'] + $row['not_assigned'];
             	?>
             
            <div class="row">
              <div class="col-md-3">
                <div class="card card-block p-b-0">
                  <div class="text-xs-center m-b-2">
                    <p class="m-a-0">
                      <span class="task-percent">
                      </span>
                      <?php echo $row['branch_name'];?><br>
                     <?php if($total_count_status != 0) echo round($row['completed']/$total_count_status*100); else echo 0;?> % task completed
                    </p>
                  </div>
                  <ul class="list-unstyled m-x-n m-b-0">
                    <li class="b-t p-a-1">
                      <span class="pull-right">
                         <?php echo $row['completed'];?>
                      </span>
                      Completed
                    </li>
                    <li class="b-t p-a-1">
                      <span class="pull-right">
                        <?php echo $row['in_route'];?>
                      </span>
                     In-route
                    </li>
                    <li class="b-t p-a-1">
                      <span class="pull-right">
                        <?php echo $row['pending'];?>
                      </span>
                      Pending
                    </li>
                    <li class="b-t p-a-1">
                      <span class="pull-right">
                        <?php echo $row['cancel'];?>
                      </span>
                     Cancel
                    </li>
					  <li class="b-t p-a-1">
                      <span class="pull-right">
                         <?php echo $row['not_assigned'];?>
                      </span>
                     Not-assigned
                    </li>
                  </ul>
                </div>
              </div>
              <?php }?>
			
            </div>
            
          </div>