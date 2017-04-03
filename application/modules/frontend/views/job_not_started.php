<!-- page stylesheets -->
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/datatables/media/css/dataTables.bootstrap4.css">
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
td{font-size:0.9em;padding:5px 5px 5px 5px !important;text-align:center}
th{text-align:center}
hr{margin-bottom:0rem}
</style>
<div class="content-view">
<div class="card">
<div class="card-header no-bg b-a-0">
Jobs
<button class="btn bg-warning btn-sm pull-right no-radius" data-toggle="modal" data-target=".bd-example-modal-sm">
<i class="fa fa-filter" aria-hidden="true"> </i> Filter
</button>
<div class="dropdown pull-right bg-purple" style="padding:3px 5px 4px 5px">
<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
<span>
Period
</span>
</a>
<div class="dropdown-menu" role="menu">
<a class="dropdown-item" href="#">
Today
</a>
<a class="dropdown-item" href="#">
This week
</a>
<a class="dropdown-item" href="#">
This month
</a>
<a class="dropdown-item" href="#">
This year
</a>
</div>
</div>
</div>
<div class="card-block">
<table class="table table-bordered datatable" >
<thead>
<tr>
<th width="10px;" style="padding-right:0px"> </th>
<th width="10px" style="padding-right:0px"> </th>
<th width="5%"> ID </th>
<th width="5%"> Job Name </th>
<th width="10%"><i class="fa fa-calendar text-success" aria-hidden="true"> </i> Created Date </th>
<th width="10%"><i class="fa fa-calendar text-success" aria-hidden="true"> </i> Start Date </th>
<th width="10%"><i class="fa fa-calendar text-success" aria-hidden="true"> </i> End Date </th>
<th width="10%"><i class="fa fa-bank text-success" aria-hidden="true"> </i> Branch </th>
<th width="15%"><i class="fa fa-motorcycle text-success" aria-hidden="true"> </i> Assign </th>
<th width="30%;text-align:left"><i class="fa fa-cogs text-success" aria-hidden="true"> </i>   Status </th>
</tr>
</thead>
<tbody >

<?php
	
$sr=0;
foreach($job as $row) {
	$sr++;


	?>
<tr>
<td style="padding-left:5px !important"><a><i class="fa fa-map text-warning" aria-hidden="true"> </i></a></td>
<td style="padding-left:5px !important"><a href="<?php echo base_url();?>edit_job/<?php echo $row['id'];?>"><i class="fa fa-external-link-square text-red" aria-hidden="true"></i></a></td>
<td><a href="job_detail.php"><span class="tag bg-red"> <?php echo getJobID($row['id']);?>  </span> </a></td>
<td> <?php echo $row['job_name'];?>   </a></td>
<td> <?php echo date("d-m-Y",strtotime($row['created_date']));?>   </td>
<td> <?php echo date("d-m-Y",strtotime($row['start_date']));?>   </td>
<td> <?php echo date("d-m-Y",strtotime($row['end_date']));?>  </td>
<td> <?php echo $row['branch_name'];?>  </td>
<td> <?php echo $row['assign_to'];?> </td>
<td> <?php echo $row['status'];?>  </td>


<?php }?>
</tbody>

</table>
</div>
</div>
</div>
    <script type="text/javascript">
      window.paceOptions = {
        document: true,
        eventLag: true,
        restartOnPushState: true,
        restartOnRequestAfter: true,
        ajax: {
          trackMethods: [ 'POST','GET']
        }
      };
    </script>

    <!-- build:js({.tmp,app}) scripts/app.min.js -->
    <script src="<?php echo asset_url();?>vendor/jquery/dist/jquery.js"></script>
    <script src="<?php echo asset_url();?>vendor/pace/pace.js"></script>
    <script src="<?php echo asset_url();?>vendor/tether/dist/js/tether.js"></script>
    <script src="<?php echo asset_url();?>vendor/bootstrap/dist/js/bootstrap.js"></script>
    <script src="<?php echo asset_url();?>vendor/fastclick/lib/fastclick.js"></script>
    <script src="<?php echo asset_url();?>scripts/constants.js"></script>
    <script src="<?php echo asset_url();?>scripts/main.js"></script>
    <!-- endbuild -->

    <!-- page scripts -->
    <script src="<?php echo asset_url();?>vendor/datatables/media/js/jquery.dataTables.js"></script>
    <script src="<?php echo asset_url();?>vendor/datatables/media/js/dataTables.bootstrap4.js"></script>
    <!-- end page scripts -->

    <!-- initialize page scripts -->
    <script type="text/javascript">
      $('.datatable').DataTable();
    </script>
    <!-- end initialize page scripts -->