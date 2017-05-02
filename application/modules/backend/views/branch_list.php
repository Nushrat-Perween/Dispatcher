<!-- page stylesheets -->
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/datatables/media/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/dist/css/bootstrap.css"/>

<!-- page stylesheets -->
<style>
td{font-size:0.9em;padding:5px 5px 5px 5px !important;text-align:center}
th{text-align:center}
hr{margin-bottom:0rem}
.icon-arrow-left {
	color:black;
}
</style>
<div class="content-view">
<div class="card">
<div class="card-header no-bg b-a-0">
<div class="dropdown pull-left " style="padding:3px 5px 4px 5px">
<H2>List Of Branch</H2>
</div>
<a href="<?php echo base_url();?>admin/add_branch"><button class="btn bg-primary btn-sm pull-right no-radius">
<i class="fa fa-plus" aria-hidden="true"> </i> Branch
</button></a>
<br>
<br>
<div class="card-block">
<table class="table table-bordered datatable" >
<thead>
<tr>

<th> ID </th>
<th> Hospital Name </th>
<th> Branch Name </th>
<th>  Address </th>
<th>  Street </th>
<th>  City </th>
<th>  State </th>
<th>  Zipcode </th>
<th>  Action </th>
</tr>
</thead>
<tbody >
<?php

$sr=0;
foreach($branch_list as $row) {
	$sr++;


	?>
<tr>
<td> <?php echo $row['id'];?> </td>
<td> <?php if($row['hospital_name'] != "") echo ucwords($row['hospital_name']); else echo "NA";?> </td>
<td> <?php if($row['branch_name'] != "") echo ucwords($row['branch_name']); else echo "NA";?> </td>
<td> <?php if($row['address'] != "") echo $row['address']; else echo "NA";?> </td>
<td> <?php if($row['street'] != "") echo $row['street']; else echo "NA";?> </td>
<td> <?php if($row['city'] != "") echo $row['city']; else echo "NA";?> </td>
<td> <?php if($row['state'] != "") echo $row['state']; else echo "NA";?> </td>
<td> <?php if($row['zipcode'] != "") echo $row['zipcode']; else echo "NA";?> </td>
<td style="padding-left:5px !important">
<a href="<?php echo base_url();?>admin/edit_branch/<?php echo $row['id'];?>" class="bg-green" style="margin:2px">&nbsp;&nbsp;<i class="fa fa-pencil text-white"></i>&nbsp;Edit&nbsp;&nbsp;</a>
</td>

<?php }?>
</tbody>

</table>
</div>
</div>
</div>
</div>
<script type="text/javascript">

</script>

   <!-- page scripts -->
    <script src="<?php echo asset_url();?>vendor/datatables/media/js/jquery.dataTables.js"></script>
    <script src="<?php echo asset_url();?>vendor/datatables/media/js/dataTables.bootstrap4.js"></script>
    <script src="<?php echo asset_url();?>vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js"></script>
   

<!-- initialize page scripts -->
<!-- initialize page scripts -->
<script type="text/javascript">
$('.datatable').DataTable();
</script>
<!-- end initialize page scripts -->