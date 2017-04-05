<!-- page stylesheets -->
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/datatables/media/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo asset_url();?>vendor/bootstrap/dist/css/bootstrap.css"/>
<style>
td{font-size:0.9em;padding:5px 5px 5px 5px !important;text-align:center}
th{text-align:center}
hr{margin-bottom:0rem}
.table-bordered {
border: 1px solid #eceeef;
  
}
.dataTables_length{
margin-left:-270px
}
.no-bg {
    background-color: transparent !important;
    margin-left: 80px;
    margin-right: 80px;
}


.thead-inverse th {
color: #fff;
    background-color: #0275d8;
}
</style>
<div class="content-view">
<div class="card">
<div class="card-header no-bg b-a-0">
<div class="dropdown pull-left " style="padding:3px 5px 4px 5px">
<H2>Attendance Tracker Of Fieldworker</H2>
</div><br><br><br>
<div class="dropdown pull-left bg-primary" style="padding:7px 5px 4px 5px">
<select class="bg-primary" style="border:0" id="fieldworker" onchange="fieldworker_filter ();">
<option value="">Select Fieldworker</option>
<?php foreach ($field_worker as $row) {?>
<option value="<?php echo $row['id'];?>" ><?php echo $row['first_name']. " ".  $row['last_name'];?></option>
<?php }?>
</select>
</select>
</div>

<div class="dropdown pull-left bg-success" style="padding:7px 5px 4px 5px">
<select class="bg-success" style="border:0" id="month" onchange="monthly_filter ();">
<option value="">Select Month</option>
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
</div>
<center>
<br><br><br>

<div class="dataTables_wrapper">
                    <table class="table table-bordered datatable" id="table_id1">
                      <thead class="thead-inverse">
                        <tr>
                          <th>
                            Date
                          </th>
                          <th>
                            Action
                          </th>
                          <th>
                            Time
                          </th>
                          <th>
                            Location
                          </th>
                          <th>
                            Fieldworker Name
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($attendance_list as $row) {?>
                        <tr>
                          <td >
                            <?php  echo date("d-m-Y",strtotime($row['action_time']));?>
                          </td>
                          <td>
                            <?php  echo $row['attendance'];?>
                          </td>
                          <td>
                            <?php  echo date("g:i A",strtotime($row['action_time']));?>
                          </td>
                          <td>
                            <?php  if($row['location'] == "" OR $row['location'] == NULL) {
			                            		echo $row['location'] = "NA";
										} else {
											echo $row['location'];
										}?>
                          </td>
                          <td>
                            <?php  if($row['fieldworker_name'] == "" OR $row['fieldworker_name'] == NULL) {
			                            		echo $row['fieldworker_name'] = "NA";
										} else {
											echo $row['fieldworker_name'];
										}?>
                          </td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  </div>
<!-- <div class="row"> -->

<!-- <div class="col-md-3"> -->
<!-- </div> -->

<!-- <div class="col-md-6"> -->
<!-- <div class="card card-block p-b-0"> -->

<!-- <div class="text-xs-center m-b-2"> -->

<!-- <div id="attendance_list"> -->
<!-- <table class="table table-bordered datatable" id="table_id1"> -->
<!-- <thead class="thead-inverse"> -->

<!-- </thead> -->
<!-- <tbody> -->

<!-- <tr> 
<td style="text-align:left">
<b><h3><font style="color:blue">Fieldworker name</font></h3></b>
<!-- </td> 

<td style="text-align:left">
<b><h3><font style="color:blue"> Present</font></h3></b>
<!-- </td> -->
<!-- </tr> -->
 <?php //foreach ($attendance_list as $row) {?>
<!-- <tr> 
<td style="text-align:left">
// <?php //echo $row['worker_name'];?>
<!-- </td> 
<td style="text-align:left">
// <?php  //echo $row['attendance'];?>
<!-- </td> -->

<!-- </tr> -->
 <?php //}?>

<!-- </tbody> -->
<!-- </table> -->
<!-- </div> -->
<!-- <br> -->
<!-- <br> -->



<br>
</div>

</div>
</div>


</div>
</center>
</div>
</div></div>
<script src="<?php echo asset_url();?>vendor/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo asset_url();?>vendor/datatables/media/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo asset_url();?>vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js"></script>
<script>

$('.datatable').DataTable();

function update_dataTable(data,tableid) {
    
    var oTable = $("#"+tableid).dataTable();
    oTable.fnClearTable();
    
    $(data).each(function(index) {
    	  			var row = [];
                 row.push(data[index].date);
                 row.push(data[index].action);
                 row.push(data[index].time);
                 row.push(data[index].location);
                 row.push(data[index].fieldworker_name);
                 oTable.fnAddData(row);
                 });
}

function fieldworker_filter () {
    $.post("<?php echo base_url();?>admin/filter_fieldworker_attendance",{"admin_id": $('#fieldworker').val(),"month": $('#month').val()},function(data){
           tableid="table_id1";
           update_dataTable(data,tableid);
    							
           },'json');
    
}

function monthly_filter () {
    $.post("<?php echo base_url();?>admin/filter_fieldworker_attendance",{"month": $('#month').val(),"admin_id": $('#fieldworker').val()},function(data){
           tableid="table_id1";
           update_dataTable(data,tableid);
    							
           },'json');
    
}

</script>
