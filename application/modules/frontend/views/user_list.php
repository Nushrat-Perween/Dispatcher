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
<H2>List Of Users</H2>
</div>
<button class="btn bg-warning btn-sm pull-right no-radius" onclick="display_filter();" data-toggle="modal" data-target=".bd-example-modal-sm">
<i class="fa fa-filter" aria-hidden="true"> </i> Filter
</button>
<div class="dropdown pull-right bg-purple" style="padding:3px 5px 4px 5px">
<select class="bg-purple" style="border:0" id="period" onchange="period_filter ();">
	<option value="">Period</option>
	<option value="1">Today</option>
	<option value="2">This week</option>
	<option value="3">This month</option>
	<option value="4">This year</option>
</select>
</div>
<br>
<br>
<div class="card-block">
<table class="table table-bordered datatable" >
<thead>
<tr>
<th width="10px;" style="padding-right:0px"> </th>
<th width="10px" style="padding-right:0px"> </th>
<th width="5%"> ID </th>
<th width="5%"> Name </th>
<!-- <th width="5%"> Email </th> -->
<th width="5%"> Mobile No. </th>
<th width="10%"><i class="fa fa-bank text-success" aria-hidden="true"> </i> Group </th>
<th width="10%"><i class="fa fa-bank text-success" aria-hidden="true"> </i> Branch </th>
<th width="10%"><i class="fa fa-motorcycle text-success" aria-hidden="true"> </i> Status</th>
<th width="10%"><i class="fa fa-motorcycle text-success" aria-hidden="true"> </i> Assign Job</th>

<th width="20%"> <i class="fa fa-map-marker text-success" aria-hidden="true"> </i>  Location </th>
<th width="30%;text-align:left"><i class="fa fa-calculator text-success" aria-hidden="true"> </i>   Schedule & Action </th>
</tr>
</thead>
<tbody >
<?php
																							
	$sr=0;
	foreach($user_list as $row) {
	$sr++;
	
		
?>	
<tr>
<td style="padding-left:5px !important"><a><i class="fa fa-map text-warning" aria-hidden="true"> </i></a></td>
<td style="padding-left:5px !important"><a href="<?php echo base_url();?>fieldworker/edit_user/<?php echo $row['id'];?>"><i class="fa fa-external-link-square text-red" aria-hidden="true"></i></a></td>
<td><a href="<?php echo base_url();?>fieldworker/edit_user/<?php echo $row['id'];?>"><span class="tag bg-red"> <?php echo getUserID($row['id']);?>  </span> </a></td>
<td> <?php if($row['first_name']!="" || $row['last_name']!="") echo $row['first_name']." ".$row['last_name']; else echo "NA";?> </td>
<!-- <td> <?php //if($row['email'] != "") echo $row['email']; else echo "NA";?> </td> -->
<td> <?php if($row['mobile'] != "") echo $row['mobile']; else echo "NA";?> </td>
<td> <?php if($row['group_name'] != "") echo $row['group_name']; else echo "NA";?> </td>

<td> <?php if($row['branch_name'] != "") echo $row['branch_name']; else echo "NA";?></td>
<td> <?php if($row['verified'] == 1)echo "Verified";else echo "Not Verified";?></td>
<td> 23456</td>
<td> Location name</td>

<td style="font-size:0.8em;text-align:left">

</td>

<?php }?>
</tbody>

</table>
</div>
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

   <!-- page scripts -->
    <script src="<?php echo asset_url();?>vendor/datatables/media/js/jquery.dataTables.js"></script>
    <script src="<?php echo asset_url();?>vendor/datatables/media/js/dataTables.bootstrap4.js"></script>
    <script src="<?php echo asset_url();?>vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js"></script>
   

<!-- initialize page scripts -->
<script type="text/javascript">
$('.datatable').DataTable();
</script>
<!-- end initialize page scripts -->