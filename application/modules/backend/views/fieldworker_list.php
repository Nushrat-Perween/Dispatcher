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
<H2>List Of Field Workers</H2>
</div>
<a href="<?php echo base_url();?>admin/add_fieldworker"><button class="btn bg-primary btn-sm pull-right no-radius">
<i class="fa fa-plus" aria-hidden="true"> </i> Fieldworker
</button></a>
<br>
<br>
<div class="card-block">
<table class="table table-bordered datatable" >
<thead>
<tr>
<th > Name </th>
<!-- <th width="5%"> Email </th> -->
<th > Mobile No. </th>
<th> Email </th>
<th> User Role </th>
<th >Status</th>
<th> Last Job Assigned </th>
<th>City </th>
<th > Zone </th>
</tr>
</thead>
<tbody >
<?php
    
    $sr=0;
    foreach($fieldworker_list as $row) {
        $sr++;
        
        
        ?>
<tr>
<td> <?php if($row['first_name']!="" || $row['last_name']!="") echo $row['first_name']." ".$row['last_name']; else echo "NA";?> </td>
<!-- <td> <?php //if($row['email'] != "") echo $row['email']; else echo "NA";?> </td> -->
<td> <?php if($row['mobile'] != "") echo $row['mobile']; else echo "NA";?> </td>
<td> <?php if($row['email'] != "") echo $row['email']; else echo "NA";?> </td>

<td> <?php if($row['role_name'] != "") echo $row['role_name']; else echo "NA";?></td>
<td> <?php if($row['verified'] == 1)echo "Verified";else echo "Not Verified";?></td>
<td> 23456</td>
<td> City name</td>
<td> Zone name</td>


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
