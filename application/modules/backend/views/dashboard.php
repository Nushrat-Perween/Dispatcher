<div class="container">

  <div class="content">

    <div class="content-container">

      

      <div>
       

      </div>

      <br>

      <div class="row">
<?php if($_SESSION['admin']['user_role']!=5){?>
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Total Client</p>
            <h3 class="row-stat-value"><?php echo $totalclient[0]['total_client'];?></h3>
            <span class="label label-success row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">New Client</p>
            <h3 class="row-stat-value"><?php echo $newlclient[0]['new_client'];?></h3>
            <span class="label label-success row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
<?php }?>
 	<a href="<?php echo base_url();?>admin/job_list">
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Total Job</p>
            <h3 class="row-stat-value"> <?php if(isset($getcustomeralljobdetail[0]['total_job'])) {echo $getcustomeralljobdetail[0]['total_job'];} else { echo "0"; }?></h3>
            <span class="label label-success row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
     </a>
 <a href="<?php echo base_url();?>admin/job_list?status=1">
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Completed job</p>
            <h3 class="row-stat-value"><?php if(isset($getcustomeralljobdetail[0]['completed_job'])) {echo $getcustomeralljobdetail[0]['completed_job'];} else { echo "0"; }?></h3>
            <span class="label label-danger row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
  </a>
  
  <a href="<?php echo base_url();?>admin/job_list?status=2">
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label"> Cancel Job</p>
            <h3 class="row-stat-value"><?php if(isset($getcustomeralljobdetail[0]['cancel_job'])) {echo $getcustomeralljobdetail[0]['cancel_job'];} else { echo "0"; }?></h3>
            <span class="label label-danger row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
  </a>
   <a href="<?php echo base_url();?>admin/job_list?status=0">
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Pending job</p>
            <h3 class="row-stat-value"><?php if(isset($getcustomeralljobdetail[0]['pendin_job'])) {echo $getcustomeralljobdetail[0]['pendin_job'];} else { echo "0"; }?></h3>
            <span class="label label-danger row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
  </a>
  <a href="<?php echo base_url();?>admin/job_list?action=1">
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Not started</p>
            <h3 class="row-stat-value"><?php if(isset($getcustomeralljobdetail[0]['not_started_job'])) {echo $getcustomeralljobdetail[0]['not_started_job'];} else { echo "0"; }?></h3>
            <span class="label label-danger row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
  </a>
  <a href="<?php echo base_url();?>admin/job_list?status=1">
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">  Accepted</p>
            <h3 class="row-stat-value"> <?php if(isset($getcustomeralljobdetail[0]['accepted_job'])) {echo $getcustomeralljobdetail[0]['accepted_job'];} else { echo "0"; }?></h3>
            <span class="label label-danger row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
  </a>
  
   <a href="<?php echo base_url();?>admin/job_list?action=3">
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">   In-Route </p>
            <h3 class="row-stat-value"><?php if(isset($getcustomeralljobdetail[0]['in_route_job'])) {echo $getcustomeralljobdetail[0]['in_route_job'];} else { echo "0"; }?></h3>
            <span class="label label-danger row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
  </a>
 <a href="<?php echo base_url();?>admin/job_list?action=4">
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">  Arrived</p>
            <h3 class="row-stat-value"> <?php if(isset($getcustomeralljobdetail[0]['arrived_job'])) {echo $getcustomeralljobdetail[0]['arrived_job'];} else { echo "0"; }?></h3>
            <span class="label label-danger row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
  </a>
     <a href="<?php echo base_url();?>admin/job_list?action=5">
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">  Departed</p>
            <h3 class="row-stat-value"> <?php if(isset($getcustomeralljobdetail[0]['departed_job'])) {echo $getcustomeralljobdetail[0]['departed_job'];} else { echo "0"; }?></h3>
            <span class="label label-danger row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
  </a>
  <a href="<?php echo base_url();?>admin/job_list?action=6">
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">   Dropped Off </p>
            <h3 class="row-stat-value">  <?php if(isset($getcustomeralljobdetail[0]['droppedof_job'])) {echo $getcustomeralljobdetail[0]['droppedof_job'];} else { echo "0"; }?></h3>
            <span class="label label-danger row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
  </a>
  <a href="<?php echo base_url();?>admin/job_list?action=7">
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">   Submitted </p>
            <h3 class="row-stat-value"> <?php if(isset($getcustomeralljobdetail[0]['submitted_job'])) {echo $getcustomeralljobdetail[0]['submitted_job'];} else { echo "0"; }?></h3>
            <span class="label label-danger row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
  </a>
   <a href="<?php echo base_url();?>admin/job_list?priority=2">
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">   Stat Job </p>
            <h3 class="row-stat-value">  <?php if(isset($getcustomeralljobdetail[0]['stat'])) {echo $getcustomeralljobdetail[0]['stat'];} else { echo "0"; }?></h3>
            <span class="label label-danger row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
  </a>
    <a href="<?php echo base_url();?>admin/job_list?priority=0">
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">   Am Job </p>
            <h3 class="row-stat-value">  <?php if(isset($getcustomeralljobdetail[0]['am'])) {echo $getcustomeralljobdetail[0]['am'];} else { echo "0"; }?></h3>
            <span class="label label-danger row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
  </a>
     <a href="<?php echo base_url();?>admin/job_list?priority=1">
        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">  Timed Job </p>
            <h3 class="row-stat-value">  <?php if(isset($getcustomeralljobdetail[0]['timed'])) {echo $getcustomeralljobdetail[0]['timed'];} else { echo "0"; }?></h3>
            <span class="label label-danger row-stat-badge"></span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
  </a>
        
      </div> <!-- /.row -->

    </div> <!-- /.content-container -->
      
  </div> <!-- /.content -->

</div> <!-- /.container -->