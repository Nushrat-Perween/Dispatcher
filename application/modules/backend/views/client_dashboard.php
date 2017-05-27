<div class="container">
  <div class="content">
    <div class="content-container">
      <br>

      <div class="row">

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label"> 	Total Job</p>
            <h3 class="row-stat-value"><?php echo $totaljob[0]['total_job'];?></h3>
            <span class="label label-success row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label"> New  Job</p>
            <h3 class="row-stat-value"><?php echo $newjob[0]['new_job'];?></h3>
            <span class="label label-success row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
 	
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Pending Job</p>
            <h3 class="row-stat-value"> <?php echo $pendingjob[0]['pending_job'];?></h3>
            <span class="label label-success row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Completed job</p>
            <h3 class="row-stat-value"><?php echo $completedjob[0]['completed_job'];?></h3>
            <span class="label label-danger row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label"> Cancel Job</p>
            <h3 class="row-stat-value"><?php echo $cancejob[0]['cancel_job'];?></h3>
            <span class="label label-danger row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

  
        
      </div> <!-- /.row -->

    </div> <!-- /.content-container -->
      
  </div> <!-- /.content -->

</div> <!-- /.container -->